<?php

namespace App\Livewire\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public string $model;

    public array $columns = [];

    public string $search = '';

    #[Url(as: 'per-page', keep: true)]
    public int $perPage = 10;

    public string $createLink = '';

    public string $editLink = '';

    public string $deleteLink = '';

    protected array $updatesQueryString = ['search', 'perPage'];

    public function mount(string $model, array $columns = [])
    {
        $this->model = $model;
        $this->columns = $columns;
    }

    public function render()
    {
        $query = $this->model::query()
            ->select($this->columns)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    foreach ($this->columns as $column) {
                        $query->orWhere($column, 'like', '%' . $this->search . '%');
                    }
                });
            })
            ->paginate($this->perPage);

        return view('livewire.admin.data-table', [
            'query' => $query,
        ]);
    }
}
