<?php

namespace App\Dtos;

use App\Models\Location;
use Spatie\LaravelData\Data;

/**
 * Dto representing Favourite location of a user
 */
class FavouriteLocationDto extends Data
{
    /**
     * Contructor for Dto
     * @param float $lon
     * @param float $lat
     * @param string $name
     * @param string $url
     */
    public function __construct(


        public readonly float $lon,
        public readonly float $lat,
        public readonly string $name,
        public readonly string $url
    )
    {
        //
    }

    /**
     * Helper method for filling from response
     * @param Location $value
     * @return static
     */
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
