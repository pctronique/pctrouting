<?php

include_once dirname(__FILE__) . '/src/class/pctrpath/Path.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/PathDef.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/Platform.php';
include_once dirname(__FILE__) . '/src/class/pctrpath/PathServe.php';

$testpathhttp = [
    ["https://test.fr/usr/local/www/../site/../../tmp/index.php",
        "https://test.fr/usr/tmp/index.php",
        "https://test.fr/usr/tmp",
        "https://test.fr/usr/tmp"],
        ["https://test.fr/usr/local/www/../../../../../../site/../../tmp/index.php",
        "https://test.fr/tmp/index.php",
        "https://test.fr/tmp",
        "https://test.fr/tmp"],
        ["../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["./../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["https://test.fr",
        "https://test.fr",
        "https://test.fr",
        "https://test.fr"]
];

$testpath = [
    ["/usr/local/www/../site/../../tmp/index.php",
        "/usr/tmp/index.php",
        "/usr/tmp"],
        ["/usr/local/www/../../../../../../site/../../tmp/index.php",
        "/tmp/index.php",
        "/tmp",
        "/tmp"],
        ["../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["./../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["c:\\usr\\local\\www\\..\\site\\..\\..\\tmp\\index.php",
        "c:\\usr\\tmp\\index.php",
        "c:\\usr\\tmp",
        "c:\\usr\\tmp"],
        ["c:\\usr\\local\\www\\..\\..\\..\\..\\..\\..\\site\\..\\..\\tmp\\index.php",
        "c:\\tmp\\index.php",
        "c:\\tmp",
        "c:\\tmp"],
        ["c:",
        "c:",
        "c:",
        "c:"],
        ["/",
        "/",
        "/",
        "/"]
];

function pathvalid($boolpath) {
    if($boolpath) {
        return "pathtrue";
    }
    return "pathfalse";
}

function display($txt, $testout) {
    $valueAll = [];
    array_push($valueAll, $txt);
    $validpath = ($testout->getPath()==preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt[1]));
    $divval = '<div id="pathval" class="'.pathvalid($validpath).'"></div>';
    $arrayAdd = [
        preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt[1]), 
        $testout->getPath(), 
        $validpath,
        $divval
    ];
    array_push($valueAll, $arrayAdd);
    $validpath = ($testout->getParent()==preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt[2]));
    $divval = '<div id="pathval" class="'.pathvalid($validpath).'"></div>';
    $arrayAdd = [
        preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt[2]), 
        $testout->getParent(), 
        $validpath,
        $divval
    ];
    array_push($valueAll, $arrayAdd);
    if(!empty($txt[3])) {
        $validpath = ($testout->getAbsoluteParent()==preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt[3]));
        $divval = '<div id="pathval" class="'.pathvalid($validpath).'"></div>';
        $arrayAdd = [
            preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt[3]), 
            $testout->getAbsoluteParent(),
            $validpath,
            $divval
        ];
        array_push($valueAll, $arrayAdd);
    }
    array_push($valueAll, (array)$testout);
    var_dump($valueAll);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            display: grid;
            grid-template-columns: auto auto;
        }

        div {
            border: 1px black solid;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div>
        <?php
            foreach ($testpathhttp as $value) {
                display($value, new PathServe($value[0]));
            }
        ?>
    </div>
    <div>
        <?php
            foreach ($testpath as $value) {
                display($value, new Path($value[0]));
            }
        ?>
    </div>
    <div>
        <?php
            $test2 = new PathServe();
            var_dump($test2);
            var_dump(PathServe::base());
            $test2 = new PathServe("test021/jhgf", "rtyu/frt");
            var_dump($test2);
            $test2 = new PathServe("http://localhost:86");
            var_dump($test2);
        ?>
    </div>
    <div>
        <?php
            $test2 = new Path();
            var_dump($test2);
            var_dump(Path::base());
            $test2 = new Path("test021/jhgf", "rtyu/frt");
            var_dump($test2);
            $test2 = new Path("/usr/local/apache2/www");
            var_dump($test2);
        ?>
    </div>
    <div>
        <?php
            var_dump(preg_replace(RegexPath::ENDFILE->value, '_ph', "filephp.php"));
            var_dump(preg_replace(RegexPath::ENDFILE->value, '_ph', "filehtml.html"));
        ?>
    </div>
    <div>
        <?php
            var_dump([(new RouteMain()), (new RouteMain(true))]);
        ?>
    </div>
</body>
</html>
