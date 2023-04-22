<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
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
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.date_of_birth')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('course.name')->limit(50),
                Tables\Columns\TextColumn::make('semester.name')->limit(50),
                Tables\Columns\TextColumn::make('academicYear.name')->limit(50),
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

                MultiSelectFilter::make('student_id')->relationship(
                    'student',
                    'date_of_birth'
                ),

                MultiSelectFilter::make('course_id')->relationship(
                    'course',
                    'name'
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
