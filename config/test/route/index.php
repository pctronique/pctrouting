<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/../../code/tabletest.php';
include_once dirname(__FILE__) . '/../../code/routetest.php';

$txttitle = "";
switch (true) {
  case $table->indexbool("page2"):
    switch (true) {
      case $table->indexbool("page2/item1"):
        $txttitle = "page2/item1";
        break;

      case $table->indexbool("page2/item2"):
        $txttitle = "page2/item2";
        break;
      
      default:
        $txttitle = "page2";
        break;
    }
    break;
  
  case $table->indexbool("page3"):
    switch (true) {
      case $table->indexbool("page3/item1"):
        $txttitle = "page2/item1";
        break;

      case $table->indexbool("page3/item2"):
        switch (true) {
          case $table->indexbool("page3/item2/item1"):
            $txttitle = "page3/item2/item1";
            break;
    
          case $table->indexbool("page3/item2/item2"):
            $txttitle = "page3/item2/item2";
            break;
          
          default:
          $txttitle = "page3/item2";
            break;
        }
        break;
      
      default:
      $txttitle = "page3";
        break;
    }
    break;
    
  default:
    $txttitle = "route";
    break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= $table->pathFile("../../css/style.css") ?>" />
  <link rel="stylesheet" href="<?= $table->pathFile("../../css/style_media.css") ?>" />
  <link rel="stylesheet" href="<?= $table->pathFile("../css/tabtest.css") ?>" />
  <link rel="stylesheet" href="<?= $table->pathFile("../css/route.css") ?>" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <style>
    body:before {
      background-image: url(<?= $table->pathFile("images/motherboard-binary.svg") ?>);
    }
  </style>
</head>

<body>
  <header>
    <div class="all-logo">
      <img src="<?= $table->pathFile("../../favicon.ico") ?>" alt="logo site" />
    </div>
    <menu>
      <label id="menu-burger" for="menu-display">
        <i class="bi bi-list"></i>
      </label>
      <input type="checkbox" name="menu display" id="menu-display" />
      <ul class="all-bt-menu">
        <li class="bt-menu no-submenu">
          <a href="<?= $table->path("../../") ?>">acc</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("../") ?>">path</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("../pathtest.php") ?>">pathtest</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("") ?>">route</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page1") ?>">page1</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page2") ?>">page2</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page3") ?>">page3</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page1/item1") ?>">item11</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page2/item1") ?>">item21</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page2/item2") ?>">item22</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page3/item1") ?>">item31</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page3/item2") ?>">item32</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page3/item2/item1") ?>">item321</a>
          </li>
          <li class="bt-menu no-submenu">
          <a href="<?= $table->path("page3/item2//item2") ?>">item322</a>
        </li>
      </ul>
    </menu>
  </header>
  <section class="firstsection">
    <h1><?= $txttitle ?></h1>
    <div class="ctpgroute">
      <?php
      displaytab(createtabclassr($table0), "class RouteMain | routing");
      displaytab(createtabclass($table2), "class RouteMain | no routing");
      displaytab(createtabclass($table), "class RouteMain | def");
      ?>
    </div>
  </section>

</body>

</html>