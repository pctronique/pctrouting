<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrpath/PathServe.php');
require_once(RACINE_WWW . '/src/class/pctrpath/RegexPath.php');

/**
 * ClassNameTest
 * @group group
 */
class PathServeTest extends TestCase
{

    protected PathServe|null $object;

    protected function setUp(): void {
        foreach (array_string_all() as $value) {
            $this->object = new PathServe($value);
            $this->testing();
            foreach (array_string_all() as $value2) {
                $this->object = new PathServe($value, $value2);
                $this->testing();
            }
        }
        $this->object = new PathServe();
        $this->testing();
    }

    public function testPathdef():void {
        foreach (array_pathhttp() as $value) {
            $this->object =  (!empty($value["filein"])) ? 
                                new PathServe($value["parentin"], $value["filein"]) : 
                                new PathServe($value["parentin"]);
            $this->testing();
            $this->assertEquals($this->object->getName(), $value["name"]);
            $this->assertEquals($this->object->getPath(), $value["path"]);
            $this->assertEquals($this->object->getParent(), $value["parent"]);
            if(!empty($value["absolutparent"])) {
                $this->assertEquals($this->object->getAbsoluteParent(), $value["absolutparent"]);
                $this->assertEquals($this->object->getAbsolutePath(), $value["absolutpath"]);
                $this->assertEquals($this->object->getDiskname(), $value["namedisk"]);
            }
            $this->testing();
        }
    }

    public function testBase(): void
    {
        $testFunction = PathServe::base();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }

    private function testing() {
        $this->testGetName();
        $this->testGetParent();
        $this->testGetDiskname();
        $this->testGetAbsoluteParent();
        $this->testGetAbsolutePath();
        $this->testGetPath();
    }
    
    public function testGetName(): void
    {
        $testFunction = $this->object->getName();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetParent(): void
    {
        $testFunction = $this->object->getParent();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetDiskname(): void
    {
        $testFunction = $this->object->getDiskname();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }

    public function testGetAbsoluteParent(): void
    {
        $testFunction = $this->object->getAbsoluteParent();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetAbsolutePath(): void
    {
        $testFunction = $this->object->getAbsolutePath();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetPath(): void
    {
        $testFunction = $this->object->getPath();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }

}
