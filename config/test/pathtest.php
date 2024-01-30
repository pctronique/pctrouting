<?php

include_once dirname(__FILE__) . '/code/tabpathtest2.php';
include_once dirname(__FILE__) . '/code/tabpathtest.php';
include_once dirname(__FILE__) . '/code/tabletest.php';
include_once dirname(__FILE__) . '/code/pathtest.php';

function boolstring($val) {
    return $val ? "true" : "false";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/style.css" />
    <link rel="stylesheet" href="./css/tabtest.css" />
    <link rel="stylesheet" href="./css/pathtest.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <header>
      <div class="all-logo">
        <img
            src="./../favicon.ico"
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
            <a href="./../">acc</a>
            <a href="./phpinfo.php" target="_blank">phpinfo</a>
            <a href="./">path</a>
            <a href="./pathtest.php">pathtest</a>
            <a href="./route">route</a>
            <a href="./route/page1">page1</a>
            <a href="./route/page2">page2</a>
            <a href="./route/page3">page3</a>
            <a href="./route/page1/item1">item11</a>
            <a href="./route/page2/item1">item21</a>
            <a href="./route/page2/item2">item22</a>
            <a href="./route/page3/item1">item31</a>
            <a href="./route/page3/item2">item32</a>
            <a href="./route/page3/item2/item1">item321</a>
          </li>
        </ul>
      </menu>
    </header>
    <section class="firstsection">
      <?php $path01 = new Path();
            $path02 = new Path($path01);
            ?>
        <h1>Path test</h1>
        <?php
        foreach ($testpath as $value) {
            displaytaball($value, new Path($value[0]));
        }
        foreach ($testpatrelatif as $value) {
            displaytaball($value, new Path($value[0]));
        }
        foreach ($testpath2 as $value) {
            displaytaball($value, new Path($value[3], $value[4]));
        }
        foreach ($testpatrelatif2 as $value) {
            displaytaball($value, new Path($value[3], $value[4]));
        }
        ?>
    </section>
    <section>
        <h1>PathServe test</h1>-
        <?php 
        foreach ($testpathhttp as $value) {
            displaytaball($value, new PathServe($value[0]));
        }
        foreach ($testpatrelatif as $value) {
            displaytaball($value, new PathServe($value[0]));
        }
        foreach ($testpathhttp2 as $value) {
            displaytaball($value, new PathServe($value[3], $value[4]));
        }
        foreach ($testpatrelatif2 as $value) {
            displaytaball($value, new PathServe($value[3], $value[4]));
        }
        ?>
    </section>
</body>
</html>