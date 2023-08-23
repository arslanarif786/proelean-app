<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    use HasFactory;
    protected $fillable = [
        'Term_&_Conditions',
        'YOUR_AGREEMENT',
        'PRIVACY',
        'LINKED_SITES',
        'FORWARD_LOOKING_STATEMENTS'
    ];
}
