<?php

namespace TeedShow\Controllers;

class Home extends Base
{
    public function index() {
        return $this->view('welcome');
    }
}
