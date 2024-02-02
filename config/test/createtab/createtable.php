<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/RegexPath.php';
include_once dirname(__FILE__) . '/../code/tabpathtest.php';

$line = "<br/>";

function createtab($value, $value1) {
    global $line;
    $value[0] = preg_replace(RegexPath::ANTISLASH->value, "/", $value[0]);
    $value[1] = preg_replace(RegexPath::ANTISLASH->value, "/", $value[1]);
    $value[2] = preg_replace(RegexPath::ANTISLASH->value, "/", $value[2]);
    $value[3] = preg_replace(RegexPath::ANTISLASH->value, "/", $value[3]);
    $value1[0] = preg_replace(RegexPath::ANTISLASH->value, "/", $value1[0]);
    $value1[1] = preg_replace(RegexPath::ANTISLASH->value, "/", $value1[1]);
    $value1[2] = preg_replace(RegexPath::ANTISLASH->value, "/", $value1[2]);
    $value1[3] = preg_replace(RegexPath::ANTISLASH->value, "/", $value1[3]);
    echo "[".$line;
    echo '"'.$value[0].'[-]'.$value1[0].'",'.$line;
    echo '"'.$value[1].'/'.$value1[1].'",'.$line;
    echo '"'.$value[1].'/'.$value1[2].'",'.$line;
    if(!empty($value[3])) {
        echo '"'.$value[1].'/'.$value1[2].'",'.$line;
    } else {
        echo '"",'.$line;
    }
    echo '"'.$value[0].'",'.$line;
    echo '"'.$value1[0].'",'.$line;
    echo "],".$line;
}
echo "\$testpathhttp2 = [".$line;
foreach ($testpathhttp as $value) {
    foreach ($testpathhttp as $value1) {
        createtab($value, $value1);
    }
}
foreach ($testpathhttp as $value) {
    foreach ($testpatrelatif as $value1) {
        createtab($value, $value1);
    }
}
foreach ($testpathhttp as $value) {
    foreach ($testpath as $value1) {
        createtab($value, $value1);
    }
}
echo "];".$line;
echo "\$testpatrelatif2 = [".$line;
foreach ($testpatrelatif as $value) {
    foreach ($testpathhttp as $value1) {
        createtab($value, $value1);
    }
}
foreach ($testpatrelatif as $value) {
    foreach ($testpatrelatif as $value1) {
        createtab($value, $value1);
    }
}
foreach ($testpatrelatif as $value) {
    foreach ($testpath as $value1) {
        createtab($value, $value1);
    }
}
echo "];".$line;
echo "\$testpath2 = [".$line;
foreach ($testpath as $value) {
    foreach ($testpathhttp as $value1) {
        createtab($value, $value1);
    }
}
foreach ($testpath as $value) {
    foreach ($testpatrelatif as $value1) {
        createtab($value, $value1);
    }
}
foreach ($testpath as $value) {
    foreach ($testpath as $value1) {
        createtab($value, $value1);
    }
}
echo "];".$line;
