<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__)."/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_WWW . '/src/class/pctrpath/PathPhp.php');

/**
 * ClassNameTest
 * @group group
 */
class PathPhpTest extends TestCase
{

    protected PathPhp|null $object;

    protected function setUp(): void {
        $this->object = new PathPhp();
    }

    public static function pathParent(string|null $path = null): string|null {
        return null;
    }
    
    public static function currentPath(string|null $path):string|null {
        return null;
    }
    
    public static function path(string|null $pathParent, string|null $path = null): string|null {  
        return null;
    }

}
