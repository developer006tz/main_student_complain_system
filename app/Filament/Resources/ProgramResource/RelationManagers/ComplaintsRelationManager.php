<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class ComplaintsRelationManager extends RelationManager
{
    protected static string $relationship = 'complaints';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('complain_type_id')
                    ->rules(['exists:complain_types,id'])
                    ->relationship('complainType', 'name')
                    ->searchable()
                    ->placeholder('Complain Type')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('student_id')
                    ->rules(['exists:students,id'])
                    ->relationship('student', 'date_of_birth')
                    ->searchable()
                    ->placeholder('Student')
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

                Select::make('course_id')
                    ->rules(['exists:courses,id'])
                    ->relationship('course', 'name')
                    ->searchable()
                    ->placeholder('Course')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('lecture_id')
                    ->rules(['exists:lectures,id'])
                    ->relationship('lecture', 'image')
                    ->searchable()
                    ->placeholder('Lecture')
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

                Select::make('academic_year_id')
                    ->rules(['exists:academic_years,id'])
                    ->relationship('academicYear', 'name')
                    ->searchable()
                    ->placeholder('Academic Year')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('description')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Description')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('solution')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Solution')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DatePicker::make('date')
                    ->rules(['date'])
                    ->placeholder('Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('status')
                    ->rules(['in:0,1,2,3,4'])
                    ->searchable()
                    ->options([
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ])
                    ->placeholder('Status')
                    ->default('0')
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
                Tables\Columns\TextColumn::make('complainType.name')->limit(50),
                Tables\Columns\TextColumn::make('student.date_of_birth')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('department.name')->limit(50),
                Tables\Columns\TextColumn::make('program.name')->limit(50),
                Tables\Columns\TextColumn::make('course.name')->limit(50),
                Tables\Columns\TextColumn::make('lecture.image')->limit(50),
                Tables\Columns\TextColumn::make('semester.name')->limit(50),
                Tables\Columns\TextColumn::make('academicYear.name')->limit(50),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('solution')->limit(50),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('status')->enum([
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ]),
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

                MultiSelectFilter::make('complain_type_id')->relationship(
                    'complainType',
                    'name'
                ),

                MultiSelectFilter::make('student_id')->relationship(
                    'student',
                    'date_of_birth'
                ),

                MultiSelectFilter::make('department_id')->relationship(
                    'department',
                    'name'
                ),

                MultiSelectFilter::make('program_id')->relationship(
                    'program',
                    'name'
                ),

                MultiSelectFilter::make('course_id')->relationship(
                    'course',
                    'name'
                ),

                MultiSelectFilter::make('lecture_id')->relationship(
                    'lecture',
                    'image'
                ),

                MultiSelectFilter::make('semester_id')->relationship(
                    'semester',
                    'name'
                ),

                MultiSelectFilter::make('academic_year_id')->relationship(
                    'academicYear',
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
