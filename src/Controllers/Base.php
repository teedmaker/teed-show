<?php

namespace TeedShow\Controllers;

class Base
{
    public function execute(string $method, array $data=[]) {
        $response = call_user_func_array([$this, $method], $data);
        if(is_string($response)) {
            return $this->renderString($response);
        }
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
