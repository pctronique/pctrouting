<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('Path')) {

    require_once __DIR__ . "/Platform.php";
    require_once __DIR__ . "/PathDef.php";
    require_once __DIR__ . "/RegexPath.php";

    define("RACINE_SITE", __DIR__."/../../..");

    /**
     * Creation de la class pour la lecture du fichier ini avec les configurations
     */
    class Path extends PathDef {

        public function __construct(string|null $pathParent = null, string|null $path = null) {
            parent::__construct($pathParent, $path);
            $this->name = $this->separator_system($this->name);
            $this->parent = $this->separator_system($this->parent);
            $this->absoluteParent = $this->separator_system($this->absoluteParent);
            $this->absolutePath = $this->separator_system($this->absolutePath);
            $this->path = $this->separator_system($this->path);
        }

        protected function absolut_def():string|null {
            $valueModif = RACINE_SITE;
            if(!empty($_SERVER) && array_key_exists("SCRIPT_FILENAME" ,$_SERVER) && !empty($_SERVER['SCRIPT_FILENAME'])) {
                $valueModif = $_SERVER['SCRIPT_FILENAME'];
            }
            $endvalue = strrev(explode('/', strrev($this->reg_slash($valueModif)))[0]);
            if(is_file($valueModif)) {
                $valueModif=str_replace($endvalue, '', $valueModif);
            }
            return $valueModif;
        }

        private function separator_system(string|null $path):string|null {
            return str_replace("/", DIRECTORY_SEPARATOR, $path);
        }

    }

}
