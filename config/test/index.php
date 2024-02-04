<?php

include_once dirname(__FILE__) . '/../../unit/function_test_path.php';
include_once dirname(__FILE__) . '/../code/tabletest.php';
include_once dirname(__FILE__) . '/../code/pathtest.php';

$testAllpath = array_merge($testpath, $testpatrelatif);
$testAllpathhtt = array_merge($testpathhttp, $testpatrelatif);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/style.css" />
    <link rel="stylesheet" href="./../css/style_media.css" />
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
          </li>
          <li class="bt-menu no-submenu">
            <a href="./">path</a>
          </li>
          <li class="bt-menu no-submenu">
            <a href="./pathtest.php">pathtest</a>
          </li>
          <li class="bt-menu no-submenu">
            <a href="./route">route</a>
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
            foreach ($testAllpath as $value) {
                displaytaball($value, new Path($value["parentin"]), "class Path");
            }
        ?>
    </section>
    <section>
        <h1>Path</h1>
        <h6>path base : <?= Path::base() ?></h6>
            <?php
                displaytab(createtabclass(new Path()), "new Path()");
                displaytab(createtabclass(new Path("./folder/")), 'new Path("./folder/")');
                displaytab(createtabclass(new Path(new Path("./folder/"), "./file")), 'new Path(new Path("./folder/"), "./file")');
                displaytab(createtabclass(new Path("test021/jhgf", "rtyu/frt")), 'new Path("test021/jhgf", "rtyu/frt")');
                displaytab(createtabclass(new Path("/usr/local/apache2/www")), 'new Path("/usr/local/apache2/www")');
            ?>
    </section>
    <section>
        <h1>PathServe test</h1>
        <?php foreach ($testAllpathhtt as $value) {
            displaytaball($value, new PathServe($value["parentin"]), "class PathServe");
        } ?>
    </section>
    <section>
        <h1>PathServe</h1>
        <h6>path base : <?= PathServe::base() ?></h6>
            <?php
                displaytab(createtabclass(new PathServe()), "class 1");
                displaytab(createtabclass(new PathServe("test021/jhgf", "rtyu/frt")), "class 2");
                displaytab(createtabclass(new PathServe("http://localhost:86")), "class 3");
            ?>
    </section>
</body>
</html>
