<?php

namespace App\Filament\Resources;

use App\Models\Enrollment;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\EnrollmentResource\Pages;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('student_id')
                        ->rules(['exists:students,id'])
                        ->required()
                        ->relationship('student', 'date_of_birth')
                        ->searchable()
                        ->placeholder('Student')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('course_id')
                        ->rules(['exists:courses,id'])
                        ->required()
                        ->relationship('course', 'name')
                        ->searchable()
                        ->placeholder('Course')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('semester_id')
                        ->rules(['exists:semesters,id'])
                        ->required()
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
                        ->required()
                        ->relationship('academicYear', 'name')
                        ->searchable()
                        ->placeholder('Academic Year')
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
                Tables\Columns\TextColumn::make('student.date_of_birth')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('course.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('semester.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('academicYear.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('student_id')
                    ->relationship('student', 'date_of_birth')
                    ->indicator('Student')
                    ->multiple()
                    ->label('Student'),

                SelectFilter::make('course_id')
                    ->relationship('course', 'name')
                    ->indicator('Course')
                    ->multiple()
                    ->label('Course'),

                SelectFilter::make('semester_id')
                    ->relationship('semester', 'name')
                    ->indicator('Semester')
                    ->multiple()
                    ->label('Semester'),

                SelectFilter::make('academic_year_id')
                    ->relationship('academicYear', 'name')
                    ->indicator('AcademicYear')
                    ->multiple()
                    ->label('AcademicYear'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'view' => Pages\ViewEnrollment::route('/{record}'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }
}
