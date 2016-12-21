<?php

namespace Shawn\Kdniao\Facades;

use Illuminate\Support\Facades\Facade;

class Kdniao extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'kdniao';
    }
}