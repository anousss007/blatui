<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Advertises the site's machine-readable resources in HTTP Link headers on
 * every HTML page, so an agent discovers them without parsing the document:
 * llms.txt, the sitemap, the RFC 9727 API catalogue, the MCP server card and
 * the A2A agent card. Also signals that a markdown alternate exists (Vary).
 */
class AgentDiscovery
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $contentType = (string) $response->headers->get('Content-Type', '');
        if (! str_contains($contentType, 'text/html')) {
            return $response;
        }

        $base = rtrim((string) config('brand.url', 'https://blatui.remix-it.com'), '/');

        $links = [
            '<'.$base.'/llms.txt>; rel="llms-txt"; type="text/markdown"',
            '<'.$base.'/sitemap.xml>; rel="sitemap"; type="application/xml"',
            '<'.$base.'/.well-known/api-catalog>; rel="api-catalog"',
            '<'.$base.'/.well-known/mcp/server-card.json>; rel="mcp-server"',
            '<'.$base.'/.well-known/agent-card.json>; rel="agent-card"',
            '<'.$request->url().'.md>; rel="alternate"; type="text/markdown"',
        ];

        $response->headers->set('Link', implode(', ', $links));

        $vary = array_filter(array_map('trim', explode(',', (string) $response->headers->get('Vary', ''))));
        if (! in_array('Accept', $vary, true)) {
            $vary[] = 'Accept';
        }
        $response->headers->set('Vary', implode(', ', $vary));

        return $response;
    }
}
