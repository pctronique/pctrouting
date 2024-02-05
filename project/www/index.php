<?php

include_once dirname(__FILE__) . '/src/class/pctrouting/Path.php';
include_once dirname(__FILE__) . '/src/class/pctrouting/PathDef.php';
include_once dirname(__FILE__) . '/src/class/pctrouting/RouteMain.php';
include_once dirname(__FILE__) . '/src/class/pctrouting/Platform.php';
include_once dirname(__FILE__) . '/src/class/pctrouting/PathServe.php';
include_once dirname(__FILE__) . '/code/tabletest.php';
include_once dirname(__FILE__) . '/code/pathtest.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/style_media.css" />
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
            src="./favicon.ico"
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
            <a href="./">acc</a>
          </li>
          <li class="bt-menu no-submenu">
            <a href="./route">route</a>
          </li>
        </ul>
      </menu>
    </header>
    <section class="firstsection">
        <h1>Path</h1>
            <?php
                displaytab(createtabclass(new Path()), "new Path()");
                displaytab(createtabclass(new Path("./folder/")), 'new Path("./folder/")');
                displaytab(createtabclass(new Path(new Path("./folder/"), "./file")), 'new Path(new Path("./folder/"), "./file")');
                displaytab(createtabclass(new Path("test021/jhgf", "rtyu/frt")), 'new Path("test021/jhgf", "rtyu/frt")');
                displaytab(createtabclass(new Path("/usr/local/apache2/www")), 'new Path("/usr/local/apache2/www")');
            ?>
    </section>
    <section>
        <h1>PathServe</h1>
            <?php
                displaytab(createtabclass(new PathServe()), "class 1");
                displaytab(createtabclass(new PathServe("test021/jhgf", "rtyu/frt")), "class 2");
                displaytab(createtabclass(new PathServe("http://localhost:86")), "class 3");
            ?>
    </section>
</body>
</html>
