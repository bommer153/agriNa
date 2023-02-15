<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\pcategory;
use App\Models\productImage;
use App\Models\cart;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = products::select('*','products.id as pID',)->get();
       

        return view('product.view',['product'=> $product]);
    }

    public function indexU()
    {
        $product = products::select('*','products.id as pID',)->get();
       
     
        return view('userView.product',['product'=> $product]);
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
        products::insert([
            'name' => $request->name,
            'description' => $request->description,         
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);
        return redirect('admin/product')->with('sucess','product added');
    }

    public function addImage(Request $request,$id)
    {
        $image = $request->file('image');

        foreach ($image as $image) {
            $random = rand(1000000,999999999);
            $extension = $image->extension();
            $name = $random.".".$extension;
            $image->storeAs('public/productImage', $name);

            productImage::insert(['image'=>$name,'product'=>$id]);
            
        }
        return redirect('admin/product/'.$id)->with('success','image added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = products::select('*','products.id as pID')           
            ->where('products.id','=',$id)           
            ->get(); 
         //dd($product[0]->productImage);
        $image = productImage::where('product',$id)->get();
     
        
        return view('product.show',['product'=> $product,'image'=>$image]);
    }

    public function showU($id)
    {
        
        $product = products::select('*','products.id as pID')            
            ->where('products.id','=',$id)           
            ->get();       
         //dd($product[0]->productImage);
        $image = productImage::where('product',$id)->get();
        $category = pcategory::all();
     
        return view('userView.productView',['product'=> $product,'image'=>$image]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
   

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        products::where('id',$id)->
        update([
            'name' => $request->name,
            'description' => $request->description,           
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        return redirect('admin/product/'.$id)->with('scucess','product updated');
    }

    public function setThumbnail($image,$id)
    {    
        $images = productImage::findOrFail($image);

        products::where('id',$id)
        ->update([
            'thumbnail' => $images->image              
        ]);

        return redirect('admin/product/')->with('scucess','thumbnail updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }

    public function addToCart($id,Request $request){
        if($request->ajax()){
            $user = auth::user()->id;
            $newStock = $request->stock - $request->quantity;
            $transac = transaction::where(['user'=>$user,'status'=>'1']);
           
            
            if($transac->count() == 0){
                $transacNumber = mt_rand(1000000000,9999999999);
                
                transaction::insert([
                    'transactionNumber'=>$transacNumber,
                    'user'=>$user,
                    'status'=>'1',
                    
                ]);
                
            }else{
                $tr = $transac->get();
                $transacNumber = $tr[0]->transactionNumber;
            }
            
            $getCart = cart::where(['product'=>$id,'transaction'=>$transacNumber]);
            
            if($getCart->count() == 0){
                cart::insert([
                    'user'=>$user,
                    'product'=>$id,
                    'quantity'=>$request->quantity,
                    'status'=>'1',
                    'transaction'=>$transacNumber,
                    'unitPrice'=> products::find($id)->price,
                ]);
            }else{
                $getC = $getCart->get();                
                $quantity = $getC[0]->quantity;

                $getCart->update([
                    'quantity' => $quantity + $request->quantity
                ]);
            }
            
            products::where('id',$id)
            ->update([
                'quantity' => $newStock
            ]);
           
            return response()->json(['success'=>'goods','stock'=>$newStock]);
          
        }
    }

    static function cartCount(){
        
        $user = auth::user()->id;  
        return cart::where(['user'=>$user,'status'=>'1'])->count();
    }

    static function cartDetails(){
        
        $user = auth::user()->id;  
        return cart::select('*','products.id as pID','carts.quantity as totalq')
            ->join('products','products.id','=','carts.product')
            ->where(['user'=>$user,'status'=>'1'])->get();
       
    }

    public function myCart(){
        
        $user = auth::user()->id; 
        $transaction = transaction::where(['user'=>$user,'status'=>'1'])->first(); 
        $cart =  cart::select('*','products.id as pID','carts.quantity as totalq','carts.id as cartID')
            ->join('products','products.id','=','carts.product')
            ->where(['user'=>$user,'status'=>'1'])->get();

        
        return view('userView.cart',['cart'=> $cart,'transaction'=>$transaction]);
        
    }

    public function quantityUpdate($id,Request $request){

        if($request->ajax()){
            
            cart::where('id',$id)
            ->update([
                'quantity' => $request->quantity
            ]);

            products::where('id',$request->product)
            ->update([
                'quantity' => $request->newStock
            ]);
            
            
            return response()->json(['newstock'=>$request->product]);
          
        }
    }

    public function order(){
        
        $user = auth::user()->id;  
        $cart =  cart::select('*','products.id as pID','carts.quantity as totalq','carts.id as cartID')
            ->join('products','products.id','=','carts.product')
            ->where(['user'=>$user,'status'=>'1'])->get();
            return view('userView.cart',['cart'=> $cart]);
    }

}

