<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Product;
use App\Models\OrderStatus;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\Converter;
use App\Models\AddToCart;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateOrderReqeust;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!check('Order')->show) {
            return back();
        }

        $orders = Order::with(['shipping'])->where('status', 'active')->get();
        return view('backend.pages.order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $rule = [
        //     'name'=>'string|required',
        //     'shipping_id'=>'required',
        //     'quantity'=>'required',
        //     'address'=>'string|required',
        //     'phone'=>'numeric|required',
        // ];
        // $msg = [];
        // $attributes = [
        //     'name'=>'First Name',
        //     'address'=>'Address',
        //     'phone'=>'Phone Number',
        //     'post_code'=>'string|nullable',
        //     'shipping_id'=>'Shipping Method'
        // ];
        // Validator::make($request->all(),$rule,$msg,$attributes);
        $comany_contact = companyContact();
        $order = Order::where('phone',$request->phone)->first();
        if($order){
            return redirect()->back()->with('success', $order->phone);
        }
        $order_number = 'ORD-' . strtoupper(Str::random(10));
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $cart_check = AddToCart::where('user_id', $user_id)->first();
            if ($cart_check) {
                AddToCart::where('user_id', $user_id)->delete();
            }
        } else {
            $check = User::where('phone', $request->phone)->first();
            if ($check) {
                $user_id = $check->id;
                $cart_check = AddToCart::where('user_id', $user_id)->first();
                if ($cart_check) {
                    AddToCart::where('user_id', $user_id)->delete();
                }
            } else {
                $cart_check = AddToCart::where('ip_address', $request->ip())->first();
                if ($cart_check) {
                    AddToCart::where('ip_address', $request->ip())->delete();
                }

                $user_create = new User();
                $user_create->name = $request->name;
                $user_create->phone = $request->phone;
                // $user_create->email = $request->email;
                $user_create->address = $request->address;
                $user_create->password = Hash::make($request->phone);
                $user_create->save();
                $user_id = $user_create->id;
            }
        }
        $product = DB::table('products')->where('slug', $request->slug)->first();
        $shipping = Shipping::find($request->shipping_id);
         // Get the last invoice number
         $lastInvoice = Order::max('invoice_id');

        $lastInvoice = $lastInvoice >= 1000 ?   $lastInvoice : 999;
        $newInvoiceId = str_pad((int)$lastInvoice + 1, 4, '0', STR_PAD_LEFT);

        $insert = new Order();
        $insert->invoice_id = $newInvoiceId;
        $insert->order_number = $order_number;
        $insert->user_id = $user_id;
        $insert->shipping_id = $request->shipping_id;
        $insert->payment_id = 1;
        $insert->ip_address = $request->ip();
        $insert->name = $request->name;
        $insert->phone = $request->phone;
        // $insert->email = $request->email;
        $insert->address = $request->address;
        $insert->note = $request->note;
        $insert->subtotal = $product->price - $product->discount;
        $insert->total = ($insert->subtotal * $request->qty) + ($shipping ? $shipping->price : 0);
        $insert->payment_number = $request->payment_number;
        $insert->transection = $request->transection;
        $insert->country = $request->country;
        $insert->district = $request->district;
        $insert->thana = $request->thana;

        // Status Status

        $order_statuses = OrderStatus::first();
        if ($order_statuses != null) {
            $insert->order_status = $order_statuses->name;
        } else {
            $insert->order_status = 'New';
        }


        $insert->status = 'active';
        $insert->save();

        // foreach ($request->order_item as $key => $order) {
        // dd($order);
        $order_item = new OrderItem();
        $order_item->order_id = $insert->id;
        $order_item->product_id = $product->id;

        // if (isset($order['p_color_id'])) {
        //     $order_item->p_color_id = $order['p_color_id'];
        // }

        $order_item->qty = $request->qty;
        $order_item->price = $insert->total;
        $order_item->save();
        // }
        try{

            //Mail send to admin
            Mail::to($comany_contact->email)->send(new OrderMail($insert));

            //Mail send to user
            // Mail::to($request->email)->send(new OrderMail($insert));

        }catch(\Exception $e){
            log::error($e->getMessage());
        }

        return redirect()->route('order.thanks', $insert->order_number);


    }

    public function view($id)
    {
        $n['order'] = Order::with(['shipping', 'orderItem', 'payment', 'orderItem.product', 'orderItem.color', 'orderItem.color.color', 'orderItem.size', 'orderItem.size.size'])->find($id);
        return view('backend.pages.order.order-view', $n);
    }

    public function sendToCourier($id)
    {
        $order = Order::find($id);
        $sent = $order->sendToCourier();

        if(isset($sent['success'])){
            if($sent['success']['status'] === 200){
                return redirect()->route('order.index')->with('success', 'Order sent to courier successfully');
            }
            if($sent['success']['status'] === 400){
                return back()->withErrors($sent['success']['errors']);
            }
        }

        if(isset($sent['error'])){
            return back()->with('error', $sent['error']);
        }
    }
    
     public function sendToPathao($id)
    {
        $order = Order::find($id);
       // call pathao api 

        return redirect()->route('order.index')->with('success', 'Order sent to Pathao successfully');

//            return back()->with('error', $sent['error']);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        // return $order;
        return view('backend.order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $n['order'] = Order::find($id);
        $n['order_statuses'] = OrderStatus::where('status','active')->get();

        return view('backend.pages.order.edit',$n);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderReqeust $request, $id)
    {
        $order = Order::find($id);

        $data = $request->validated();

        // return $request->status;
        if ($request->order_status == 'delivered') {
            foreach ($order->cart as $cart) {
                $product = $cart->product;
                // return $product;
                $product->stock -= $cart->quantity;
                $product->save();
            }
        }
        $status = $order->update($data);
        if ($status) {
            request()->session()->flash('success', 'Successfully updated order');
        } else {
            request()->session()->flash('error', 'Error while updating order');
        }
        return redirect()->route('order.index')->with('success', 'Successfully updated order');
    }

    // trash function
    public function trash()
    {
        $orders = Order::with(['shipping'])->orderBy('id', 'DESC')->where('status', 'inactive')->get();
        return view('backend.pages.order.trash')->with('orders', $orders);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!check('Order')->delete) {
            return back();
        }

        $order = Order::find($id);
        $order->status = 'inactive';
        if ($order) {
            $status = $order->save();
            if ($status) {
                request()->session()->flash('success', 'Ordered item successfully moved to trash');
            } else {
                request()->session()->flash('error', 'Order item can not moved to trash');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Order item can not found');
            return redirect()->back();
        }
    }

    //Restore function
    public function restore($id)
    {
        $order = Order::find($id);
        $order->status = 'active';
        if ($order) {
            $status = $order->save();
            if ($status) {
                request()->session()->flash('success', 'Ordered item successfully restored');
            } else {
                request()->session()->flash('error', 'Order item can not restored');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Order item can not found');
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        if (!check('Order')->delete) {
            return back();
        }

        $order = Order::find($id);
        $order->status = Auth::user()->id;
        if ($order) {
            $status = $order->save();
            if ($status) {
                request()->session()->flash('success', 'Trash item Successfully deleted');
            } else {
                request()->session()->flash('error', 'Trash item can not deleted');
            }
            return redirect()->back();
        } else {
            request()->session()->flash('error', 'Order can not found');
            return redirect()->back();
        }
    }

    public function orderTrack()
    {
        return view('frontend.pages.order-track');
    }

    public function productTrackOrder(Request $request)
    {
        // return $request->all();
        $order = Order::where('user_id', auth()->user()->id)->where('order_number', $request->order_number)->first();
        if ($order) {
            if ($order->status == "new") {
                request()->session()->flash('success', 'Your order has been placed. please wait.');
                return redirect()->route('home');

            } elseif ($order->status == "process") {
                request()->session()->flash('success', 'Your order is under processing please wait.');
                return redirect()->route('home');

            } elseif ($order->status == "delivered") {
                request()->session()->flash('success', 'Your order is successfully delivered.');
                return redirect()->route('home');

            } else {
                request()->session()->flash('error', 'Your order canceled. please try again');
                return redirect()->route('home');

            }
        } else {
            request()->session()->flash('error', 'Invalid order numer please try again');
            return back();
        }
    }

    // PDF generate
    public function pdf(Request $request)
    {
        $order = Order::getAllOrder($request->id);
        // return $order;
        $file_name = $order->order_number . '-' . $order->first_name . '.pdf';
        // return $file_name;
        // $pdf=PDF::loadview('backend.order.pdf',compact('order'));
        // return $pdf->download($file_name);
    }
    // Income chart
    public function incomeChart(Request $request)
    {
        $year = \Carbon\Carbon::now()->year;
        // dd($year);
        $items = Order::with(['cart_info'])->whereYear('created_at', $year)->where('status', 'delivered')->get()
            ->groupBy(function ($d) {
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
        // dd($items);
        $result = [];
        foreach ($items as $month => $item_collections) {
            foreach ($item_collections as $item) {
                $amount = $item->cart_info->sum('amount');
                // dd($amount);
                $m = intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
            }
        }
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = (!empty($result[$i])) ? number_format((float) ($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }

    public function checkout(Request $request, $slug = null)
    {
        // dd($request->all());

        $n['payments'] = DB::table('payments')->get();
        $n['color'] = DB::table('product_colors')->where('id', $request->color_id)->first();
        $n['qty'] = $request->qty;

        if ($slug) {
            $n['product'] = Product::with('productShipping', 'productShipping.shipping')->where('slug', $slug)->first();
            $n['shippings'] = DB::table('product_shippings')->where('product_id', $n['product']->id)->get();
        } else {

            if (serviceCheck('Database Add To Cart')) {
                $user_ip = $_SERVER['REMOTE_ADDR'];
                $n['cart_products'] = AddToCart::with('product', 'product.productShipping', 'product.productShipping.shipping')->where('ip_address', $user_ip)->orderBy('id', 'desc')->get();
                if (Auth::user()) {
                    $n['cart_products'] = AddToCart::with('product', 'product.productShipping', 'product.productShipping.shipping')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
                }

            }
        }


        return view('frontend.pages.checkout', $n);
    }

    public function thanks($order_num)
    {
        $n['order'] = Order::with(['orderItem', 'shipping', 'payment', 'user', 'products', 'orderItem.product'])
            ->withSum('orderItem as pqty', 'qty')
            ->withSum('products as pp', 'price')
            ->withSum('products as pd', 'discount')
            ->where('order_number', $order_num)->first();
        // dd($n);
        return view('frontend.pages.thanks', $n);
    }

    public function checkStatus(Order $order)
    {
        $steadFastCourier = steadFastCourier();
        $newStatus = $steadFastCourier->updateOrderStatus($order);

        return response()->json([
            'newStatus' => $newStatus
        ]);
    }

}
