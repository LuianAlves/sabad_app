<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Business\User\EmployeeUser;
use App\Models\Business\Task\Task;
use App\Models\Business\Chip\ChipControl\ChipControl;

use App\Contracts\Auditable;
use App\Models\Business\Tickets\Ticket;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasRoles;

    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    public function getDisplayName(): string
    {
        return $this->name ?? "Usuário #{$this->id}";
    }

    public function canAuthenticate()
    {
        if ($this->hasRole('admin')) {
            return true;
        }

        // if (!$this->is_active) {
        //     session()->flash('error', 'Sua conta não está ativa.');
        //     return false;
        // }

        return true;
    }

    public function employeeUser()
    {
        return $this->hasOne(EmployeeUser::class, 'user_id');
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function chipControl()
    {
        return $this->hasOne(ChipControl::class, 'employee_id', 'id');
    }


}
