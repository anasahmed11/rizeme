<?php
    namespace App\Filament\Resources;

    use App\Filament\Resources\NewItemResource\Pages;
    use App\Filament\Resources\NewItemResource\RelationManagers;
    use App\Models\Category;
    use App\Models\NewItem;
    use Carbon\Carbon;
    use Filament\Forms;
    use Filament\Forms\Components\DateTimePicker;
    use Filament\Forms\Components\Fieldset;
    use Filament\Forms\Components\Wizard;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\ImageColumn;
    use Filament\Tables\Columns\ToggleColumn;
    use Filament\Tables\Table;
    use Filament\Forms\Components\FileUpload;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\SoftDeletingScope;
    use Filament\Tables\Actions\CreateAction;

    class NewItemResource extends Resource
    {
        protected static ?string $model          = NewItem::class;
        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        public static function form(Form $form): Form
        {
            // Fetch categories from the database
            $categories = Category::pluck('name', 'id')->toArray();
            return $form->schema([
                Wizard::make([
                    Wizard\Step::make('basics')
                        ->schema([
                            // ...
                            Fieldset::make('text')
                                ->schema([
                                    // ...
                                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                                    Forms\Components\Textarea::make('description')->autosize()->required(),
                                ]),
                            Forms\Components\Select::make('category_id')->required()->options($categories),
                        ]),
                    Wizard\Step::make('Image')
                        ->schema([
                            // ...
                            FileUpload::make('image')->image()->required(),
                        ]),
                    Wizard\Step::make('Publishing')
                        ->description('allaw you to scheduling time of publish')
                        ->schema([
                            // ...
                            DateTimePicker::make('publish_at')->rules('nullable', 'date')->hint('Select the date and time when this new item should be published. Leave empty for immediate publication.'),
                        ]),
                ])

            ]);
        }

        public static function table(Table $table): Table
        {
            return $table->columns([//
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('description')->limit(30)->tooltip(fn($record) => $record->description),
                ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->searchable(),
                Tables\Columns\TextColumn::make('published')
                    ->formatStateUsing(fn($state): string => $state == '1' ? 'Published' : 'Unpublished')
                    ->color(fn(string $state): string => match($state){'0' => 'warning',
                '1' => 'success',})
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
