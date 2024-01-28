<?php

include_once dirname(__FILE__) . '/../../src/class/pctrpath/RouteMain.php';
include_once dirname(__FILE__) . '/../code/routetest.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= $lien_cssimg ?>../../css/style.css" />
    <link rel="stylesheet" href="<?= $lien_cssimg ?>../css/tabtest.css" />
    <link rel="stylesheet" href="<?= $lien_cssimg ?>../css/route.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <header>
      <div class="all-logo">
        <img
            src="<?= $lien_cssimg ?>../../favicon.ico"
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
            <a href="<?= $lien_pg ?>../../">acc</a>
            <a href="<?= $lien_pg ?>phpinfo.php" target="_blank">phpinfo</a>
            <a href="<?= $lien_pg ?>../">path</a>
            <a href="<?= $lien_pg ?>">route</a>
            <a href="<?= $lien_pg ?>page1">page1</a>
            <a href="<?= $lien_pg ?>page2">page2</a>
            <a href="<?= $lien_pg ?>page3">page3</a>
            <a href="<?= $lien_pg ?>page1/item1">item11</a>
            <a href="<?= $lien_pg ?>page2/item1">item21</a>
            <a href="<?= $lien_pg ?>page2/item2">item22</a>
            <a href="<?= $lien_pg ?>page3/item1">item31</a>
            <a href="<?= $lien_pg ?>page3/item2">item32</a>
            <a href="<?= $lien_pg ?>page3/item2/item1">item321</a>
            <a href="<?= $lien_pg ?>page3/item2//item2">item322</a>
          </li>
        </ul>
      </menu>
    </header>
    <section class="firstsection">
        <img src="<?= $lien_cssimg ?>images/imgtest.png" alt="test img">
        <?php
            displaytab(createtabclass($table), "class");
            displaytab(createtabclass($table2), "class");
        ?>
    </section>
    
</body>
</html>