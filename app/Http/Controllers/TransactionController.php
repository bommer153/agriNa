<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\pcategory;
use App\Models\productImage;
use App\Models\cart;
use App\Models\user;
use App\Models\address;
use App\Models\barangay;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order($transaction, Request $request)
    {
        
        $address = address::where('user',auth::user()->id)->count();
        
        //dd($request->address);
        
        if($address == 0){
            return redirect('/profile')->with('addAddress','Add Address to continue');
        }else{
            cart::where('transaction',$transaction)
                ->update([
                    'status'=>'2',                   
                ]);

            transaction::where('transactionNumber',$transaction)
                ->update([
                    'status'=>'2',
                    'address'=> $request->address,
                    'shippingPrice'=> $request->shippingPrice,
                ]);

             return redirect('/dashboard')->with('success','Order Success');
        }
       
    }

    public function myOrder()
    {
        $user = auth::user()->id;
        $orders = transaction::with('cart','cart.productzz','myAddress','myDriver','myAddress.barangayR')->where(['user'=>$user])->where('status','!=','1')->get();     
        
       
        //dd($orders[0]->cart[0]->productzz[0]->name);
        
        return view('userView.myOrders',[
            'orders' => $orders
        ]);
    }

    public function pendingA()
    {
       
        $orders = transaction::with('cart','cart.productzz','users','myAddress','myAddress.barangayR')->where(['status'=>'2'])->get();             
       
        //dd($orders);
        
        return view('transaction.pending',[
            'orders' => $orders
        ]);
    }

    public function preparationA()
    {
       
        $orders = transaction::with('cart','cart.productzz','users')->where(['status'=>'3'])->get();             
        $driver = user::where('license','!=','0')->where('role','3')->get();
        //dd($driver);
        
        return view('transaction.preparation',[
            'orders' => $orders,
            'driver' => $driver
        ]);
    }

    public function shippingA()
    {
       
        $orders = transaction::with('cart','cart.productzz','users','myDriver','myAddress.barangayR')->where(['status'=>'4'])->get();             
       
        //dd($driver);
        
        return view('transaction.shipping',[
            'orders' => $orders  
        ]);
    }

    public function finishA()
    {
       
        $orders = transaction::with('cart','cart.productzz','users','myDriver','myAddress.barangayR')->where(['status'=>'5'])->get();             
       
        //dd($driver);
        
        return view('transaction.finish',[
            'orders' => $orders  
        ]);
    }

   

    
    public function acceptA($transaction)
    {
       
        cart::where('transaction',$transaction)
        ->update([
            'status'=>'3'
        ]);

        transaction::where('transactionNumber',$transaction)
            ->update([
                'status'=>'3'
            ]);

        return redirect('/admin/orders')->with('success','Order for Preparation');
    }

    public function endorseA($transaction, Request $request)
    {
       
        cart::where('transaction',$transaction)
        ->update([
            'status'=>'4'
        ]);

        transaction::where('transactionNumber',$transaction)
            ->update([
                'status'=>'4',
                'driver'=> $request->driver
            ]);

        return redirect('/admin/orders')->with('success','Order for Preparation');
    }

    //driver Function
    public function pendingD()
    {
        $user = auth::user()->id;
        $orders = transaction::with('cart','cart.productzz','users')->where(['status'=>'4','driver'=>$user])->get();             
       
        //dd($driver);
        
        return view('driver.pending',[
            'orders' => $orders  
        ]);
    }

    public function finishListD()
    {
        $user = auth::user()->id;
        $orders = transaction::with('cart','cart.productzz','users')->where(['status'=>'5','driver'=>$user])->paginate(10);             
       
        //dd($driver);
        
        return view('driver.finish',[
            'orders' => $orders  
        ]);
    }

    
    public function finishD($transaction, Request $request)
    {
       
        cart::where('transaction',$transaction)
        ->update([
            'status'=>'5'
        ]);

        transaction::where('transactionNumber',$transaction)
            ->update([
                'status'=>'5',                
            ]);

        return redirect()->back()->with('finish', 'Transaction Finish');
    }

    public function cancelOrder($transaction)
    {
       
        cart::where('transaction',$transaction)
        ->update([
            'status'=>'1'
        ]);

        transaction::where('transactionNumber',$transaction)
            ->update([
                'status'=>'1',                
            ]);

        return redirect()->back()->with('warning', 'Transaction Canceled');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction $transaction)
    {
        //
    }
}
