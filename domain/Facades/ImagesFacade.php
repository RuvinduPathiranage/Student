<?php

namespace domain\Facades;

use domain\Services\ImagesService;
use Illuminate\Support\Facades\Facade;

class ImagesFacade extends Facade
{
/**
 * 
 * @return string
 */

    protected static function getFacadeAccessor()
    {
        return ImagesService::class;
    }
}
