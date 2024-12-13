<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Materi;

class KelasMateri extends Component
{
    public $materiContent = null;

    protected $listeners = ['showMateri'];

    public function showMateri($materiId)
    {
        $materi = Materi::find($materiId);

        if ($materi) {
            $this->materiContent = [
                'title' => $materi->title,
                'content' => $materi->content,
            ];
        } else {
            $this->materiContent = null; // Reset jika materi tidak ditemukan
        }
    }

    public function render()
    {
        return view('livewire.kelas-materi');
    }
}
