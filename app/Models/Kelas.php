<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_visible',
        'created_by',
    ];

    // Relasi dengan model User (Instruktur)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan model Materi
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    // Optional: Scope untuk memfilter kelas yang visible
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

     protected $casts = [
        'is_visible' => 'boolean',
    ];
}