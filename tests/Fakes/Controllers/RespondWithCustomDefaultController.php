<?php

namespace PHL\LaravelRespondTo\Tests\Fakes\Controllers;

use Illuminate\Routing\Controller;
use PHL\LaravelRespondTo\Respond;

class RespondWithCustomDefaultController extends Controller
{
    public function index()
    {
        return Respond::to('txt')->with('some-text')
            ->default('txt');
    }
}
