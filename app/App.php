<?php
class App {
    private $__controller, $__action, $__params, $__routes;
    function __construct() {
        global $routes, $config;

        $this->__routes = $routes;

        $this->__routes = new Route();

        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        
        $this->__action = "index";
        $this->__params = array();

        $this->handleUrl();
    }
    function getUrl() {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    public function handleUrl() {
        $url = $this->getUrl();

        $url = $this->__routes->handleRoute($url);

        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);
        
        // xu ly url dan den file
        $urlCheck = '';
        if (!empty($urlArr)) {
            foreach ($urlArr as $key=>$item) {
                $urlCheck.=$item.'/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);
                
                if (!empty($urlArr[$key -1])) {
                    unset($urlArr[$key -1]);
                }
                
                if (file_exists('app/controller/'.($fileCheck).'.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        } else {
            $urlCheck = $this->__controller;
        }

        // xu ly controller
        if (!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        if (file_exists('app/controller/'.$urlCheck.'.php')) {
            require_once 'controller/'.$urlCheck.'.php';
            
            // Kiem tra class $this->__controller ton tai
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            } else {
                $this->loadError();
            }
            
        } else {
            $this->loadError();
        }

        // xu ly action
        if (!empty($urlArr[1])) {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }
        
        
        // xu ly param
        $this->__params = array_values($urlArr);
        
        // Kiem tra method ton tai
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array(array($this->__controller, $this->__action), $this->__params);
        } else {
            $this->loadError();
        }
        
    }

    public function loadError($name='404') {
        require_once 'errors/'.$name.'.php';
    }
}
?>