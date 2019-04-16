# Laravel RespondTo

![Travis](https://api.travis-ci.org/paulhenri-l/laravel-respond-to.svg?branch=master)

This library will provide you with rails like `respond_to` functionality. This
feature allows a controller action to return different responses according to
the request `Accept` header (the format).

## Installation

```
composer require phl/laravel-respond-to
```

## Usage

You may use the respond to functionality in any of your controller action by
using the `PHL\LaravelRespondTo\Respond` class.

```php
<?php

use PHL\LaravelRespondTo\Respond;

class MyController
{
    public function index()
    {
        return Respond::to('html')->withView('hello', ['name' => 'John Doe'])
            ->to('json')->with(['key' => 'value'])
            ->to('txt')->with('some text')
            ->to('xml')->with(function () {})
            ->to('rss')->with(new \Illuminate\Http\Response())
            ->to('css')->with(new ResponsableClass);
    }
}
```

This controller is now able to respond to different formats with different 
responses.

*Each call to the `to` function must be followed by a `with` or `withView`
call.*

### Default format

If the current request asks for a response format that is not supported
the default one will be returned.

The default format is `html` you may change that using the `default` function.

```php
use PHL\LaravelRespondTo\Respond;

Respond::withNewRespond()
    ->to('json')->with(['key' => 'value'])
    ->default('json');
```

*If no response has been set for the default format an exception will get 
thrown when the controller will try to resolve the response*

### Supported formats

Under the hood this library relies on the Symfony Request mime types list. This
list is initially set with these formats:

```php
$formats = [
    'html' => ['text/html', 'application/xhtml+xml'],
    'txt' => ['text/plain'],
    'js' => ['application/javascript', 'application/x-javascript', 'text/javascript'],
    'css' => ['text/css'],
    'json' => ['application/json', 'application/x-json'],
    'jsonld' => ['application/ld+json'],
    'xml' => ['text/xml', 'application/xml', 'application/x-xml'],
    'rdf' => ['application/rdf+xml'],
    'atom' => ['application/atom+xml'],
    'rss' => ['application/rss+xml'],
    'form' => ['application/x-www-form-urlencoded'],
];
```

You may add new formats to this list like so:

```php
request()->setFormat('csv', 'text/csv');
```

### Writing the first `to` on a new line.

If like me you'd prefer to have each call to the `to` function on its own line
I've added a bit of syntactic sugar with the `withNewRespond` function.

```php
use PHL\LaravelRespondTo\Respond;

Respond::withNewRespond()
    ->to('html')->with('some html')
    ->to('json')->with(['key' => 'value'])
    ->to('xml')->withView('welcome_xml');
```

## Contributing and help

If you have any questions about how to use this library feel free to open
an issue :)

If you think that the documentation or the code could be improved open a PR
and I'll happily review it!
