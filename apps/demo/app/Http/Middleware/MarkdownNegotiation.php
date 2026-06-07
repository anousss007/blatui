<?php

namespace App\Http\Middleware;

use App\Support\RegistryDistribution;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Per-page markdown content negotiation (specification.website convention).
 *
 * An agent gets the markdown representation of a page either by appending
 * `.md` to the URL or by sending `Accept: text/markdown`. Browsers (which send
 * text/html first) are unaffected. Responses carry Content-Location + Vary so
 * caches behave.
 */
class MarkdownNegotiation
{
    public function __construct(
        protected RegistryDistribution $dist,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        $path = trim($request->path(), '/');
        if ($path === '/') {
            $path = '';
        }

        $explicit = str_ends_with($path, '.md');
        $logical = $explicit ? substr($path, 0, -3) : $path;

        if (! $explicit && ! $this->prefersMarkdown($request)) {
            return $next($request);
        }

        $markdown = $this->markdownFor($logical);

        if ($markdown === null) {
            // We can't render this one — let the router handle it (a real `.md`
            // route such as SKILL.md, or a natural 404). Never hijack.
            return $next($request);
        }

        return response($markdown, 200, [
            'Content-Type' => 'text/markdown; charset=utf-8',
            'Content-Location' => '/'.($logical === '' ? 'index' : $logical).'.md',
            'Vary' => 'Accept',
            'Access-Control-Allow-Origin' => '*',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /** True only when markdown is preferred over HTML in the Accept header. */
    protected function prefersMarkdown(Request $request): bool
    {
        foreach ($request->getAcceptableContentTypes() as $type) {
            if (str_contains($type, 'markdown')) {
                return true;
            }
            if (in_array($type, ['text/html', 'application/xhtml+xml', '*/*'], true)) {
                return false;
            }
        }

        return false;
    }

    protected function markdownFor(string $logical): ?string
    {
        if (in_array($logical, ['', 'docs', 'components', 'blocks', 'charts'], true)) {
            return $this->dist->llms();
        }
        if (preg_match('#^components/([a-z0-9-]+)$#', $logical, $m)) {
            return $this->dist->componentMarkdown($m[1]);
        }
        if (preg_match('#^blocks/([a-z0-9-]+)$#', $logical, $m)) {
            return $this->dist->blockMarkdown($m[1]);
        }
        if (preg_match('#^charts/([a-z0-9-]+)$#', $logical, $m)) {
            return $this->dist->chartMarkdown($m[1]);
        }

        return null;
    }
}
