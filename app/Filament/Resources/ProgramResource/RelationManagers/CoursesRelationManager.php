<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class CoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('code')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Code')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('credit')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Credit')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('elective')
                    ->rules(['in:0,1'])
                    ->searchable()
                    ->options([
                        '0' => '0',
                        '1' => '1',
                    ])
                    ->placeholder('Elective')
                    ->default('1')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('semester_id')
                    ->rules(['exists:semesters,id'])
                    ->relationship('semester', 'name')
                    ->searchable()
                    ->placeholder('Semester')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('department_id')
                    ->rules(['exists:departments,id'])
                    ->relationship('department', 'name')
                    ->searchable()
                    ->placeholder('Department')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('nta_level_id')
                    ->rules(['exists:nta_levels,id'])
                    ->relationship('ntaLevel', 'name')
                    ->searchable()
                    ->placeholder('Nta Level')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->limit(50),
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('credit'),
                Tables\Columns\TextColumn::make('elective')->enum([
                    '0' => '0',
                    '1' => '1',
                ]),
                Tables\Columns\TextColumn::make('semester.name')->limit(50),
                Tables\Columns\TextColumn::make('department.name')->limit(50),
                Tables\Columns\TextColumn::make('ntaLevel.name')->limit(50),
                Tables\Columns\TextColumn::make('program.name')->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('semester_id')->relationship(
                    'semester',
                    'name'
                ),

                MultiSelectFilter::make('department_id')->relationship(
                    'department',
                    'name'
                ),

                MultiSelectFilter::make('nta_level_id')->relationship(
                    'ntaLevel',
                    'name'
                ),

                MultiSelectFilter::make('program_id')->relationship(
                    'program',
                    'name'
                ),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
