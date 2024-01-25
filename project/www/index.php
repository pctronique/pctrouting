<?php

include_once dirname(__FILE__) . '/src/class/pctrpath/PathPhp.php';
//include_once dirname(__FILE__) . '/src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/Platform.php';

$test2 = new Platform();
//$test = new RouteMain();
$test3 = new PathPhp("./jhgf", "/lkjh");
var_dump($_SERVER);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document - <?= $test2->getName() ?></title>
</head>
<body>
    
</body>
</html>
