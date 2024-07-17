<?php
    namespace App\Filament\Resources;

    use App\Filament\Resources\NewItemResource\Pages;
    use App\Filament\Resources\NewItemResource\RelationManagers;
    use App\Models\Category;
    use App\Models\NewItem;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\ImageColumn;
    use Filament\Tables\Table;
    use Filament\Forms\Components\FileUpload;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\SoftDeletingScope;

    class NewItemResource extends Resource
    {
        protected static ?string $model          = NewItem::class;
        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        public static function form(Form $form): Form
        {
            // Fetch categories from the database
            $categories = Category::pluck('name', 'id')->toArray();
            return $form->schema([
                //
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->required(),
                FileUpload::make('image')->image()->required(),
                Forms\Components\Select::make('category_id')->required()->options($categories),
            ]);
        }

        public static function table(Table $table): Table
        {
            return $table->columns([//
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('description'),
                ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->searchable(),
            ])->filters([//
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
        }

        public static function getRelations(): array
        {
            return [//
            ];
        }

        public static function getPages(): array
        {
            return [
                'index' => Pages\ListNewItems::route('/'),
                'create' => Pages\CreateNewItem::route('/create'),
                'edit' => Pages\EditNewItem::route('/{record}/edit'),
            ];
        }
    }
