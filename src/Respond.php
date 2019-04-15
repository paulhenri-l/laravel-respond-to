<?php

namespace PHL\LaravelRespondTo;

class Respond
{
    /**
     * Create a new RespondScope.
     */
    public static function withNewRespond(): RespondScope
    {
        return new RespondScope();
    }

    /**
     * Respond to the given format.
     */
    public static function to(string $format): RespondScope
    {
        return static::withNewRespond()->to($format);
    }
}
