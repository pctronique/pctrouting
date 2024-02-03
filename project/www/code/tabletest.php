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

function tdstring($txt): string {
    return $txt;
}

function returnvalue($obj):string {
    $typeobj = strtolower(gettype($obj));
    if($typeobj == "integer") {
        return strval($obj);
    } else if($typeobj == "double") {
        return doubleval($obj);
    } else if($typeobj == "string") {
        return tdstring($obj);
    } else if($typeobj == "boolean") {
        return tdbool($obj);
    } else if($typeobj == "array" || $typeobj == "object") {
        return tdarray($obj);
    }
    return "";
}

function dnamebool(string|bool $data):string|null {
    $typeobj = strtolower(gettype($data));
    if($typeobj == "boolean") {
        return $data ? "true" : "false";
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

function displaytabLin(array|null $table, string|null $name, array|null $header = null):void {
    $isvallog = "";
    foreach ($table as $line) {
        if(strtolower(gettype($line["valid"])) == "boolean") {
            if(strtolower(gettype($isvallog)) == "boolean") {
                if($isvallog) {
                    $isvallog = $line["valid"];
                }
            } else {
                $isvallog = $line["valid"];
            }
        }
    }
    $nmclassv = "nullvl";
    if(strtolower(gettype($isvallog)) == "boolean") {
        $nmclassv = pathvalid($isvallog);
    }
    if(empty($header)) {
        $header = [];
        $nbcol = 2;
    } else {
        $nbcol = count($header);
    }
    if($nbcol < 2) {
        $nbcol = 2;
    }
    $addgridcss = "";
    for ($i=0; $i < $nbcol; $i++) { 
        if($i == 0) {
            $addgridcss .= " auto";
        } else {
            $addgridcss .= " 1fr";
        }
        $addgridcss = trim($addgridcss);
    }
    ?>
    <div class="tab">
        <div class="tabtitle">
            <div class="dispval <?= $nmclassv ?>"></div>
            <h2><?= $name ?></h2>
        </div>
        <div class="tabbody" style="grid-template-columns: <?= $addgridcss ?>;">
            <?php foreach ($header as $key => $value) {
                if($key == 0) { ?>
                    <div class="tab0 tabth tabthtl">
                            <?= returnvalue($value) ?>
                    </div>
                <?php } else { ?>
                    <div class="tab0 tabth tabthtl">
                            <?= returnvalue($value) ?>
                    </div>
                <?php }
            }
            foreach ($table as $line) { 
                $tdval = "tdvalnul";
                if(strtolower(gettype($line["valid"])) == "boolean") {
                    $tdval = pathvalid($line["valid"]);
                }   
                unset($line["valid"]); ?>
                <?php  ?>
                <?php foreach ($line as $key => $value) {
                    if($key == 0) { ?>
                        <div class="tab0 tabth">
                            <div class="tdval0">
                                <div class="tdval <?= $tdval ?>"></div>
                                <?= returnvalue($value) ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="tab1 tabth"><?= returnvalue($value) ?></div>
                    <?php }
                }
            } ?>
        </div>
    </div>
    <?php
}