<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_as',
        'mother_name',
        'father_name',
        'address',
        'age',
        'profile_image',
        'metrial_status',
        'highest_qualification',
        'emg_phone_no',
        'workshop',
        'gender',
        'phone_no',
        'whatapps_no',
        'designation_id',
        'basic_salary',
        'bank_name',
        'bank_account_no',
        'ifsc_code',
        'bank_branch_name',
        'pf_no',
        'esi_no',
        'team',
        'department_id',
        'user_type',
        'designation',
        'dob',
        'marital_status',
        'guardian_name',
        'date_of_joining',
    ];

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

    /** user has one designation */

    public function designation() {

        return $this->belongsTo(Designation::class);
    }

    /** user has one payroll class */
    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }

    /** user has one payslip class */
    public function payslip()
    {
        return $this->hasMany(Payslip::class);
    }

    /** use has many employee attandance  */
    public function employee_attendance()
    {
        return $this->hasMany(EmployeeAttendence::class,'staff_id');
    }

    /** use has many leave  application  */
    public function leave_application()
    {
        return $this->hasMany(LeaveApplication::class,'staff_id');
    }
}
