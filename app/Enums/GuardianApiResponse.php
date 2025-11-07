<?php

namespace App\Enums;

/**
 * Response field names and status values for Guardian API
 */
enum GuardianApiResponse: string
{
    case STATUS_OK = 'ok';
    case FIELD_RESPONSE = 'response';
    case FIELD_STATUS = 'status';
    case FIELD_RESULTS = 'results';
}
