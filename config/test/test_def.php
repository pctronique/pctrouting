<?php

include_once dirname(__FILE__) . '/code/tabpathtest2.php';
include_once dirname(__FILE__) . '/code/tabpathtest.php';
include_once dirname(__FILE__) . '/code/tabletest.php';
include_once dirname(__FILE__) . '/code/pathtest.php';

function boolstring($val) {
    return $val ? "true" : "false";
}

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
    <!--<link rel="stylesheet" href="./../css/style.css" />
    <link rel="stylesheet" href="./css/tabtest.css" />
    <link rel="stylesheet" href="./css/pathtest.css" />-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <!--<header>
      <div class="all-logo">
        <img
            src="./../favicon.ico"
            alt="logo site"
        />
      </div>
      <menu>
        <label id="menu-burger" for="menu-display">
          <i class="bi bi-list"></i>
        </label>
        <input type="checkbox" name="menu display" id="menu-display" />
        <ul class="all-bt-menu">
          <li class="bt-menu no-submenu">
            <a href="./../">acc</a>
            <a href="./phpinfo.php" target="_blank">phpinfo</a>
            <a href="./">path</a>
            <a href="./route">route</a>
            <a href="./route/page1">page1</a>
            <a href="./route/page2">page2</a>
            <a href="./route/page3">page3</a>
            <a href="./route/page1/item1">item11</a>
            <a href="./route/page2/item1">item21</a>
            <a href="./route/page2/item2">item22</a>
            <a href="./route/page3/item1">item31</a>
            <a href="./route/page3/item2">item32</a>
            <a href="./route/page3/item2/item1">item321</a>
          </li>
        </ul>
      </menu>
    </header>-->
    <section class="firstsection">
      <?php /*$path01 = new Path();
            $path02 = new Path($path01);*/
            ?>
        <!--<h1>Path test</h1>-->
        <?php
        $i = 1;
        foreach ($testpath as $value) {
            if(displayvalue($value, (new Path($value["parentin"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new Path($value["parentin"]));
        }
        foreach ($testpatrelatif as $value) {
            if(displayvalue($value, (new Path($value["parentin"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new Path($value["parentin"]));
        }
        foreach ($testpath2 as $value) {
            if(displayvalue($value, (new Path($value["parentin"], $value["filein"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new Path($value["absolutparent"], $value["parentin"])); 
        }
        foreach ($testpatrelatif2 as $value) {
            if(displayvalue($value, (new Path($value["parentin"], $value["filein"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new Path($value["absolutparent"], $value["parentin"]));
        }
        ?>
    </section>
    <section>
        <!--<h1>PathServe test</h1>-->
        <?php 
        foreach ($testpathhttp as $value) {
            if(displayvalue($value, (new PathServe($value["parentin"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new PathServe($value["parentin"]));
        }
        foreach ($testpatrelatif as $value) {
            if(displayvalue($value, (new PathServe($value["parentin"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new PathServe($value["parentin"]));
        }
        foreach ($testpathhttp2 as $value) {
            if(displayvalue($value, (new PathServe($value["parentin"], $value["filein"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new PathServe($value["absolutparent"], $value["parentin"]));
        }
        foreach ($testpatrelatif2 as $value) {
            if(displayvalue($value, (new PathServe($value["parentin"], $value["filein"])), $i, __LINE__)) {
                $i++;
            }
            //displaytaball($value, new PathServe($value["absolutparent"], $value["parentin"]));
        }
        ?>
    </section>
</body>
</html>
