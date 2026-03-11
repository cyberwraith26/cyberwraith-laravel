<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Contact Messages';
    protected static ?string $navigationGroup = 'Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Message Details')->schema([
                Forms\Components\TextInput::make('name')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('type')->disabled(),
                Forms\Components\Select::make('status')
                    ->options(['unread' => 'Unread', 'read' => 'Read', 'replied' => 'Replied'])
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Message')->schema([
                Forms\Components\Textarea::make('message')->disabled()->rows(6),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn($s) => ucfirst($s)),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger'  => 'unread',
                        'success' => 'replied',
                        'warning' => 'read',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['unread' => 'Unread', 'read' => 'Read', 'replied' => 'Replied']),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->visible(fn($record) => $record->status === 'unread')
                    ->action(fn($record) => $record->update(['status' => 'read'])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'unread')->count() ?: null;
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListContactSubmissions::route('/'),
            'edit'   => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
