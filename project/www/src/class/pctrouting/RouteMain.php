<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('RouteMain')) {

    include_once __DIR__ . '/Path.php';
    include_once __DIR__ . '/PathServe.php';
    require_once __DIR__ . "/RegexPath.php";
    define("PCTR_ROUTING_NR", "nurl");

    /**
     * Pour le routage des pages du site.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class RouteMain {
        
        private string|null $currentDir;
        private string|null $url;
        private array|null $index;
        private bool $isRoutage;

        /**
         * le constructeur par défaut ou par référence.
         */
        public function __construct() {
            $this->isRoutage = array_key_exists("url", $_GET);
            $this->currentDir = "./";
            $this->index = array();
            $this->url = "";
            $emptyget = (!empty($_GET));
            $isnotroute = ($emptyget && array_key_exists(PCTR_ROUTING_NR, $_GET));
            $this->isRoutage = ($emptyget && array_key_exists("url", $_GET));
            if($this->isRoutage && !empty($_GET['url'])) {
                $this->url = preg_replace(RegexPath::RELATIVE->value, "", (new PathServe($_GET["url"]))->getPath());
            } else if(!$this->isRoutage && $isnotroute && !empty($_GET[PCTR_ROUTING_NR])) {
                $this->url = preg_replace(RegexPath::RELATIVE->value, "", (new PathServe($_GET[PCTR_ROUTING_NR]))->getPath());
            }
            $this->index = $this->createTabIndex($this->url);
            if($this->isRoutage) {
                foreach ($this->index as $value) {
                    $this->currentDir .= "../";
                }
                $this->currentDir = trim((new PathServe($this->currentDir))->getPath(), "/")."/";

            }
        }

        /**
         * Créer la table index de routage.
         *
         * @param string|null $path chemin routage.
         * @return array|null table index.
         */
        private function createTabIndex(string|null $path):array|null {
            if(empty($path)) {
                return array();
            }
            $arrayIndex = array();
            $tabIndex = explode("/", trim($path, "/"));
            foreach ($tabIndex as $key => $value) {
                array_push($arrayIndex, $value);
            }
            unset($tabIndex);
            return $arrayIndex;
        }

        /**
         * Chemin non routé. Créer un tableau de travail.
         *
         * @param string|null $path Chemin non routé
         * @return array|null tableau de travail.
         */
        private function pathnoroute(string|null $path):array|null {
            $tabpath = ["parent" => "", "path" => ""];
            if(empty($path)) {
                return $tabpath;
            }
            $tabname = explode("/", trim($path, "/"));
            $newpath = explode("/", trim($path, "/"));
            foreach ($tabname as $value) {
                $pathtest = trim($tabpath["parent"]."/".$value, "/");
                if($value == "..") {
                    $tabpath["parent"] = $pathtest;
                    unset($newpath[0]);
                    $newpath = array_values($newpath);
                } else {
                    $pathfile = new Path($pathtest);
                    if($pathfile->exists()) {
                        $tabpath["parent"] = $pathtest;
                        unset($newpath[0]);
                        $newpath = array_values($newpath);
                    } else {
                        break;
                    }
                }
            }
            foreach ($newpath as $value) {
                $tabpath["path"] = trim($tabpath["path"]."/".$value, "/");
            }
            return $tabpath;
        }
        
        /**
         * Créer un chemin d'un lien valide absolu à partir d'un chemin relatif.
         *
         * @param string|null $path d'un chemin relatif.
         * @return string|null chemin d'un lien valide absolu.
         */
        public function path(string|null $path = null):string|null {
            if(empty($path)) {
                $path = "";
            }
            $path = trim(preg_replace(RegexPath::TWOSLASH->value, "/", preg_replace(RegexPath::RELATIVE->value, "", $path)), "/");
            if(!$this->isRoutage) {
                $pathGetIndex = "";
                $explodePath = [];
                $tabpath = [];
                $explodePathGet = [];
                if(!empty($path)) {
                    $tabpath = [$path];
                    $pathrecp = new PathServe($path);
                    $explodePath = explode("#", preg_replace(RegexPath::RELATIVE->value, "", $pathrecp->getPath()), 2);
                    if(!empty($explodePath)) {
                        $explodePathGet = explode("?", $explodePath[0], 2);
                    }
                    $tabpath = $this->pathnoroute($explodePathGet[0]);
                    $pathGetIndex .= $tabpath["parent"];
                    $tabIndex = $this->createTabIndex($tabpath["path"]);
                    if(!empty($tabpath["path"])) {
                        $pathGetIndex .= "?nurl=".$tabpath["path"];
                    }
                }
                $pathGetIndex = trim($pathGetIndex, "&");
                if(count($explodePathGet) > 1) {
                    if(count($tabIndex) > 0) {
                        $pathGetIndex .= "&" . $explodePathGet[1];
                    } else {
                        $pathGetIndex .= "?" . $explodePathGet[1];
                    }
                }
                if(count($explodePath) > 1) {
                    $pathGetIndex .= "#" . $explodePath[1];
                }
                $path = $pathGetIndex;
            }
            if($this->isRoutage) {
                $path = (new PathServe($this->currentDir,$path))->getPath();
            }
            return (new PathServe($path))->getAbsolutePath();
        }

        /**
         * Créer un chemin d'un lien valide absolu pour un fichier à partir d'un chemin relatif d'un fichier.
         *
         * @param string|null $path chemin relatif d'un fichier.
         * @return string|null un chemin d'un lien valide absolu pour un fichier.
         */
        public function pathFile(string|null $path):string|null {
            $pathou = "./".$path;
            if($this->isRoutage) {
                $pathou = $this->currentDir.$path;
            }
            return (new PathServe($pathou))->getAbsolutePath();
        }

        /**
         * Créer un chemin valide absolu pour un fichier sur un disque dur à partir d'un chemin relatif d'un fichier.
         *
         * @param string|null $path chemin relatif d'un fichier.
         * @return string|null chemin valide absolu pour un fichier sur un disque dur.
         */
        public function pathSystem(string|null $path):string|null {
            $pathou = "./".$path;
            if($this->isRoutage) {
                $pathou = $this->currentDir.$path;
            }
            return (new Path($pathou))->getAbsolutePath();
        }

        /**
         * Vérifier l'emplacement du routage.
         *
         * @param string|null $index entrer chemin base du routage.
         * @return boolean true si on est au bon endroit.
         */
        public function indexbool(string|null $index):bool {
            if(empty($index)) {
                return false;
            }
            $index = trim(preg_replace(RegexPath::TWOSLASH->value, "/", preg_replace(RegexPath::RELATIVE->value, "", $index)), "/");
            $nbind = count(explode("/", $index));
            $tabind = array_values($this->index);
            if(count($tabind) >= $nbind) {
                $array = [];
                for ($i=0; $i < $nbind; $i++) { 
                    array_push($array, $tabind[$i]);
                }
                $indv = trim(implode("/", $array), "/");
                return (strtolower($index) == strtolower($indv));
            }
            return false;
        }

        /**
         * Valider un chemin à partir d'un regex.
         * @param string|null $index
         * @return bool
         */
        public function indexregexbool(string|null $index):bool {
            if(empty($index)) {
                return false;
            }
            $nbind = preg_match("/\//sim",$index);
            $tabind = array_values($this->index);
            if(count($tabind) >= $nbind) {
                $indv = implode("/", $this->index);
                return preg_match($index,$indv);
            }
            return false;
        }

        /**
         * Vérifier le chemin à partir d'un regex.
         * @param string|null $index
         * @return string|null
         */
        public function recupregexvalue(string|null $regex):string|null {
            if(empty($regex)) {
                return "";
            }
            $indv = implode("/", $this->index);
            $valid = preg_match($regex,$indv, $matches);
            if($valid) {
                return $matches[0];
            }
            return "";
        }
        
        /**
         * Récupère la dernière valeur du tableau index.
         * 
         * @return string|null
         */
        public function lastvaluerouting(): string|null {
            if(empty($this->index)) {
                return "";
            }
            return end($this->index);
        }
        
        /**
         * Récupérer le tableau du routage.
         *
         * @return array|null tableau du routage.
         */
        public function getIndPg():array|null {
            return  $this->index;
        }
        
        /**
         * Récupère une valeur du tableau index à parir d'une clée.
         *
         * @param integer $key la clée.
         * @return string|null la valeur du tableau index.
         */
        public function getIndPgKey(int $key):string|null {
            if(($key >= 0) && !empty($this->index) && ($key < count($this->index))) {
                return  array_values($this->index)[$key];
            } else {
                return "";
            }
        }
        
        /**
         * Récupère le chemin relatif du parent.
         *
         * @return string|null chemin relatif du parent.
         */
        public function getCurrentDir():string|null
        {
            return $this->currentDir;
        }

        /**
         * Si on est en mode de routage.
         *
         * @return bool true si on route la page.
         */
        public function getIsRoutage(): bool
        {
                return $this->isRoutage;
        }

        /**
         * Récupère l'url du routage.
         *
         * @return string|null url du routage.
         */
        public function getUrl(): string|null
        {
                return $this->url;
        }
    }

}
