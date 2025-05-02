<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectCategories;
use App\Helpers\SanitizeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        $projectClass = Project::class;

        return view('admin.pages.projects.index', [
            'projectClass' => $projectClass,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        $projectCategories = ProjectCategories::values();
        $projectTags = Tag::select(['id', 'name'])->get();

        return view('admin.pages.projects.create', [
            'projectCategories' => $projectCategories,
            'projectTags' => $projectTags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create([
            'title' => $request->input('title'),
            'description' => SanitizeHelper::cleanHtml($request->input('description')),
            'category' => $request->input('category'),
            'is_published' => $request->boolean('is_published'),
        ]);

        $project->tags()->attach($request->input('tags'));

        if ($request->hasFile('main_image')) {
            $project->addMedia($request->file('main_image'))->toMediaCollection('main_image');
        }

        collect($request->file('gallery', []))
            ->each(function ($file) use ($project) {
                $project->addMedia($file)->toMediaCollection('gallery');
            });

        return redirect()->route('admin.projects.index')->with('message', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View|Factory|Application
    {
        $tags = Tag::select('id', 'name')->get();
        $projectCategories = ProjectCategories::values();

        return view('admin.pages.projects.edit', [
            'project' => $project,
            'tags' => $tags,
            'projectCategories' => $projectCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update([
            'title' => $request->input('title'),
            'description' => SanitizeHelper::cleanHtml($request->input('description')),
            'category' => $request->input('category'),
            'is_published' => $request->boolean('is_published'),
        ]);

        $project->tags()->sync($request->input('tags'));

        if ($request->hasFile('main_image')) {
            $project->addMedia($request->file('main_image'))->toMediaCollection('main_image');
        }

        if ($request->hasFile('gallery')) {
            collect($request->file('gallery', []))->each(function (UploadedFile $file) use ($project) {
                $project->addMedia($file)->toMediaCollection('gallery');
            });
        }

        return redirect()->route('admin.projects.index')->with('success', __('validation.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', __('validation.success.delete'));
    }

    public function storeMedia(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        // Validate the image uploads
        $request->validate([
            'main_image' => 'nullable|image|max:2048',
            'gallery.*'  => 'nullable|image|max:2048',
        ]);

        // Handle Main Image Upload
        if ($request->hasFile('main_image')) {
            $project->addMedia($request->file('main_image'))->toMediaCollection('main_image');
        }

        // Handle Gallery Images Upload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $project->addMedia($file)->toMediaCollection('gallery');
            }
        }

        return back()->with('message', 'Media uploaded successfully');
    }

    public function destroyMedia(Media $media): RedirectResponse
    {
        $media->delete();
        return back()->with('message', 'Media item deleted successfully.');
    }
}
