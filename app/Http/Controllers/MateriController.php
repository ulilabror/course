<?php
namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show($id)
    {
        // Ambil materi spesifik
        $materi = Materi::with('kelas')->findOrFail($id);

        // Ambil nama kelas
        $kelasName = $materi->kelas->title ?? 'Tanpa Kelas';

        // Ambil semua materi dalam kelas yang sama dengan pagination
        $materiList = Materi::where('kelas_id', $materi->kelas_id)
                            ->paginate(5);

        return view('materi.show', compact('materi', 'kelasName', 'materiList'));
    }
}
