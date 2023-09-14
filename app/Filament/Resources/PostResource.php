<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('author_id')->default(auth()->user()->id),
                Section::make([
                    TextInput::make('title')->required(),
                    Textarea::make('excerpt'),
                    Textarea::make('meta_description'),
                    Textarea::make('meta_tags'),
                    TextInput::make('slug')->required()
                ]),
                Section::make([
                    RichEditor::make('body')->required(),
                    FileUpload::make('cover_image')->image()
                ]),
                Section::make([
                    Select::make('category_id')
                    ->options(Category::all()->pluck('title', 'id'))
                    ->required()
                    ->label("Category"),
                    Select::make('is_future')
                    ->options([
                        'false' => 'NO',
                        'true' => 'YES'
                    ])->default('false')->required(),
                    Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published'
                    ])->default('draft')->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")->sortable(),
                Tables\Columns\TextColumn::make("title")->searchable(),
                Tables\Columns\TextColumn::make("category.title")
                    ->listWithLineBreaks(),
                Tables\Columns\ImageColumn::make("cover_image")->circular(),
                Tables\Columns\TextColumn::make('created_at')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }    
}
