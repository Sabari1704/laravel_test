<?php

namespace App\Http\Controllers;
require_once('../vendor/autoload.php');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use \Stripe\Charge;




class WebsiteController extends Controller
{
    //
    public function __construct() {
       $this->middleware('auth');
   }
    /**

     * Write code on Method
     *
     * @return 
     */

    public function productlist()
    {
        
            $list = DB::table('products')->orderBy('id', 'DESC')->get();
            return view('productlist',compact('list'));
        
    }

    public function productDetails(Request $request, $id){

           $product = DB::table('products')->where('id', $id)->first();
           $intent = auth()->user()->createSetupIntent();
           return view('productDetails',compact('product', 'intent'));
        
    }


    public function singleCharge(Request $request)
    {
        //return $request->all();

        $amount = $request->amount;
        $amount = $amount * 100;
        $paymentMethod = $request->payment_method;

        $user = auth()->user();
        // $user->createOrGetStripeCustomer();

        // // if ($paymentMethod != null) {
        // //     $paymentMethod = $user->addPaymentMethod($paymentMethod);
        // // }
        // $paymentMethod = $user->addPaymentMethod($paymentMethod);
        // $user->charge($amount, $paymentMethod->id);
        // dd('success');
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($amount, $paymentMethod);        
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

     

        return back()->with('message', 'Product purchased successfully!');

    }
    

  
}
