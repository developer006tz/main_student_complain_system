<?php

namespace App\Filament\Resources;

use App\Models\Course;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\CourseResource\Pages;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

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

                    TextInput::make('credit')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Credit')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('elective')
                        ->rules(['in:0,1'])
                        ->required()
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
                        ->nullable()
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
                        ->required()
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
                        ->required()
                        ->relationship('ntaLevel', 'name')
                        ->searchable()
                        ->placeholder('Nta Level')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('program_id')
                        ->rules(['exists:programs,id'])
                        ->required()
                        ->relationship('program', 'name')
                        ->searchable()
                        ->placeholder('Program')
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
                Tables\Columns\TextColumn::make('credit')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('elective')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '0' => '0',
                        '1' => '1',
                    ]),
                Tables\Columns\TextColumn::make('semester.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('department.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('ntaLevel.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('program.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('semester_id')
                    ->relationship('semester', 'name')
                    ->indicator('Semester')
                    ->multiple()
                    ->label('Semester'),

                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->indicator('Department')
                    ->multiple()
                    ->label('Department'),

                SelectFilter::make('nta_level_id')
                    ->relationship('ntaLevel', 'name')
                    ->indicator('NtaLevel')
                    ->multiple()
                    ->label('NtaLevel'),

                SelectFilter::make('program_id')
                    ->relationship('program', 'name')
                    ->indicator('Program')
                    ->multiple()
                    ->label('Program'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CourseResource\RelationManagers\EnrollmentsRelationManager::class,
            CourseResource\RelationManagers\ComplaintsRelationManager::class,
            CourseResource\RelationManagers\LecturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
