<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/RegexPath.php';
include_once dirname(__FILE__) . '/../code/tabpathtestdef2.php';
include_once dirname(__FILE__) . '/functcreatetab.php';

$line = "<br/>";

function createtab($value, $line) {
    global $line;
    $tabAllVal = recupeother($value);
    $name = $tabAllVal["name"];
    $namedisk = $tabAllVal["namedisk"];
    $absolutpath = $tabAllVal["absolutpath"];
    echo "[".$line;
    echo '"data" => "'.$value[0].'",'.$line;
    echo '"path" => "'.$value[1].'",'.$line;
    echo '"parent" => "'.$value[2].'",'.$line;
    echo '"absolutparent" => "'.$value[3].'",'.$line;
    echo '"absolutpath" => "'.$absolutpath.'",'.$line;
    echo '"name" => "'.$name.'",'.$line;
    echo '"namedisk" => "'.$namedisk.'",'.$line;
    echo '"parentin" => "'.$value[4].'",'.$line;
    echo '"filein" => "'.$value[5].'",'.$line;
    echo "],".$line;
}
//echo "<br /><br />".$line;
echo "\$testpathhttp2 = [".$line;
foreach ($testpathhttp2 as $value) {
    createtab($value);
}
echo "];".$line;
//echo "<br /><br />".$line;
echo "\$testpatrelatif2 = [".$line;
foreach ($testpatrelatif2 as $value) {
    createtab($value);
}
echo "];".$line;
//echo "<br /><br />".$line;
echo "\$testpath2 = [".$line;
foreach ($testpath2 as $value) {
    createtab($value);
}
echo "];".$line;
