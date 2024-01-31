<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('PathServe')) {

    require_once __DIR__ . "/Platform.php";
    require_once __DIR__ . "/PathDef.php";
    require_once __DIR__ . "/RegexPath.php";

    /**
     * Undocumented class
     */
    class PathServe extends PathDef {

        /**
         * Undocumented function
         *
         * @param PathServe|string|null $pathParent
         * @param string|null $path
         */
        public function __construct(PathServe|string|null $pathParent = null, string|null $path = null) {
            if(strtolower(gettype($pathParent)) == "object" && strtolower(get_class($pathParent)) == "pathserve") {
                $pathParent = $pathParent->getPath();
            }
            parent::__construct($pathParent, $path);
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        protected function absolut_def():string|null {
            $valueout = "";
            if(!empty($_SERVER) && !empty($_SERVER) && array_key_exists("REQUEST_URI" ,$_SERVER) && !empty($_SERVER['REQUEST_URI'])) {
                $valueout = PathServe::base().$_SERVER['REQUEST_URI'];
            }
            if(empty($valueout)) {
                $valueout = PathServe::base();
            }
            return preg_replace(RegexPath::ENDPATH->value, '', PathServe::del_get_anc($valueout));
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public static function base():string|null {
            if(!array_key_exists('REQUEST_SCHEME', $_SERVER) || !array_key_exists('HTTP_HOST', $_SERVER)) {
                return "";
            }
            $valueout = (new PathServe($_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].'/'))->getAbsolutePath();
            return preg_replace(RegexPath::ENDPATH->value, '', PathServe::del_get_anc($valueout));
        }

    }

}
