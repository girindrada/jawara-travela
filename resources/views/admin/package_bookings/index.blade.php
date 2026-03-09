<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Bookings') }}
            </h2>
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
                            <th class="p-4">Status</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Total Days</th>
                            <th class="p-4">Quantity</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($packageBookings as $booking)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img 
                                        src="{{ Storage::url($booking->tour->thumbnail) }}"
                                        class="w-[80px] h-[60px] object-cover rounded-lg"
                                    >
                                
                                    <div class="flex flex-col items-start">
                                        <span class="font-semibold text-indigo-950">
                                            {{ $booking->tour->name }}
                                        </span>
                                        <span class="font-light text-indigo-950">
                                            {{ $booking->tour->category->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                @if($booking->is_paid)
                                    <span class="px-4 py-2 text-white text-sm font-semibold rounded-lg bg-green-500">
                                        SUCCESS
                                    </span>
                                @else
                                    <span class="px-4 py-2 text-white text-sm font-semibold rounded-lg bg-orange-500">
                                        PENDING
                                    </span>
                                @endif
                            </td>
                            <td class="p-4">
                                Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="p-4">
                                {{ $booking->tour->days }} Days
                            </td>
                            <td class="p-4">
                                {{ $booking->quantity }} People
                            </td>
                            <td class="p-4">
                                <div class="hidden md:flex flex-row items-center gap-x-3">
                                    <a href="{{ route('admin.package_bookings.show', $booking) }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                        Details
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-500">
                                    <p>Belum ada data pembayaran tours</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 bg-white p-4 rounded-lg">
                    {{ $packageBookings->links() }}
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
