<?php

namespace PHL\LaravelRespondTo\Tests\Fakes\Controllers;

use Illuminate\Routing\Controller;
use PHL\LaravelRespondTo\Respond;

class NoResponseController extends Controller
{
    public function index()
    {
        return Respond::to('json')->with(['key' => 'value']);
    }
}
