<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

    public function section()
    {
        return $this->hasOneThrough(Section::class, Grade::class);
    }

    public function subjects()
    {
        return $this->hasManyThrough(Subject::class, Grade::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function name(): Attribute{
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );
    }

    public function lastname(): Attribute{
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );
    }

    public function email(): Attribute{
        return new Attribute(
            set: fn($value) => strtolower($value)
        );
    }

    public function username(): Attribute{
        return new Attribute(
            set: fn($value) => strtolower($value)
        );
    }

    public function role(): Attribute{
        return new Attribute(
            set: fn($value) => strtolower($value)
        );
    }

    // public function password(): Attribute{
    //     return new Attribute(
    //         get: fn($value) => bcrypt($value),
    //         set: fn($value) => bcrypt($value)
    //     );
    // }
}
