<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class MockyException extends \Exception
{
    public function render(): JsonResponse
    {
        return apiResponse()->withMessage('Unable to connect to run.mocky.io')->notFound();
    }
}
