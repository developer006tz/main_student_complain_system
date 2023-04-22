<?php

namespace App\Filament\Resources;

use App\Models\AcademicYear;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\AcademicYearResource\Pages;

class AcademicYearResource extends Resource
{
    protected static ?string $model = AcademicYear::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('start_date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Start Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('end_date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('End Date')
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
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('start_date')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->toggleable()
                    ->date(),
            ])
            ->filters([DateRangeFilter::make('created_at')]);
    }

    public static function getRelations(): array
    {
        return [
            AcademicYearResource\RelationManagers\EnrollmentsRelationManager::class,
            AcademicYearResource\RelationManagers\ComplaintsRelationManager::class,
            AcademicYearResource\RelationManagers\SemestersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicYears::route('/'),
            'create' => Pages\CreateAcademicYear::route('/create'),
            'view' => Pages\ViewAcademicYear::route('/{record}'),
            'edit' => Pages\EditAcademicYear::route('/{record}/edit'),
        ];
    }
}
