<?php

namespace PHL\LaravelRespondTo\Tests\Fakes\Controllers;

use Illuminate\Routing\Controller;
use PHL\LaravelRespondTo\Respond;

class NoWithController extends Controller
{
    public function index()
    {
        return Respond::to('html')->to('js')->with('some-js');
    }
}
