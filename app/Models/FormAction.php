<?php

namespace App\Models;

use App\Models\Form;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormAction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

}
