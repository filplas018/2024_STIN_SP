<?php

namespace App\Dtos;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

/**
 * Dto representing historical data
 */
class WeatherHistoryDto extends Data
{

    /**
     * Constructor for dto
     * @param string $dt
     * @param float $temp
     * @param float $pressure
     * @param float $humidity
     * @param float $speed
     * @param float $deg
     * @param float $clouds
     */
    public function __construct(
        public readonly string $dt,
        public readonly float $temp,
        public readonly float $pressure,
        public readonly float $humidity,
        public readonly float $speed,
        public readonly float $deg,
        public readonly float $clouds,
    )
    {
        //
    }

    /**
     * Helper method for filling from response
     * @param array $value
     * @return static
     */
    public static function fromArray(array $value) :static
    {
        return new static(
            dt: Carbon::createFromTimestampUTC($value['dt'])->toAtomString(),
            temp: $value['main']['temp'],
            pressure: $value['main']['pressure'],
            humidity: $value['main']['humidity'],
            speed: $value['wind']['speed'],
            deg: $value['wind']['deg'],
            clouds: $value['clouds']['all'],
        );
    }
}
