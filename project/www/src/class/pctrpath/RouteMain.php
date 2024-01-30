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

        private string|null $parentPath;
        private string|null $currentDir;
        private string|null $cssImgDir;
        private array|null $index;
        private bool $isRoutage;
        public static string $NAMEKEY = "rt_index_";

        /**
         * Undocumented function
         *
         * @param boolean $isRoutage
         */
        public function __construct(bool $isRoutage = true) {
            $this->isRoutage = $isRoutage;
            $this->parentPath = "./";
            $this->currentDir = "./";
            $this->cssImgDir = "./";
            $this->index = array();
            $nbredir = substr_count($_SERVER["REDIRECT_URL"], '/');
            $nbrequ = substr_count($_SERVER["REQUEST_URI"], '/');
            if(!empty($_GET) && array_key_exists('url', $_GET) && !empty($_GET['url']) && $isRoutage) {
                $geturl = preg_replace(RegexPath::RELATIVE->value, "", (new PathServe($_GET["url"]))->getPath());
                $this->index = $this->createTabIndex($geturl);
                //$nbParentCurrentDirectory = substr_count(preg_replace(RegexPath::TWOSLASH->value, "/", $geturl), '/');
                //for ($i=0; $i < $nbParentCurrentDirectory; $i++) { 
                foreach ($this->index as $value) {
                    $this->parentPath .= "../";
                    $this->currentDir .= "../";
                    $this->cssImgDir .= "../";
                }
                for ($i=0; $i < ($nbrequ-$nbredir); $i++) { 
                    $this->cssImgDir .= "../";
                }
                $this->parentPath = (new PathServe($this->parentPath))->getPath()."/";
                $this->currentDir = (new PathServe($this->currentDir))->getPath()."/";
                $this->cssImgDir = (new PathServe($this->cssImgDir))->getPath()."/";
            }
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
         * @return string|null
         */
        private function currentDirectory(string|null $path):string|null {
            if(empty($path)) {
                return "";
            }
            $pathOut = "";
            $path = new PathServe($path);
            $explodeCurrentDirectory = explode("/", trim(explode("?", explode("#", $path->getPath(), 2)[0], 2)[0], "/"));
            foreach ($explodeCurrentDirectory as $value) {
                if($value == "..") {
                    $pathOut .= "../";
                }
            }
            return $pathOut;
        }
        
        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        public function path(string|null $path):string|null {
            if(!$this->isRoutage) {
                $pathGetIndex = "";
                $path1 = new PathServe($path);
                $explodePath = explode("#", preg_replace(RegexPath::RELATIVE->value, "", $path1->getPath()), 2);
                $explodePathGet = explode("?", $explodePath[0], 2);
                $pathGetIndex .= $this->currentDirectory($path);
                
                $tabIndex = $this->createTabIndex($explodePathGet[0]);
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
            //$path1 = new PathServe($this->currentDir, $path);
            //return $path1->getPath();
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
                $pathou = $this->cssImgDir.$path;
            }
            return (new PathServe($pathou))->getAbsolutePath();
            //return "./".$path;
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
         * Get the value of cssImgDir
         *
         * @return string|null
         */
        public function getCssImgDir(): string|null
        {
                return $this->cssImgDir;
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

    }

}
