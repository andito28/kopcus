<?php

namespace App\Http\Controllers\cust;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Keranjang;
use App\Models\Event;
use App\Models\Users;
use App\Models\User_menu;
use Auth;

class KeranjangController extends Controller
{

    public function index(){
        $data['user'] = AUTH::user();
        $data['title'] = 'Keranjang';
        $data['menu'] = User_menu::all();
        $data['users'] = Users::all();
        $data['menus'] = Menu::all();
        $data['keranjang'] = Keranjang::where('user_id',Auth::user()->id)->get();
        return view('cust.keranjang.index',$data);
    }

    public function store(request $request){

        $duplicate = Keranjang::where('user_id',Auth::user()->id)->where('menu_id',$request->menu_id)->first();

        if($duplicate)
        {
            return redirect('/keranjang')->with('delete','Menu sudah ada dalam keranjang');
        }

       $request->validate([
           'menu_id' => 'required',
           'qty' => 'required'
       ]);

       $keranjang = new Keranjang();
       $keranjang->user_id = Auth::user()->id;
       $keranjang->menu_id = $request->menu_id;
       $keranjang->qty = $request->qty;
       $keranjang->save();
       return redirect()->route('keranjang');
}

    public function destroy($id){

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect('/keranjang')->with('warning','Menu berhasil dihapus ');
    }

    public function update(request $request){

        Keranjang::where('id',$request->id)->update([
            'user_id' => Auth::user()->id,
            'menu_id' => $request->product_id,
            'qty' => $request->quantity
        ]);

        $keranjang = Keranjang::with('Menu')->where('id',$request->id)->first();
        return response()->json($keranjang);
    }
}
