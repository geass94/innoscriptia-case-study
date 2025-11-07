<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class KeywordFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        if (! empty($value)) {
            $query->where(function ($q) use ($value) {
                $q->where('title', 'like', "%{$value}%")
                    ->orWhere('description', 'like', "%{$value}%")
                    ->orWhere('content', 'like', "%{$value}%");
            });
        }
    }
}
