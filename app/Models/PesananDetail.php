<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $table = 'pesanan_detail';
    protected $fillable = ['pesanan_id','menu_id','qty'];

    public function User(){
        return $this->belongsTo(User::class);
    }


    public function Pesanan(){
        return $this->belongsTo(Pesanan::class);
    }

    public function Menu(){
        return $this->belongsTo(Menu::class);
    }
}
