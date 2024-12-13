<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $label = 'Pengguna';

    protected static ?string $navigationGroup = 'User Manajement';

    protected static ?string $pluralLabel = 'Pengguna';

    public static function shouldRegisterNavigation(): bool
{
    $user = Auth::user(); // Dapatkan pengguna yang sedang login

    if($user->role === "admin"){
        return true;
    }
    // Hanya tampilkan navigasi jika pengguna bukan student
    return  false;
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->label('Peran')
                    ->options([
                        'instruktor' => 'Instruktor',
                        'student' => 'Student',
                        'admin' => 'Admin'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser) // Password hanya required saat create
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)) // Hash password sebelum disimpan
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Peran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter Peran')
                    ->options([ 
                        'instruktor' => 'Instruktor',
                        'biasa' => 'Biasa',
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}