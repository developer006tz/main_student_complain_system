<?php

namespace App\Filament\Resources;

use App\Models\Lecture;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\LectureResource\Pages;

class LectureResource extends Resource
{
    protected static ?string $model = Lecture::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'image';

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

                    FileUpload::make('image')
                        ->rules(['image', 'max:1024'])
                        ->nullable()
                        ->image()
                        ->placeholder('Image')
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
                Tables\Columns\ImageColumn::make('image')
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LectureResource\RelationManagers\ComplaintsRelationManager::class,
            LectureResource\RelationManagers\ProgramsRelationManager::class,
            LectureResource\RelationManagers\CoursesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLectures::route('/'),
            'create' => Pages\CreateLecture::route('/create'),
            'view' => Pages\ViewLecture::route('/{record}'),
            'edit' => Pages\EditLecture::route('/{record}/edit'),
        ];
    }
}
