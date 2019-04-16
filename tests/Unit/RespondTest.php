<?php

namespace PHL\LaravelRespondTo\Tests\Unit;

use Illuminate\Http\Request;
use PHL\LaravelRespondTo\Exceptions\MissingWithException;
use PHL\LaravelRespondTo\Exceptions\NotSupportedFormatException;
use PHL\LaravelRespondTo\Tests\TestCase;

class RespondTest extends TestCase
{
    public function test_get_with_html_and_view()
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('some-view');
    }

    public function test_get_with_js()
    {
        $response = $this->get('/', ['Accept' => 'application/javascript']);

        $response->assertOk();
        $response->assertSee('some-js');
    }

    public function test_get_with_json()
    {
        $response = $this->getJson('/');

        $response->assertOk();
        $response->assertJsonFragment(['key' => 'value']);
    }

    public function test_get_with_pdf_and_responsable()
    {
        Request::createFromGlobals()->setFormat('pdf', 'text/csv');

        $response = $this->get('/', ['Accept' => 'text/csv']);

        $response->assertOk();
        $response->assertSee('some-csv');
    }

    public function test_get_with_xml_and_callable()
    {
        $response = $this->get('/', ['Accept' => 'application/xml']);

        $response->assertOk();
        $response->assertSee('some-xml');
    }

    public function test_get_with_txt_and_callable()
    {
        $response = $this->get('/', ['Accept' => 'text/plain']);

        $response->assertOk();
        $response->assertSee('some-text');
    }

    public function test_exception_is_thrown_if_no_response_for_format()
    {
        $this->withoutExceptionHandling();
        $this->expectException(NotSupportedFormatException::class);

        $this->get('/no-response');
    }

    public function test_exception_is_thrown_if_with_has_not_been_called()
    {
        $this->withoutExceptionHandling();
        $this->expectException(MissingWithException::class);

        $this->get('/no-with');
    }

    public function test_default_format()
    {
        $response = $this->get('/default-format', ['Accept' => 'application/js']);

        $response->assertOk();
        $response->assertSee('some-html');
    }

    public function test_custom_default_format()
    {
        $response = $this->get('/custom-format', ['Accept' => 'application/js']);

        $response->assertOk();
        $response->assertSee('some-text');
    }
}
