<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('PathPhp')) {

    require_once __DIR__ . "/Platform.php";

    define("RACINE_SITE", __DIR__."/../../..");

    /**
     * Creation de la class pour la lecture du fichier ini avec les configurations
     */
    class PathPhp {

        private string|null $name;
        private string|null $parent;
        private string|null $absolutePath;
        private string|null $canonicalPath;
        private string|null $windisk;

        public function __construct(string|null $pathParent = null, string|null $path = null) {
            if(empty($pathParent)) {
                $pathParent = "";
            }
            if(empty($path)) {
                $pathParent = "";
            }
            $this->absolutePath = $this->not_dote_path($pathParent.DIRECTORY_SEPARATOR.$path);
            var_dump($this->absolutePath);
        }

        public function server_folder():string|null {
            $valueModif = RACINE_SITE;
            if(!empty($_SERVER) && array_key_exists("SCRIPT_FILENAME" ,$_SERVER) && !empty($_SERVER['SCRIPT_FILENAME'])) {
                $valueModif = $_SERVER['SCRIPT_FILENAME'];
            }
            $endvalue = strrev(explode('/', strrev($this->reg_slash($valueModif)))[0]);
            if(is_file($valueModif)) {
                $valueModif=str_replace($endvalue, '', $valueModif);
            }
            return $this->not_dote_path($valueModif);
        }

        private function reg_slash(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            return preg_replace('/[\/]{2,}|\/\.\/|\\\\/sim', "/", trim($path));
        }

        public function getIsAbsolute(string|null $path):bool {
            if(empty($path)) {
                return false;
            }
            $thepath = $this->reg_slash($path);
            $isabsolute = preg_match_all('/^\//sim', $thepath) != false;
            if((new Platform())->iswin()) {
                $isabsolute = preg_match_all('/^.:\//sim', $thepath) != false;
            }
            return $isabsolute;
        }

        public function not_dote_path(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            $isabsolute = $this->getIsAbsolute($path);
            $thepath = preg_replace('/^\.\//sim', '', $this->reg_slash($path));
            $windisk = "";
            if($isabsolute && (new Platform())->iswin()) {
                $windisk = explode(':', $thepath, 2)[0];
                preg_replace('/^.:\//sim', '/', $this->reg_slash($path));
            }
            while (preg_match_all('/[^.^\/.]{1,}[\/]{1,}\.\./sim', $thepath) != false) {
                $thepath = preg_replace('/[^.^\/.]{1,}[\/]{1,}\.\./sim', '', $thepath);
            }
            $thepath = preg_replace('/[\/]{2,}|\/\.\//sim', "/", $thepath);
            $thepath = trim($thepath, "/");
            if($isabsolute) {
                $thepath = "/".$thepath;
            }
            if($isabsolute && (new Platform())->iswin()) {
                $thepath = $windisk.":".$thepath;
            }
            return str_replace("/", DIRECTORY_SEPARATOR, $thepath);
        }

        /**
         * Recuperer le parent du fichier ou dossier.
         */
        public static function pathParent(string|null $path = null): string|null {
            if(!empty(trim($path))) {
                $pathTab = explode("/", strrev($path), 2);
                if(count($pathTab) > 1) {
                    return strrev($pathTab[1]);
                }
            }
            return "";
        }

        /**
         * Retire le './' au debut du chemin (si il est present).
         */
        /*private function currentPath(string|null $path):string|null {
            if(empty($path)) {
                $path = "";
            }
            $path = PathPhp::replace_antislash($path);
            while (stripos($path, './') === 0) {
                $path = ltrim(ltrim($path, "."), "/");
            }
            return PathPhp::pathPlatform($path);
        }*/

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        //private function path(string|null $pathParent, string|null $path = null): string|null {
            /*if(empty($pathParent) || empty(trim($pathParent))) {
                $pathParent = "";
            }
            if(empty($path) || empty(trim($path))) {
                $path = "";
            }
            $path = PathPhp::replace_antislash($path);
            if(!empty($pathParent) && !empty($path)) {
                $pathParent = PathPhp::replace_end_slash(PathPhp::replace_slash(trim($pathParent)));
                $path = PathPhp::replace_slash(trim($path));
                if(!empty($path)) {
                    $path = trim($path);
                    if(stripos($path, '../')  === 0 && !PathPhp::path_absolu($path)) {
                        $path = $pathParent . "/" . $path;
                    }else if(stripos($path, './')  === 0 && !PathPhp::path_absolu($path)) {
                        $path = $pathParent . "/" . $this->currentPath($path);
                    } else if(!PathPhp::path_absolu($path)) {
                        $path = $pathParent . "/" . $this->currentPath($path);
                    }
                }
            } else if(!empty($pathParent)) {
                $path = PathPhp::replace_slash($pathParent);
            }
            return PathPhp::pathPlatform(PathPhp::replace_slash($path));*/
        //}

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        /*private static function replace_slash(string|null $path): string|null {
            return PathPhp::replace_double_slash(PathPhp::replace_antislash($path));
        }*/

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        /*private static function replace_antislash(string|null $path): string|null {
            return str_replace("\\", "/", $path);
        }*/

        /*private static function pathPlatform(string|null $path): string|null {
            return str_replace("/", DIRECTORY_SEPARATOR, $path);
        }

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         * /
        private static function replace_double_slash(string|null $path): string|null {
            return str_replace("/./", "/", str_replace("//", "/", $path));
        }

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         * /
        private static function replace_end_slash(string|null $path): string|null {
            if(empty($path) || empty(trim($path))) {
                return "";
            }
            return (strrpos($path, "/") === (strlen($path)-1)) ? $path : $path . "/";
        }

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         * /
        private static function path_absolu(string|null $path): string|null {
            if(empty($path)) {
                return false;
            }
            $path = PathPhp::replace_antislash($path);
            if(stripos($path, '/')  === 0) {
                return true;
            }
            $output_array = array();
            preg_match('/^[a-zA-Z]{1}:/', $path, $output_array);
            if(count($output_array) !== 0) {
                return true;
            }
            return false;
        }*/

        /**
         * Get the value of name
         *
         * @return string|null
         */
        public function getName(): string|null
        {
                return $this->name;
        }

        /**
         * Get the value of parent
         *
         * @return string|null
         */
        public function getParent(): string|null
        {
                return $this->parent;
        }

        /**
         * Get the value of absolutePath
         *
         * @return string|null
         */
        public function getAbsolutePath(): string|null
        {
                return $this->absolutePath;
        }
    }
}
