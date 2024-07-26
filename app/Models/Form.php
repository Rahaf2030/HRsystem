<?php

namespace App\Models;

use App\Models\FormAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function actions()
    {
        return $this->hasMany(FormAction::class);
    }

}
