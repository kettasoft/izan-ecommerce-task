<?php

namespace Modules\Users\Models;

use Parental\HasParent;
use Modules\Users\Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory, HasParent;

    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }
}
