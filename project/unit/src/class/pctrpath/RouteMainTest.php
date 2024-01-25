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
    }

    public function __construct(bool $isRoutage = true) {
    }

    public function addIgnorePath(string|null $name):self {
    }

    public function folderroute():string|null {
        return null;
    }
    
    public function path(string|null $path):string|null {
        return null;
    }
    
    public function tabGetIndPg():array|null {
        return null;
    }

    public function getCurrentDir():string|null
    {
        return null;
    }

}
