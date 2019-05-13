<?php

namespace TeedShow\Controllers;

class Error extends Base
{
    public function notFound() {
        return 'Essa página não existe!';
    }
}
