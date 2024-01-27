<?php


if (!class_exists('RouteMain')) {

    /* en cas d'erreur sur la classe */
    include_once __DIR__ . '/Path.php';
    include_once __DIR__ . '/PathServe.php';

    /**
     * Undocumented class
     */
    class RouteMain {

        private string|null $parentPath;
        private array|null $index;
        private bool $isRoutage;
        private string|null $currentDir;
        private array|null $tabIgnore;

        /**
         * Undocumented function
         *
         * @param boolean $isRoutage
         */
        public function __construct(bool $isRoutage = true) {
            $this->tabIgnore = array();
            $this->isRoutage = $isRoutage;
            $this->parentPath = "./";
            $this->currentDir = "./";
            $this->index = array();
            $foler_next="";
            if(!empty($this->folderroute())) {
                foreach (explode('/', $_GET["url"]) as $value) {
                    $path1 = new Path($foler_next, $value);
                    if(file_exists($path1->getPath())) {
                        $foler_next.="/".$value;
                        $foler_next=trim($foler_next,"/");
                        array_push($this->tabIgnore, $value);
                    }
                }
            }
            if(!empty($_GET) && array_key_exists('url', $_GET) && $isRoutage) {
                $path = new PathServe($_GET["url"]);
                $nbParentCurrentDirectory = substr_count($path->getPath(), '/');
                for ($i=0; $i < $nbParentCurrentDirectory; $i++) { 
                    $this->parentPath .= "../";
                    $this->currentDir .= "../";
                }

                $this->index = $this->createTabIndex($_GET["url"]);
            }
            if(!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if(!array_key_exists($key, $this->index)) {
                        $this->index[$key] = $value;
                    }
                }
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
                $arrayIndex["index".$key] = $value;
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
         * @param string|null $name
         * @return self
         */
        public function addIgnorePath(string|null $name):self {
            array_push($this->tabIgnore, $name);
            return $this;
        }

        /**
         * Undocumented function
         *
         * @return string|null
         */
        public function folderroute():string|null {
            $valueout=$_SERVER['SCRIPT_FILENAME'];
            $endvalue = strrev(explode('/', strrev(str_replace("\\", "/", $valueout)))[0]);
            if(is_file($valueout)) {
                $valueout=str_replace($endvalue, '', $valueout);
            }
            $valueout=rtrim($valueout, "/");
            return $valueout;
        }
        
        /**
         * Undocumented function
         *
         * @param string|null $path
         * @return string|null
         */
        public function path(string|null $path):string|null {
            if(!$this->isRoutage) {
                $pathGetIndex = "./";
                foreach($this->tabIgnore as $value) {
                    try{
                        if(preg_match("/".$value."/", $path)) {
                            $pathGetIndex .= $value."/";
                            $path = str_replace($value."/", "", $path);
                        }
                    } catch (Exception $e) {}
                    
                }
                $path1 = new PathServe($path);
                $explodePath = explode("#", $path1->getPath(), 2);
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
            $path1 = new PathServe($this->parentPath, $path);
            return $path1->getAbsolutePath();
        }
        
        /**
         * Undocumented function
         *
         * @return array|null
         */
        public function tabGetIndPg():array|null {
            return  $this->index;
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

    }

}
