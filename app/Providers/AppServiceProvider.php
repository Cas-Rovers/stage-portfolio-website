<?php

namespace App\Providers;

use App\Enums\Admin\SystemRoles;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrls();
        $this->configureVite();
        $this->configureDates();
        $this->configureRolesAndPermissions();
    }

    protected function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );
    }

    protected function configureModels(): void
    {
        Model::shouldBeStrict();
    }

    protected function configureUrls(): void
    {
        URL::forceHttps();
    }

    protected function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    protected function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    protected function configureRolesAndPermissions(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole(SystemRoles::SUPER_ADMIN->value) ? true : null;
        });
    }
}
