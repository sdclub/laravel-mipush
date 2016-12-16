<?php
namespace Sdclub\MiPush\Facades;

use Illuminate\Support\Facades\Facade;

class MiPush extends Facade {
    protected static function getFacadeAccessor() {
        return 'mipush';
    }
}