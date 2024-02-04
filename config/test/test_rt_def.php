<?php

include_once dirname(__FILE__) . '/../src/class/pctrpath/Path.php';
include_once dirname(__FILE__) . '/../src/class/pctrpath/PathServe.php';
include_once dirname(__FILE__) . '/../code/testrouting.php';
include_once dirname(__FILE__) . '/../code/tabletest.php';
include_once dirname(__FILE__) . '/../code/pathtest.php';
include_once dirname(__FILE__) . '/../../unit/function_routing.php';

function lienhttp($path0, $path1) {
    return (new PathServe($path0, $path1))->getAbsolutePath();
}

function lienpath($path0, $path1) {
    return (new Path($path0, $path1))->getAbsolutePath();
}

function tabind($ind) {
    return trim(implode("/", $ind), "/");
}

function boolstring($val) {
    return $val ? "true" : "false";
}

function disptabl($tab) {
    $header = ["key", "class", "expected", "validation"];
    displaytabLin($tab, "class RouteMain", $header);
}

function addlind($name, $text0, $text1, $istest) {
    $isvalid = ($text0 == $text1);
    $txtval = "";
    $tstvalid = "";
    if($istest){
        $txtval = $isvalid;
        $tstvalid = $isvalid;
    }
    return [
        $name,
        $text0,
        $text1,
        $txtval,
        "valid" => $tstvalid
    ];
}

function tabtestrt($tabtest, $route, $routenot) {
    $tabroutetest = [];
    $tabnroutetest = [];
    array_push($tabroutetest, addlind("url_a_n", $tabtest["url_a_n"], $tabtest["url_a_n"], false));
    array_push($tabnroutetest, addlind("url_a_n", $tabtest["url_a_n"], $tabtest["url_a_n"], false));
    array_push($tabroutetest, addlind("getCurrentDir", $route->getCurrentDir(), $tabtest["getCurrentDir"], true));
    array_push($tabnroutetest, addlind("getCurrentDir", $routenot->getCurrentDir(), $tabtest["getCurrentDir_n"], true));
    array_push($tabroutetest, addlind("getCurrentDir", $route->getIsRoutage(), $tabtest["getIsRoutage"], true));
    array_push($tabnroutetest, addlind("getCurrentDir", $routenot->getIsRoutage(), $tabtest["getIsRoutage_n"], true));
    array_push($tabroutetest, addlind("getUrl", $route->getUrl(), $tabtest["getUrl"], true));
    array_push($tabnroutetest, addlind("getUrl", $routenot->getUrl(), $tabtest["getUrl"], true));
    foreach ($tabtest["getUrl"] as $key => $value) {
        array_push($tabroutetest, addlind("getIndPgKey_".$key, $value["getIndPgKey"], $value["getIndPgKey"], false));
        array_push($tabnroutetest, addlind("getIndPgKey_".$key, $value["getIndPgKey"], $value["getIndPgKey"], false));
        array_push($tabroutetest, addlind("getIndPgKey_res_".$key, $route->getIndPgKey($value["getIndPgKey"]), $value["getIndPgKey_res"], true));
        array_push($tabnroutetest, addlind("getIndPgKey_res_".$key, $routenot->getIndPgKey($value["getIndPgKey"]), $value["getIndPgKey_res"], true));
    }
    foreach ($tabtest["tabIndexbool"] as $key => $value) {
        array_push($tabroutetest, addlind("indexbool_".$key, $value["indexbool"], $value["indexbool"], false));
        array_push($tabnroutetest, addlind("indexbool_".$key, $value["indexbool"], $value["indexbool"], false));
        array_push($tabroutetest, addlind("indexbool_res_".$key, $route->indexbool($value["indexbool"]), $value["indexbool_res"], true));
        array_push($tabnroutetest, addlind("indexbool_res_".$key, $routenot->indexbool($value["indexbool"]), $value["indexbool_res"], true));
    }
    foreach ($tabtest["tabPathSystem"] as $key => $value) {
        array_push($tabroutetest, addlind("pathSystem_".$key, $value["pathSystem"], $value["pathSystem"], false));
        array_push($tabnroutetest, addlind("pathSystem_".$key, $value["pathSystem"], $value["pathSystem"], false));
        array_push($tabroutetest, addlind("pathSystem_res_".$key, $route->pathSystem($value["pathSystem"]), lienpath($route->getCurrentDir(), $value["pathSystem_res"]), true));
        array_push($tabnroutetest, addlind("pathSystem_res_".$key, $routenot->pathSystem($value["pathSystem"]), lienpath($routenot->getCurrentDir(), $value["pathSystem_res_r"]), true));
    }
    foreach ($tabtest["tabPath"] as $key => $value) {
        array_push($tabroutetest, addlind("path_".$key, $value["path"], $value["path"], false));
        array_push($tabnroutetest, addlind("path_".$key, $value["path"], $value["path"], false));
        array_push($tabroutetest, addlind("path_res_".$key, $route->path($value["path"]), lienhttp($route->getCurrentDir(), $value["path_res"]), true));
        array_push($tabnroutetest, addlind("path_res_".$key, $routenot->path($value["path"]), lienhttp($routenot->getCurrentDir(), $value["path_res_r"]), true));
    }
    disptabl($tabroutetest);
    disptabl($tabnroutetest);
}


