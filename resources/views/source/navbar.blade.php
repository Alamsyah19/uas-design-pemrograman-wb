<div>
    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full py-7">
        <nav class="relative max-w-7xl w-full flex flex-wrap md:grid md:grid-cols-12 basis-full items-center px-4 md:px-6 md:px-8 mx-auto"
            aria-label="Global">
            <div class="md:col-span-3">
                <!-- Logo -->
                <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80">
                    Booking
                </a>
                <!-- End Logo -->
            </div>

            <!-- Button Group -->
            <div class="flex items-center gap-x-2 ms-auto py-1 md:ps-6 md:order-3 md:col-span-3">
                <div class="md:hidden">
                    <button type="button" id="toggleNav"
                        class="hs-collapse-toggle size-[38px] flex justify-center items-center text-sm font-semibold rounded-xl border border-gray-200 text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- End Button Group -->

            <!-- Collapse -->
            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block md:w-auto md:basis-auto md:order-2 md:col-span-6">
                <div
                    class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:justify-center md:items-center md:gap-y-0 md:gap-x-7 md:mt-0">

                    <div>
                        <a class="inline-block text-black hover:text-gray-600" href="#tntg">Tentang Kami</a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600" href="#menu">Menu</a>
                    </div>
                    <div>
                        <a class="inline-block text-black hover:text-gray-600" href="#kontak">Kontak</a>
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>

    <!-- ========== END HEADER ========== -->
</div>

<script>
    // Select the toggle button
    const toggleNavButton = document.getElementById('toggleNav');

    // Select the navigation collapse element
    const navCollapse = document.getElementById('navbar-collapse-with-animation');

    // Add event listener to toggle button
    toggleNavButton.addEventListener('click', function() {
        // Toggle the 'hidden' class on the navigation collapse element
        navCollapse.classList.toggle('hidden');
    });
</script>
