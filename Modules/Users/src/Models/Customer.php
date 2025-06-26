<?php

namespace Modules\Users\Models;

use Parental\HasParent;
use Modules\Users\Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends User
{
    use HasFactory, HasParent;

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }
}
