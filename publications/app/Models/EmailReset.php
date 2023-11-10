<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MyCustom\Models\BaseModel;

final class EmailReset extends Model
{
    use HasFactory, BaseModel, SoftDeletes;

    const UPDATED_AT = null;
}
