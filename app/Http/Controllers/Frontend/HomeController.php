<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;

class HomeController extends Controller
{
    /**
     * Shows you the home page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function home(): View|Factory|Application
    {
        $skills = Skill::get(['id', 'name', 'icon_data']);
        $personImage = Vite::asset('resources/assets/frontend/media/images/Person.png');
        return view('pages.welcome', [
            'skills' => $skills,
            'personImage' => $personImage,
        ]);
    }
}
