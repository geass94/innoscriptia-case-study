<?php

namespace App\Enums;

/**
 * NewsAPI endpoint paths
 */
enum NewsApiEndpoint: string
{
    case EVERYTHING = '/everything';
    case TOP_HEADLINES = '/top-headlines';
}
