<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentActivityWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Latest Contact Messages';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactSubmission::latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn($s) => ucfirst($s)),
                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->message),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger'  => 'unread',
                        'success' => 'replied',
                        'warning' => 'read',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->visible(fn($record) => $record->status === 'unread')
                    ->action(fn($record) => $record->update(['status' => 'read'])),
            ]);
    }
}
