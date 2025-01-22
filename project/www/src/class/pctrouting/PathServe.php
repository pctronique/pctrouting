<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('PathServe')) {

    require_once __DIR__ . "/Platform.php";
    require_once __DIR__ . "/PathDef.php";
    require_once __DIR__ . "/RegexPath.php";

    /**
     * Pour la création d'un chemin valide à partir du site.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class PathServe extends PathDef {

        /**
         * le constructeur par défaut ou par référence.
         *
         * @param PathServe|string|null $pathParent le chemin parent ou du fichier.
         * @param string|null $path le chemin du fichier si on utilise un chemin parent.
         */
        public function __construct(PathServe|string|null $pathParent = null, string|null $path = null) {
            if(strtolower(gettype($pathParent)) == "object" && strtolower(get_class($pathParent)) == "pathserve") {
                $pathParent = $pathParent->getPath();
            }
            parent::__construct($pathParent, $path);
        }

        /**
         * Récupère le chemin absolu par défaut.
         *
         * @return string|null chemin absolu par défaut.
         */
        protected function absolut_def():string|null {
            $valueout = "";
            if(!empty($_SERVER) && !empty($_SERVER) && array_key_exists("REQUEST_URI" ,$_SERVER) && !empty($_SERVER['REQUEST_URI'])) {
                $valueout = PathServe::base().preg_replace(RegexPath::FILEWEB->value, "/", $_SERVER['REQUEST_URI']);
            }
            if(empty($valueout)) {
                $valueout = PathServe::base();
            }
            return preg_replace(RegexPath::ENDPATH->value, '', PathServe::del_get_anc($valueout));
        }

        /**
         * Récupère le chemin absolu de base.
         *
         * @return string|null le chemin absolu de base.
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
