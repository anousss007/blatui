<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // The pre-built pages pull assets in via @vite. Stub the manifest so the whole
        // suite renders without a `npm run build` first — the asset build is verified
        // separately in CI. Tests stay green out of the box on a fresh clone.
        $this->withoutVite();
    }
}
