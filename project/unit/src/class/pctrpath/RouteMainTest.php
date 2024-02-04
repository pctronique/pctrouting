<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_routing.php');
require_once(RACINE_WWW . '/src/class/pctrpath/RouteMain.php');
require_once(RACINE_WWW . '/src/class/pctrpath/Path.php');
require_once(RACINE_WWW . '/src/class/pctrpath/PathServe.php');

/**
 * ClassNameTest
 * @group group
 */
class RouteMainTest extends TestCase
{

    protected RouteMain|null $object;

    private function lienhttp($path0, $path1) {
        return (new PathServe($path0, $path1))->getAbsolutePath();
    }
    
    private function lienpath($path0, $path1) {
        return (new Path($path0, $path1))->getAbsolutePath();
    }
    
    private function tabind($ind) {
        return trim(implode("/", $ind), "/");
    }

    private function tabtestrt($tabtest, $route, $routenot) {
        $this->assertEquals($this->tabind($route->getIndPg()), $tabtest["getIndPg"]);
        $this->assertEquals($this->tabind($routenot->getIndPg()), $tabtest["getIndPg"]);
        $this->assertEquals($route->getCurrentDir(), $tabtest["getCurrentDir"]);
        $this->assertEquals($routenot->getCurrentDir(), $tabtest["getCurrentDir_n"]);
        $this->assertEquals($route->getIsRoutage(), $tabtest["getIsRoutage"]);
        $this->assertEquals($routenot->getIsRoutage(), $tabtest["getIsRoutage_n"]);
        $this->assertEquals($route->getUrl(), $tabtest["getUrl"]);
        $this->assertEquals($routenot->getUrl(), $tabtest["getUrl"]);
        foreach ($tabtest["getUrl"] as $key => $value) {
            $this->assertEquals($route->getIndPgKey($value["getIndPgKey"]), $value["getIndPgKey_res"]);
            $this->assertEquals($routenot->getIndPgKey($value["getIndPgKey"]), $value["getIndPgKey_res"]);
        }
        foreach ($tabtest["tabIndexbool"] as $key => $value) {
            $this->assertEquals($route->indexbool($value["indexbool"]), $value["indexbool_res"]);
            $this->assertEquals($routenot->indexbool($value["indexbool"]), $value["indexbool_res"]);
        }
        foreach ($tabtest["tabPathSystem"] as $key => $value) {
            $this->assertEquals($route->pathSystem($value["pathSystem"]), $this->lienpath($route->getCurrentDir(), $value["pathSystem_res"]));
            $this->assertEquals($routenot->pathSystem($value["pathSystem"]), $this->lienpath($routenot->getCurrentDir(), $value["pathSystem_res_r"]));
        }
        foreach ($tabtest["tabPath"] as $key => $value) {
            $this->assertEquals($route->path($value["path"]), $this->lienhttp($route->getCurrentDir(), $value["path_res"]));
            $this->assertEquals($routenot->path($value["path"]), $this->lienhttp($routenot->getCurrentDir(), $value["path_res_r"]));
        }
    }

    public function testrouting() {
        foreach (array_tabrouting() as $value) {
            $_GET["url"] = $value["url_a_n"];
            $table0 = new RouteMain();
            $_GET[PCTR_ROUTING_NR] = $_GET["url"];
            unset($_GET["url"]);
            $table2 = new RouteMain();
            unset($_GET[PCTR_ROUTING_NR]);
            $this->tabtestrt($value, $table0, $table2);
        }
    }

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

    public function testPath(): void {
        $object = new RouteMain();
        foreach (array_string_all() as $value) {
            $testFunction = $object->path($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
        }
    }

    public function testPathFile(): void {
        $object = new RouteMain();
        foreach (array_string_all() as $value) {
            $testFunction = $object->pathFile($value);
            $this->assertNotNull($testFunction);
            $this->assertIsString($testFunction);
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
