<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFlightRequest;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function searchFlight(SearchFlightRequest $request)
    {
        $startDate = (new Carbon($request['departure_date']))->startOfDay();
        $endDate = (new Carbon($request['departure_date']))->endOfDay();

        return Flight::where('departure_airport', Airport::where('code', $request['departure_airport'])->firstOrFail()->id)
            ->where('arrival_airport', Airport::where('code', $request['arrival_airport'])->firstOrFail()->id)
            ->whereBetween('departure_date_time', [$startDate, $endDate])
            ->with(array('transporter' => function ($query) {
                $query->select('id', 'code', 'name');
            }))
            ->with('departureAirport:id,code')
            ->with('arrivalAirport:id,code')
            ->get()
            ->toArray();
    }

    /**
     * @param SearchFlightRequest $request
     * @return mixed
     */
    public function viewSearchResults(SearchFlightRequest $request)
    {
        $flights = $this->searchFlight($request);

        return view('flight_search_results')
            ->withFlights(json_encode($flights))
            ->withSearch(json_encode([
                'departure_airport' => $request['departure_airport'],
                'arrival_airport'   => $request['arrival_airport'],
                'departure_date'    => $request['departure_date']
            ]));
    }

    /**
     * @return mixed
     */
    public function viewSearch()
    {
        return view('flight_search');
    }
}
