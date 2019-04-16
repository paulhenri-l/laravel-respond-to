<?php

namespace PHL\LaravelRespondTo\Tests\Fakes\Responsables;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class SomeCsvResponsable implements Responsable
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        return Response::create('some-csv');
    }
}
