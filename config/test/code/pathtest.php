<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/Path.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/PathDef.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/Platform.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/PathServe.php';

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
        "validpath" => testpath($texttab, $textclass) ? "true" : "false"
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
        "start" => $pathall[0],
        "path" => $pathall[1],
        "parent" => $pathall[2],
        "absoluteParent" => $pathall[3]
    ];
}

function displaytab($table, $name) {
    $nmclassv = "nullvl";
    if(array_key_exists("validpath", $table)) {
        $nmclassv = pathvalid($table["validpath"] == "true");
    }
    ?>
    <div class="tab">
        <div class="tabtitle">
            <div class="dispval <?= $nmclassv ?>"></div>
            <h2><?= $name ?></h2>
        </div>
        <div class="tabbody">
            <?php foreach ($table as $key => $value) { ?>
                <div class="tab0 tabth"><?= $key ?></div>
                <div class="tab1 tabth">
                    <?= str_replace(
                            "true",
                            '<div class="textval texttrue">true</div>',
                            str_replace(
                                "false",
                                '<div class="textval textfalse">false</div>',
                                $value
                        ))
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

function displaytaball($txt, $testout) {
    $pathclass = createtabclass($testout);
    $pathall = createtabpathall($txt);
    $tabvalues1 = tabvalues($testout->getPath(), $txt[1]);
    $tabvalues2 = tabvalues($testout->getParent(), $txt[2]); ?>
    <div class="allclass">
        <?php displaytab($pathclass, "class");
        displaytab($pathall, "paths");
        displaytab($tabvalues1, "path test");
        displaytab($tabvalues2, "parent test");
        if(!empty($txt[3])) {
            $tabvalues3 = tabvalues($testout->getAbsoluteParent(), $txt[3]);
            displaytab($tabvalues3, "absoluteParent test");
        } ?>
    </div>
<?php }
