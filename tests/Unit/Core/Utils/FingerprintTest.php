<?php

namespace Tests\Unit\Core\Utils;

use App\Console\Core\Utils\Fingerprint;
use Tests\TestCase;

class FingerprintTest extends TestCase
{
    public function testCreateFingerprint(): void
    {
        $fingerprint = Fingerprint::make([]);
        $this->assertEquals('d751713988987e9331980363e24189ce', $fingerprint);
    }

    public function testCreateDiffFingerprint(): void
    {
        $fingerprint1 = Fingerprint::make([]);
        $fingerprint2 = Fingerprint::make([1]);

        $this->assertNotEquals($fingerprint1, $fingerprint2);
    }
}
