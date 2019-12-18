<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    /**
     * Limit results to 100 records
     * @return int
     */
    protected function getLimit(): int
    {
        $limit = request('limit') ?? 10;
        return ($limit > 100) ? 100 : $limit;
    }
}