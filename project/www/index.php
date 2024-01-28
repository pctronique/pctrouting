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
    <link rel="stylesheet" href="./css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <header>
      <div class="all-logo">
        <img
            src="./favicon.ico"
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
            <a href="./">acc</a>
            <a href="./phpinfo.php" target="_blank">phpinfo</a>
            <a href="./test/">path</a>
            <a href="./test/route">route</a>
            <a href="./test/route/page1">page1</a>
            <a href="./test/route/page2">page2</a>
            <a href="./test/route/page3">page3</a>
            <a href="./test/route/page1/item1">item11</a>
            <a href="./test/route/page2/item1">item21</a>
            <a href="./test/route/page2/item2">item22</a>
            <a href="./test/route/page3/item1">item31</a>
            <a href="./test/route/page3/item2">item32</a>
            <a href="./test/route/page3/item2/item1">item321</a>
          </li>
        </ul>
      </menu>
    </header>
    <section class="firstsection">
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
                var_dump(preg_replace(RegexPath::ENDFILE->value, '_ph', "filephp.php"));
                var_dump(preg_replace(RegexPath::ENDFILE->value, '_ph', "filehtml.html"));
            ?>
        </div>
        <div>
            <?php
                var_dump([(new RouteMain()), (new RouteMain(true))]);
            ?>
        </div>
    </section>
</body>
</html>
