<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    // protected $dates = ['date'];
    protected $fillable = ['title', 'date', 'by_employee_or_office', 'details', 'attachment' , 'bank_id' , 'transaction_id'];

}
