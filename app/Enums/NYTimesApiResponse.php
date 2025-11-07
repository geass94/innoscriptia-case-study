<?php

namespace App\Enums;

/**
 * Response field names and status values for NY Times API
 */
enum NYTimesApiResponse: string
{
    case STATUS_OK = 'OK';
    case FIELD_STATUS = 'status';
    case FIELD_RESPONSE = 'response';
    case FIELD_DOCS = 'docs';
}
