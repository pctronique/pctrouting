<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('Platform')) {

    include_once __DIR__ . "/PlatformEnum.php";

    /**
     * Undocumented class
     */
    class Platform {

        private PlatformEnum|null $name;

        /**
         * Undocumented function
         */
        public function __construct() {
            $this->name=$this->recupPlarform(PHP_OS);
        }

        /**
         * Undocumented function
         *
         * @param string|null $name
         * @return string|null
         */
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

        /**
         * Undocumented function
         *
         * @param string|null $name
         * @return PlatformEnum|null
         */
        private function recupPlarform(string|null $name):PlatformEnum|null {
            if(empty($name)) {
                return PlatformEnum::UNKNOWN;
            }
            $name = $this->transformName($name);
            foreach(PlatformEnum::cases() as $enumPlatform) {
                if($enumPlatform->name == $name) {
                    return $enumPlatform;
                }
            }
            return PlatformEnum::UNKNOWN;
        }

        /**
         * Undocumented function
         *
         * @return PlatformEnum|null
         */
        public function getName(): PlatformEnum|null
        {
            return $this->name;
        }
        
        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function php_os(): string|null
        {
            return $this->transformName(PHP_OS);
        }

        /**
         * Undocumented function
         *
         * @return boolean
         */
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
