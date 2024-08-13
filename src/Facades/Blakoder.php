<?php

namespace Blakoder\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Blakoder\Core\Blakoder
 */
class Blakoder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Blakoder\Core\Blakoder::class;
    }
}
