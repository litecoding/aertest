<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * @param array $data
     * @return array
     */
    public function searchFlight(array $data): array
    {
        $startDate = (new Carbon($data['departure_date']))->startOfDay();
        $endDate = (new Carbon($data['departure_date']))->endOfDay();

        return Flight::where('departure_airport', Airport::firstWhere('code', $data['departure_airport'])->id)
            ->where('arrival_airport', Airport::firstWhere('code', $data['arrival_airport'])->id)
            ->whereBetween('departure_date_time', [$startDate, $endDate])
            ->with('transporter:id,code,name')
            ->with('departureAirport:id,code')
            ->with('arrivalAirport:id,code')
            ->orderBy('departure_date_time')
            ->get()
            ->toArray();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function viewSearchResults(Request $request)
    {
        $flights = $this->searchFlight($this->getSearchParamsFromRequest($request));
        $search = $this->getSearchParamsFromRequest($request);
        $view = view('flight_search_results')->withFlights($flights)->withSearch($search);

        if ($flights) {
            return $view;
        } else {
            return $view->withErrors(['Error' => 'Nothing was found']);
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function returnSearchResultsJson(Request $request): string
    {
        $result = [];
        $result['searchQuery'] = $this->getSearchParamsFromJsonRequest($request);
        $flights = $this->searchFlight($this->getSearchParamsFromJsonRequest($request));
        if ($flights) {
            foreach ($flights as $flight) {
                $result['searchResults'][] = [
                    'transporter'       => [
                        'code' => $flight['transporter']['code'],
                        'name' => $flight['transporter']['name']
                    ],
                    'flightNumber'      => $flight['flight_number'],
                    'departureAirport'  => $flight['departure_airport']['code'],
                    'arrivalAirport'    => $flight['arrival_airport']['code'],
                    'departureDateTime' => $flight['departure_date_time'],
                    'arrivalDateTime'   => $flight['arrival_date_time'],
                    'duration'          => $flight['duration']
                ];
            }
        } else {
            $result['errors'] = ['Error' => 'Nothing was found'];
        }
        return json_encode($result);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSearchParamsFromJsonRequest(Request $request): array
    {
        $validated = $request->validate([
            '*.departureAirport' => 'required|exists:airports,code|max:255',
            '*.arrivalAirport'   => 'required|exists:airports,code|max:255',
            '*.departureDate'    => 'required|date',
        ]);

        return [
            'departure_airport' => $validated['searchQuery']['departureAirport'],
            'arrival_airport'   => $validated['searchQuery']['arrivalAirport'],
            'departure_date'    => $validated['searchQuery']['departureDate']
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSearchParamsFromRequest(Request $request): array
    {
        $validated = $request->validate([
            'departure_airport' => 'required|exists:airports,code|max:255',
            'arrival_airport'   => 'required|exists:airports,code|max:255',
            'departure_date'    => 'required|date',
        ]);

        return [
            'departure_airport' => $validated['departure_airport'],
            'arrival_airport'   => $validated['arrival_airport'],
            'departure_date'    => $validated['departure_date']
        ];
    }

}
