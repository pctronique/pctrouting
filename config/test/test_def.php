<?php

include_once dirname(__FILE__) . '/../../unit/function_test_path.php';
include_once dirname(__FILE__) . '/../code/tabletest.php';
include_once dirname(__FILE__) . '/../code/pathtest.php';

function boolstring($val) {
    return $val ? "true" : "false";
}

$testAllpath = array_merge($testpath, array_merge($testpatrelatif, array_merge($testpath2, $testpatrelatif2)));
$testAllpathhtt = array_merge($testpathhttp, array_merge($testpatrelatif, array_merge($testpathhttp2, $testpatrelatif2)));

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
</head>
<body>
    <section class="firstsection">
      <?php /*$path01 = new Path();
            $path02 = new Path($path01);*/
            ?>
        <!--<h1>Path test</h1>-->
        <?php
        $i = 1;
        foreach ($testAllpath as $value) {
            $obj = (!empty($value["parentin"])) ? 
                            new Path($value["parentin"], $value["filein"]) : 
                            new Path($value["parentin"]);
            if(displayvalue($value, $obj, $i, __LINE__)) {
                $i++;
            }
        }
        ?>
    </section>
    <section>
        <!--<h1>PathServe test</h1>-->
        <?php 
        foreach ($testAllpathhtt as $value) {
            $obj = (!empty($value["parentin"])) ? 
                            new PathServe($value["parentin"], $value["filein"]) : 
                            new PathServe($value["parentin"]);
            if(displayvalue($value, $obj, $i, __LINE__)) {
                $i++;
            }
        }
        ?>
    </section>
</body>
</html>
