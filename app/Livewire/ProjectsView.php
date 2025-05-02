<?php

namespace App\Livewire;

use App\Enums\ProjectCategories;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Isolate;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsView extends Component
{
    use WithPagination;

    public Collection $tags;
    #[Url(as: 'category', keep: false)]
    public ?string $category = '';
    public array $categories = [];
    #[Url(as: 'tags', keep: false)]
    public string $tagsQuery = '';
    public ?array $selectedTags = [];
    #[Url(as: 'search', keep: false)]
    public ?string $search = '';

    public function mount(): void
    {
        $this->tags = Tag::pluck('name');
        $this->categories = ProjectCategories::values();
    }

    public function updatedSelectedTags(): void
    {
        $this->tagsQuery = implode(',', $this->selectedTags);
        $this->resetPage();
    }

    public function updatedTagsQuery(): void
    {
        $this->selectedTags = array_filter(explode(',', $this->tagsQuery));
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function search(): void
    {
        $this->resetPage();
    }

    #[Computed()]
    #[Isolate]
    public function getProjectsProperty()
    {
        return Project::query()
            ->select([
                'id',
                'title',
                'description',
                'slug',
                'category',
                'published_at',
                'updated_at'
            ])
            ->when($this->category, function ($query) {
                $query->where('category', $this->category);
            })
            ->when($this->selectedTags, function ($query) {
                foreach ($this->selectedTags as $tag) {
                    $query->whereHas('tags', function ($query) use ($tag) {
                        $query->where('name', $tag);
                    });
                }
            })
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->whereIsPublished(true)
            ->with('tags')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.projects-view');
    }
}
