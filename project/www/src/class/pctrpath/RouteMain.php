<?php


if (!class_exists('RouteMain')) {

    /* en cas d'erreur sur la classe */
    include_once __DIR__ . '/Path.php';
    include_once __DIR__ . '/PathServe.php';
    require_once __DIR__ . "/RegexPath.php";

    /**
     * Undocumented class
     */
    class RouteMain {

        public static string $NAMEKEY = "pctroutind";
        private string|null $parentPath;
        private string|null $currentDir;
        private string|null $url;
        private array|null $index;
        private bool $isRoutage;

        /**
         * Undocumented function
         *
         * @param boolean $isRoutage
         */
        public function __construct() {
            $this->isRoutage = array_key_exists("url", $_GET);
            $this->parentPath = "./";
            $this->currentDir = "./";
            $this->index = array();
            if(!empty($_GET) && array_key_exists('url', $_GET) && !empty($_GET['url'])) {
                $geturl = preg_replace(RegexPath::RELATIVE->value, "", (new PathServe($_GET["url"]))->getPath());
                $this->index = $this->createTabIndex($geturl);
                foreach ($this->index as $value) {
                    $this->parentPath .= "../";
                    $this->currentDir .= "../";
                }
                $this->parentPath = (new PathServe($this->parentPath))->getPath()."/";
                $this->currentDir = (new PathServe($this->currentDir))->getPath()."/";
            } else {
                if(!empty($_GET)) {
                    $regex_ind = str_replace("%1", RouteMain::$NAMEKEY, RegexPath::RTINDEX->value);
                    foreach ($_GET as $key => $value) {
                        if(preg_match_all($regex_ind, $key) && !array_key_exists($key, $this->index)) {
                            $this->index[$key] = $value;
                        }
                    }
                }
            }
            $this->url = trim(implode("/", $this->index), "/");
        }

        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return array|null
         */
        private function createTabIndex(string|null $path):array|null {
            if(empty($path)) {
                return array();
            }
            $arrayIndex = array();
            $tabIndex = explode("/", trim($path, "/"));
            foreach ($tabIndex as $key => $value) {
                $arrayIndex[RouteMain::$NAMEKEY.$key] = $value;
            }
            unset($tabIndex);
            return $arrayIndex;
        }

        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return array|null
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
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        public function path(string|null $path):string|null {
            $path = trim(preg_replace(RegexPath::TWOSLASH->value, "/", preg_replace(RegexPath::RELATIVE->value, "", $path)), "/");
            if(!$this->isRoutage) {
                $pathGetIndex = "";
                $path1 = new PathServe($path);
                $explodePath = explode("#", preg_replace(RegexPath::RELATIVE->value, "", $path1->getPath()), 2);
                $explodePathGet = explode("?", $explodePath[0], 2);
                $tabpath = $this->pathnoroute($explodePathGet[0]);
                $pathGetIndex .= $tabpath["parent"];
                //$pathGetIndex .= $this->currentDirectory($path);
                $tabIndex = $this->createTabIndex($tabpath["path"]);
                if(count($tabIndex) > 0) {
                    $pathGetIndex .= "?";
                }
                foreach ($tabIndex as $key => $value) {
                    $pathGetIndex .= $key . "=" .$value . "&";
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
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        public function pathFile(string|null $path):string|null {
            $pathou = "./".$path;
            if($this->isRoutage) {
                $pathou = $this->currentDir.$path;
            }
            return (new PathServe($pathou))->getAbsolutePath();
        }

        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        public function pathSystem(string|null $path):string|null {
            $pathou = "./".$path;
            if($this->isRoutage) {
                $pathou = $this->currentDir.$path;
            }
            return (new Path($pathou))->getAbsolutePath();
        }

        /**
         * Undocumented function
         *
         * @param string|null $index
         * @return boolean
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
         * Undocumented function
         *
         * @return array|null
         */
        public function getIndAndKeyPg():array|null {
            return  $this->index;
        }
        
        /**
         * Undocumented function
         *
         * @return array|null
         */
        public function getIndPg():array|null {
            return  array_values($this->index);
        }
        
        /**
         * Undocumented function
         *
         * @param string|null $key
         * @return string|null
         */
        public function getIndAndKeyPgKey(string|null $key):string|null {
            if(!empty($key) && !empty($this->index) && array_key_exists($key, $this->index)) {
                return $this->index[$key];
            }
            return  "";
        }
        
        /**
         * Undocumented function
         *
         * @param integer $key
         * @return string|null
         */
        public function getIndPgKey(int $key):string|null {
            if(($key >= 0) && !empty($this->index) && ($key < count($this->index))) {
                return  array_values($this->index)[$key];
            } else {
                return "";
            }
        }
        
        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function getCurrentDir():string|null
        {
            return $this->currentDir;
        }

        /**
         * Get the value of parentPath
         *
         * @return string|null
         */
        public function getParentPath(): string|null
        {
                return $this->parentPath;
        }

        /**
         * Get the value of isRoutage
         *
         * @return bool
         */
        public function getIsRoutage(): bool
        {
                return $this->isRoutage;
        }


        /**
         * Get the value of url
         *
         * @return string|null
         */
        public function getUrl(): string|null
        {
                return $this->url;
        }
    }

}
