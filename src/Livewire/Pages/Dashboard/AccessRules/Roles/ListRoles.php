<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Roles;

use ArtisanBR\AbstractTallCrud\Foundation\CrudActions\CrudActions;
use ArtisanBR\AbstractTallCrud\Livewire\AbstractModelListComponent;
use ArtisanBR\AbstractTallCrud\Traits\AutoMountModel;
use ArtisanBR\AbstractTallCrud\Traits\WithModel;
use ArtisanBR\StarterPack\Filters\RoleTableFilter;
use ArtisanBR\StarterPack\Http\Resources\RolePermissionChoiceResource;
use ArtisanBR\StarterPack\Models\Permission;
use ArtisanBR\StarterPack\Models\Role;
use ArtisanBR\StarterPack\Repositories\AccessRules\RoleRepository;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Session;
use Livewire\Attributes\Title;
use Livewire\Features\SupportEvents\BaseOn;
use Livewire\WithPagination;

class ListRoles extends AbstractModelListComponent
{
    use AutoMountModel, WithModel, WithPagination;

    public string $title = 'Listar Grupos';

    public ?string $modelClass = Role::class;

    protected string $repositoryClass = RoleRepository::class;

    public bool $showFormModal = false;

    public bool $readonly = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    #[Session]
    public RoleTableFilter $filter;

    public Role $model;

    public RoleForm $form;

    public array $permissions = [];

    public function mount(): void
    {
        $this->permissions = RolePermissionChoiceResource::collection(Permission::take(15)->get())->toArray(request());
    }

    public function show($id): void
    {
        $this->setModel($this->modelClass::findOrFail($id), true);
        $this->readonly = true;
        $this->showFormModal = true;
    }

    public function edit($id = null): void
    {
        $this->form->reset();
        $this->setModel($this->modelClass::findOrNew($id), true);
        $this->form->fill([
            'permissions' => $this->model->permissions->pluck('id')->toArray(),
        ]);
        $this->permissions = RolePermissionChoiceResource::collection($this->model->permissions)->toArray(request());
        $this->readonly = false;
        $this->showFormModal = true;
    }

    public function create(): void
    {
        $this->edit();
    }

    public function save(): void
    {
        if ($this->form->validate() && $this->repository->save($this->form->toArray(), $this->model)) {
            $this->toast()->success('Grupo salvo com sucesso!')->send();
            $this->showFormModal = false;
        }
    }

    public function actions(): array
    {
        return [
            CrudActions::deleteButton(),
            CrudActions::search(),
            CrudActions::button('create')
                ->label('Novo Grupo')
                ->wireClick('create()')
                ->class('btn btn-primary'),
        ];
    }

    // Table headers
    public function headers(): array
    {
        return [
            ...parent::headers(), //ID
            ['key' => 'display_name', 'label' => 'Título', 'class' => 'w-64'],
            ['key' => 'name', 'label' => 'Apelido', 'class' => 'w-48'],
            ['key' => 'created_at', 'label' => 'Criado em'],
        ];
    }

    /**
     * User List
     */
    #[BaseOn('table-refresh')]
    public function rows(): LengthAwarePaginator|array
    {

        $rows = $this->modelClass::query()->orderBy(...array_values($this->sortBy));

        if (! empty($this->search)) {
            $rows = $rows->whereAny(['name', 'display_name'], 'like', '%'.$this->search.'%');
        }

        return $rows->paginate(15);
    }

    public function searchPermissions(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Permission::whereIn('id', $this->form->permissions)->get();

        $permissionsSearch = Permission::query()
            ->whereAny(['name', 'display_name', 'description'], 'like', "%$value%")
            ->take(10)
            ->orderBy('name')
            ->get()
            ->merge($this->model->permissions);

        $this->permissions = RolePermissionChoiceResource::collection($permissionsSearch)->toArray(request());
    }

    public function modelPermissions()
    {
        return $this->model->permissions;
    }

    #[Title('Gerenciar Grupos de Usuários')]
    public function render(): View|Closure|string
    {

        //dd(MenuBuilder::render('sidebar'));

        return view('starter-pack::livewire.pages.dashboard.access-rules.roles.list-roles');

    }
}
