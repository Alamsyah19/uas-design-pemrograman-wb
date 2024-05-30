<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use Spatie\Permission\Traits\HasRoles;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Meja;
use App\Models\User;
use App\Models\MenuMakanan;
use App\Models\MenuMinuman;
use App\Models\Order;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use App\Filament\Clusters\Pesan;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Carbon;
use function Laravel\Prompts\select;

class OrderResource extends Resource
{
    use hasRoles;
    protected static ?string $model = Order::class;


    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $cluster = Pesan::class;
    protected static ?string $pluralLabel = 'Pesan';
    protected static ?string $modelLabel = 'Pesan';
    protected static ?string $slug = 'pesan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pesan')->schema([
                    Repeater::make('itemMakanan')
                        ->label('Menu Makanan')
                        ->relationship()
                        ->schema([
                            Select::make('menu_makanan_id')
                                ->live()
                                ->required()
                                ->label('Makanan')
                                ->relationship('menuMakanan', 'nama_makanan')
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('unit_items', MenuMakanan::find($state)->harga ?? 0))

                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_harga_items', MenuMakanan::find($state)->harga ?? 0)),
                            TextInput::make('quantity')
                                ->required()
                                ->live()
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_harga_items', $state * $get('unit_items'))),
                            TextInput::make('unit_items')->required()->disabled()->dehydrated(),
                            TextInput::make('total_harga_items')->required()->disabled()->dehydrated(),

                        ]),
                    Repeater::make('itemMinuman')
                        ->label('Menu Minuman')
                        ->relationship()
                        ->schema([
                            Select::make('menu_minuman_id')
                                ->label('Minuman')
                                ->required()
                                ->live()
                                ->relationship('menuMinuman', 'nama_minuman')
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('unit_items', MenuMinuman::find($state)->harga ?? 0))
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_harga_items', MenuMinuman::find($state)->harga ?? 0)),
                            TextInput::make('quantity')
                                ->required()
                                ->live()
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_harga_items', $state * $get('unit_items'))),
                            TextInput::make('unit_items')->required()->disabled()->dehydrated(),
                            TextInput::make('total_harga_items')->required()->disabled()->dehydrated(),

                        ])
                ]),
                DateTimePicker::make('tgl_order')
                    ->label('Tanggal Pesan')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('meja_id', null);
                    }),

                Select::make('meja_id')
                    ->relationship('meja', 'no_meja', function (Builder $query, callable $get) {
                        $tgl_order = $get('tgl_order');

                        if ($tgl_order) {
                            // Menggunakan Carbon untuk memastikan waktu yang dipilih
                            $dateTime = Carbon::parse($tgl_order);

                            $startOfDay = $dateTime->copy()->startOfDay();
                            $endOfDay = $dateTime->copy()->endOfDay();

                            $query->whereDoesntHave('order', function (Builder $query) use ($startOfDay, $endOfDay) {
                                $query->whereBetween('tgl_order', [$startOfDay, $endOfDay]);
                            });
                        }
                    })
                    ->preload()
                    ->required(),
                Placeholder::make('total_harga')
                    ->label('Total Harga')
                    ->content(function (Get $get, Set $set) {
                        $totalMakan = 0;
                        $totalHarga = 0;
                        $totalMinum = 0;

                        // Ambil data dari item makanan
                        if ($itemsMakanan = $get('itemMakanan')) {
                            foreach ($itemsMakanan as $itemMakanan) {
                                $totalMakan += $itemMakanan['total_harga_items'];
                            }
                        }

                        // Ambil data dari item minuman
                        if ($itemsMinuman = $get('itemMinuman')) {
                            foreach ($itemsMinuman as $itemMinuman) {
                                $totalMinum += $itemMinuman['total_harga_items'];
                            }
                        }

                        // Hitung total harga keseluruhan
                        $totalHarga = $totalMakan + $totalMinum;

                        // Set nilai total_harga
                        $set('total_harga', $totalHarga);

                        return $totalHarga;
                    }),
                Hidden::make('total_harga')->default(0),
                Hidden::make('user_id')->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->query(function (Builder $query) {
                if (Auth::user()->hasRole('super_admin')) {
                    return Order::query();
                } else {
                    return Order::query()->where('user_id', Auth::id());
                }
            })
            ->columns([
                TextColumn::make('user.name')->label('Pemesan atas Nama'),
                TextColumn::make('meja.no_meja')
                    ->label('Meja'),
                TextColumn::make('itemMakanan.menuMakanan.nama_makanan')->label('Makanan'),
                TextColumn::make('itemMinuman.menuMinuman.nama_minuman')->label('Minuman'),
                TextColumn::make('tgl_order')->dateTime(),
                TextColumn::make('total_harga')->numeric()->money('Rp. '),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])

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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
