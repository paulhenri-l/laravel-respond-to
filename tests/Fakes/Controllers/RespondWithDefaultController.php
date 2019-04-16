<?php

namespace PHL\LaravelRespondTo\Tests\Fakes\Controllers;

use Illuminate\Routing\Controller;
use PHL\LaravelRespondTo\Respond;

class RespondWithDefaultController extends Controller
{
    public function index()
    {
        return Respond::to('html')->with('some-html');
    }
}
