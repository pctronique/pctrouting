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
        $this->object = new RouteMain(false);
        $this->test();
        $this->object = new RouteMain();
        $this->test();
    }

    private function test(): void {
        $this->testGetIndAndKeyPg();
        $this->testGetIndPg();
        $this->testGetIndAndKeyPgKey();
        $this->testGetIndPgKey();
        $this->testGetCurrentDir();
        $this->testGetParentPath();
        $this->testGetCssImgDir();
        $this->testGetIsRoutage();
    }

    public function testPath(): void {
        $object = new RouteMain();
        $objectf = new RouteMain(false);
        foreach (array_string_all() as $value) {
            $testFunction = $object->path($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            $testFunction = $objectf->path($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
        foreach (array_route() as $value) {
            $testFunction = $object->path($value[0]);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            $this->assertEquals($testFunction, $value[1]);
            $testFunction = $objectf->path($value[0]);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            $this->assertEquals($testFunction, $value[2]);
        }
    }

    public function testPathFile(): void {
        $object = new RouteMain();
        $objectf = new RouteMain(false);
        foreach (array_string_all() as $value) {
            $testFunction = $object->pathFile($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            $testFunction = $objectf->pathFile($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
        foreach (array_route() as $value) {
            $testFunction = $object->path($value[0]);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            $this->assertEquals($testFunction, $value[1]);
            $testFunction = $objectf->path($value[0]);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
            $this->assertEquals($testFunction, $value[2]);
        }
    }
    
    public function testGetIndAndKeyPg(): void {
        $testFunction = $this->object->getIndAndKeyPg();
        $this->assertNotNull($testFunction);
        $this->assertIsArray($testFunction);
    }
    
    public function testGetIndPg(): void {
        $testFunction = $this->object->getIndPg();
        $this->assertNotNull($testFunction);
        $this->assertIsArray($testFunction);
    }

    public function testGetIndAndKeyPgKey(): void {
        foreach (array_string_all() as $value) {
            $testFunction = $this->object->getIndAndKeyPgKey($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
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
    
    public function testGetParentPath(): void {
        $testFunction = $this->object->getParentPath();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetCssImgDir(): void {
        $testFunction = $this->object->getCssImgDir();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetIsRoutage(): void {
        $testFunction = $this->object->getIsRoutage();
        $this->assertNotNull($testFunction);
        $this->assertIsBool($testFunction);
    }

}
