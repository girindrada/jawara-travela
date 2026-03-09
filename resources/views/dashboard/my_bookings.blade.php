@extends('layouts.front')
@section('content')
    <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-[120px]">
        <nav class="mt-8 px-4 w-full flex items-center justify-between">
          <a href="{{ route('front.index') }}">
            <img src="{{ asset('assets/icons/back.png') }}" alt="back">
          </a>
          <p class="text-center m-auto font-semibold">Schedule</p>
          <div class="w-12"></div>
        </nav>
        <div class="flex flex-col gap-3 px-4">
          <p class="font-semibold">My Packages</p>

          @forelse ( Auth::user()->bookings as $booking)
            <a href="{{ route('dashboard.booking.details', $booking->id) }}" class="card">
                <div class="bg-white p-4 rounded-[26px] flex items-center gap-4">
                    <p class="text-center text-sm leading-[22px] tracking-035">
                        <span class="font-semibold text-2xl">{{ $booking->start_date->format('d') }}</span> 
                        <br> {{ $booking->start_date->format('M') }} 
                        <br> {{ $booking->start_date->format('Y') }}
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                            <img src="{{ Storage::url($booking->tour->thumbnail) }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold text-sm tracking-035 leading-[22px]">
                               {{ $booking->tour->name }}
                            </p>
                            <p class="text-sm leading-[22px] tracking-035 text-darkGrey">
                                {{ $booking->tour->days }} days | {{ $booking->quantity }} packs
                            </p>

                            @if($booking->is_paid)
                                <div class="success-badge w-fit border border-[#60A5FA] p-[4px_8px] rounded-lg bg-[#EFF6FF] flex items-center justify-center">
                                    <span class="text-xs leading-[22px] tracking-035 text-[#2563EB]">Success Paid</span>
                                </div>
                            @else
                                <div class="w-fit border border-orange-300 p-[4px_8px] rounded-lg bg-orange-50 flex items-center justify-center">
                                    <span class="text-xs leading-[22px] tracking-035 text-orange-600">Checking</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
          @empty
              <p>History booking anda masih kosong</p>
          @endforelse
   
        </div>

         <div class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
          @include('components.navigation')
        </div>
    </section>
@endsection