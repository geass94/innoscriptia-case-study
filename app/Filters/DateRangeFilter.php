<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class DateRangeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        // Expects value to be an array with 'from' and/or 'to' keys
        if (is_array($value)) {
            if (isset($value['from'])) {
                $query->where('published_at', '>=', $value['from']);
            }
            if (isset($value['to'])) {
                $query->where('published_at', '<=', $value['to']);
            }
        }
    }
}
