# Listing the BlatUI MCP server in directories

The hosted MCP server is live at `POST https://blatui.remix-it.com/mcp`
(Streamable HTTP, stateless) and advertised by its card at
`/.well-known/mcp/server-card.json`. It exposes **tools** (list/search/get/
install), **resources** (`blatui://component|block|chart/{name}`) and
**prompts** (`use-component`, `scaffold-page`).

`server.json` (repo root) is the submission manifest for the official registry.

## Where to submit (each needs your account / approval)

1. **Official MCP Registry** — `registry.modelcontextprotocol.io`
   - Install the publisher: `brew install mcp-publisher` (or download a release).
   - Auth with GitHub (proves ownership of the `io.github.anousss007/*` namespace):
     `mcp-publisher login github`
   - `mcp-publisher publish` (reads `server.json`).
   - This feeds the downstream aggregators below.

2. **Smithery** — https://smithery.ai/new — add the GitHub repo or remote URL.
3. **mcp.so** — https://mcp.so/submit — submit name, description, remote URL.
4. **Glama** — https://glama.ai/mcp/servers — auto-indexes; can submit the repo.
5. **PulseMCP** — https://www.pulsemcp.com/submit

## Suggested listing copy

> **BlatUI** — shadcn/ui for Laravel Blade. An MCP server that lets your AI
> editor search, read and install 55+ accessible Blade components, 60+ blocks
> and 70+ charts directly into a Laravel project. Free, MIT, you own the code.
> Tools: `search_registry`, `get_component`, `get_example`, `install_command`.

## Editor quick-add (for the README)

Claude Code / Cursor / VS Code MCP config:

```json
{
  "mcpServers": {
    "blatui": { "type": "streamable-http", "url": "https://blatui.remix-it.com/mcp" }
  }
}
```

Or the local stdio server (after `composer require blatui/blatui`):

```json
{ "mcpServers": { "blatui": { "command": "php", "args": ["artisan", "blatui:mcp"] } } }
```

Steps 1–5 are outward-facing (public submissions under your accounts) and are
left for your approval — this file is the playbook, not the submission.
