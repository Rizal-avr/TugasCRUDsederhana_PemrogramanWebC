<nav class="bg-blue-900 dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-cyan-400 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <span class="text-white self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Penjualan Sayur</span>
        </a>

        <div class="flex items-center md:order-2 space-x-4">
            <ul class="flex flex-row space-x-8 rtl:space-x-reverse font-medium">
                <li>
                    <a >
                        Dashboard
                    </a>
                </li>
                <li>
                    <a >
                        Pengelolaan
                    </a>
                </li>
                <li>
                    <a>
                        Profile
                    </a>
                </li>
            </ul>

                @csrf
                <button type="submit" 
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

