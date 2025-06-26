<?php

namespace Modules\Users\Models;

use Parental\HasChildren;
use Illuminate\Notifications\Notifiable;
use Modules\Users\Transformers\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasChildren, HasApiTokens;

    /**
     * The code of admin type.
     *
     * @var string
     */
    public const ADMIN_TYPE = 'admin';

    /**
     * The code of customer type.
     *
     * @var string
     */
    public const CUSTOMER_TYPE = 'customer';

    /**
     * @var array
     */
    protected array $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::CUSTOMER_TYPE => Customer::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the resource representation of the user.
     *
     * @return JsonResource
     */
    public function getResource(): JsonResource
    {
        return new UserResource($this);
    }
}
