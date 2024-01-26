<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('PathServe')) {

    require_once __DIR__ . "/Platform.php";
    require_once __DIR__ . "/PathDef.php";
    require_once __DIR__ . "/RegexPath.php";

    define("RACINE_SITE", __DIR__."/../../..");

    /**
     * Creation de la class pour la lecture du fichier ini avec les configurations
     */
    class PathServe extends PathDef {

        public function __construct(string|null $pathParent = null, string|null $path = null) {
            parent::__construct($pathParent, $path);
        }

        protected function absolut_def():string|null {
            return "";
        }

    }

}
