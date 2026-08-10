// What to test, discovered from the site's own sitemap rather than a committed list —
// a new component is covered the moment it is published, and the same run works against
// localhost or production without a second source of truth to keep in sync.

export async function discover(baseUrl) {
    const xml = await fetch(`${baseUrl}/sitemap.xml`).then((r) => {
        if (!r.ok) throw new Error(`sitemap.xml → HTTP ${r.status}. Is the demo served at ${baseUrl}?`);

        return r.text();
    });

    const paths = [...xml.matchAll(/<loc>([^<]+)<\/loc>/g)]
        .map((m) => m[1].replace(/^https?:\/\/[^/]+/, ''))
        .map((p) => p.replace(/\/$/, ''));

    const slugsUnder = (prefix) =>
        [...new Set(paths.filter((p) => p.startsWith(`${prefix}/`)).map((p) => p.slice(prefix.length + 1)))]
            .filter((s) => s && !s.includes('/'))
            .sort();

    return {
        components: slugsUnder('/components'),
        blocks: slugsUnder('/blocks'),
        templates: slugsUnder('/templates'),
        charts: slugsUnder('/charts'),
    };
}
