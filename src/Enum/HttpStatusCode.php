<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Enum;

/**
 * Subset of HTTP status codes returned by the Enhance API.
 */
enum HttpStatusCode: int
{
    case Ok = 200;

    case Created = 201;

    case Accepted = 202;

    case NoContent = 204;

    case PartialContent = 206;

    case Found = 302;

    case BadRequest = 400;

    case Unauthorized = 401;

    case Forbidden = 403;

    case NotFound = 404;

    case Conflict = 409;

    case TooManyRequests = 429;

    case InternalServerError = 500;

    case BadGateway = 502;

    case ServiceUnavailable = 503;

    case GatewayTimeout = 504;

    public function isSuccess(): bool
    {
        // Every case in this enum is >= 200, so a single upper bound suffices.
        return $this->value < 300;
    }

    public function isClientError(): bool
    {
        return $this->value >= 400 && $this->value < 500;
    }

    public function isServerError(): bool
    {
        // Every case in this enum is < 600, so a single lower bound suffices.
        return $this->value >= 500;
    }
}
