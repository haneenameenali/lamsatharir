<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
     public function index(){
     $cart=session()->get('cart',[]);
return view('cart',compact('cart'));
     }
    public function add($id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    // إذا المنتج موجود مسبقاً نزود الكمية، إذا مش موجود نضيفه
    if (isset($cart[$id])) {

        $cart[$id]['quantity']++;

    } else {

        $cart[$id] = [
            "name"     => $product->name,
            "quantity" => 1,
            "price"    => $product->price,
            "image"    => $product->image
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'تم إضافة المنتج للسلة بنجاح!');
}
public function remove($id){
    $cart=session()->get('cart');
    if(isset($cart[$id])){
        unset($cart[$id]);
        session()->put('cart',$cart);
    }
return redirect()->back()->with('success', ' تم إزالة المنتج من السلة ');
}
}
