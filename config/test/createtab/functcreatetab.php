<?php

function del_name_disk(string|null $path):string|null {
    if(empty($path)) {
        return "";
    }
    $path = preg_replace(RegexPath::ANTISLASH->value, "/", trim($path));
    $path = preg_replace(RegexPath::ABSOSERVE->value, "", trim($path));
    return preg_replace(RegexPath::ABSOWIN->value, "", trim($path));
}

function recup_value_disk(string|null $regex, string|null $path):string|null {
    if(empty($path) || empty($regex)) {
        return "";
    }
    preg_match($regex, $path, $matches);
    if(!empty($matches) && count($matches) > 0) {
        return $matches[0];
    }
    return "";
}

function recup_name_disk(string|null $pathparent):string|null {
    if(empty($pathparent)) {
        return "";
    }
    $path = preg_replace(RegexPath::ANTISLASH->value, "/", trim($pathparent));
    if(preg_match_all(RegexPath::ABSOSERVE->value, $path) != false) {
        return recup_value_disk(RegexPath::ABSOSERVE->value, $path);
    } else if(preg_match_all(RegexPath::ABSOWIN->value, $path) != false) {
        $valuedef = recup_value_disk(RegexPath::ABSOWIN->value, $path);
        $path = del_name_disk($path);
        if(preg_match_all(RegexPath::MAXSLASH->value, $path) != false) {
            $valuedef .= recup_value_disk(RegexPath::MAXSLASH->value, $path);
            $valuedef=substr($valuedef, 0, (strlen($valuedef)-1));
        }
        return $valuedef;
    }
    return "";
}

function recupname(string|null $pathParent):string {
    $parent = trim(del_name_disk($pathParent), "/");
    $name = strrev(explode('/', strrev($parent), 2)[0]);
    $name = trim(trim($name), "/");
    if($name == "..") {
        $name = "";
    }
    return trim(trim($name), "/");
}

function recupeother(array $tab):array {
    $absolutpath = "";
    $namedisk = "";
    $name = recupname($tab[1]);
    if(!empty($tab[3])) {
        $namedisk = recup_name_disk($tab[2]);
        if(empty($namedisk)) {
            $namedisk = "/";
        }
        if(empty($namedisk)) {
            $namedisk = $tab[2];
        }
        $absolutpath = rtrim($tab[3]."/".$name, "/");
        if(empty($absolutpath)) {
            $absolutpath = $tab[3];
        }
        $absolutpath = str_replace("https:/t", "https://t", str_replace("//", "/", $absolutpath));
    }
    return ["name" => $name, "absolutpath" => $absolutpath, "namedisk" => $namedisk];
}
