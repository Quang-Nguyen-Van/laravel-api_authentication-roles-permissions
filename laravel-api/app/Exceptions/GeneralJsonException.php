<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    /**
     * Report the Exception
     *
     * @return void
     */
    public function report()
    {

    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param \illuminate\Http\Request $request
     */
    public function render($request)
    {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ], $this->code);
    }
}
