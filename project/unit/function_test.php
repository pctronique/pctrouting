<?php

require __DIR__ . "/config_path.php";
require_once(RACINE_WWW . '/src/class/pctrpath/RouteMain.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function array_route() {
    return array(
        ["",
        "./",
        "./"],
        ["./",
        "./",
        "./"],
        ["?key0=value0",
        "./?key0=value0",
        "./?key0=value0"],
        ["./?key0=value0",
        "./?key0=value0",
        "./?key0=value0"],
        ["?key0=value0&key1=value1",
        "./?key0=value0&key1=value1",
        "./?key0=value0&key1=value1"],
        ["./?key0=value0&key1=value1",
        "./?key0=value0&key1=value1",
        "./?key0=value0&key1=value1"],
        ["route1?key0=value0&key1=value1",
        "./route1?key0=value0&key1=value1",
        "./?".PCTR_ROUTING_NR."=route1&key0=value0&key1=value1"],
        ["./route1?key0=value0&key1=value1",
        "./route1?key0=value0&key1=value1",
        "./?".PCTR_ROUTING_NR."=route1&key0=value0&key1=value1"],
        ["route1/route2?key0=value0&key1=value1",
        "./route1/route2?key0=value0&key1=value1",
        "./?".PCTR_ROUTING_NR."=route1/route2&key0=value0&key1=value1"],
        ["./route1/route2?key0=value0&key1=value1",
        "./route1/route2?key0=value0&key1=value1",
        "./?".PCTR_ROUTING_NR."=route1/route2&key0=value0&key1=value1"]
    );
}

function array_path()
{
    return array(
        ["/usr/local/www/../site/../../tmp/index.php",
        "/usr/tmp/index.php",
        "/usr/tmp"],
        ["/usr/local/www/../../../../../../site/../../tmp/index.php",
        "/tmp/index.php",
        "/tmp",
        "/tmp"],
        ["../index.php",
        "./../index.php",
        "./..",
        ""],
        ["./../index.php",
        "./../index.php",
        "./..",
        ""],
        ["/../../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["./../../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["./../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["c:\\usr\\local\\www\\..\\site\\..\\..\\tmp\\index.php",
        "c:\\usr\\tmp\\index.php",
        "c:\\usr\\tmp",
        "c:\\usr\\tmp"],
        ["c:\\usr\\local\\www\\..\\..\\..\\..\\..\\..\\site\\..\\..\\tmp\\index.php",
        "c:\\tmp\\index.php",
        "c:\\tmp",
        "c:\\tmp"],
        ["c:",
        "c:",
        "c:",
        "c:"],
        ["/",
        "/",
        "/",
        "/"]
    );
}

function array_https()
{
    return array(
        ["https://test.fr/usr/local/www/../site/../../tmp/index.php",
        "https://test.fr/usr/tmp/index.php",
        "https://test.fr/usr/tmp",
        "https://test.fr/usr/tmp"],
        ["https://test.fr/usr/local/www/../../../../../../site/../../tmp/index.php",
        "https://test.fr/tmp/index.php",
        "https://test.fr/tmp",
        "https://test.fr/tmp"],
        ["../index.php",
        "./../index.php",
        "./..",
        ""],
        ["./../index.php",
        "./../index.php",
        "./..",
        ""],
        ["./../../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["./../../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["./../site/../../tmp/../index.php",
        "./../../index.php",
        "./../..",
        ""],
        ["https://test.fr",
        "https://test.fr",
        "https://test.fr",
        "https://test.fr"]
    );
}

function array_string()
{
    return array(
        null, "", "tintin", "####", "////", "/opt/titi",
        "Pc*#014HgIl*#78", "0125", "01.25", "01,25", "A15F", "0", "1", "2",
        "/usr/local/projecttmp/tmp/php", "/", "/opt/tmp", "message_1", "[%s]"
    );
}

function array_cmd()
{
    return array(
        null, "", "cd /", "ls", "export Home=tintin", "export Home=tintin",
        "cd /usr/local/apache2/www", "/usr/local/projecttmp/tmp/php",
        "export Home=/usr/local/apache2/www", "cd ", "cd Home", 'cd $Home', "cd /",
        "cd /usr/local/******/htdocs", "cd /usr/local/apa.che2/ht.docs/tmp", "cd /opt/tmp"
    );
}

function array_file()
{
    return array(null, RACINE_WWW . "/favicon.ico", RACINE_WWW . "/example/test.html", 
                    RACINE_WWW . "/example/message.ini", RACINE_WWW . "/example/messages.json");
}

function array_folder()
{
    return array(
        null, "", "/usr/local/src/", "/usr/local/apache2/www2/",
        "/usr/local/projecttmp/tmp/php",
        "/usr/local/projecttmp/tmp/php/test1", "/usr/local////apache2/www/tmp/test1",
        "./tmp/test1", "/usr/local/projecttmp/tmp/php/test1/../../../",
        "/usr/local/projecttmp/tmp/php/test1/../../../tmp//kml/",
        "/usr/local/projecttmp/tmp/php/test1/../../..", "linux", "tintin", "/opt/tmp"
    );
}

function array_email()
{
    return array(
        null, "", "test@test.fr", "test1@test.fr"
    );
}

function array_charsets()
{
    $tab = mb_list_encodings();
    array_unshift($tab, null);
    return $tab;
}


function array_string_all()
{
    return array_unique(array_merge(array_string(), array_cmd(), array_folder(), array_file(), array_email(), array_charsets()));
}

function slash_initial_pwd($folder)
{
    $value = stripos($folder, "/");
    if (!$value && $value !== 0) {
        return false;
    } else if ($value !== 0) {
        return false;
    }
    return true;
}

function tmp_folder($file)
{
    if (!slash_initial_pwd($file)) {
        $path = "/tmp/www/";
        return $path . $file;
    }
    return $file;
}

function tmp_folder2($file)
{
    if (!slash_initial_pwd($file)) {
        $path = "/tmp/www/003/";
        return $path . $file;
    }
    return $file;
}

function not_racine($file)
{
    if (empty(trim(trim(str_replace(" ", "", $file), "/")))) {
        $path = "/tmp/www/003/";
        return $path;
    }
    return $file;
}
