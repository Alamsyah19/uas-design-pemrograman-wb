<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuMakananResource\Pages;
use App\Filament\Resources\MenuMakananResource\RelationManagers;
use App\Models\MenuMakanan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Pesan;

class MenuMakananResource extends Resource
{
    protected static ?string $model = MenuMakanan::class;
    protected static ?string $pluralLabel = 'Makanan';
    protected static ?string $modelLabel = 'Makanan';
    protected static ?string $slug = 'makanan';
    protected static ?string $cluster = Pesan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_makanan')->columnSpanFull(),
                FileUpload::make('image')->columnSpanFull()->openable(),
                TextInput::make('harga'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    ImageColumn::make('image')
                        ->height('80px')
                        ->width('100px')->columnSpanFull(),
                    Tables\Columns\Layout\Stack::make([
                        TextColumn::make('nama_makanan')->weight(FontWeight::Bold)->size('lg')->columnSpanFull(),
                        TextColumn::make('harga')->size('md')->columnSpanFull()->numeric()->money('Rp. '),
                    ]),

                ])

            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMenuMakanans::route('/'),
            'create' => Pages\CreateMenuMakanan::route('/create'),
            'edit' => Pages\EditMenuMakanan::route('/{record}/edit'),
        ];
    }
}
