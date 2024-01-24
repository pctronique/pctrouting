<?php
/**
 * Pour lire le fichier avec les configurations du site.
 */

if (!class_exists('PathPhp')) {

    /**
     * Creation de la class pour la lecture du fichier ini avec les configurations
     */
    class PathPhp {

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        private static function replace_slash(string|null $path): string|null {
            return PathPhp::replace_double_slash(PathPhp::replace_antislash($path));
        }

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        private static function replace_antislash(string|null $path): string|null {
            return str_replace("\\", "/", $path);
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
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        private static function replace_double_slash(string|null $path): string|null {
            return str_replace("/./", "/", str_replace("//", "/", $path));
        }

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
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
         */
        private static function path_absolu(string|null $path): string|null {
            if(stripos($path, '/')  === 0) {
                return true;
            }
            $output_array = array();
            preg_match('/^[a-zA-Z]{1}:/', $path, $output_array);
            if(count($output_array) !== 0) {
                return true;
            }
            return false;
        }

        /**
         * Remplace les "/./" et "//" par "/".
         * @param string|null $path le chemin canonique a modifier
         * @return string|null le chemin canonique modifie
         */
        public static function path(string|null $pathParent, string|null $path = null): string|null {
            if(empty($pathParent) || empty(trim($pathParent))) {
                $pathParent = "";
            }
            if(empty($path) || empty(trim($path))) {
                $path = "";
            }
            if(!empty($pathParent) && !empty($path)) {
                $pathParent = PathPhp::replace_end_slash(PathPhp::replace_slash($pathParent));
                $path = PathPhp::replace_slash($path);
                if(!empty($path)) {
                    $path = trim($path);
                    if(stripos($path, '../')  === 0 && !PathPhp::path_absolu($path)) {
                        $path = $pathParent . "/" . $path;
                    }else if(stripos($path, './')  === 0 && !PathPhp::path_absolu($path)) {
                        $path = $pathParent . "/" . PathPhp::currentPath($path);
                    } else if(!PathPhp::path_absolu($path)) {
                        $path = $pathParent . "/" . PathPhp::currentPath($path);
                    }
                }
            } else if(!empty($pathParent)) {
                $path = PathPhp::replace_slash($pathParent);
            }
            return PathPhp::replace_slash($path);
        }

        /**
         * Retire le './' au debut du chemin (si il est present).
         */
        public static function currentPath(string|null $path):string|null {
            while (stripos($path, './') === 0) {
                $path = ltrim(ltrim($path, "."), "/");
            }
            return $path;
        }
    }
}
