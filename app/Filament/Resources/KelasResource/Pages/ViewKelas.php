<?php
namespace App\Filament\Resources\KelasResource\Pages;

use App\Filament\Resources\KelasResource;
use Filament\Resources\Pages\Page;
use App\Models\Kelas;

class ViewKelas extends Page
{
    protected static string $resource = KelasResource::class; // Rujukan ke resource utama

    public Kelas $record; // Properti untuk merepresentasikan data kelas

    public function mount(Kelas $record)
    {
        $this->record = $record;
    }

    protected function getViewData(): array
    {
        return [
            'kelas' => $this->record,
        ];
    }

    protected static string $view = 'filament.resources.kelas-resource.pages.view-kelas';
}
