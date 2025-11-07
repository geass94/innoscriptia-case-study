<?php

namespace App\Enums;

/**
 * Common input parameter names used across all news providers
 */
enum NewsProviderParam: string
{
    case KEYWORD = 'keyword';
    case CATEGORY = 'category';
    case FROM = 'from';
    case TO = 'to';
    case PAGE_SIZE = 'pageSize';
    case PAGE = 'page';
}
