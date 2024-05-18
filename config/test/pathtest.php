<?php

include_once dirname(__FILE__) . '/../../unit/function_test_path.php';
include_once dirname(__FILE__) . '/../code/tabletest.php';
include_once dirname(__FILE__) . '/../code/pathtest.php';

function boolstring($val) {
    return $val ? "true" : "false";
}

$testAllpath = array_merge($testpath, array_merge($testpatrelatif, array_merge($testpath2, $testpatrelatif2)));
$testAllpathhtt = array_merge($testpathhttp, array_merge($testpatrelatif, array_merge($testpathhttp2, $testpatrelatif2)));

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
            <a href="./phpinfo.php" target="_blank">phpinfo</a>
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
        <h1>Path test</h1>
        <?php
        foreach ($testAllpath as $value) {
            $obj = (!empty($value["parentin"])) ? 
                            new Path($value["parentin"], $value["filein"]) : 
                            new Path($value["parentin"]);
            displaytaball($value, $obj, $i, __LINE__);
        }
        ?>
    </section>
    <section>
        <h1>PathServe test</h1>
        <?php 
        foreach ($testAllpathhtt as $value) {
            $obj = (!empty($value["parentin"])) ? 
                            new PathServe($value["parentin"], $value["filein"]) : 
                            new PathServe($value["parentin"]);
            displaytaball($value, $obj, $i, __LINE__);
        }
        ?>
    </section>
</body>
</html>
