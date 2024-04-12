<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users;

use ArtisanBR\AbstractTallCrud\Foundation\CrudActions\CrudActions;
use ArtisanBR\AbstractTallCrud\Livewire\AbstractModelListComponent;
use ArtisanBR\StarterPack\Filters\UserTableFilter;
use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Repositories\UserRepository;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Session;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class ListUser extends AbstractModelListComponent
{
    use WithPagination;

    public string $title = 'Listar Usuários';

    public ?string $modelClass = User::class;

    protected string $repositoryClass = UserRepository::class;

    #[Session]
    public UserTableFilter $filter;

    //public null|string|bool $filterSession = true;

    #[Session]
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    /*public function mount(): void
    {
        if (empty($this->filter ?? null)) {
            $this->filter = new UserTableFilter();
        }
        //$this->filter = new UserTableFilter();
    }*/

    // Clear filters
    public function actions(): array
    {

        return [
            CrudActions::deleteButton(),
            CrudActions::filterButton()
                ->badge($this->filter->appliedFiltersCount() > 0 ? $this->filter->appliedFiltersCount() : null),
            CrudActions::search(),
            CrudActions::button('create')
                ->label('Novo Usuário')
                ->link(route('dashboard.users.create'))
                ->class('btn-primary')
                ->icon('o-user-plus')
                ->can('create', User::class),
        ];
    }

    // Table headers
    public function headers(): array
    {
        return [
            ...parent::headers(), //ID
            ['key' => 'avatar', 'label' => 'Avatar', 'class' => 'w-11 p-1', 'sortable' => false],
            ['key' => 'name', 'label' => 'Nome', 'class' => 'w-64'],
            ['key' => 'username', 'label' => 'Apelido', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail'],
            ['key' => 'role_name', 'label' => 'Privilégios', 'sortable' => false],
        ];
    }

    /**
     * User List
     */
    public function rows(): LengthAwarePaginator|array
    {

        $users = User::query()
            ->orderBy(...array_values($this->sortBy))
            ->when(! blank($this->search), function (Builder $query) {
                $query->whereAny(['name'], 'like', '%'.$this->search.'%');
            });

        $users = $this->filter->applyFilters($users);

        return $users->paginate(15);
    }

    #[Title('Gerenciar Usuários')]
    public function render(): View|Closure|string
    {
        return view('starter-pack::livewire.pages.dashboard.users.list-users')/*->with([
            'rows'    => $this->rows(),
            'headers' => $this->headers(),
        ])*/;

    }
}
