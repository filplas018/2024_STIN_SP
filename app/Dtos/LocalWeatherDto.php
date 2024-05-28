<?php

namespace App\Dtos;


use Spatie\LaravelData\Data;

class LocalWeatherDto extends Data
{

    public function __construct(


        public readonly float $lon,
        public readonly float $lat,
        public readonly string $main,
        public readonly string $description,
        public readonly string $icon,
        public readonly float $temp,
        public readonly float $pressure,
        public readonly float $humidity,
        public readonly float $speed,
        public readonly float $deg,
        public readonly string $country,
        public readonly string $name,
        public readonly float $timezone,
        public readonly float $sunrise,
        public readonly float $sunset,
    )
    {
        //
    }

    public static function fromArray(array $value) :static
    {
        return new static(
            lon: $value['coord']['lon'],
            lat: $value['coord']['lat'],
            main: $value['weather'][0]['main'],
            description: $value['weather'][0]['description'],
            icon: "http://openweathermap.org/img/w/{$value['weather'][0]['icon']}.png",
            temp: $value['main']['temp'],
            pressure: $value['main']['pressure'],
            humidity: $value['main']['humidity'],
            speed: $value['wind']['speed'],
            deg: $value['wind']['deg'],
            country: $value['sys']['country'],
            name: $value['name'],
            timezone: $value['timezone'],
            sunrise: $value['sys']['sunrise'],
            sunset: $value['sys']['sunset'],



        );
    }
}
