<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    "default" => 2
                ])
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(2048)
                            ->live()
                            ->debounce(500)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->hint('Automatically generated')
                            ->required()
                            ->maxLength(2048),
                    ]),
                Grid::make(1)->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->hint('Upload an image')
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('body')
                        ->required()
                        ->columnSpanFull(),
                ]),
                Grid::make([
                    "default" => 2
                ])
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at'),

                        Forms\Components\Select::make('categories')
                            ->multiple()
                            ->searchable()
                            ->hint('You can search for categories')
                            ->relationship('categories', 'title')
                            ->required(),
                    ]),
                Grid::make([
                    "default" => 2
                ])->schema([
                    Forms\Components\TextInput::make('meta_title'),
                    Forms\Components\TextInput::make('meta_description'),
                ]),

                Forms\Components\Toggle::make('active')
                    ->required()
                    ->label('Show on site?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('user.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}/view'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
