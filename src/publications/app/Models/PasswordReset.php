<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MyCustom\Models\BaseModel;

class PasswordReset extends Model
{
    use HasFactory, BaseModel;

    const UPDATED_AT = null;
}
