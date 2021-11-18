<?php declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Meta;
use PHPUnit\Framework\TestCase;

class MetaTest extends TestCase
{
    public function testMeta(): void
    {
        $clientFilename = 'excample.pdf';
        $serverFilename = 'DF23534253T4FASFWFASF';
        $mediaType = 'application/pdf';
        $password = 'dsdafefwfdsfasd';
        $path = '/ds/da/fe';

        $metaTest = new Meta();
        $metaTest->setClientFilename($clientFilename)
            ->setServerFilename($serverFilename)
            ->setMediaType($mediaType)
            ->setPassword($password)
            ->setPath($path);

        $this->assertSame($clientFilename, $metaTest->getClientFilename());
        $this->assertSame($serverFilename, $metaTest->getServerFilename());
        $this->assertSame($mediaType, $metaTest->getMediaType());
        $this->assertSame($password, $metaTest->getPassword());
        $this->assertSame($path, $metaTest->getPath());
    }
}
