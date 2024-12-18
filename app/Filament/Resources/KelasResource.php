<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelasResource\Pages;
use App\Filament\Resources\KelasResource\RelationManagers\MateriRelationManager;
use App\Models\Kelas;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function canCreate(): bool
{
   
    /** @var App\Models\User $currentUser */
    $currentUser = Auth::user();
    $record = request()->route('record');

    // Pastikan ada pengguna yang sedang login
    if (!$currentUser) {
        return false;
    }

    // Jika ada record dan pengguna bukan instruktur dan bukan pemilik kelas, maka tidak bisa membuat
    if (!$currentUser->isInstructor()) {
        return false; // Tidak bisa membuat jika bukan instruktur atau pemilik
    }

    // Jika tidak ada kondisi yang menghalangi, kembalikan true
    return true;
}


    public static function form(Form $form): Form
    {
        /** @var App\Models\User $currentUser */
        $currentUser = Auth::user();
        $record = request()->route('record');

        // Jika pengguna bukan instruktur dan bukan pemilik kelas, maka form kosong
        if ($record && ($currentUser instanceof User) && 
        !$currentUser->isInstructor() && $currentUser->id !== $record->created_by) {
        return $form->schema([]); // Form kosong jika bukan pemilik atau instruktur
    }

        return $form->schema([
            Section::make('Informasi Utama')->schema([
                TextInput::make('title')->required()->label(__('Judul')),
                RichEditor::make('description')->required()->label(__('Deskripsi')),
                Toggle::make('is_visible')->default(true)->label(__('Terlihat')),
                Select::make('created_by')
                    ->relationship('user', 'name')
                    ->required()
                    ->label(__('Dibuat Oleh'))
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        /** @var App\Models\User $currentUser */
        $currentUser = Auth::user();
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable()->label(__('Judul')),
                TextColumn::make('user.name')->sortable()->searchable()->label(__('Dibuat Oleh')),
                IconColumn::make('is_visible')->boolean()->label(__('Terlihat')),
                TextColumn::make('created_at')->dateTime()->sortable()->label(__('Dibuat pada')),
                TextColumn::make('updated_at')->dateTime()->sortable()->label(__('Diupdate pada')),
            ])
            ->actions([
                /** @var App\Models\User $user */
                EditAction::make()->visible(fn (Kelas $record) => Auth::user() && (
                    Auth::id() === $record->created_by || $currentUser->isInstructor() || $currentUser->isAdmin()
                )),
                Tables\Actions\DeleteAction::make()->visible(fn (Kelas $record) => Auth::user() && (
                    Auth::id() === $record->created_by || $currentUser->isInstructor() || $currentUser->isAdmin()
                )),
                Action::make('view')
                    ->label(__('Lihat Kelas'))
                    ->icon('heroicon-o-eye')
                    ->url(fn (Kelas $record) => route('filament.admin.resources.kelas.view', ['record' => $record->id])),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MateriRelationManager::class,
        ];
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListKelas::route('/'),
        'create' => Pages\CreateKelas::route('/create'),
        'edit' => Pages\EditKelas::route('/{record}/edit'),
        'view' => Pages\ViewKelas::route('/{record}/view'), // Tambahkan ini
    ];
}

}
