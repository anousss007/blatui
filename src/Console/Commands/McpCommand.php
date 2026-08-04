<?php

namespace BlatUI\Console\Commands;

use BlatUI\Mcp\RegistryClient;
use BlatUI\Mcp\Server;
use BlatUI\Registry;
use Composer\InstalledVersions;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Runs the BlatUI MCP server over stdio so an AI editor (Claude Code, Cursor,
 * Windsurf, VS Code…) can discover and install components in conversation.
 *
 * Register it in the editor's MCP config, e.g.:
 *   {
 *     "mcpServers": {
 *       "blatui": { "command": "php", "args": ["artisan", "blatui:mcp"] }
 *     }
 *   }
 *
 * Transport: newline-delimited JSON-RPC 2.0 messages on STDIN/STDOUT. Nothing
 * but protocol frames may be written to STDOUT — diagnostics go to STDERR.
 */
class McpCommand extends Command
{
    protected $signature = 'blatui:mcp {--registry= : Base URL of the registry (default: https://blatui.remix-it.com)}';

    protected $description = 'Run the BlatUI MCP server (stdio) for AI editors';

    public function handle(Registry $registry): int
    {
        // Keep STDOUT clean for protocol frames only.
        $this->output->setVerbosity(OutputInterface::VERBOSITY_QUIET);

        $client = new RegistryClient($registry, $this->option('registry') ?: null);
        $server = new Server($client, $this->blatuiVersion());

        $stdin = fopen('php://stdin', 'rb');
        $stdout = fopen('php://stdout', 'wb');
        if ($stdin === false || $stdout === false) {
            fwrite(STDERR, "blatui:mcp — could not open stdio streams\n");

            return self::FAILURE;
        }

        fwrite(STDERR, "blatui:mcp listening on stdio (registry: {$client->base()})\n");

        while (($line = fgets($stdin)) !== false) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            $message = json_decode($line, true);
            if (! is_array($message)) {
                $this->writeFrame($stdout, [
                    'jsonrpc' => '2.0',
                    'id' => null,
                    'error' => ['code' => -32700, 'message' => 'Parse error'],
                ]);

                continue;
            }

            $response = $server->handle($message);
            if ($response !== null) {
                $this->writeFrame($stdout, $response);
            }
        }

        return self::SUCCESS;
    }

    /** Write one newline-delimited JSON-RPC frame and flush. */
    protected function writeFrame($stream, array $payload): void
    {
        fwrite($stream, json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)."\n");
        fflush($stream);
    }

    /**
     * The installed package version, as reported to the MCP client.
     *
     * Composer derives a library's version from its git tag — a `version` field
     * in composer.json is discouraged and this package has none, so reading it
     * from there always fell through to 'dev'. Ask Composer's installed-packages
     * metadata instead, and keep the composer.json read as a fallback for the
     * odd install that does pin one.
     */
    protected function blatuiVersion(): string
    {
        if (class_exists(InstalledVersions::class) && InstalledVersions::isInstalled('anousss007/blatui')) {
            $version = InstalledVersions::getPrettyVersion('anousss007/blatui');
            if (is_string($version) && $version !== '') {
                return ltrim($version, 'v');
            }
        }

        $composer = dirname(__DIR__, 3).'/composer.json';
        if (is_file($composer)) {
            $data = json_decode((string) file_get_contents($composer), true);
            if (isset($data['version'])) {
                return (string) $data['version'];
            }
        }

        return 'dev';
    }
}
