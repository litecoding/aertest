<?php

namespace Database\Factories;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Transporter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $duration = $this->faker->numberBetween(30, 500);
        $departureDateTime = $this->faker->dateTimeBetween('+1 week', '+2 weeks');
        $departureAirport = $this->faker->numberBetween(1, Airport::count());
        $arrivalAirport = $this->faker->randomElement(Airport::where('id', '!=', $departureAirport)->pluck('id'));
        return [
            'flight_number' => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            'departure_date_time' => $departureDateTime,
            'arrival_date_time' => Carbon::createFromTimeString($departureDateTime->format('Y-m-d H:i:s'))
                ->add($duration, 'minutes')->toDate(),
            'duration' => $this->faker->numberBetween(30, 500),
            'departure_airport' => $departureAirport,
            'arrival_airport' => $arrivalAirport,
            'transporter' => $this->faker->numberBetween(1, Transporter::count()),
        ];
    }
}
