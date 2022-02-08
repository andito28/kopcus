<?php

namespace App\Http\Controllers\cust;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Keranjang;
use App\Models\Users;
use App\Models\User_menu;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index(){
        $data['user'] = AUTH::user();
        $data['title'] = 'Pesanan';
        $data['menu'] = User_menu::all();
        $data['users'] = Users::all();
        $data['menus'] = Menu::all();
        $data['keranjang'] = Keranjang::where('user_id',Auth::user()->id)->get();
        return view('cust.pesanan.index', $data);
    }


    public function orderList(){
        $title = 'List Pesanan';
        $user = AUTH::user();
        $users = Users::all();
        $menu = User_menu::all();
        $menus =  Menu::all();

        $orders = Pesanan::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->simplePaginate(10);

        return view('cust.pesanan.order_list',compact('orders','title','user','users','menu','menus'));

    }

    public function store(){

        $carts = Keranjang::where('user_id',Auth::user()->id);

        $cart_user = $carts->get();

        $receipt_number = "REC/".date('Ymd')."/".substr(sha1(time()), 0, 20);

        $order = new Pesanan;
        $order->user_id = Auth::user()->id;
        $order->receipt_number = $receipt_number;
        $order->save();

        // $total = 0;

        foreach($cart_user as $cart){
            $order_detail = new PesananDetail;
            $order_detail->pesanan_id = $order->id;
            $order_detail->menu_id = $cart->menu_id;
            $order_detail->qty = $cart->qty;
            $order_detail->save();
        }

        $carts->delete();

        return redirect()->route('detailOrder',['id' => $order->id])->with('success','Berhasil melakukan pemesanan');
    }



    public function detail($id){
        $title = 'List Pesanan';
        $user = AUTH::user();
        $users = Users::all();
        $menu = User_menu::all();
        $menus =  Menu::all();

        $order = Pesanan::where('id',$id)->first();
        $detailOrder = PesananDetail::where('pesanan_id',$id)->get();
        return view('cust.pesanan.order_detail',compact('detailOrder','order','title','user','users','menu','menus'));
    }
}
