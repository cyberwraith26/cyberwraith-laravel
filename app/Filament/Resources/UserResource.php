<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Profile')->schema([
                Forms\Components\TextInput::make('name')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()->required()->maxLength(255),
                Forms\Components\Select::make('role')
                    ->options(['user' => 'User', 'admin' => 'Admin'])
                    ->required(),
                Forms\Components\Select::make('tier')
                    ->options(['free' => 'Free', 'pro' => 'Pro', 'agency' => 'Agency'])
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Password')->schema([
                Forms\Components\TextInput::make('password')
                    ->password()->dehydrateStateUsing(fn($s) => bcrypt($s))
                    ->dehydrated(fn($s) => filled($s))
                    ->required(fn(string $context) => $context === 'create')
                    ->label('New Password'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('role')
                    ->colors(['primary' => 'admin', 'secondary' => 'user']),
                Tables\Columns\BadgeColumn::make('tier')
                    ->colors([
                        'success' => 'agency',
                        'warning' => 'pro',
                        'secondary' => 'free',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options(['user' => 'User', 'admin' => 'Admin']),
                Tables\Filters\SelectFilter::make('tier')
                    ->options(['free' => 'Free', 'pro' => 'Pro', 'agency' => 'Agency']),
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
