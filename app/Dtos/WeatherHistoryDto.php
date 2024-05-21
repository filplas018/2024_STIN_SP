<?php

namespace App\Dtos;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class WeatherHistoryDto extends Data
{

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
