<?php

namespace App\Enums;

/**
 * NewsAPI-specific API parameter names
 *
 * @see https://newsapi.org/docs/endpoints
 */
enum NewsApiParam: string
{
    case API_KEY = 'apiKey';
    case QUERY = 'q';
    case CATEGORY = 'category';
    case COUNTRY = 'country';
    case FROM = 'from';
    case TO = 'to';
    case PAGE_SIZE = 'pageSize';
}
