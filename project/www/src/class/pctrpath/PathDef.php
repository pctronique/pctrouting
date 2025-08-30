<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('PathDef')) {

    require_once __DIR__ . "/../pctrplatform/Platform.php";
    require_once __DIR__ . "/RegexPath.php";

    define("RACINE_SITE", __DIR__."/../../..");

    /**
     * Pour la création d'un chemin valide.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    abstract class PathDef {

        protected string|null $name;
        protected string|null $parent;
        protected string|null $absoluteParent;
        protected string|null $absolutePath;
        protected string|null $path;
        private string|null $diskname;

        /**
         * le constructeur par défaut ou par référence.
         *
         * @param string|null $pathParent le chemin parent ou du fichier.
         * @param string|null $path le chemin du fichier si on utilise un chemin parent.
         */
        public function __construct(string|null $pathParent = null, string|null $path = null) {
            if(empty($pathParent) && empty($path)) {
                $this->recupvalue($this->absolut_def());
            } else {
                $this->recupvalue($pathParent, $path);
            }
        }

        /**
         * Création des données de la classe.
         *
         * @param string|null $pathParent le chemin parent ou du fichier.
         * @param string|null $path le chemin du fichier si on utilise un chemin parent.
         * @return self
         */
        private function recupvalue(string|null $pathParent = null, string|null $path = null):self {
            if(empty($pathParent)) {
                $pathParent = "";
            }
            if(empty($path)) {
                $path = "";
            }
            // récupération de base
            $this->diskname = $this->recup_name_disk($pathParent);
            $this->name = $this->del_name_disk($path);
            $this->parent = $this->del_name_disk($pathParent);
            $is_absolute = $this->getIsAbsolute($this->parent);
            // récupération pour faire le travaille sur les valeurs.
            $this->name = $this->del_relative($this->name);
            $this->parent = $this->del_relative($this->parent);
            $this->absoluteParent = "";
            $this->absolutePath = "";
            $this->path = "";
            $pathall=$this->parent."/".$this->name;
            // si le chemin de base est absolu.
            if(!($is_absolute || !empty($this->diskname))) {
                $pathall=trim($pathall, "/");
            }
            // sépare le chemin du ficher ou dossier.
            $this->sep_file_parent(trim($this->not_dote_path($pathall), "/"));
            if($is_absolute || !empty($this->diskname)) {
                $this->pathmodabsol();
            } else {
                $this->pathmodrelat();
            }
            // recupère le nom du disque pour linux.
            if(empty($this->diskname)) {
                $this->diskname = "/";
            }
            if(empty($this->absoluteParent)) {
                $this->absoluteParent = "/";
            }
            if(empty($this->absolutePath)) {
                $this->absolutePath = "/";
            }
            return $this;
        }

        /**
         * Si on travail sur un chemin absolu.
         *
         * @return self
         */
        private function pathmodabsol():self {
            $this->path = "/" . trim($this->reg_slash($this->parent . "/" . $this->name), "/");
            $this->parent = "/" . trim($this->parent, "/");
            $this->path = rtrim($this->diskname . $this->path, "/");
            $this->parent = rtrim($this->diskname . $this->parent, "/");
            $this->absoluteParent = rtrim($this->parent, "/");
            $this->absolutePath = rtrim($this->absoluteParent . $this->reg_slash("/" . rtrim($this->name, "/")), "/");
            if(empty($this->parent)) {
                $this->parent = "/";
            }
            if(empty($this->path)) {
                $this->path = "/";
            }
            return $this;
        }

        /**
         * Si on travail sur un chemin relatif.
         * 
         * @return self
         */
        private function pathmodrelat():self {
            $basepath = $this->absolut_def();
            $this->path = "./".trim($this->reg_slash($this->parent . "/" . $this->name), "/");
            $basepath = $this->absolut_def();
            if(!empty($basepath)) {
                $is_absolute = $this->getIsAbsolute($basepath);
                $this->diskname = $this->recup_name_disk($basepath);
                $basepath = $this->del_name_disk($basepath);
                if($is_absolute || !empty($this->diskname)) {
                    $this->absoluteParent = rtrim($this->diskname."/".trim($this->not_dote_path($basepath."/".$this->parent), "/"), "/");
                    $this->absolutePath = rtrim($this->diskname."/".trim($this->not_dote_path($basepath."/".$this->parent."/" . $this->name), "/"), "/");
                }
                
            }
            $this->parent = "./".trim($this->parent, "/");
            return $this;
        }

        /**
         * Supprime le début ("./") d'un chemin relatif.
         *
         * @param string|null $path chemin relatif.
         * @return string|null chemin relatif sans "./".
         */
        private function del_relative(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            return preg_replace(RegexPath::RELATIVE->value, "", trim($path));
        }

        /**
         * Récupère le nom du disque
         *
         * @param string|null $path chemin avec le nom du disque.
         * @return string|null le nom du disque.
         */
        private function recup_name_disk(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            $path = preg_replace(RegexPath::ANTISLASH->value, "/", trim($path));
            if(preg_match_all(RegexPath::ABSOSERVE->value, $path) != false) {
                return $this->reg_replace(RegexPath::ABSOSERVE->value, $path);
            } else if(preg_match_all(RegexPath::ABSOWIN->value, $path) != false) {
                $valuedef = $this->reg_replace(RegexPath::ABSOWIN->value, $path);
                $path = $this->del_name_disk($path);
                if(preg_match_all(RegexPath::MAXSLASH->value, $path) != false) {
                    $valuedef .= $this->reg_replace(RegexPath::MAXSLASH->value, $path);
                    $valuedef=substr($valuedef, 0, (strlen($valuedef)-1));
                }
                return $valuedef;
            }
            return "";
        }

        /**
         * Remplace le texte à partir du regex.
         *
         * @param string|null $regex le regex.
         * @param string|null $path Le chemin.
         * @return string|null Le chemin après modification.
         */
        private function reg_replace(string|null $regex, string|null $path):string|null {
            if(empty($path) || empty($regex)) {
                return "";
            }
            preg_match($regex, $path, $matches);
            if(!empty($matches) && count($matches) > 0) {
                return $matches[0];
            }
            return "";
        }

        /**
         * Sépare le fichier ou dossier du chemin parent.
         *
         * @param string|null $pathParent le chemin.
         * @return self
         */
        private function sep_file_parent(string|null $pathParent):self {
            $this->parent = $pathParent;
            if(preg_match_all(RegexPath::PATHENDRETU->value, rtrim($pathParent, "/")) == false) {
                $tabval = explode('/', strrev($this->reg_slash(rtrim($pathParent, "/"))), 2);
                $this->name = strrev($tabval[0]);
                if(count($tabval) > 1) {
                    $this->parent = $this->not_dote_path(strrev($tabval[1]));
                } else {
                    $this->parent = "";
                }
            } else {
                $this->name = "";
            }
            return $this;
        }
        
        /**
         * Retire le double slash.
         *
         * @param string|null $path chemin avec double slash.
         * @return string|null chemin avec simple slash.
         */
        protected function reg_slash(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            return preg_replace(RegexPath::TWOSLASH->value, "/", trim($path));
        }

        /**
         * Vérifier que le chemin soit absolu.
         *
         * @param string|null $path le chemin.
         * @return boolean true si le chemin est absolu.
         */
        private function getIsAbsolute(string|null $path):bool {
            if(empty($path)) {
                return false;
            }
            $thepath = $this->reg_slash($path);
            $isabsolute = preg_match_all(RegexPath::ABSOLIN->value, $thepath) != false;
            return $isabsolute;
        }

        /**
         * Supprime le nom du disque du chemin.
         *
         * @param string|null $path chemin avec le nom du disque.
         * @return string|null chemin sans le nom du disque.
         */
        private function del_name_disk(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            $path = preg_replace(RegexPath::ANTISLASH->value, "/", trim($path));
            $path = preg_replace(RegexPath::ABSOSERVE->value, "", trim($path));
            return preg_replace(RegexPath::ABSOWIN->value, "", trim($path));
        }

        /**
         * Retire au maximum les deux points dans un chemin.
         *
         * @param string|null $path chemin avec trop de deux points
         * @return string|null chemin avec le minimum de deux points.
         */
        private function not_dote_path(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            $isabsolute = $this->getIsAbsolute($path);
            $thepath = $this->reg_slash(trim($path));
            while (preg_match_all(RegexPath::PATHRETU->value, $thepath) != false) {
                $thepath = $this->reg_slash(preg_replace(RegexPath::PATHRETU->value, '/', $thepath));
            }
            $thepath = $this->reg_slash($thepath);
            $thepath = trim($thepath, "/");
            if($isabsolute) {
                while (preg_match_all(RegexPath::PATHNORETU->value, $thepath) != false) {
                    $thepath = preg_replace(RegexPath::PATHNORETU->value, '', $thepath);
                }
                if($thepath == "..") {
                    $thepath = "";
                }
                $thepath = "/".$thepath;
            }
            return $thepath;
        }

        /**
         * Supprime le get et ancrage du chemin.
         *
         * @param string|null $lien chemin avec get et ancrage
         * @return string|null chemin sans get, ni ancrage.
         */
        protected static function del_get_anc(string|null $lien):string|null {
            if(empty($lien)) {
                return "";
            }
            return explode("?", explode("#", $lien)[0])[0];
        }

        /**
         * Récupère le chemin absolut par défaut.
         *
         * @return string|null chemin absolu par défaut.
         */
        protected function absolut_def():string|null {
            return "";
        }

        /**
         * Récupère le chemin absolu de base.
         *
         * @return string|null le chemin absolu de base.
         */
        public static function base():string|null {
            return "";
        }

        /**
         * Récupère le nom du fichier ou dossier.
         *
         * @return string|null le nom du fichier ou dossier.
         */
        public function getName(): string|null
        {
                return $this->name;
        }

        /**
         * Récupère le chemin parent.
         *
         * @return string|null le chemin parent.
         */
        public function getParent(): string|null
        {
                return $this->parent;
        }

        /**
         * Récupère le nom du disque.
         *
         * @return string|null le nom du disque.
         */
        public function getDiskname(): string|null
        {
                return $this->diskname;
        }

        /**
         * Récupère le chemin absolu du parent.
         *
         * @return string|null le chemin absolu du parent.
         */
        public function getAbsoluteParent(): string|null
        {
                return $this->absoluteParent;
        }

        /**
         * Récupère le chemin absolu.
         *
         * @return string|null le chemin absolu.
         */
        public function getAbsolutePath(): string|null
        {
                return $this->absolutePath;
        }

        /**
         * Récupère le chemin relatif.
         *
         * @return string|null le chemin relatif.
         */
        public function getPath(): string|null
        {
                return $this->path;
        }
        
    }

}
