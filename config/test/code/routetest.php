<?php
include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';

$table = new RouteMain();
foreach ($table->getIndAndKeyPg() as $key => $value) {
    $_GET[$key] = $value;
}

unset($_GET["url"]);

$table2 = new RouteMain();

function createtabclass($pathclass) {
    return [
        "getIndPg" => $pathclass->getIndPg(),
        "getIndAndKeyPg" => $pathclass->getIndAndKeyPg(),
        "getCurrentDir" => $pathclass->getCurrentDir(),
        "getParentPath" => $pathclass->getParentPath(),
        "getUrl" => $pathclass->getUrl(),
        "getIsRoutage" => $pathclass->getIsRoutage(),
        "path 1" => $pathclass->path("route0/route1"),
        "path 2" => $pathclass->path("route0/route1?test=8&pass=lkjh"),
        "path img" => $pathclass->pathFile("image.png"),
        "path img 2" => $pathclass->pathFile("../image2.png"),
        "path sys 1" => $pathclass->pathSystem("image.png"),
        "path sys 2" => $pathclass->pathSystem("../image2.png"),
        "no url" => $pathclass->path("route0?test=8&pass=lkjh&nurl=place0/place1/place2")
    ];
}
