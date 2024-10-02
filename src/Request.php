<?php

namespace Request;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * Class Request
 * @package Request
 * @author Adam Patterson <http://github.com/adampatterson>
 * @link  https://github.com/adampatterson/Request
 */
class Request
{
    public static function __callStatic($method, $args)
    {
        return MakeRequest::new()->{$method}(...$args);
    }
}

class MakeRequest
{

    protected $request;

    static function new(...$args)
    {
        return new self(...$args);
    }

    public function __construct()
    {
        $this->request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }

    public function instance(): SymfonyRequest
    {
        return $this->request;
    }

    public function method(): string
    {
        return $this->request->getMethod();
    }

    public function root(): string
    {
        return rtrim($this->request->getSchemeAndHttpHost().$this->request->getBaseUrl(), '/');
    }

    public function uri(): string
    {
        return $this->request->getUri();
    }

    public function ip(): ?string
    {
        return $this->request->getClientIp();
    }

    public function userAgent(): ?string
    {
        return $this->request->headers->get('User-Agent');
    }

    public function get(string $key, $default = null): mixed
    {
        return $this->request->get($key, $default);
    }

    public function has(string $key): bool
    {
        return $this->request->query->has($key);
    }

    public function all($method = 'GET'): array
    {
        return match ($method) {
            'get', 'GET'       => $this->request->query->all(),
            'post', 'POST'     => $this->request->request->all(),
            'cookie', 'COOKIE' => $this->request->cookies->all(),
        };
    }
}
