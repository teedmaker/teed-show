<?php

namespace TeedShow\Controllers;

class Base
{
    private $path = null;
    private $data = [];

    public function execute(string $method, array $data=[]) {
        $response = call_user_func_array([$this, $method], $data);
        if(is_string($response)) {
            return $this->renderString($response);
        }
        if($this->path === null) {
            throw new Exception( "An error has occurred with this url!", 1);
        }
        ob_start();
        extract($this->data);
        include $this->path;
        $content = ob_get_clean();
        $this->renderView($content);
    }

    public function view(string $path) {
        $path = str_replace('.', '/', $path);
        $this->path = __DIR__ . "/../views/{$path}.php";
        return $this;
    }

    public function with(string $title, $value) {
        $this->data[$title] = $value;
        return $this;
    }

    private function renderView(string $content) {
        extract($this->data);
        if(isset($this->template) && $this->template===false){
            echo $content;
            exit;
        }
        $template = isset($this->template) && file_exists(__DIR__."/../template/{$this->template}.php")? $this->template: 'default';
        $template = __DIR__ . "/../templates/{$template}.php";
        include $template;
    }

    private function renderString(string $response) {
        $result = json_decode($response);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $this->renderJson($response);
        }
        echo $response;
        exit;
    }

    public function renderJson(string $response) {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
