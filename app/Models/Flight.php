<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Flight extends Model
{
    use HasFactory;

    /**
     * @return HasOne
     */
    public function transporter(): HasOne
    {
        return $this->hasOne(Transporter::class, 'id', 'transporter');
    }

    /**
     * @return HasOne
     */
    public function departureAirport(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'departure_airport');
    }

    /**
     * @return HasOne
     */
    public function arrivalAirport(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'arrival_airport');
    }
}
