<header class="flex justify-between w-full gap-12 px-8 text-lg bg-white shadow-lg h-fit">
    <div class="py-6">
        <a href="#" id="hambuger"><i class="fa-solid fa-bars"></i></a>
    </div>
    <div class="relative flex ">
        <button
            class="flex items-center justify-between w-full gap-[0.8rem] px-8 transition-all duration-300 accordion hover:bg-sky-200 bg-slate-100">
            <span class="text-lg"><i class="mr-1 text-lg fa-solid fa-user"></i>
                {{ Auth::user()->username }}</span>
            <i class="text-lg transition-transform duration-300 fa-solid fa-chevron-down"></i>
        </button>

        <div
            class="absolute flex flex-col overflow-hidden text-lg transition-all duration-300 bg-white top-[4.7rem] accordion-content shadow-lg rounded-b-lg w-full">
            <a href="" class="block w-full px-8 py-2 transition-all duration-300 border-b hover:bg-sky-300 border-slate-300"><i
                    class="fa-solid fa-user"></i>
                Profile</a>
            <a
            <a href="" class="block w-full px-8 py-2 transition-all duration-300 hover:bg-sky-300"><i
                    class="fa-solid fa-gear"></i>
                Settings</a>
            <a
                class="block w-full px-8 py-2 transition-all duration-300 list-group-item logout hover:bg-sky-300">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500">
                        <i class="fa-solid fa-door-open"></i>
                        Log Out
                    </button>
                </form>
            </a>
        </div>
    </div>
</header>
