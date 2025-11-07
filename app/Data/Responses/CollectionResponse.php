<?php

namespace App\Data\Responses;

use Spatie\LaravelData\Data;

class CollectionResponse extends Data
{
    public function __construct(
        /** @var array<int, string> */
        public array $data,
    ) {}
}
