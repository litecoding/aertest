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
                    Search Request
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        @php($searchQuery = $search)
                        Departure airport: {{ $searchQuery['departure_airport'] }}<br>
                        Arrival airport: {{ $searchQuery['arrival_airport'] }}<br>
                        Departure DateTime: {{ $searchQuery['departure_date'] }}<br>
                    </p>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    Search Results
                </div>
                @if (count($errors) > 0)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>Error:</b>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($flights as $flight)
                        <div class="p-6 bg-white border-b border-gray-200">
                        Transporter code: {{ $flight['transporter']['code'] }} <br>
                        Transporter name: {{ $flight['transporter']['name'] }}<br>
                        Flight number: {{ $flight['flight_number'] }}<br>
                        Departure airport: {{ $flight['departure_airport']['code'] }}<br>
                        Arrival airport: {{ $flight['arrival_airport']['code'] }}<br>
                        Departure DateTime: {{ $flight['departure_date_time'] }}<br>
                        Arrival DateTime: {{ $flight['arrival_date_time'] }}<br>
                        Duration: {{ $flight['duration'] }} min<br>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
