<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Service\Entities\Service;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function service()
    {
        return $this->hasOne(Service::class);
    }
}
