<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function saveOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'phone' => 'required|max:10',
            'postcode' => 'required|max:10',
            'adress' => 'required|max:512',
            'note' => 'required|max:512',
            'email' => 'required|max:255'
        ]);
        $order = Order::create([
            // 'first_name' => $request->first_name,
            // 'last_name' => $request->last_name,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'postcode' => $request->postcode,
            'adress' => $request->adress,
            'note' => '',
            // 'email' => $request->email,
            'status' => Order::STATUS_PENDING,
            'total' => 0,
            'user_id' => Auth::user()->id
        ]);

        $cart = session()->get('cart') ?? [];
        $total = 0;
        foreach ($cart as $item) {
            $totalRow = $item['qty'] * $item['price'];
            OrderProduct::create([
                'name' => $item['name'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'total' => $totalRow,
                'order_id' => $order->id
            ]);
            $total += $totalRow;
        }
        $order->total = $total;
        $order->save();

        //session()->flush();
        session()->forget('cart');

        //send mail to customer


        //send mail to admin
        $data = [
            'content' => 'You have 1 new order',
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'order_total' => $order->total,
            'order_product' => $order->products->toArray()

        ];

        Mail::to("happyboyhn92@gmail.com")->send(new OrderMail($data));
        return redirect()->route('home')->with('checkout', 'success');
    }
    public function getOrder()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order.list')->with('datas', $orders);
    }
}
