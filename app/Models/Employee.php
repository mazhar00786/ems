<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone'      
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'company_id' => 'integer',
        'email' => 'string',
        'phone' => 'string'
    ];



    /**
     * Get the company that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
