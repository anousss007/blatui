# Agent readiness

BlatUI's docs site is built to be **legible to AI agents**, not just humans. This
is what we expose and where, mapped to the checks at
[isitagentready.com](https://isitagentready.com) / [specification.website](https://specification.website).

## Endpoints (all live, no build step)

| Surface | Path | Type |
|---|---|---|
| LLM index | `/llms.txt` | `text/markdown` |
| LLM full reference | `/llms-full.txt` | `text/markdown` |
| Registry index (shadcn schema) | `/registry.json` | `application/json` |
| Registry item (source inlined) | `/r/{name}.json` · `/r/blocks/{name}.json` · `/r/charts/{name}.json` | `application/json` |
| **Hosted MCP server** (JSON-RPC, Streamable HTTP) | `POST /mcp` | `application/json` |
| MCP server card (SEP-1649) | `/.well-known/mcp/server-card.json` | `application/json` |
| A2A agent card | `/.well-known/agent-card.json` | `application/json` |
| Agent Skills index | `/.well-known/agent-skills/index.json` | `application/json` |
| Agent Skill | `/.well-known/agent-skills/blatui/SKILL.md` | `text/markdown` |
| API catalogue (RFC 9727) | `/.well-known/api-catalog` | `application/linkset+json` |
| OpenAPI 3.1 | `/openapi.json` | `application/json` |
| Per-page markdown | append `.md` or send `Accept: text/markdown` | `text/markdown` |

Every HTML page also carries `Link:` discovery headers (llms.txt, sitemap,
api-catalog, MCP server card, agent card) and a `<link rel="alternate"
type="text/markdown">`. `robots.txt` welcomes the major AI crawlers and carries
an IETF AI-Preferences `Content-Signal` directive. A WebMCP tool is registered
in-page when `navigator.modelContext` is present.

## One manual step: DNS-AID

DNS for AI Discovery is the only signal we can't ship from the app — it lives in
DNS, which the domain owner controls. Add this record at the `remix-it.com` DNS
provider:

```
Host:  _blatui._mcp._agents.blatui.remix-it.com
Type:  TXT
Value: v=mcp1; registry=https://blatui.remix-it.com/registry.json; card=https://blatui.remix-it.com/.well-known/mcp/server-card.json; endpoint=https://blatui.remix-it.com/mcp; public=true; version=2025-06-18
```

(Enable DNSSEC on the zone if available — DNS-AID uses it for verification.)

## Not applicable (free OSS library)

The OAuth and Commerce checks (x402, MPP, UCP, ACP, OAuth Protected Resource)
target paid/transactional APIs. BlatUI is free and MIT-licensed, so these are
intentionally not implemented rather than faked.

## Regenerating

All payloads are generated on demand from the authored components + `config/docs.php`
and cached on a content signature, so they stay in sync automatically. The
services live in `app/Support/RegistryDistribution.php`, `app/Support/AgentReadiness.php`
and `app/Mcp/HttpServer.php`.
