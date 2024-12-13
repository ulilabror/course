<?php
namespace App\Filament\Resources\KelasResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MateriRelationManager extends RelationManager
{
    protected static string $relationship = 'materi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Judul Materi'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('content')
                    ->label(__('Konten Materi'))
                    ->required()
                    ->maxLength(65535)
                    // ->disableToolbarButtons(['attachFiles']) // Opsional: Disable file upload
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('Judul Materi')),
                Tables\Columns\TextColumn::make('content')->label(__('Konten Materi'))
                    ->limit(50), // Batasi panjang teks yang ditampilkan
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
