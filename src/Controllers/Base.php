<?php

namespace TeedShow\Controllers;

class Base
{
    public function execute(string $method, array $data=[]) {
        $response = call_user_func_array([$this, $method], $data);
        var_dump($response);
    }
}
