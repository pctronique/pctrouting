<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__) . "/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrouting/Platform.php');

/**
 * ClassNameTest
 * @group group
 */
class PlatformTest extends TestCase
{

    protected Platform|null $object;

    protected function setUp(): void
    {
        $this->object = new Platform();
        $this->testing();
    }

    private function testing() {
        $this->testGetName();
        $this->testPhp_os();
        $this->testIswin();
    }
    
    public function testGetName(): void
    {
        $testFunction = $this->object->getName();
        $this->assertNotNull($testFunction);
        $this->assertNotEmpty($testFunction);
    }
    
    public function testPhp_os(): void
    {
        $testFunction = $this->object->php_os();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testIswin(): void
    {
        $testFunction = $this->object->iswin();
        $this->assertNotNull($testFunction);
        $this->assertIsBool($testFunction);
    }


}

