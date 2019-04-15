<?php

namespace PHL\LaravelRespondTo\Tests\Fakes;

use Illuminate\Routing\Controller;
use PHL\LaravelRespondTo\Respond;

class HelloController extends Controller
{
    public function index()
    {
        return Respond::withNewRespond()
            ->to('js')->with()
            ->to('html')->with();
    }
}
