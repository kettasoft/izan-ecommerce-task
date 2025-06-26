<?php

namespace App\Http\Controllers;

use App\Traits\Responsable;

abstract class Controller extends \Illuminate\Routing\Controller
{
    use Responsable;
}
