<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'vendor/autoload.php';
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();
        $folder = '';

        //controllers
        if (isset($url[0])) {
            if ($url[0] == 'a' && isset($url[1])) {
                $folder = 'admin/';
                array_shift($url);
            } else if ($url[0] == 'c' && isset($url[1])) {
                $folder = 'canteen/';
                array_shift($url);
            }

            if (file_exists('app/controllers/' . $folder . ucfirst($url[0]) . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        require_once 'app/controllers/' . $folder . ucfirst($this->controller) . '.php';
        $this->controller = new $this->controller();

        //method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        //menjalankan controller dan method, dan kirim params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}