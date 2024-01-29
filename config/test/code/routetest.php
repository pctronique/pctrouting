<?php
include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';

$isroute=true;

$table = new RouteMain($isroute);
$lien_pg = $table->getCurrentDir();
$lien_cssimg = $table->getCssImgDir();
//$lien_pg = $table->getLienpg() . "/";
$table2 = new RouteMain(false);
//$lien_pg = $table->getCurrentDir();
//$lien_cssimg = $table->getCssImgDir();

function createtabclass($pathclass) {
    return [
        "tabGetIndPg" => $pathclass->tabGetIndPg(),
        "getCssImgDir" => $pathclass->getCssImgDir(),
        "getCurrentDir" => $pathclass->getCurrentDir(),
        "getParentPath" => $pathclass->getParentPath(),
        "getIsRoutage" => ($pathclass->getIsRoutage() ? "true" : "false")
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
                <div class="tabth tab0"><?= $key ?></div>
                <div class="tabth tab1">
                    <?php 
                        if(gettype($value) == "array") {
                            echo "<pre>";
                            print_r($value);
                            echo "</pre>";
                        } else {
                            echo str_replace(
                                "true",
                                '<div class="textval texttrue">true</div>',
                                str_replace(
                                    "false",
                                    '<div class="textval textfalse">false</div>',
                                     $value
                            ));
                        }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

//var_dump($_SERVER);
