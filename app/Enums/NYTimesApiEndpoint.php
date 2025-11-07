<?php

namespace App\Enums;

/**
 * NY Times API endpoint paths
 */
enum NYTimesApiEndpoint: string
{
    case ARTICLE_SEARCH = '/search/v2/articlesearch.json';
}
