<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_WWW . '/src/class/pctrpath/RouteMain.php');

/**
 * ClassNameTest
 * @group group
 */
class RouteMainTest extends TestCase
{

    protected RouteMain|null $object;

    protected function setUp(): void {
        $this->object = new RouteMain();
        $this->test();
    }

    private function test(): void {
        $this->testGetIndPg();
        $this->testGetIndPgKey();
        $this->testGetCurrentDir();
        $this->testGetIsRoutage();
        $this->testPathSystem();
        $this->testIndexbool();
        $this->testGetUrl();
    }

    private function trimchar(string $txt):string {
        return trim(trim($txt, "."), "/");
    }

    public function testPath(): void {
        $object = new RouteMain();
        foreach (array_string_all() as $value) {
            $testFunction = $object->path($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
        foreach (array_route() as $value) {
            $testFunction = $object->path($value[0]);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            fwrite(STDOUT, $value[0]." | ".$this->trimchar($testFunction)." | ".$this->trimchar($value[1])."\n");
            $this->assertEquals($this->trimchar($testFunction), $this->trimchar($value[1]));
        }
    }

    public function testPathFile(): void {
        $object = new RouteMain();
        foreach (array_string_all() as $value) {
            $testFunction = $object->pathFile($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
        foreach (array_route() as $value) {
            $testFunction = $object->path($value[0]);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            fwrite(STDOUT, $value[0]." | ".$this->trimchar($testFunction)." | ".$this->trimchar($value[1])."\n");
            $this->assertEquals($this->trimchar($testFunction), $this->trimchar($value[1]));
        }
    }
    
    public function testGetIndPg(): void {
        $testFunction = $this->object->getIndPg();
        $this->assertNotNull($testFunction);
        $this->assertIsArray($testFunction);
    }
    
    public function testGetIndPgKey(): void {
        for ($i=-10; $i < 10; $i++) {
            $testFunction = $this->object->getIndPgKey($i);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }

    public function testGetCurrentDir(): void {
        $testFunction = $this->object->getCurrentDir();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetIsRoutage(): void {
        $testFunction = $this->object->getIsRoutage();
        $this->assertNotNull($testFunction);
        $this->assertIsBool($testFunction);
    }
    
    public function testPathSystem():void {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->pathSystem($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }
    
    public function testIndexbool():void {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->getIsRoutage($value);
            $this->assertNotNull($testFunction);
            $this->assertIsBool($testFunction);
        }
        
    }
    
    public function testGetUrl(): void
    {
        $testFunction = $this->object->getUrl();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }

}
