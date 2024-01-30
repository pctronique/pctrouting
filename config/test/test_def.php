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
    <!--<link rel="stylesheet" href="./../css/style.css" />
    <link rel="stylesheet" href="./css/tabtest.css" />
    <link rel="stylesheet" href="./css/pathtest.css" />-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <!--<header>
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
    </header>-->
    <section class="firstsection">
      <?php /*$path01 = new Path();
            $path02 = new Path($path01);*/
            ?>
        <!--<h1>Path test</h1>-->
        <?php
        $i = 0;
        foreach ($testpath as $value) {
            //displaytaball($value, new Path($value["parentin"]));
            $table = new Path($value["parentin"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpath <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        foreach ($testpatrelatif as $value) {
            //displaytaball($value, new Path($value["parentin"]));
            $table = new Path($value["parentin"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpatrelatif <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        foreach ($testpath2 as $value) {
            //displaytaball($value, new Path($value["absolutparent"], $value["parentin"])); 
            $table = new Path($value["parentin"], $value["filein"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpath2 <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        foreach ($testpatrelatif2 as $value) {
            //displaytaball($value, new Path($value["absolutparent"], $value["parentin"]));
            $table = new Path($value["parentin"], $value["filein"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpatrelatif2 <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        ?>
    </section>
    <section>
        <!--<h1>PathServe test</h1>-->
        <?php 
        foreach ($testpathhttp as $value) {
            //displaytaball($value, new PathServe($value["parentin"]));
            $table = new PathServe($value["parentin"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpathhttp <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        foreach ($testpatrelatif as $value) {
            //displaytaball($value, new PathServe($value["parentin"]));
            $table = new PathServe($value["parentin"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpatrelatif <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        foreach ($testpathhttp2 as $value) {
            //displaytaball($value, new PathServe($value["absolutparent"], $value["parentin"]));
            $table = new PathServe($value["parentin"], $value["filein"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpathhttp2 <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        foreach ($testpatrelatif2 as $value) {
            //displaytaball($value, new PathServe($value["absolutparent"], $value["parentin"]));
            $table = new PathServe($value["parentin"], $value["filein"]);
            $test1 = $table->getPath() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["path"]);
            $test2 = $table->getParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["parent"]);
            $test3 = true;
            $display3 = false;
            if(!empty($value["absolutparent"])) {
                $test2 = $table->getAbsoluteParent() == preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $value["absolutparent"]);
                $display3 = true;
            }
            if(!$test1 || !$test2) {
                var_dump("-----------------00000000000000000000000--------------------");
                echo "tab (".__LINE__.") : testpatrelatif2 <br />";
                $i++;
                echo "nb ".$i." : <br />";
                echo "<br />";
                //echo $table->getErrortxt();
                var_dump($value);
                var_dump("getPath class       : ".$table->getPath());
                var_dump("getPath test        : ".$value["path"]);
                var_dump("getPath bool        : ".boolstring($test1));
                var_dump("getParent class     : ".$table->getParent());
                var_dump("getParent test      : ".$value["parent"]);
                var_dump("getParent bool      : ".boolstring($test2));
                if($display3) {
                    var_dump("absolParent class   : ".$table->getAbsoluteParent());
                    var_dump("absolParent test    : ".$value["absolutparent"]);
                    var_dump("absolParent bool    : ".boolstring($test3));
                }
                var_dump($table);
                var_dump("-----------------11111111111111111111111--------------------");
            }
        }
        ?>
    </section>
</body>
</html>
