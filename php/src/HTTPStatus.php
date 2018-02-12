<?php
namespace Sustav;

/**
 * HTTP status.
 */
class HTTPStatus
{
    /** 200 Ok */
    public const OK = 200;
    /** 301 Moved Permanently */
    public const MOVED_PERMANENTLY = 301;
    /** 302 Found (Moved Temporarily, HTTP/1.0) */
    public const FOUND = 302;
    /** 303 See Other (Moved Temporarily, HTTP/1.1) */
    public const SEE_OTHER = 303;
    /** 404 Not Found */
    public const NOT_FOUND = 404;
    /** 405 Method Not Allowed */
    public const METHOD_NOT_ALLOWED = 405;
    /** 500 Internal Server Error */
    public const INTERNAL_SERVER_ERROR = 500;
}
