<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = ['user_id','menu_id','qty'];

    public function Menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
