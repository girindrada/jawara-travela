<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Tours') }}
            </h2>
            <a href="{{ route('admin.package_tours.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($packageTours as $packageTour)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($packageTour->thumbnail) }}" alt="tour thumbnail" class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $packageTour->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $packageTour->category->name }}</p>
                            </div>
                        </div> 
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Price</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                Rp {{ number_format($packageTour->price, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Total Days</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $packageTour->days }} Days</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.package_tours.show', $packageTour) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Manage
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Belum ada data paket tour</p>
                @endforelse                

            </div>
        </div>
    </div>
</x-app-layout>
