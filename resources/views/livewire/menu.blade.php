<?php
$makanan = \App\Models\MenuMakanan::all();
$minuman = \App\Models\MenuMinuman::all();
?>
<div id="menu" class="max-w-5xl mb-48 mt-24 mx-auto">
    <h1 class="mb-5 font-semibold text-black text-3xl md:text-4xl">Menu</h1>

    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-4 md:p-2 xl:p-5">

        <!-- card Menu Makanan -->
        @foreach ($makanan as $makan)
            <div
                class="relative
        bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transform transition duration-500
        hover:scale-105">
                <div class="p-2 flex justify-center">
                    <a href="menu/pesan/makanan">
                        <img class="rounded-md w-48 h-36" src="{{ $makan->image }}" loading="lazy">
                    </a>
                </div>

                <div class="px-4 pb-3">
                    <div>
                        <a href="menu/pesan/makanan"
                            class="text-xl font-semibold tracking-tight hover:text-violet-800 dark:hover:text-violet-300 text-gray-900 dark:text-white ">
                            {{ $makan->nama_makanan }}
                        </a>

                        <p class="antialiased text-gray-600 dark:text-gray-400 text-sm break-all">
                            Rp.{{ $makan->harga }}
                        </p>
                    </div>
                </div>

            </div>
        @endforeach
        <!-- card  minuman -->
        @foreach ($minuman as $minum)
            <div
                class="relative bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 transform transition duration-500 hover:scale-105">
                <div class="p-2 flex justify-center">
                    <a href="menu/pesan/minuman">
                        <img class="rounded-md w-48 h-36" src="{{ $minum->image }}" loading="lazy">
                    </a>
                </div>

                <div class="px-4 pb-3">
                    <div>
                        <a href="menu/pesan/minuman"
                            class="text-xl font-semibold tracking-tight hover:text-violet-800 dark:hover:text-violet-300 text-gray-900 dark:text-white ">
                            {{ $minum->nama_minuman }}
                        </a>

                        <p class="antialiased text-gray-600 dark:text-gray-400 text-sm break-all">
                            Rp.{{ $minum->harga }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</div>
