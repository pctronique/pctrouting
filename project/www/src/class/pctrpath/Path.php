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
     * Undocumented class
     */
    class Path extends PathDef {

        /**
         * Undocumented function
         *
         * @param string|null $pathParent
         * @param string|null $path
         */
        public function __construct(string|null $pathParent = null, string|null $path = null) {
            parent::__construct($pathParent, $path);
            $this->name = $this->separator_system($this->name);
            $this->parent = $this->separator_system($this->parent);
            $this->absoluteParent = $this->separator_system($this->absoluteParent);
            $this->absolutePath = $this->separator_system($this->absolutePath);
            $this->path = $this->separator_system($this->path);
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        protected function absolut_def():string|null {
            $valueout = "";
            if(!empty($_SERVER) && array_key_exists("PWD" ,$_SERVER) && !empty($_SERVER['PWD']) && 
            array_key_exists("REQUEST_URI" ,$_SERVER) && !empty($_SERVER['REQUEST_URI'])) {
                $valueout = $_SERVER['PWD']."/".$_SERVER['REQUEST_URI'];
            } else if(!empty($_SERVER) && array_key_exists("PWD" ,$_SERVER) && !empty($_SERVER['PWD'])) {
                $valueout = $_SERVER['PWD'];
            }
            if(empty($valueout)) {
                $valueout = Path::base();
            }
            return preg_replace(RegexPath::ENDPATH->value, '', $valueout);
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public static function base():string|null {
            $valueout = new Path(RACINE_SITE);
            return preg_replace(RegexPath::ENDPATH->value, '', $valueout->getAbsolutePath());
        }

        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        private function separator_system(string|null $path):string|null {
            return preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $path);
        }

    }

}
