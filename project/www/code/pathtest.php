<?php

include_once dirname(__FILE__) . '/../src/class/pctrouting/Path.php';
include_once dirname(__FILE__) . '/../src/class/pctrouting/PathDef.php';
include_once dirname(__FILE__) . '/../src/class/pctrouting/RouteMain.php';
include_once dirname(__FILE__) . '/../src/class/pctrouting/Platform.php';
include_once dirname(__FILE__) . '/../src/class/pctrouting/PathServe.php';

function pathclass($text) {
    return preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $text);
}

function testpath($texttab, $textclass) {
    return ($texttab == pathclass($textclass));
}

function tabvalues($texttab, $textclass){
    return [
        "pathclass" => pathclass($textclass),
        "pathtable" => $texttab,
        "validpath" => testpath($texttab, $textclass)
    ];
}

function createtabclass($pathclass) {
    return [
        "name" => $pathclass->getName(),
        "parent" => $pathclass->getParent(),
        "absoluteParent" => $pathclass->getAbsoluteParent(),
        "absolutePath" => $pathclass->getAbsolutePath(),
        "path" => $pathclass->getPath(),
        "diskname" => $pathclass->getDiskname()
    ];
}

function createtabpathall($pathall) {
    return [
        "name" => $pathall["name"],
        "parent" => $pathall["parent"],
        "absoluteParent" => $pathall["absolutparent"],
        "absolutePath" => $pathall["absolutpath"],
        "path" => $pathall["path"],
        "diskname" => $pathall["diskname"],
        "data" => $pathall["data"],
    ];
}

function textpathsys(string $txt):string {
    return preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $txt);
}

function displaytaball($tab, $theclass, $name = null) {
    if(empty($name)) {
        $name = "class";
    }
    $header = ["key", "class", "expected", "validation"];
    $valuestab = [];
    $linetd = [
        "parentin",
        $tab["parentin"],
        $tab["parentin"],
        "",
        "valid" => ""
    ];
    array_push($valuestab, $linetd);
    $filein = [
        "filein",
        "",
        "",
        "",
        "valid" => ""
    ];
    if(!empty($tab["filein"])) {
        $filein = [
            "filein",
            $tab["filein"],
            $tab["filein"],
            "",
            "valid" => ""
        ];
    }
    array_push($valuestab, $filein);
    $testName = $theclass->getName() == textpathsys($tab["name"]);
    $linetd = [
        "name",
        $theclass->getName(),
        textpathsys($tab["name"]),
        $testName,
        "valid" => $testName
    ];
    array_push($valuestab, $linetd);
    $testPath = $theclass->getPath() == textpathsys($tab["path"]);
    $linetd = [
        "path",
        $theclass->getPath(),
        textpathsys($tab["path"]),
        $testPath,
        "valid" => $testPath
    ];
    array_push($valuestab, $linetd);
    $testParent = $theclass->getParent() == textpathsys($tab["parent"]);
    $linetd = [
        "parent",
        $theclass->getParent(),
        textpathsys($tab["parent"]),
        $testParent,
        "valid" => $testParent
    ];
    array_push($valuestab, $linetd);
    $linetdabpr = [
        "absolutparent",
        $theclass->getAbsoluteParent(),
        "",
        "",
        "valid" => ""
    ];
    $linetdabpat = [
        "absolutpath",
        $theclass->getAbsolutePath(),
        "",
        "",
        "valid" => ""
    ];
    $linetdabdis = [
        "namedisk",
        $theclass->getDiskname(),
        "",
        "",
        "valid" => ""
    ];
    if(!empty($tab["absolutparent"])) {
        $testAbsParent = $theclass->getAbsoluteParent() == textpathsys($tab["absolutparent"]);
        $linetdabpr = [
            "absolutparent",
            $theclass->getAbsoluteParent(),
            textpathsys($tab["absolutparent"]),
            $testAbsParent,
            "valid" => $testAbsParent
        ];
        $testAbsPath = $theclass->getAbsolutePath() == textpathsys($tab["absolutpath"]);
        $linetdabpat = [
            "absolutpath",
            $theclass->getAbsolutePath(),
            textpathsys($tab["absolutpath"]),
            $testAbsPath,
            "valid" => $testAbsPath
        ];
        $testAbsDisk = $theclass->getDiskname() == textpathsys($tab["namedisk"]);
        $linetdabdis = [
            "namedisk",
            $theclass->getDiskname(),
            textpathsys($tab["namedisk"]),
            $testAbsDisk,
            "valid" => $testAbsDisk
        ];
    }
    array_push($valuestab, $linetdabpr);
    array_push($valuestab, $linetdabpat);
    array_push($valuestab, $linetdabdis);
    displaytabLin($valuestab, $name, $header);
}
