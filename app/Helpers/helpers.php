<?php

use App\Utilities\Response\ApiResponse;

if (!function_exists('apiResponse')) {
    function apiResponse(): ApiResponse
    {
        return app(ApiResponse::class);
    }
}
