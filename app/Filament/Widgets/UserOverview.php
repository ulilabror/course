<?php

namespace App\Filament\Widgets;

use App\Models\Kelas;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class UserOverview extends BaseWidget
{
    protected ?string $heading = 'Users';
 
protected ?string $description = 'An overview of some analytics.';
    protected function getStats(): array
    {
        return [
            Stat::make('Instruktor',  User::where('role', 'instruktor')->count()),
            Stat::make('Admin',  User::where('role', 'admin')->count()),
            Stat::make('Student',  User::where('role', 'student')->count()),
            Stat::make('Class', Kelas::count()),
        ];
    }
}
