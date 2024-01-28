<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('Path')) {

    require_once __DIR__ . "/Platform.php";
    require_once __DIR__ . "/RegexPath.php";

    define("RACINE_SITE", __DIR__."/../../..");

    /**
     * Creation de la class pour la lecture du fichier ini avec les configurations
     */
    abstract class PathDef {

        protected string|null $name;
        protected string|null $parent;
        protected string|null $absoluteParent;
        protected string|null $absolutePath;
        protected string|null $path;
        private string|null $diskname;

        /**
         * Undocumented function
         *
         * @param string|null $pathParent
         * @param string|null $path
         */
        public function __construct(string|null $pathParent = null, string|null $path = null) {
            if(empty($pathParent) && empty($path)) {
                $this->recupvalue($this->absolut_def());
            } else {
                $this->recupvalue($pathParent, $path);
            }
        }

        /**
         * Undocumented function
         *
         * @param string|null $pathParent
         * @param string|null $path
         * @return self
         */
        private function recupvalue(string|null $pathParent = null, string|null $path = null):self {
            if(empty($pathParent)) {
                $pathParent = "";
            }
            if(empty($path)) {
                $path = "";
            }
            $this->diskname = $this->recup_name_disk($pathParent);
            $this->name = $this->del_name_disk($path);
            $this->parent = $this->del_name_disk($pathParent);
            $this->name = $this->del_relative($this->name);
            $this->parent = $this->del_relative($this->parent);
            $this->absoluteParent = "";
            $this->absolutePath = "";
            $this->path = "";
            $is_absolute = $this->getIsAbsolute($this->parent);
            $this->sep_file_parent($this->not_dote_path($this->parent."/".$this->name));
            if($is_absolute || !empty($this->diskname)) {
                $this->pathmodabsol();
            } else {
                $this->pathmodrelat($this->absolut_def());
            }
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

        private function pathmodabsol():self {
            $this->path = "/" . trim($this->reg_slash($this->parent . "/" . $this->name), "/");
            $this->parent = "/" . trim($this->parent, "/");
            $this->path = rtrim($this->diskname . $this->path, "/");
            $this->parent = rtrim($this->diskname . $this->parent, "/");
            $this->absoluteParent = rtrim($this->parent, "/");
            //$this->parent = "";
            $this->absolutePath = rtrim($this->absoluteParent . $this->reg_slash("/" . rtrim($this->name, "/")), "/");
            if(empty($this->parent)) {
                $this->parent = "/";
            }
            if(empty($this->path)) {
                $this->path = "/";
            }
            return $this;
        }

        private function pathmodrelat(string|null $basepath = null):self {
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
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        private function del_relative(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            return preg_replace(RegexPath::RELATIVE->value, "", trim($path));
        }

        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        private function recup_name_disk(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            $path = preg_replace(RegexPath::ANTISLASH->value, "/", trim($path));
            if(preg_match_all(RegexPath::ABSOSERVE->value, $path) != false) {
                return $this->recup_value_disk(RegexPath::ABSOSERVE->value, $path);
            } else if(preg_match_all(RegexPath::ABSOWIN->value, $path) != false) {
                $valuedef = $this->recup_value_disk(RegexPath::ABSOWIN->value, $path);
                $path = $this->del_name_disk($path);
                if(preg_match_all(RegexPath::MAXSLASH->value, $path) != false) {
                    $valuedef .= $this->recup_value_disk(RegexPath::MAXSLASH->value, $path);
                    $valuedef=substr($valuedef, 0, (strlen($valuedef)-1));
                }
                return $valuedef;
            }
            return "";
        }

        /**
         * Undocumented function
         *
         * @param string|null $regex
         * @param string|null $path
         * @return string|null
         */
        private function recup_value_disk(string|null $regex, string|null $path):string|null {
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
         * Undocumented function
         *
         * @param string|null $pathParent
         * @return self
         */
        private function sep_file_parent(string|null $pathParent):self {
            $tabval = explode('/', strrev($this->reg_slash(rtrim($pathParent, "/"))), 2);
            $this->name = strrev($tabval[0]);
            if(count($tabval) > 1) {
                $this->parent = $this->not_dote_path(strrev($tabval[1]));
            }
            return $this;
        }
        
        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        protected function reg_slash(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            return preg_replace(RegexPath::TWOSLASH->value, "/", trim($path));
        }

        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return boolean
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
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
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
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
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
                $thepath = "/".$thepath;
            }
            return $thepath;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        protected function absolut_def():string|null {
            return "";
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public static function base():string|null {
            return "";
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getName(): string|null
        {
                return $this->name;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getParent(): string|null
        {
                return $this->parent;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getDiskname(): string|null
        {
                return $this->diskname;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getAbsoluteParent(): string|null
        {
                return $this->absoluteParent;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getAbsolutePath(): string|null
        {
                return $this->absolutePath;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getPath(): string|null
        {
                return $this->path;
        }
    }

}
