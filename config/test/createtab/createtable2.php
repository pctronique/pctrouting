<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/RegexPath.php';
include_once dirname(__FILE__) . '/../code/tabpathtestdef.php';
include_once dirname(__FILE__) . '/functcreatetab.php';

$line = "<br/>";

function createtab($value, $line) {
    $absolutpath = "";
    $name = "";
    $namedisk = "";
    if(!empty($value[3])) {
        $namedisk = recup_name_disk($value[3]);
        if(empty($namedisk)) {
            $namedisk = "/";
        }

        $name = trim(str_replace($value[2], "", $value[1]), "/");
        $absolutpath = $value[3]."/".$name;
    }
    echo "[".$line;
    echo '"data" => "'.$value[0].'",'.$line;
    echo '"path" => "'.$value[1].'",'.$line;
    echo '"parent" => "'.$value[2].'",'.$line;
    echo '"absolutparent" => "'.$value[3].'",'.$line;
    echo '"absolutpath" => "'.$absolutpath.'",'.$line;
    echo '"name" => "'.$name.'",'.$line;
    echo '"namedisk" => "'.$namedisk.'",'.$line;
    echo '"parentin" => "'.$value[0].'",'.$line;
    echo "],".$line;
}
echo "<br /><br />".$line;
echo "\$testpathhttp = [".$line;
foreach ($testpathhttp as $value) {
    createtab($value, $line);
}
echo "];".$line;
echo "<br /><br />".$line;
echo "\$testpatrelatif = [".$line;
foreach ($testpatrelatif as $value) {
    createtab($value, $line);
}
echo "];".$line;
echo "<br /><br />".$line;
echo "\$testpath = [".$line;
foreach ($testpath as $value) {
    createtab($value, $line);
}
echo "];".$line;
