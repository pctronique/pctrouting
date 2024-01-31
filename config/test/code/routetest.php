<?php
include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';

$table = new RouteMain();

function createtabclass($pathclass) {
    return [
        "getIndPg" => $pathclass->getIndPg(),
        "getIndAndKeyPg" => $pathclass->getIndAndKeyPg(),
        "getCssImgDir" => $pathclass->getCssImgDir(),
        "getCurrentDir" => $pathclass->getCurrentDir(),
        "getParentPath" => $pathclass->getParentPath(),
        "getIsRoutage" => $pathclass->getIsRoutage(),
        "path 1" => $pathclass->path("route0/route1"),
        "path 2" => $pathclass->path("route0/route1?test=8&pass=lkjh"),
        "path img" => $pathclass->pathFile("image.png"),
        "path img 2" => $pathclass->pathFile("../image2.png"),
        "path sys 1" => $pathclass->pathSystem("image.png"),
        "path sys 2" => $pathclass->pathSystem("../image2.png")
    ];
}
