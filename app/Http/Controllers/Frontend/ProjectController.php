<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ProjectCategories;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Shows you the project page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request): View|Factory|Application
    {
        $tags = Tag::select(['id', 'name'])->get();
        $categories = ProjectCategories::values();
        $projectsQuery = Project::select([
            'id',
            'title',
            'description',
            'slug',
            'category',
            'published_at',
            'updated_at'
        ])->whereIsPublished(true);

        if ($request->filled('tags')) {
            $tagNames = is_array($request->input('tags')) ? $request->input('tags') : [$request->input('tags')];

            $projectsQuery->whereHas('tags', function ($query) use ($tagNames) {
                $query->whereIn('name', $tagNames);
            });
        }

        if ($request->filled('category')) {
            $projectsQuery->where('category', $request->input('category'));
        }

        $projects = $projectsQuery->with('tags')->get();

        return view('pages.projects.index', [
            'tags' => $tags,
            'categories' => $categories,
            'projects' => $projects,
        ]);
    }

    public function show(string $slug): View|Factory|Application
    {
        $project = Project::whereSlug($slug)->firstOrFail();
        return view('pages.projects.show', [
            'project' => $project,
        ]);
    }
}
