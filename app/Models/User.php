<?php

/*
* Author: Delvin
*/

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * USER ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key (id)
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email
     * $this->attributes['email_verified_at'] - timestamp - contains the user email verification date
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['remember_token'] - string - contains the user password
     * $this->attributes['is_admin'] - bool - contains if the user is an admin or not
     * $this->attributes['created_at'] - timestamp - contains the user creation date
     * $this->attributes['updated_at'] - timestamp - contains the user update date
     * RELATIONSHIPS
     * $this->orders - Order[] - contains the user's associated product orders
     * $this->comments - Comment[] - contains the user's associated comments
     **/

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

    /*
     * GETTERS
    */

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function getIsAdmin(): bool
    {
        return $this->attributes['is_admin'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    /*
     * SETTERS
    */

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function setIsAdmin(bool $adminStatus): void
    {
        $this->attributes['is_admin'] = $adminStatus;
    }

    public function setOrders(Collection $orders): void
    {
        $this->orders = $orders;
    }

    public function setComments(Collection $comments): void
    {
        $this->comments = $comments;
    }

    /*
     * RELATIONSHIPS
    */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
