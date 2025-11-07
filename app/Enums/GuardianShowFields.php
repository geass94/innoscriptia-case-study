<?php

namespace App\Enums;

/**
 * Guardian API show-fields values
 */
enum GuardianShowFields: string
{
    case TRAIL_TEXT = 'trailText';
    case BODY = 'body';
    case BYLINE = 'byline';
    case THUMBNAIL = 'thumbnail';
    case HEADLINE = 'headline';
    case STANDFIRST = 'standfirst';
    case BODY_TEXT = 'bodyText';
    case SHORT_URL = 'shortUrl';

    /**
     * Get all show-fields as a comma-separated string
     */
    public static function all(): string
    {
        return implode(',', array_column(self::cases(), 'value'));
    }
}
