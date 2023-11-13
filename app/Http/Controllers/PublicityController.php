<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Publicity;
use App\Models\Order;

class PublicityController extends Controller
{
    public function storePub(Request $request){

        if($request->hasFile('img') && $request->file('img')->isValid()){

            $extension = $request->img->extension();
            $imageName = md5($request->img->getClientOriginalName() . strtotime("now"). "." . $extension);

            $request->img->move(public_path('img/bdImages'), $imageName);

            Publicity::create([
                'title' => $request->input('title'),
                'pub_description' => $request->input('pub_description'),
                'img'=> $imageName,
            ]);
        }

        return redirect('/view/publicity')->with('msg', 'Publicidade Inserida Com Sucesso');
    }

    public function show(){
        $publicity = Publicity::take(1)->get();

        $order_qtys = Order::all();
        $sum = 0;

        foreach($order_qtys as $order_qty){
            $sum += $order_qty->order_qty;
        }

        if($publicity->isNotEmpty()){
            return view('banner', ['publicity' => $publicity, 'sum' => $sum]);
        } else {
            $publicity = []; 
            return view('banner', ['publicity' => $publicity, 'sum' => $sum]);
        }
    }

    public function delete($id){
        $publicity = Publicity::find($id);
        
        $publicity->delete();

        return view('banner'); 
    }
}