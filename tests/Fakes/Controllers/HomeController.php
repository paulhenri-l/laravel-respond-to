<?php

namespace PHL\LaravelRespondTo\Tests\Fakes\Controllers;

use Illuminate\Routing\Controller;
use PHL\LaravelRespondTo\Respond;
use PHL\LaravelRespondTo\Tests\Fakes\Responsables\SomeCsvResponsable;

class HomeController extends Controller
{
    public function index()
    {
        return Respond::withNewRespond()
            ->to('html')->withView('FakeApp::some-view')
            ->to('js')->with('some-js')
            ->to('json')->with(['key' => 'value'])
            ->to('pdf')->with(new SomeCsvResponsable())
            ->to('txt')->with([$this, 'getSomeText'])
            ->to('xml')->with(function () {
                return 'some-xml';
            });
    }

    public function getSomeText()
    {
        return 'some-text';
    }
}
