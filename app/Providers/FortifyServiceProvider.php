<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect(route('login'));
            }
        });
    }

    /**
     * Generate a unique throttle key based on various request attributes.
     *
     * @param \lluminate\Http\Request $request
     * @return string
     */
    protected function throttleKey(Request $request): string
    {
        $throttleKeyParts = [
            Str::lower(Fortify::username()),
            $request->ip(),
            $request->path(),
            $request->userAgent(),
            $request->httpHost(),
            $request->header('Accept'),
            $request->header('Referer'),
            $request->header('X-Requested-Width'),
            $request->bearerToken(),
        ];

        return hash('sha256', implode('|', array_filter($throttleKeyParts)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /** @var int $maxAttempts */
        $maxAttempts = 5;

        Fortify::authenticateUsing(function (Request $request) use ($maxAttempts) {
            $attributes = $request->validate([
                'email' => ['required', 'string', 'email', 'exists:users,email'],
                'password' => ['required', 'string']
            ]);

            $throttleKey = $this->throttleKey($request);

            if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
                event(new Lockout($request));
                $availableIn = RateLimiter::availableIn($throttleKey);

                return redirect()->back()->with('error', __('auth.throttle', ['seconds' => $availableIn]));
            }

            $user = User::whereEmail($attributes['email'])->first();

            if (!$user || !Hash::check($attributes['password'], $user->password)) {
                RateLimiter::hit($throttleKey);
                return redirect()->back()->with('error', __('auth.failed'));
            }

            if (!$user->is_active) {
                return redirect()->back()->with('error', __('auth.is_active'));
            }

            // (Optional) Check if 2FA is enabled for the user.
            // if ($user->two_factor_enabled) {
            // // Perform two-factor authentication checks here,
            // // for example, send OTP, verify code, and so on.
            // }

            RateLimiter::clear($throttleKey);

            return $user;
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            return view('auth.login');
        });

        RateLimiter::for('login', function (Request $request) use ($maxAttempts) {
            $throttleKey = $this->throttleKey($request);

            return Limit::perMinute($maxAttempts)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) use ($maxAttempts) {
            $throttleKey = $this->throttleKey($request);

            return Limit::perMinute($maxAttempts)->by($throttleKey . '|' . $request->session()->get('login.id'));
        });
    }
}
