<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrpath/Path.php');
require_once(RACINE_WWW . '/src/class/pctrpath/RegexPath.php');

/**
 * ClassNameTest
 * @group group
 */
class PathTest extends TestCase
{

    protected Path|null $object;

    protected function setUp(): void {
        foreach (array_string_all() as $value) {
            $this->object = new Path($value);
            $this->testing();
            foreach (array_string_all() as $value2) {
                $this->object = new Path($value, $value2);
                $this->testing();
            }
        }
        $this->object = new Path();
        $this->testing();
    }

    private function systemsepa(string $text): string {
        return preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $text);
    }

    public function testPathdef():void {
        foreach (array_pathmain() as $value) {
            $this->object = (!empty($value["filein"])) ? 
                                new Path($value["parentin"], $value["filein"]) : 
                                new Path($value["parentin"]);
            $this->testing();
            $this->assertEquals($this->object->getName(), $this->systemsepa($value["name"]));
            $this->assertEquals($this->object->getPath(), $this->systemsepa($value["path"]));
            $this->assertEquals($this->object->getParent(), $this->systemsepa($value["parent"]));
            if(!empty($value["absolutparent"])) {
                $this->assertEquals($this->object->getAbsoluteParent(), $this->systemsepa($value["absolutparent"]));
                $this->assertEquals($this->object->getAbsolutePath(), $this->systemsepa($value["absolutpath"]));
                $this->assertEquals($this->object->getDiskname(), $this->systemsepa($value["namedisk"]));
            }
            $this->testing();
        }
    }

    public function testBase(): void
    {
        $testFunction = Path::base();
        $this->assertNotEmpty($testFunction);
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
        $this->testExists();
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

    public function testExists(): void {
        $testFunction = $this->object->exists();
        $this->assertNotNull($testFunction);
        $this->assertIsBool($testFunction);
    }

}
