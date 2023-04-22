<?php

namespace App\Filament\Resources;

use App\Models\Program;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\ProgramResource\Pages;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('code')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Code')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('capacity')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Capacity')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('nta_level_id')
                        ->rules(['exists:nta_levels,id'])
                        ->required()
                        ->relationship('ntaLevel', 'name')
                        ->searchable()
                        ->placeholder('Nta Level')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('department_id')
                        ->rules(['exists:departments,id'])
                        ->required()
                        ->relationship('department', 'name')
                        ->searchable()
                        ->placeholder('Department')
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
                Tables\Columns\TextColumn::make('code')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('capacity')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('ntaLevel.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('department.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('nta_level_id')
                    ->relationship('ntaLevel', 'name')
                    ->indicator('NtaLevel')
                    ->multiple()
                    ->label('NtaLevel'),

                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->indicator('Department')
                    ->multiple()
                    ->label('Department'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProgramResource\RelationManagers\StudentsRelationManager::class,
            ProgramResource\RelationManagers\ComplaintsRelationManager::class,
            ProgramResource\RelationManagers\CoursesRelationManager::class,
            ProgramResource\RelationManagers\LecturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'view' => Pages\ViewProgram::route('/{record}'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
