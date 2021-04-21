<?php

namespace Request;

use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

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

    protected $request;
    protected $pathInfo;
    protected $requestUri;
    protected $baseUrl;
    protected $basePath;
    protected $method;

    /**
     * @param  mixed  ...$args
     *
     * @return HttpRequest
     */
    static function new(...$args)
    {
        return new self(...$args);
    }

    public function __construct()
    {
        $this->request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

        $this->pathInfo   = null;
        $this->requestUri = null;
        $this->baseUrl    = null;
        $this->basePath   = null;
        $this->method     = null;
    }

    public function instance()
    {
        return $this;
    }

    public function method()
    {
        return $this->request->getMethod();
    }

    public function root()
    {
        return rtrim($this->request->getSchemeAndHttpHost().$this->request->getBaseUrl(), '/');
    }

    public function uri()
    {
        return $this->request->getUri();
    }

    public function ip()
    {
        return $this->request->getClientIp();
    }

    public function userAgent()
    {
        return $this->request->headers->get('User-Agent');
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
        return $this->request->get($key, $default);
    }

    public function all()
    {
        return $this->request->query->all();
    }
}
