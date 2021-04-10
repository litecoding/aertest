<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Search
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/search_results">
                        @csrf
                        <p class="p-6"><b>Departure:</b><br>
                            <input type="text" size="40" name="departure_airport">
                        </p>
                        <p class="p-6"><b>Arrival:</b><br>
                            <input type="text" size="40" name="arrival_airport">
                        </p>
                        <p class="p-6"><b>Date:</b><br>
                            <input type="date" size="40" name="departure_date">
                        </p>
                        <p class="p-6">
                            <input type="submit" value="Search!">
                            <input type="reset" value="Clear">
                        </p>
                    </form>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{ $flights ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
