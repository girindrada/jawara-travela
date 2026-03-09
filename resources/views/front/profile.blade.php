@extends('layouts.front')
@section('content')
    <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-[120px]">
        <nav class="mt-8 px-4 w-full flex items-center justify-between">
            <a href="{{ route('front.index') }}">
                <img src="{{ asset('assets/icons/back.png') }}" alt="back">
            </a>
            <p class="text-center m-auto font-semibold">My Profile</p>
            <div class="w-12"></div>
        </nav>


        <div class="mx-4 flex flex-col gap-3 bg-white p-[16px_24px] rounded-[22px]">
            <div class="flex justify-center gap-3 items-center">
                <div
                    class="w-12 h-12 border-4 border-white rounded-full overflow-hidden flex items-center justify-center shrink-0 shadow-[6px_8px_20px_0_#00000008]">
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover object-center"
                        alt="photo">
                </div>
            </div>

            <div class="flex flex-col gap-3 px-4 py-4">
                <div class="bg-white p-[16px_24px] rounded-[26px] flex flex-col gap-3">
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Name</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Email</p>
                        <p class="font-semibold">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Phone</p>
                        <p class="font-semibold">{{ Auth::user()->phone_number }}</p>
                    </div>
                </div>
            </div>

            @auth
                <form method="POST" action="{{ route('logout') }}"
                    class="flex flex-col items-center justify-center py-[46px] px-[28px] gap-8">
                    @csrf
                    <button type="submit"
                        class="p-[16px_24px] rounded-xl bg-white w-full border border-1 text-center font-semibold text-blue hover:bg-[#06C755] hover:text-white transition-all duration-300">
                        Log Out
                    </button>
                </form>
            @endauth



        </div>

        <div
            class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
            @include('components.navigation')
        </div>
    </section>
@endsection
