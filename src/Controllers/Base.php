<?php

namespace TeedShow\Controllers;

class Base
{
    public function run($object) {
        if(\is_string($object)) {
            echo $object;
        }
    }
}
