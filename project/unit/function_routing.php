<?php

/*
public function getIndPg():array|null
public function getCurrentDir():string|null
public function getIsRoutage(): bool
public function getUrl(): string|null
public function path(string|null $path = null):string|null
public function pathSystem(string|null $path):string|null
public function indexbool(string|null $index):bool
public function getIndPgKey(int $key):string|null
*/

$tabrouting = [
    [
        "url_a_n" => "",
        "getIndPg" => "",
        "getCurrentDir" => "./",
        "getCurrentDir_n" => "./",
        "getIsRoutage" => true,
        "getIsRoutage_n" => false,
        "getUrl" => "",
        "tabIndPgKey" => [
            [
                "getIndPgKey" => -1,
                "getIndPgKey_res" => ""
            ],
            [
                "getIndPgKey" => 0,
                "getIndPgKey_res" => ""
            ],
            [
                "getIndPgKey" => 1,
                "getIndPgKey_res" => ""
            ]
        ],
        "tabIndexbool" => [
            [
                "indexbool" => "",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "test",
                "indexbool_res" => false
            ]
        ],
        "tabPathSystem" => [
            [
                "pathSystem" => "",
                "pathSystem_res" => "",
                "pathSystem_res_r" => ""
            ],
            [
                "pathSystem" => "image.png",
                "pathSystem_res" => "image.png",
                "pathSystem_res_r" => "image.png"
            ],
            [
                "pathSystem" => "./../image.png",
                "pathSystem_res" => "./../image.png",
                "pathSystem_res_r" => "./../image.png"
            ],
            [
                "pathSystem" => "../../image.png",
                "pathSystem_res" => "../../image.png",
                "pathSystem_res_r" => "../../image.png"
            ],
            [
                "pathSystem" => "./../../image.png",
                "pathSystem_res" => "./../../image.png",
                "pathSystem_res_r" => "./../../image.png"
            ]
        ],
        "tabPath" => [
            [
                "path" => "",
                "path_res" => "",
                "path_res_r" => ""
            ],
            [
                "path" => "./",
                "path_res" => "./",
                "path_res_r" => "./"
            ],
            [
                "path" => "./../src/",
                "path_res" => "./../src/",
                "path_res_r" => "./../src"
            ],
            [
                "path" => "./../src/test/",
                "path_res" => "./../src/test/",
                "path_res_r" => "./../src?nurl=test"
            ],
            [
                "path" => "./../src/test/?test0=testv0&test1=testv1",
                "path_res" => "./../src/test/?test0=testv0&test1=testv1",
                "path_res_r" => "./../src?nurl=test&test0=testv0&test1=testv1"
            ],
            [
                "path" => "./../src/test/test1/?test0=testv0&test1=testv1",
                "path_res" => "./../src/test/test1/?test0=testv0&test1=testv1",
                "path_res_r" => "./../src?nurl=test/test1&test0=testv0&test1=testv1"
            ]
        ],
    ],

    [
        "url_a_n" => "get0",
        "getIndPg" => "",
        "getCurrentDir" => "./../",
        "getCurrentDir_n" => "./",
        "getIsRoutage" => true,
        "getIsRoutage_n" => false,
        "getUrl" => "get0",
        "tabIndPgKey" => [
            [
                "getIndPgKey" => -1,
                "getIndPgKey_res" => ""
            ],
            [
                "getIndPgKey" => 0,
                "getIndPgKey_res" => "get0"
            ],
            [
                "getIndPgKey" => 1,
                "getIndPgKey_res" => ""
            ]
        ],
        "tabIndexbool" => [
            [
                "indexbool" => "",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "test",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "get01",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "get1",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "get0",
                "indexbool_res" => true
            ]
        ],
        "tabPathSystem" => [
            [
                "pathSystem" => "",
                "pathSystem_res" => "",
                "pathSystem_res_r" => ""
            ],
            [
                "pathSystem" => "image.png",
                "pathSystem_res" => "image.png",
                "pathSystem_res_r" => "image.png"
            ],
            [
                "pathSystem" => "./../image.png",
                "pathSystem_res" => "./../image.png",
                "pathSystem_res_r" => "./../image.png"
            ],
            [
                "pathSystem" => "../../image.png",
                "pathSystem_res" => "../../image.png",
                "pathSystem_res_r" => "../../image.png"
            ],
            [
                "pathSystem" => "./../../image.png",
                "pathSystem_res" => "./../../image.png",
                "pathSystem_res_r" => "./../../image.png"
            ]
        ],
        "tabPath" => [
            [
                "path" => "",
                "path_res" => "",
                "path_res_r" => ""
            ],
            [
                "path" => "./",
                "path_res" => "./",
                "path_res_r" => "./"
            ],
            [
                "path" => "./../src/",
                "path_res" => "./../src/",
                "path_res_r" => "./../src/"
            ],
            [
                "path" => "./../src/test/",
                "path_res" => "./../src/test/",
                "path_res_r" => "./../src?nurl=test"
            ],
            [
                "path" => "./../src/test/?test0=testv0&test1=testv1",
                "path_res" => "./../src/test/?test0=testv0&test1=testv1",
                "path_res_r" => "./../src?nurl=test&test0=testv0&test1=testv1"
            ],
            [
                "path" => "./../src/test/test1/?test0=testv0&test1=testv1",
                "path_res" => "./../src/test/test1/?test0=testv0&test1=testv1",
                "path_res_r" => "./../src?nurl=test/test1&test0=testv0&test1=testv1"
            ]
        ],
    ],

    [
        "url_a_n" => "get0/get1",
        "getIndPg" => "",
        "getCurrentDir" => "./../../",
        "getCurrentDir_n" => "./",
        "getIsRoutage" => true,
        "getIsRoutage_n" => false,
        "getUrl" => "get0/get1",
        "tabIndPgKey" => [
            [
                "getIndPgKey" => -1,
                "getIndPgKey_res" => ""
            ],
            [
                "getIndPgKey" => 0,
                "getIndPgKey_res" => "get0"
            ],
            [
                "getIndPgKey" => 1,
                "getIndPgKey_res" => "get1"
            ],
            [
                "getIndPgKey" => 2,
                "getIndPgKey_res" => ""
            ]
        ],
        "tabIndexbool" => [
            [
                "indexbool" => "",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "test",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "get01",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "get1",
                "indexbool_res" => false
            ],
            [
                "indexbool" => "get0",
                "indexbool_res" => true
            ],
            [
                "indexbool" => "get0/get1",
                "indexbool_res" => true
            ]
        ],
        "tabPathSystem" => [
            [
                "pathSystem" => "",
                "pathSystem_res" => "",
                "pathSystem_res_r" => ""
            ],
            [
                "pathSystem" => "image.png",
                "pathSystem_res" => "image.png",
                "pathSystem_res_r" => "image.png"
            ],
            [
                "pathSystem" => "./../image.png",
                "pathSystem_res" => "./../image.png",
                "pathSystem_res_r" => "./../image.png"
            ],
            [
                "pathSystem" => "../../image.png",
                "pathSystem_res" => "../../image.png",
                "pathSystem_res_r" => "../../image.png"
            ],
            [
                "pathSystem" => "./../../image.png",
                "pathSystem_res" => "./../../image.png",
                "pathSystem_res_r" => "./../../image.png"
            ]
        ],
        "tabPath" => [
            [
                "path" => "",
                "path_res" => "",
                "path_res_r" => ""
            ],
            [
                "path" => "./",
                "path_res" => "./",
                "path_res_r" => "./"
            ],
            [
                "path" => "./../src/",
                "path_res" => "./../src/",
                "path_res_r" => "./../src/"
            ],
            [
                "path" => "./../src/test/",
                "path_res" => "./../src/test/",
                "path_res_r" => "./../src?nurl=test"
            ],
            [
                "path" => "./../src/test/?test0=testv0&test1=testv1",
                "path_res" => "./../src/test/?test0=testv0&test1=testv1",
                "path_res_r" => "./../src?nurl=test&test0=testv0&test1=testv1"
            ],
            [
                "path" => "./../src/test/test1/?test0=testv0&test1=testv1",
                "path_res" => "./../src/test/test1/?test0=testv0&test1=testv1",
                "path_res_r" => "./../src?nurl=test/test1&test0=testv0&test1=testv1"
            ]
        ],
    ]
];


function array_tabrouting() {
    global $tabrouting;
    return $$tabrouting;
}