<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users;

use App\Facades\Repositories\UserRepository;
use ArtisanBR\StarterPack\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Livewire\WithFileUploads;
use Throwable;

class UserForm extends Form
{
    use WithFileUploads;

    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $username = '';

    #[Validate('confirmed|string|nullable')]
    public ?string $new_password = null;

    #[Validate('required_with:new_password|string|nullable')]
    public ?string $new_password_confirmation = null;

    #[Validate('image|max:4096|nullable')]
    public ?TemporaryUploadedFile $avatar_upload = null;

    public array $roles = [];

    /**
     * @throws Throwable
     */
    public function save(User &$user = new User()): bool
    {
        $this->validate();

        $user = UserRepository::save($this->all(), $user);

        $this->new_password = $this->new_password_confirmation = null;

        return $user->id;
    }

    /**
     * @throws Throwable
     */
    public function delete(User &$user): bool
    {
        return UserRepository::delete($user);

        /*$this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');*/
    }
}
