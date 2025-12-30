<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public const ROLE_ADMIN = 'admin';
    public const ROLE_PANORAMA_MANAGER = 'panorama_manager';

    public const ROLES = [
        self::ROLE_ADMIN => 'Администратор',
        self::ROLE_PANORAMA_MANAGER => 'Менеджер панорам',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if user is panorama manager
     */
    public function isPanoramaManager(): bool
    {
        return $this->role === self::ROLE_PANORAMA_MANAGER;
    }

    /**
     * Check if user has access to a specific section
     */
    public function hasAccessTo(string $section): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        $accessMap = [
            'panoramas' => [self::ROLE_PANORAMA_MANAGER],
        ];

        return isset($accessMap[$section]) && in_array($this->role, $accessMap[$section]);
    }

    /**
     * Get role display name
     */
    public function getRoleName(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
