<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\pcategory;
use App\Models\productImage;
use App\Models\cart;
use App\Models\barangay;
use App\Models\address;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    $a=array();
        for($i = 1; $i <= 12; $i++){
            $sale = cart::with('productzz')->whereMonth("updated_at",$i)->where('status','5')->get();
            $totalSale = 0;    
                foreach($sale as $ss){
                    $salsal = $ss->quantity * $ss->unitPrice;
                    $totalSale = $totalSale + $salsal;
                }
            array_push($a,$totalSale);
        }

    $bestSeller = array();
        $unitPrice = cart::with('productzz')->groupBy('product')->where('status',5)->selectRaw('sum(quantity) as sum, product')->orderBy('sum','desc')->get();
            foreach($unitPrice as $product){

                array_push($bestSeller,array($product->sum,$product->productzz[0]->name));
            }  
    $bestBarangay = array();
    $brgyName = array();
         $barangay = barangay::all();
            foreach($barangay as $brgy){
                $getData = address::
                      join('transactions','transactions.address','=','addresses.id')
                    ->join('carts','carts.transaction','=','transactions.transactionNumber')
                    ->where('addresses.barangay',$brgy->id)->where('transactions.status',5)->get();
                $totalSaleBrgy = 0;
                    foreach ($getData as $ggData){
                        $totalSale = $ggData->quantity * $ggData->unitPrice; 
                        $totalSaleBrgy = $totalSaleBrgy + $totalSale;
                    }

                array_push($bestBarangay, $totalSaleBrgy);
                array_push($brgyName, $brgy->barangay);
            }
    $bestDriverA = array();
    $bestDriverLabel = array();
            $bestDriver = transaction::with("myDriver")->groupBy('driver')->where('status',5)->selectRaw('count(driver) as total,driver')->orderBy('total','desc')->get();
           
                foreach($bestDriver as $bestDriver){
    
                    array_push($bestDriverA,$bestDriver->total);
                    array_push($bestDriverLabel,$bestDriver->myDriver->name);
                }  
        //dd($bestDriverLabel);
        return view('home',[
            'sale' => $a,
            'bestSeller' => $bestSeller,
            'bestBarangay' => $bestBarangay,
            'brgyName' => $brgyName,
            'bestDriverA' => $bestDriverA,
            'bestDriverLabel' => $bestDriverLabel,
        ]);
    }

    public function verify(){
        return view('userView.verification');
    }
    public function dashboardU()
    {
        $user = auth::user()->id;
        $order = transaction::where(['user'=>$user,'status'=>'2'])->count();
        $preparation = transaction::where(['user'=>$user,'status'=>'3'])->count();
        $shipping = transaction::where(['user'=>$user,'status'=>'4'])->count();
        $finish = transaction::where(['user'=>$user,'status'=>'5'])->count();
        return view('userView.dashboard',
            [
                'order' => $order,
                'preparation' => $preparation,
                'shipping' => $shipping,
                'finish' => $finish,
            ]
        );
    }

    public function dashboardD()
    {
        $user = auth::user()->id;
        $pending = transaction::where(['driver'=>$user,'status'=>'4'])->count();
        $finish = transaction::where(['driver'=>$user,'status'=>'5'])->count();
        
        return view('driver.dashboard',
            [
                'pending' => $pending,
                'finish' => $finish,
            ]
        );
    }

    public function verification()
    {        
        return view('driver.verification');
    }
}
