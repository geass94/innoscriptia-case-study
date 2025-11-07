<?php

namespace App\Enums;

/**
 * NY Times API-specific parameter names
 *
 * @see https://developer.nytimes.com/docs/articlesearch-product/1/overview
 */
enum NYTimesApiParam: string
{
    case API_KEY = 'api-key';
    case QUERY = 'q';
    case FILTER_QUERY = 'fq';
    case BEGIN_DATE = 'begin_date';
    case END_DATE = 'end_date';
    case PAGE = 'page';
}
