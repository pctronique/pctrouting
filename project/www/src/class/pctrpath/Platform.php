<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('Platform')) {

    include_once __DIR__ . "/EnumPlatform.php";

    /**
     * Creation de la class pour la lecture du fichier ini avec les configurations
     */
    class Platform {

        private EnumPlatform|null $name;

        public function __construct() {
            $this->name=$this->recupPlarform(PHP_OS);
        }

        private function transformName(string|null $name):string|null {
            if(empty($name)) {
                return null;
            }
            return str_replace("'", "", 
                    str_replace('"', "", 
                    str_replace("/", "_", 
                    str_replace(".", "_", 
                    str_replace("-", "_", 
                    str_replace(" ", "_", 
                    strtoupper($name)))))));
        }

        private function recupPlarform(string|null $name):EnumPlatform|null {
            if(empty($name)) {
                return EnumPlatform::UNKNOWN;
            }
            $name = $this->transformName($name);
            foreach(EnumPlatform::cases() as $enumPlatform) {
                if($enumPlatform->name == $name) {
                    return $enumPlatform;
                }
            }
            return EnumPlatform::UNKNOWN;
        }


        /**
         * Get the value of name
         *
         * @return EnumPlatform|null
         */
        public function getName(): EnumPlatform|null
        {
            return $this->name;
        }


        /**
         * Get the value of name
         *
         * @return string|null
         */
        public function php_os(): string|null
        {
            return $this->transformName(PHP_OS);
        }

        public function iswin():bool {
            $php_os = $this->php_os();
            if(!empty($php_os) && strlen($php_os) > 2) {
                if (substr($php_os, 0, 3) == "WIN") {
                    return true;
                }
            }
            return false;
        }


    }

}
