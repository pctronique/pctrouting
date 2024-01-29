<?php

function pathvalid($boolpath) {
    if($boolpath) {
        return "pathtrue";
    }
    return "pathfalse";
}

function tdbool(bool $thebool):string {
    $classbool = $thebool ? "texttrue" : "textfalse";
    $text = $thebool ? "true" : "false";
    return '<div class="textval '.$classbool.'">'.$text.'</div>';
}

function tdarray($array):string {
    return "<pre>".print_r($array, true)."</pre>";
}

function returnvalue($obj):string {
    $typeobj = strtolower(gettype($obj));
    if($typeobj == "integer") {
        return strval($obj);
    } else if($typeobj == "double") {
        return doubleval($obj);
    } else if($typeobj == "string") {
        return $obj;
    } else if($typeobj == "boolean") {
        return tdbool($obj);
    } else if($typeobj == "array" || $typeobj == "object") {
        return tdarray($obj);
    }
    return "";
}

function displaytab($table, $name, $isvallog = null) {
    $nmclassv = "nullvl";
    if(strtolower(gettype($isvallog)) == "boolean") {
        $nmclassv = pathvalid($isvallog);
    }
    ?>
    <div class="tab">
        <div class="tabtitle">
            <div class="dispval <?= $nmclassv ?>"></div>
            <h2><?= $name ?></h2>
        </div>
        <div class="tabbody">
            <?php foreach ($table as $key => $value) { ?>
                <div class="tab0 tabth"><?= $key ?></div>
                <div class="tab1 tabth">
                    <?= returnvalue($value) ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
}