<?php

declare(strict_types=1);

namespace GoSuccess\Enhance\Http;

use GoSuccess\Enhance\Client\Configuration;
use GoSuccess\Enhance\Enum\HttpMethod;
use GoSuccess\Enhance\Exception\RequestException;
use GoSuccess\Enhance\Exception\TransportException;

/**
 * The default transport, over the cURL extension.
 */
final class CurlTransport implements Transport
{
    /**
     * Reused cURL handle, enabling connection keep-alive across requests.
     *
     * Since PHP 8.0 this is a \CurlHandle object that is closed automatically
     * once it goes out of scope, so no explicit teardown is required.
     */
    private ?\CurlHandle $handle = null;

    public function __construct()
    {
        if (! \extension_loaded('curl')) {
            throw new RequestException('The cURL extension is required but not loaded');
        }
    }

    public function send(HttpMethod $method, string $url, array $headers, string|array|null $payload, Configuration $config): RawResponse
    {
        if ($url === '') {
            throw new TransportException('Request URL must not be empty');
        }

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_ENCODING => '',
            CURLOPT_CONNECTTIMEOUT => $config->connectTimeout,
            CURLOPT_TIMEOUT => $config->timeout,
            CURLOPT_SSL_VERIFYPEER => $config->verifySsl,
            CURLOPT_SSL_VERIFYHOST => $config->verifySsl ? 2 : 0,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method->value,
            CURLOPT_HEADER => true,
            CURLOPT_HTTPHEADER => $headers,
        ];

        if ($payload !== null) {
            $options[CURLOPT_POSTFIELDS] = $payload;
        }

        // Reuse the handle across requests so cURL can keep the connection alive.
        $ch = $this->handle ??= curl_init();
        curl_reset($ch);
        curl_setopt_array($ch, $options);

        $raw = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $statusCode = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $headerSize = (int)curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        if ($errno !== 0 || ! \is_string($raw)) {
            throw new TransportException($error !== '' ? $error : 'unknown cURL error');
        }

        return new RawResponse($statusCode, self::parseHeaders(substr($raw, 0, $headerSize)), substr($raw, $headerSize));
    }

    /**
     * @return array<string, string>
     */
    private static function parseHeaders(string $rawHeaders): array
    {
        $headers = [];

        foreach (explode("\r\n", $rawHeaders) as $line) {
            $position = strpos($line, ':');

            if ($position === false) {
                continue;
            }

            $name = strtolower(trim(substr($line, 0, $position)));
            $headers[$name] = trim(substr($line, $position + 1));
        }

        return $headers;
    }
}
