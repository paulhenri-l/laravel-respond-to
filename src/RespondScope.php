<?php

namespace PHL\LaravelRespondTo;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHL\LaravelRespondTo\Exceptions\MissingWithException;
use PHL\LaravelRespondTo\Exceptions\NotSupportedFormatException;

class RespondScope implements Responsable
{
    /**
     * Used when the response to the current format has not been set.
     */
    protected const NOT_SET = 'RESPOND_SCOPE_NOT_SET';

    /**
     * The default format used when the request format does not exists.
     *
     * @var string
     */
    protected $defaultFormat = 'html';

    /**
     * The format that we are currently configuring.
     *
     * @var string
     */
    protected $currentFormat;

    /**
     * Array containing all of the response formats and their response.
     *
     * @var array
     */
    public $formats = [];

    /**
     * Change to a new format.
     */
    public function to(string $format): RespondScope
    {
        $this->ensureCurrenntFormatHasResponse();
        $this->setCurrentFormat($format);

        return $this;
    }

    /**
     * Respond to the current format with the given responsable, callable or data.
     */
    public function with(?$response = null)
    {
        $this->formats[$this->currentFormat] = $response;

        return $this;
    }

    /**
     * Respond to the current format with the given view.
     */
    public function withView($view = null, $data = [], $mergeData = []): RespondScope
    {
        $this->with(
            view(...func_get_args())
        );

        return $this;
    }

    /**
     * Set the default format that should be returned by this RespondScope
     */
    public function default(string $format): RespondScope
    {
        $this->defaultFormat = $format;

        return $this;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     * @return Response
     */
    public function toResponse($request)
    {
        $response = $this->getResponseForFormat(
            $request->format()
        );

        if ($response instanceof Responsable) {
            return $response->toResponse($request);
        }

        // Check if callable too. If necessary.

        return $response;
    }

    /**
     * Set the current format.
     */
    protected function setCurrentFormat(?string $format): void
    {
        if (!$format) {
            return;
        }

        $this->formats[$format] = static::NOT_SET;
        $this->currentFormat = $format;
    }

    /**
     * Ensure the current format has a response.
     */
    protected function ensureCurrenntFormatHasResponse(): void
    {
        if (!$this->currentFormat) {
            return;
        }

        if ($this->formats[$this->currentFormat] === static::NOT_SET) {
            throw new MissingWithException(
                "Missing `with` for response format {$this->currentFormat}"
            );
        }
    }

    /**
     * Get the response for the given format.
     */
    protected function getResponseForFormat(string $format)
    {
        $response = $this->formats[$format]
            ?? $this->formats[$this->defaultFormat]
            ?? null;

        if (!$response) {
            throw new NotSupportedFormatException(
                "No response for this response format ({$format})"
            );
        }

        return $response;
    }
}
