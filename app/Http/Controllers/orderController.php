<?php

namespace App\Http\Controllers;

use App\Mail\alertemail;
use App\Models\ingredient;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\alertmail;
use App\Models\updatestock;

class orderController extends Controller
{
    public function order(Request $request)
    {
        if(is_numeric($request->burger) > 0){

            $stock = ingredient::all();
            $beef =  $stock->where('id', 1)->first();
            $cheese =  $stock->where('id', 2)->first();
            $onion =  $stock->where('id', 3)->first();

            $beefPercentage = ($beef->quantity / 150000) * 100;
            $cheesePercentage = ($cheese->quantity / 30000) * 100;
            $onionPercentage = ($onion->quantity / 20000) * 100;

            if($beefPercentage < 50){
                $mailexist = updatestock::where('email', 1)->first();
                if(!$mailexist){
                    Mail::to("webtech1800@gmail.com")->send(new alertemail());
                    updatestock::insert(['email' => 1, 'ingredient' => 'beef']);
                }
            }

            if($cheesePercentage < 50){
                $mailexist = updatestock::where('email', 2)->first();
                if(!$mailexist){
                    Mail::to("webtech1800@gmail.com")->send(new alertemail());
                    updatestock::insert(['email' => 2, 'ingredient' => 'cheese']);
                }
            }

            if($onionPercentage < 50 ){
                $mailexist = updatestock::where('email', 3)->first();
                if(!$mailexist){
                    Mail::to("webtech1800@gmail.com")->send(new alertemail());
                    updatestock::insert(['email' => 3, 'ingredient' => 'onion']);
                }
            }

            for($i = 1 ; $i <= $request->burger; $i++)
            {
                $beef->quantity = $beef->quantity - 150;
                $beef->save();

                $cheese->quantity = $cheese->quantity - 30;
                $cheese->save();

                $onion->quantity = $onion->quantity - 20;
                $onion->save();
            }

            $beef_percentage = ($beef->quantity / 150000) * 100;
            $cheese_percentage = ($cheese->quantity / 30000) * 100;
            $onion_percentage = ($onion->quantity / 20000) * 100;

            $order = new order();
            $order->items = 'burger';
            $order->quantity = $request->burger;
            $order->save();

            return response()->json([
                'products' => [
                    'product_id' => $order->id,
                    'quantity' => $request->burger,
                    'stock' => $stock,
                    'ingredients' => [
                        'beeef' => $beef_percentage.'%',
                        'cheese' => $cheese_percentage.'%',
                        'onion' => $onion_percentage.'%',
                    ],

                ]
            ], 200);
        }else{
            return response()->json([
                'products' => 'place a right order'
            ], 403);
        }
    }
}
