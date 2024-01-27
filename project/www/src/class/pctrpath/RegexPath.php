<?php

if (!enum_exists("RegexPath")) {
    enum RegexPath: string
    {
        case NULL = '';
        case ABSOLIN = '/^\//sim';
        case RELATIVE = '/^.\//sim';
        case ANTISLASH = '/\\\\/sim';
        case MAXSLASH = '/^[\/]{2,}/sim';
        case ENDFILE = '/\.[a-zA-Z]*$/sim';
        case PATHNORETU = '/^[.]{2}\//sim';
        case ENDPATH = '/[\/\\\\]{1,}$/sim';
        case SEPSYSTEM = '/[\/\\\\]{1}/sim';
        case ABSOWIN = '/^[^.^\/^\\\\.]{1,}:/sim';
        case TWOSLASH = '/[\/]{2,}|\/\.\/|\\\\/sim';
        case PATHRETU = '/[\w ]{1,}[\/]{1,}[.]{2}|[\/]{2,}/sim';
        case ABSOSERVE = '/^[^.^\/.]{1,}:[\/]{2}[\.\w: ]{1,}/sim';
    }
}
