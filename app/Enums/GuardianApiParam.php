<?php

namespace App\Enums;

/**
 * Guardian API-specific parameter names
 *
 * @see https://open-platform.theguardian.com/documentation/
 */
enum GuardianApiParam: string
{
    case API_KEY = 'api-key';
    case QUERY = 'q';
    case SECTION = 'section';
    case FROM_DATE = 'from-date';
    case TO_DATE = 'to-date';
    case PAGE_SIZE = 'page-size';
    case SHOW_FIELDS = 'show-fields';
}
