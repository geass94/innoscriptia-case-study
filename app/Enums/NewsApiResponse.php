<?php

namespace App\Enums;

/**
 * Response field names and status values for NewsAPI
 */
enum NewsApiResponse: string
{
    case STATUS_OK = 'ok';
    case FIELD_STATUS = 'status';
    case FIELD_ARTICLES = 'articles';
}
