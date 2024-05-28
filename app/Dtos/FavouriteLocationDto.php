<?php

namespace App\Dtos;

use App\Models\Location;
use Spatie\LaravelData\Data;

class FavouriteLocationDto extends Data
{
    public function __construct(


        public readonly float $lon,
        public readonly float $lat,
        public readonly string $name,
        public readonly string $url
    )
    {
        //
    }

    public static function fromArray(Location $value) :static
    {
        return new static(
            lon: $value->long,
            lat: $value->lat,
            name: $value->name,
            url: "/?city={$value->name}"
        );
    }
}