function display() {
    global $tabrouting;
    foreach ($tabrouting as $value) {
        $_GET["url"] = $value["url_a_n"];
        $table0 = new RouteMain();
        $_GET[PCTR_ROUTING_NR] = $table0->getUrl();
        unset($_GET["url"]);
        $table2 = new RouteMain();
        unset($_GET[PCTR_ROUTING_NR]);
        tabtestrt($value, $table0, $table2);
    }
}



/*
public function path(string|null $path = null):string|null {
public function pathFile(string|null $path):string|null {
public function pathSystem(string|null $path):string|null {
public function indexbool(string|null $index):bool {
public function getIndPg():array|null {
public function getIndPgKey(int $key):string|null {
public function getCurrentDir():string|null
public function getIsRoutage(): bool
public function getUrl(): string|null
*/
function displayvalue($tab, $theclass, $nb, $linetab) {
    $testName = $theclass->getName() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $tab["name"]);
    $testPath = $theclass->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $tab["path"]);
    $testParent = $theclass->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $tab["parent"]);
    $testAbsParent = true;
    $testAbsPath = true;
    $testAbsDisk = true;
    $displayAbs = false;
    if(!empty($tab["absolutparent"])) {
        $testAbsParent = $theclass->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $tab["absolutparent"]);
        $testAbsPath = $theclass->getAbsolutePath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $tab["absolutpath"]);
        $testAbsDisk = $theclass->getDiskname() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $tab["namedisk"]);
        $displayAbs = true;
    }
    if(!($testName && $testPath && $testParent && $testAbsParent && $testAbsPath && $testAbsDisk)) {
        var_dump("-----------------00000000000000000000000--------------------");
        echo "nb ".$nb." : <br /><br />";
        echo "tab (".$linetab.") : testpath <br />";
        echo "<br />";
        echo $theclass->getMsgerror();
        //echo $table->getErrortxt();
        var_dump("data             : ".$tab["data"]);
        var_dump("---------------------------");
        var_dump("name class       : ".$theclass->getName());
        var_dump("name test        : ".$tab["name"]);
        var_dump("name bool        : ".boolstring($testName));
        var_dump("---------------------------");
        var_dump("path class       : ".$theclass->getPath());
        var_dump("path test        : ".$tab["path"]);
        var_dump("path bool        : ".boolstring($testPath));
        var_dump("---------------------------");
        var_dump("parent class     : ".$theclass->getParent());
        var_dump("parent test      : ".$tab["parent"]);
        var_dump("parent bool      : ".boolstring($testParent));
        var_dump("---------------------------");
        if($displayAbs) {
            var_dump("absolParent class   : ".$theclass->getAbsoluteParent());
            var_dump("absolParent test    : ".$tab["absolutparent"]);
            var_dump("absolParent bool    : ".boolstring($testAbsParent));
            var_dump("---------------------------");
            var_dump("absolPath class     : ".$theclass->getAbsolutePath());
            var_dump("absolPath test      : ".$tab["absolutpath"]);
            var_dump("absolPath bool      : ".boolstring($testAbsPath));
            var_dump("---------------------------");
            var_dump("diskname class      : ".$theclass->getDiskname());
            var_dump("diskname test       : ".$tab["namedisk"]);
            var_dump("diskname bool       : ".boolstring($testAbsDisk));
        }
        var_dump("-----------------11111111111111111111111--------------------");
        return true;
    }
    return false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/style.css" />
    <link rel="stylesheet" href="./../css/style_media.css" />
    <link rel="stylesheet" href="./css/tabtest.css" />
    <link rel="stylesheet" href="./css/pathtest.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <section class="firstsection">
      <?php display(); ?>
    </section>
</body>
</html>
