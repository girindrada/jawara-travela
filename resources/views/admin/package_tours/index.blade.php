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

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left">
                            <th class="p-4">Tour Name</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Days</th>
                            <th class="p-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($packageTours as $packageTour)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img 
                                        src="{{ Storage::url($packageTour->thumbnail) }}"
                                        class="w-[80px] h-[60px] object-cover rounded-lg"
                                    >
                                    <span class="font-semibold text-indigo-950">
                                        {{ $packageTour->name }}
                                    </span>
                                </div>
                            </td>

                            <td class="p-4">
                                {{ $packageTour->category->name }}
                            </td>

                            <td class="p-4">
                                Rp {{ number_format($packageTour->price, 0, ',', '.') }}
                            </td>

                            <td class="p-4">
                                {{ $packageTour->days }} Days
                            </td>

                            <td class="p-4">
                                <a href="{{ route('admin.package_tours.show', $packageTour) }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                    Manage
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-slate-500">
                                <p>Belum ada data paket tour</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 bg-white p-4 rounded-lg">
                    {{ $packageTours->links('pagination::simple-tailwind') }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
