<?php
include_once dirname(__FILE__) . '/../src/class/pctrouting/RouteMain.php';

$isroting = (!empty($_GET) && array_key_exists("url", $_GET));
if(!(!empty($_GET) && array_key_exists("url", $_GET))) {
    $_GET["url"] = "";
}
if(!empty($_GET) && array_key_exists(PCTR_ROUTING_NR, $_GET)) {
    $_GET["url"] = $_GET[PCTR_ROUTING_NR];
}

unset($_GET[PCTR_ROUTING_NR]);

$table0 = new RouteMain();

$_GET[PCTR_ROUTING_NR] = $table0->getUrl();

unset($_GET["url"]);

$table2 = new RouteMain();
$table = $table2;
$liendef = "./";

if($isroting) {
    $table = $table0;
    $liendef = $table0->getCurrentDir();
}

unset($_GET[PCTR_ROUTING_NR]);

define("LINENDEF", $liendef);

function createtabclassr($pathclass) {
    return [
        "getIndPg" => $pathclass->getIndPg(),
        "getCurrentDir" => $pathclass->getCurrentDir(),
        "getUrl" => $pathclass->getUrl(),
        "getIsRoutage" => $pathclass->getIsRoutage(),
        "path 0" => $pathclass->path(),
        "path 1" => $pathclass->path("route0/route1"),
        "path 2" => $pathclass->path("route0/route1?test=8&pass=lkjh"),
        "path img" => $pathclass->pathFile("image.png"),
        "path img 2" => $pathclass->pathFile("../image2.png"),
        "path sys 1" => $pathclass->pathSystem("image.png"),
        "path sys 2" => $pathclass->pathSystem("../image2.png"),
        "no url" => $pathclass->path("route0?test=8&pass=lkjh")
    ];
}

function createtabclass($pathclass) {
    return [
        "getIndPg" => $pathclass->getIndPg(),
        "getCurrentDir" => $pathclass->getCurrentDir(),
        "getUrl" => $pathclass->getUrl(),
        "getIsRoutage" => $pathclass->getIsRoutage(),
        "path 0" => $pathclass->path(LINENDEF),
        "path 1" => $pathclass->path(LINENDEF."route0/route1"),
        "path 2" => $pathclass->path(LINENDEF."route0/route1?test=8&pass=lkjh"),
        "path img" => $pathclass->pathFile(LINENDEF."image.png"),
        "path img 2" => $pathclass->pathFile(LINENDEF."../image2.png"),
        "path sys 1" => $pathclass->pathSystem(LINENDEF."image.png"),
        "path sys 2" => $pathclass->pathSystem(LINENDEF."../image2.png"),
        "no url" => $pathclass->path(LINENDEF."route0?test=8&pass=lkjh")
    ];
}
