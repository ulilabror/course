<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'kelas_id',
        'created_by',
    ];

    protected static function booted()
    {
        static::creating(function ($materi) {
            if (!$materi->created_by) {
                $materi->created_by = Auth::id();
            }
        });
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
