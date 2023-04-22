<?php

namespace App\Filament\Resources;

use App\Models\Complaint;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\ComplaintResource\Pages;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('complain_type_id')
                        ->rules(['exists:complain_types,id'])
                        ->required()
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
                        ->required()
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
                        ->nullable()
                        ->relationship('department', 'name')
                        ->searchable()
                        ->placeholder('Department')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('program_id')
                        ->rules(['exists:programs,id'])
                        ->nullable()
                        ->relationship('program', 'name')
                        ->searchable()
                        ->placeholder('Program')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('course_id')
                        ->rules(['exists:courses,id'])
                        ->nullable()
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
                        ->nullable()
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
                        ->nullable()
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
                        ->nullable()
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
                        ->required()
                        ->placeholder('Description')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('solution')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Solution')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('status')
                        ->rules(['in:0,1,2,3,4'])
                        ->required()
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
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('complainType.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('student.date_of_birth')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('department.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('program.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('course.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('lecture.image')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('semester.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('academicYear.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('description')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('solution')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('date')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('complain_type_id')
                    ->relationship('complainType', 'name')
                    ->indicator('ComplainType')
                    ->multiple()
                    ->label('ComplainType'),

                SelectFilter::make('student_id')
                    ->relationship('student', 'date_of_birth')
                    ->indicator('Student')
                    ->multiple()
                    ->label('Student'),

                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->indicator('Department')
                    ->multiple()
                    ->label('Department'),

                SelectFilter::make('program_id')
                    ->relationship('program', 'name')
                    ->indicator('Program')
                    ->multiple()
                    ->label('Program'),

                SelectFilter::make('course_id')
                    ->relationship('course', 'name')
                    ->indicator('Course')
                    ->multiple()
                    ->label('Course'),

                SelectFilter::make('lecture_id')
                    ->relationship('lecture', 'image')
                    ->indicator('Lecture')
                    ->multiple()
                    ->label('Lecture'),

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
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'view' => Pages\ViewComplaint::route('/{record}'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}
