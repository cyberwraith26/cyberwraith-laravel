<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentUsersWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Recent Signups';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('tier')
                    ->colors([
                        'success' => 'agency',
                        'warning' => 'pro',
                        'secondary' => 'free',
                    ]),
                Tables\Columns\BadgeColumn::make('role')
                    ->colors([
                        'primary' => 'admin',
                        'secondary' => 'user',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->url(fn($record) => "/admin/users/{$record->id}/edit")
                    ->icon('heroicon-m-pencil'),
            ]);
    }
}
