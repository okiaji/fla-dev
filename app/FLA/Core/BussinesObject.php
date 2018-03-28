<?php

namespace App\FLA\Core;

interface BussinesObject
{
    function getDescription();
    public function execute($input);
}