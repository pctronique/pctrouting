<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('Platform')) {

    include_once __DIR__ . "/PlatformEnum.php";

    /**
     * Pour récupérer le nom de la plateforme utilisé.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class Platform {

        private PlatformEnum|null $name;

        /**
         * le constructeur par défaut.
         */
        public function __construct() {
            $this->name=$this->recupPlarform(PHP_OS);
        }

        /**
         * Transforme le nom pour le retrouver dans l'enum.
         *
         * @param string|null $name le nom a transformer.
         * @return string|null Le nom modifié.
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
         * Récupère l'enum du nom de la plateforme.
         *
         * @param string|null $name le nom text.
         * @return PlatformEnum|null L'enum du nom.
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
         * Récupère le nom à partir de l'enum.
         *
         * @return PlatformEnum|null le nom de la plateforme.
         */
        public function getName(): PlatformEnum|null
        {
            return $this->name;
        }
        
        /**
         * Récupère le nom à partir d'un format texte.
         *
         * @return string|null le nom.
         */
        public function php_os(): string|null
        {
            return $this->transformName(PHP_OS);
        }

        /**
         * Vérifier qu'on utilise une plateforme windows.
         *
         * @return boolean true si c'est un windows.
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

        /**
         * Vérifier qu'on utilise l'antislash comme séparateur.
         *
         * @return boolean true si c'est un windows.
         */
        public function isSepAntislash():bool {
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
