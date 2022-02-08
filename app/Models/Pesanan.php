<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = "pesanan";
    protected $fillable = ['user_id','receipt_number'];

    public function User(){
        return $this->belongsTo(User::class);
    }


    public function PesananDetail(){
        return $this->hasMany(PesananDetail::class);
    }


}
