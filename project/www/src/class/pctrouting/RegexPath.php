<?php
// verifier qu'on n'a pas deja creer l'enum
if (!enum_exists("RegexPath")) {

    /**
     * Enum regex pour le chemin et le routage.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    enum RegexPath: string
    {
        case NULL = '';
        case ABSOLIN = '/^\//sim';
        case ANTISLASH = '/\\\\/sim';
        case NAMROUTE = '/^%1\//sim';
        case RTINDEX = '/%1[\d]{1,}/sim';
        case RELATIVE = '/^[.]{1}\//sim';
        case MAXSLASH = '/^[\/]{2,}/sim';
        case PATHENDRETU = '/[.]{2}$/sim';
        case PATHNORETU = '/^[.]{2}\//sim';
        case ENDFILE = '/\.[a-zA-Z]*$/sim';
        case ENDPATH = '/[\/\\\\]{1,}$/sim';
        case SEPSYSTEM = '/[\/\\\\]{1}/sim';
        case ABSOWIN = '/^[^.^\/^\\\\.]{1,}:/sim';
        case TWOSLASH = '/[\/]{2,}|\/\.\/|\\\\/sim';
        case ABSOSERVE = '/^[^.^\/.]{1,}:[\/]{2}[\.\w: ]{1,}/sim';
        case FILEWEB = '/\/[\w \-_]{1,}\.php$|\/[\w \-_]{1,}\.html$/sim';
        //case PATHRETU = '/[\w ]{1,}[\/]{1,}[\.]{2}|[\/]{2,}|^[\.]{2}$|^\/[\.]{2}$/sim';
        case PATHRETU = '/[\w\._\-]{1,}[\w]{1,}[\/]{1,}[\.]{2}|[\/]{2,}|\/ | \//sim';
    }
}
