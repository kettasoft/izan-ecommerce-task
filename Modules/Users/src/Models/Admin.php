<?php

namespace Modules\Users\Models;

use Parental\HasParent;
use Modules\Users\Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory, HasParent;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }
}
