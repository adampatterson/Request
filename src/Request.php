<?php

namespace Request;

/**
 * Class Request
 * @package Request
 * @author Adam Patterson <http://github.com/adampatterson>
 * @link  https://github.com/adampatterson/Request
 */
class Request
{

    /**
     * Request constructor.
     */
    public static function __callStatic($method, $args)
    {
        return MakeRequest::new()->{$method}(...$args);

    }
}

class MakeRequest
{

    static $request;


    /**
     * @param  mixed  ...$args
     *
     * @return HttpRequest
     */
    static function new(...$args)
    {
        self::$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

        return new self(...$args);
    }

    /**
     * If access to the full Symfony component is needed then use
     * $this->request->get
     *
     * @param  string  $key
     * @param  null  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return self::$request->get($key, $default);
    }
}
