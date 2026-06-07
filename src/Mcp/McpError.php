<?php

namespace BlatUI\Mcp;

/** A JSON-RPC error with a protocol error code. */
class McpError extends \RuntimeException
{
    public function __construct(int $code, string $message)
    {
        parent::__construct($message, $code);
    }
}
