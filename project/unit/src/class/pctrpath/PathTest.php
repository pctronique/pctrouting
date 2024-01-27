<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
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

    public function testPathdef():void {
        foreach (array_path() as $value) {
            $this->object = new Path($value[0]);
            $this->testing();
            fwrite(STDOUT, "path recp : ".$this->object->getPath() . "\n");
            fwrite(STDOUT, "path defa : ".preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value[1]) . "\n");
            fwrite(STDOUT, "parent recp : ".$this->object->getParent() . "\n");
            fwrite(STDOUT, "parent defa : ".preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value[2]) . "\n");
            $this->assertTrue($this->object->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value[1]));
            $this->assertTrue($this->object->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value[2]));
            if(!empty($value[3])) {
                fwrite(STDOUT, "absoluteparent recp : ".$this->object->getAbsoluteParent() . "\n");
                fwrite(STDOUT, "absoluteparent defa : ".preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value[3]) . "\n");
                $this->assertTrue($this->object->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value[3]));
            }
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
