<?php 

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan 'role' ada di sini
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi dengan model Kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'created_by');
    }

    // Relasi dengan model Materi
    public function materi()
    {
        return $this->hasMany(Materi::class, 'created_by');
    }

    /**
     * Cek apakah user memiliki role tertentu.
     *
     * @param string|array $roles
     * @return bool
     */
    public function hasRole(string|array $roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }

        return $this->role === $roles;
    }

    /**
     * Cek apakah user adalah instruktur.
     */
    public function isInstructor(): bool
    {
        return $this->hasRole('instruktor');
    }

    /**
     * Cek apakah user adalah student.
     */
    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
    /**
     * Cek apakah user bisa mengakses panel Filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Contoh kondisi tambahan, misalnya berbasis email atau role
        return true;//str_ends_with($this->email, '@std.umk.ac.id');
    }
}
