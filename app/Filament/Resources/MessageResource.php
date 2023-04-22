<?php

namespace App\Filament\Resources;

use App\Models\Message;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\MessageResource\Pages;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'body';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    RichEditor::make('body')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Body')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('user_id')
                        ->rules(['exists:users,id'])
                        ->required()
                        ->relationship('user', 'name')
                        ->searchable()
                        ->placeholder('User')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('phone')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Phone')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('send_status')
                        ->rules(['in:0,1,2,3,4'])
                        ->nullable()
                        ->searchable()
                        ->options([
                            '0' => '0',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                        ])
                        ->placeholder('Send Status')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('type')
                        ->rules(['in:0,1'])
                        ->nullable()
                        ->searchable()
                        ->options([
                            '0' => '0',
                            '1' => '1',
                        ])
                        ->placeholder('Type')
                        ->default('1')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('body')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('user.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('phone')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('send_status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ]),
                Tables\Columns\TextColumn::make('type')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '0' => '0',
                        '1' => '1',
                    ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->indicator('User')
                    ->multiple()
                    ->label('User'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
