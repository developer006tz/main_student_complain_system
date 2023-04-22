<?php

namespace App\Filament\Resources;

use App\Models\Student;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\StudentResource\Pages;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'date_of_birth';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
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

                    Select::make('country_id')
                        ->rules(['exists:countries,id'])
                        ->required()
                        ->relationship('country', 'name')
                        ->searchable()
                        ->placeholder('Country')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('gender')
                        ->rules(['in:male,female'])
                        ->required()
                        ->searchable()
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                        ])
                        ->placeholder('Gender')
                        ->default('male')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('date_of_birth')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Date Of Birth')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('admission_id')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Admission Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('maritial_status')
                        ->rules(['in:single,maried'])
                        ->required()
                        ->searchable()
                        ->options([
                            'single' => 'Single',
                            'maried' => 'Maried',
                        ])
                        ->placeholder('Maritial Status')
                        ->default('single')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    FileUpload::make('photo')
                        ->rules(['file'])
                        ->nullable()
                        ->image()
                        ->placeholder('Photo')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('status')
                        ->rules(['in:1,0'])
                        ->required()
                        ->searchable()
                        ->options([
                            '1' => '1',
                            '0' => '0',
                        ])
                        ->placeholder('Status')
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
                Tables\Columns\TextColumn::make('user.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('department.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('program.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('country.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('gender')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('admission_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('maritial_status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'single' => 'Single',
                        'maried' => 'Maried',
                    ]),
                Tables\Columns\ImageColumn::make('photo')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        '1' => '1',
                        '0' => '0',
                    ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->indicator('User')
                    ->multiple()
                    ->label('User'),

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

                SelectFilter::make('country_id')
                    ->relationship('country', 'name')
                    ->indicator('Country')
                    ->multiple()
                    ->label('Country'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StudentResource\RelationManagers\EnrollmentsRelationManager::class,
            StudentResource\RelationManagers\ComplaintsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
