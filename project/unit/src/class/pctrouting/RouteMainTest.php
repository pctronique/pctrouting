<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__) . "/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrouting/RouteMain.php');

/**
 * ClassNameTest
 * @group group
 */
class RouteMainTest extends TestCase
{

    protected RouteMain|null $object;
    
    protected function setUp(): void
    {
        $this->object = new RouteMain();
        $this->testing();
    }

    private function testing() {
        $this->testPath();
        $this->testPathFile();
        $this->testPathSystem();
        $this->testIndexbool();
        $this->testIndexregexbool();
        $this->testRecupregexvalue();
        $this->testLastvaluerouting();
        $this->testGetIndPg();
        $this->testGetIndPgKey();
        $this->testGetCurrentDir();
        $this->testGetIsRoutage();
        $this->testGetUrl();
    }
    
    public function testPath(): void
    {
        $testFunction = $this->object->path();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->path($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }
    
    public function testPathFile(): void
    {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->pathFile($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }
    
    public function testPathSystem(): void
    {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->pathSystem($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }
    
    public function testIndexbool(): void
    {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->indexbool($value);
            $this->assertNotNull($testFunction);
            $this->assertIsBool($testFunction);
        }
    }
    
    public function testIndexregexbool(): void
    {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->indexregexbool($value);
            $this->assertNotNull($testFunction);
            $this->assertIsBool($testFunction);
        }
    }
    
    public function testRecupregexvalue(): void
    {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->recupregexvalue($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }
    
    public function testLastvaluerouting(): void
    {
        $testFunction = $this->object->getCurrentDir();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetIndPg(): void
    {
        $testFunction = $this->object->getIndPg();
        $this->assertNotNull($testFunction);
        $this->assertIsArray($testFunction);
    }
    
    public function testGetIndPgKey(): void
    {
        for ($i=-100; $i <= 100; $i++) {
            $testFunction = $this->object->getIndPgKey($i);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }
    
    public function testGetCurrentDir(): void
    {
        $testFunction = $this->object->getCurrentDir();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetIsRoutage(): void
    {
        $testFunction = $this->object->getIsRoutage();
        $this->assertNotNull($testFunction);
        $this->assertIsBool($testFunction);
    }
    
    public function testGetUrl(): void
    {
        $testFunction = $this->object->getUrl();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
}

