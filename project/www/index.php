<?php

include_once dirname(__FILE__) . '/src/class/pctrpath/Path.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/PathDef.php';
//include_once dirname(__FILE__) . '/src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/Platform.php';

/*echo "<br />";
var_dump(preg_match_all('/^[\/]{2,}[.]{1,}/sim', "//uytr/iu") != false);
echo "<br />";
var_dump(preg_match_all('/^[\/]{2,}[.]* /sim', "///uytr/iu") != false);
echo "<br />";
var_dump(preg_match_all('/^[\/]{2,}[.]* /sim', "/uytr/iu") != false);
echo "<br />";

preg_match('/^[\/]{2,}[^\/.\.]{1,}/sim', "//uytr.fr/iu", $matches);
print_r($matches);
echo "<br />";

preg_match('/^[\/]{2,}[.]* /sim', "///uytr/iu", $matches);
print_r($matches);
echo "<br />";

preg_match('/^[\/]{2,}[.]* /sim', "/uytr//iu", $matches);
print_r($matches);
echo "<br />";*/

$tabvalues = [
    "./../../../../../../../lkjh/../../kjl/mpol/lkju/../../poiu/mlkjh/mpol/"
    /*, 
    "../jhgf/../../../lkjh/../kjl/mpol/lkju/../../", 
    "/jhgf/../../../lkjh/../kjl/mpol/lkju/../../", 
    "/jhgf/lkjh/../kjl/mpol/lkju/../../", 
    "k:\\jhgf\\..\\..\\..\\lkjh\\..\\kjl\\mpol\\lkju\\..\\..\\", 
    "k:\\jhgf\\lkjh\\..\\kjl\\mpol\\lkju\\..\\..\\", 
    "\\k:\\jhgf\\..\\..\\..\\lkjh\\..\\kjl\\mpol\\lkju\\..\\..\\",
    "https://jhgf.tf:80/lkjh/kjl/mpol/lkju/", 
    "file:///jhgf/lkjh/kjl/mpol/lkju/",  
    "file://C:/jhgf/lkjh/kjl/mpol/lkju/",
    "https://jhgf/../../../lkjh/../kjl/mpol/lkju/../../", 
    "file:///jhgf/../../../lkjh/../kjl/mpol/lkju/../../",  
    "file://C:/jhgf/../../../lkjh/../kjl/mpol/lkju/../../"*/
];

function display($txt) {
    $test4 = new Path($txt, "hgf21/854/lki");
    //$test4 = new PathDef($txt);
    //var_dump($txt);
    var_dump([$txt, $test4]);
}

$test2 = new Platform();

foreach ($tabvalues as $txt) {
    display($txt);
}

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
