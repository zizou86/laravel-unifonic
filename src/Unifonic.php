<?php

namespace Zizou86\Unifonic;

use Illuminate\Support\Facades\Facade;


class Unifonic extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'unifonic';
    }

}