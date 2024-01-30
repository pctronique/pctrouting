<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/Path.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/PathDef.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/Platform.php';
include_once dirname(__FILE__) . '/../../src/class/pctrpath/PathServe.php';

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

function displaytaball($txt, $testout) {
    $pathclass = createtabclass($testout);
    $pathall = createtabpathall($txt);
    $tabvalues1 = tabvalues($testout->getPath(), $txt["path"]);
    $tabvalues2 = tabvalues($testout->getParent(), $txt["parent"]);
    $tabvalues3 = tabvalues($testout->getAbsoluteParent(), $txt["absolutparent"]);
    $valbool1 = ($tabvalues1 && $tabvalues2);
    $valbool2 = (empty($txt["absolutparent"]) || (!empty($txt["absolutparent"]) && $tabvalues3));
    $valbool3 = ($valbool1 && $valbool2);
     ?>
    <div class="allclass">
        <?php displaytab($pathclass, "class ".'"'.$txt["data"].'"');
        displaytab($pathall, "paths");
        displaytab($tabvalues1, "path test", $tabvalues1["validpath"]);
        displaytab($tabvalues2, "parent test", $tabvalues2["validpath"]);
        if(!empty($txt["absolutparent"])) {
            $tabvalues3 = tabvalues($testout->getAbsoluteParent(), $txt["absolutparent"]);
            displaytab($tabvalues3, "absoluteParent test", $tabvalues3["validpath"]);
        } ?>
    </div>
<?php 
}
