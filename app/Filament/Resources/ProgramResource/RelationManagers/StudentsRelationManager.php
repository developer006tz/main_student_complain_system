<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $recordTitleAttribute = 'date_of_birth';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('user_id')
                    ->rules(['exists:users,id'])
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
                    ->relationship('department', 'name')
                    ->searchable()
                    ->placeholder('Department')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('country_id')
                    ->rules(['exists:countries,id'])
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
                    ->placeholder('Date Of Birth')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('admission_id')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Admission Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('maritial_status')
                    ->rules(['in:single,maried'])
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
                    ->image()
                    ->placeholder('Photo')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('status')
                    ->rules(['in:1,0'])
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->limit(50),
                Tables\Columns\TextColumn::make('department.name')->limit(50),
                Tables\Columns\TextColumn::make('program.name')->limit(50),
                Tables\Columns\TextColumn::make('country.name')->limit(50),
                Tables\Columns\TextColumn::make('gender')->enum([
                    'male' => 'Male',
                    'female' => 'Female',
                ]),
                Tables\Columns\TextColumn::make('date_of_birth')->date(),
                Tables\Columns\TextColumn::make('admission_id')->limit(50),
                Tables\Columns\TextColumn::make('maritial_status')->enum([
                    'single' => 'Single',
                    'maried' => 'Maried',
                ]),
                Tables\Columns\ImageColumn::make('photo')->rounded(),
                Tables\Columns\TextColumn::make('status')->enum([
                    '1' => '1',
                    '0' => '0',
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

                MultiSelectFilter::make('user_id')->relationship(
                    'user',
                    'name'
                ),

                MultiSelectFilter::make('department_id')->relationship(
                    'department',
                    'name'
                ),

                MultiSelectFilter::make('program_id')->relationship(
                    'program',
                    'name'
                ),

                MultiSelectFilter::make('country_id')->relationship(
                    'country',
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
