
       <a href="{{ route('front.index') }}" class="menu {{ request()->routeIs('front.index') ? '' : 'opacity-25' }}"">
           <div class="flex flex-col justify-center w-fit gap-1">
               <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                   <img src="{{ asset('assets/icons/home.svg') }}" alt="icon">
               </div>
               <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Home</p>
           </div>
       </a>
       <a href="{{ route('front.search') }}" class="menu {{ request()->routeIs('front.search') ? '' : 'opacity-25' }}">
           <div class="flex flex-col justify-center w-fit gap-1">
               <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                   <img src="{{ asset('assets/icons/search.svg') }}" alt="icon">
               </div>
               <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Search</p>
           </div>
       </a>
       <a href="{{ route('dashboard.bookings') }}" class="menu {{ request()->routeIs('dashboard.bookings') ? '' : 'opacity-25' }}">
           <div class="flex flex-col justify-center w-fit gap-1">
               <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                   <img src="{{ asset('assets/icons/calendar-blue.svg') }}" alt="icon">
               </div>
               <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Schedule</p>
           </div>
       </a>

        <a href="{{ auth()->check() ? route('front.profile') : route('login') }}" 
            class="menu {{ request()->routeIs('front.profile') ? '' : 'opacity-25' }}">
            <div class="flex flex-col justify-center w-fit gap-1">
                <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/user-flat.svg') }}" alt="icon">
                </div>
                <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">
                    {{ auth()->check() ? 'profile' : 'login' }}
                </p>
            </div>
        </a>
