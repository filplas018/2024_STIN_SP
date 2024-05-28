<?php

namespace App\Dtos;


use Spatie\LaravelData\Data;

/**
 * Dto representing Local weather
 */
class LocalWeatherDto extends Data
{

    /**
     * Constructor for Dto
     * @param float $lon
     * @param float $lat
     * @param string $main
     * @param string $description
     * @param string $icon
     * @param float $temp
     * @param float $pressure
     * @param float $humidity
     * @param float $speed
     * @param float $deg
     * @param string $country
     * @param string $name
     * @param float $timezone
     * @param float $sunrise
     * @param float $sunset
     */
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

    /**
     * Helper method for filling from response
     * @param array $value
     * @return static
     */
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
