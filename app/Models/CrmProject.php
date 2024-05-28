<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\ProjectsFactory;

class CrmProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'segment',
        'period_year',
        'customer_id',
        'customer_name',
        'user_rep_id',
        'project_name',
        'branch',
        'labor',
        'labor_margin',
        'sales',
        'sales_margin',
        'other',
        'other_margin',
        'gross_revenue',
        'expected_revenue',
        'net_revenue',
    ];

    public function userRep()
    {
        return $this->belongsTo(User::class, 'user_rep_id');
    }

    protected static function newFactory(): Factory
    {
        return ProjectsFactory::new();
    }
}
