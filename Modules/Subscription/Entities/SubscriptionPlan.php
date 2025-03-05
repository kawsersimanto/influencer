<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = ['features'];
    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionPlanFactory::new();
    }
}
