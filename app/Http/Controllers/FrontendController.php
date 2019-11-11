<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Contact;
use Mail;
use App\Mail\ContactMessage;
use App\Cart;
use Carbon\Carbon;

class FrontendController extends Controller
{
    function index()
    {
    	$products = Product::all();
        $categories = Category::all();
    	return view('welcome', compact('products', 'categories'));
    }

    function contact() {
        return view('frontend/contact');
    }

    function contactinsert(Request $request)
    {
        /*
        Contact::insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        */
        Contact::insert($request->except('_token'));
        //send mail
        $first_name = $request->first_name;
        $message = $request->message;
        Mail::to('muntasermuttaqi@gmail.com')->send(new ContactMessage($first_name, $message));
        // return redirect('frontend/contact');
        // return back()->with('contactstatus', 'Message Sent!');
    }

    function productdetails($product_id)
    {
    	$single_product_info = Product::find($product_id);
    	$related_products = Product::where('id', '!=', $product_id)->where('category_id', $single_product_info->category_id)->get();
    	return view('frontend/productdetails', compact('single_product_info', 'related_products'));
    }

    function categorywiseproduct($category_id)
    {
        $products = Product::where('category_id', $category_id)->get();
        return view('frontend/category', compact('products'));
    }

    function addtocart($product_id)
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if (Cart::where('customer_ip', $ip_address)->where('product_id', $product_id)->exists()) {
            Cart::where('customer_ip', $ip_address)->where('product_id', $product_id)->increment('product_quantity');
        }

        else {
            Cart::insert([
                'customer_ip' => $ip_address,
                'product_id' => $product_id,
                'created_at' => Carbon::now(),
            ]);
        }
        
        return back();
    }

    function cart()
    {
        $cart_items = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
        return view('frontend/cart', compact('cart_items'));
    }

    function deletefromcart($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back()->with('deletefromcartstatus', 'Product Removed From Cart');
    }

    function clearcart()
    {
        Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->delete();
        return back();
    }
}
