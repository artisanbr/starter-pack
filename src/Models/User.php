<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use ArtisanBR\StarterPack\Database\Factories\UserFactory;
use Buglinjo\LaravelWebp\Exceptions\CwebpShellExecutionFailed;
use Buglinjo\LaravelWebp\Exceptions\DriverIsNotSupportedException;
use Buglinjo\LaravelWebp\Exceptions\ImageMimeNotSupportedException;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\Uid\Ulid;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'new_password',
        'username',
        'avatar_url',
        'avatar_upload',
        'data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'new_password'      => 'hashed',
            'username'          => 'string',
            'avatar_url'        => 'string',
            'avatar_file'       => 'string',
            'gravatar'          => 'string',
            'data'              => 'object',
        ];
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): UserFactory|Factory
    {
        return UserFactory::new();
    }

    //region Attributes
    protected function gravatar(): Attribute
    {
        //$hash = md5(strtolower(trim($this->attributes['email'])));

        return Attribute::make(
            get: fn ($value, array $attributes) => ($attributes['email'] ?? false) ? '//www.gravatar.com/avatar/'.md5(strtolower(trim($attributes['email']))) : fake()->imageUrl(width: 150, height: 150, word: 'Avatar'),
        );
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => $value ?? $this->gravatar,
            set: fn ($value) => $value,
        );
    }

    protected function avatarFile(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                $avatarUrl = str($attributes['avatar_url']);

                return $avatarUrl->startsWith('/storage/') ? $avatarUrl->replace('/storage/', '') : $avatarUrl;
            }
        );
    }

    protected function setNewPasswordAttribute($value): void
    {
        if (! blank($value)) {
            $this->password = Hash::make($value);
        }
    }

    /**
     * @throws CwebpShellExecutionFailed
     * @throws ImageMimeNotSupportedException
     * @throws DriverIsNotSupportedException
     */
    protected function setAvatarUploadAttribute(?UploadedFile $value = null): void
    {
        if (! blank($value)) {
            $webp = Webp::make($value);

            $publicStorage = Storage::disk('public');

            $webpName = Ulid::generate().'.webp';
            $webpRelativePath = "avatars/{$webpName}";

            $webpUploadPath = $publicStorage->path($webpRelativePath);

            if ($webp->save($webpUploadPath, 100)) {

                if (! empty($this->avatar_url) && $publicStorage->exists($this->avatar_file)) {
                    $publicStorage->delete($this->avatar_file);
                }

                $this->avatar_url = '/storage/'.$webpRelativePath;

            }
        }

    }
    //endregion
}
