<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuMinumanResource\Pages;
use App\Filament\Resources\MenuMinumanResource\RelationManagers;
use App\Models\MenuMinuman;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Pesan;

class MenuMinumanResource extends Resource
{
    protected static ?string $model = MenuMinuman::class;
    protected static ?string $pluralLabel = 'Minuman';
    protected static ?string $modelLabel = 'Minuman';
    protected static ?string $slug = 'minuman';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $cluster = Pesan::class;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_minuman')->columnSpanFull(),
                FileUpload::make('image')->columnSpanFull()->openable(),
                TextInput::make('harga')->numeric()->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image')
                    ->height('90px')
                    ->width('120px')->columnSpanFull(),
                Tables\Columns\Layout\Stack::make([
                    TextColumn::make('nama_minuman')->weight(FontWeight::Bold)->size('lg')->columnSpanFull(),
                    TextColumn::make('harga')->size('md')->columnSpanFull()->numeric()->money('Rp. '),
                ]),

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
            'index' => Pages\ListMenuMinumen::route('/'),
            'create' => Pages\CreateMenuMinuman::route('/create'),
            'edit' => Pages\EditMenuMinuman::route('/{record}/edit'),
        ];
    }
}
