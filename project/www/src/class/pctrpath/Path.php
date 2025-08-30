<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('Path')) {

    require_once __DIR__ . "/PathDef.php";
    require_once __DIR__ . "/PathServe.php";

    define("PCTR_PATH_RACINE_SITE", __DIR__."/../../..");

    /**
     * Pour la création d'un chemin valide à partir du disque dur.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class Path extends PathDef {

        /**
         * le constructeur par défaut ou par référence.
         *
         * @param Path|string|null $pathParent le chemin parent ou du fichier.
         * @param string|null $path le chemin du fichier si on utilise un chemin parent.
         */
        public function __construct(Path|string|null $pathParent = null, string|null $path = null) {
            if(strtolower(gettype($pathParent)) == "object" && strtolower(get_class($pathParent)) == "path") {
                $pathParent = $pathParent->getPath();
            }
            parent::__construct($pathParent, $path);
            $this->name = $this->separator_system($this->name);
            $this->parent = $this->separator_system($this->parent);
            $this->absoluteParent = $this->separator_system($this->absoluteParent);
            $this->absolutePath = $this->separator_system($this->absolutePath);
            $this->path = $this->separator_system($this->path);
        }

        /**
         * Récupère le chemin absolut par défaut.
         *
         * @return string|null chemin absolu par défaut.
         */
        protected function absolut_def():string|null {
            $valueout = "";
            if(!empty($_SERVER) && array_key_exists("PWD" ,$_SERVER) && !empty($_SERVER['PWD']) && 
            array_key_exists("REQUEST_URI" ,$_SERVER) && !empty($_SERVER['REQUEST_URI'])) {
                $valueout = $_SERVER['PWD']."/".preg_replace(RegexPath::FILEWEB->value, "/", $_SERVER['REQUEST_URI']);
            } else if(!empty($_SERVER) && array_key_exists("PWD" ,$_SERVER) && !empty($_SERVER['PWD'])) {
                $valueout = $_SERVER['PWD'];
            }
            if(empty($valueout)) {
                $valueout = Path::base();
            }
            return preg_replace(RegexPath::ENDPATH->value, '', PathServe::del_get_anc($valueout));
        }

        /**
         * Récupère le chemin absolu de base.
         *
         * @return string|null le chemin absolu de base.
         */
        public static function base():string|null {
            $valueout = new Path(PCTR_PATH_RACINE_SITE);
            return preg_replace(RegexPath::ENDPATH->value, '', Path::del_get_anc($valueout->getAbsolutePath()));
        }

        /**
         * Remplace le séparateur par celui de la plateforme.
         *
         * @param string|null $path chemin avec le séparateur /.
         * @return string|null chemin avec le séparateur de la plateforme.
         */
        private function separator_system(string|null $path):string|null {
            return preg_replace(RegexPath::SEPSYSTEM->value, DIRECTORY_SEPARATOR, $path);
        }

        /**
         * Vérifier que le fichier ou dossier existe.
         *
         * @return boolean true si le fichier ou dossier existe.
         */
        public function exists():bool {
            return file_exists($this->absolutePath);
        }

    }

}
