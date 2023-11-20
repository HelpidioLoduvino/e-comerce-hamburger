<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ConfirmOrder;
use App\Models\OrderItem;
use App\Models\Publicity;
use App\Models\Sale;
use App\Models\SoldItem;
use App\Models\Email;
use App\Models\User;
use App\Models\Statistic;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    public function addProduct(Request $request){

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $extension = $request->image->extension();
            $imageName = md5($request->image->getClientOriginalName() . strtotime("now"). "." . $extension);

            $request->image->move(public_path('img/bdImages'), $imageName);

            Product::create([
                'product_name' => $request->input('product_name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image' => $imageName,
            ]);
        }

        return redirect('/view/add-product')->with('msg', 'Produto inserido com sucesso');
    }

    public function showAdminHome(){
        $statistics = Statistic::firstOrCreate(['id' => 1]);

        $order_qtys = Order::all();

        $sum = 0;

        if($order_qtys->isNotEmpty()){

            foreach($order_qtys as $order_qty){
                $sum += $order_qty->order_qty;
            }
        }

        $total_month = 0;

        $month = now()->format('m');

        $finance_monthly = DB::table('sales')
        ->whereMonth('created_at', $month)
        ->get();

        foreach($finance_monthly as $profit){
            $total_month += $profit->total;
        }
        
        return view('manager', compact('statistics', 'sum', 'total_month'));
    }

    public function addProductView(){

        $order_qtys = Order::all();
        $sum = 0;

        foreach($order_qtys as $order_qty){
            $sum += $order_qty->order_qty;
        }
        return view('addProduct', compact('sum'));
    }

    public function showProduct(){
        $products = Product::take(3)->get();

        $publicities = Publicity::take(1)->get();

        $userId = Session::get('id');
        
        $carts = Cart::select('quantity')->where('user_id', $userId)->get();

        $sum = 0;

        foreach($carts as $cart){
            $sum += $cart->quantity;;
        }

        return view('homepage', ['products' => $products, 'publicities' => $publicities, 'sum' => $sum]);
        
    }

    public function insertToCart($product_id, $user_id){

        $cartItem = Cart::where('product_id', $product_id)
                        ->where('user_id', $user_id)
                        ->first();

        if($cartItem){
            $cartItem->quantity += 1;
            $cartItem->save();
            return redirect('/')->with('msg', 'produto inserido no cart com sucesso');
        } else {
            $newCartItem = new Cart();
            $newCartItem->product_id = $product_id;
            $newCartItem->user_id = $user_id;
            $newCartItem->quantity = 1;
            $newCartItem->save();
            return redirect('/')->with('msg', 'produto inserido no cart com sucesso');      
        }
    }

    public function listCartItems($user_id){
        $cartProducts = Cart::select('carts.id', 'carts.quantity', 'products.product_name', 'products.price', 'products.description', 'products.image')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $user_id)
            ->get();

        if ($cartProducts->isNotEmpty()) {
            return view('cart', ['cartProducts' => $cartProducts]);

        } else {
            return redirect('/')->with('msg', 'Nao tem nenhum Produto no Cart');
        }
    }

    public function deleteCartItem($product_id, $user_id){
        $product = Cart::find($product_id);
        $product->delete();
        return redirect('/cart/'. $user_id)->with('msg', 'Produto deletado do Cart Com sucesso');
    }

    public function addQuantity($cart_id, $user_id) {
        $cartItem = Cart::where('id', $cart_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            return redirect('/cart/'. $user_id);
        }
    }

    public function subtractQuantity($cart_id, $user_id) {
        $cartItem = Cart::where('id', $cart_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            return redirect('/cart/'. $user_id);
        }
    }

    public function confirmOrder(Request $request, $user_id){
        ConfirmOrder::create([
            'user_id' => $user_id,
            'total' => $request->input('total'),
            'payment_method' => $request->input('payment_method'),
        ]);

        return redirect('/confirm-order/'. $user_id);
    }

    public function showOrderItem($user_id){
            $orders = confirmOrder::where('user_id', $user_id)
                        ->get();

            $items = Cart::select('carts.product_id', 'carts.quantity', 'products.product_name')
                        ->join('products', 'carts.product_id', '=', 'products.id')
                        ->where('carts.user_id', $user_id)
                        ->get();

        return view('confirmOrder', ['orders' => $orders, 'items' => $items]);
    }

    public function storeOrder(Request $request, $user_id){

        $order = Order::create([
            'user_id' => $user_id,
            'total' => $request->input('total'),
            'payment_method' => $request->input('payment_method'),
        ]);

        $order_id = $order->id;
        $product_ids = $request->input('product_id');
        $quantities = $request->input('quantity');
    
        foreach ($product_ids as $key => $product_id) {
            $quantity = $quantities[$key];
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity 
            ]);
        }

        $confirm_order_id = $request->input('confirm_order_id');

        $delete_confirm_order = ConfirmOrder::find($confirm_order_id);
        $delete_confirm_order->delete();

        /*

        $numeroTelefone = '944459953'; // Número de telefone do destinatário
        $mensagem = 'Tem um novo pedido'; // Mensagem a ser enviada

        $token = 'SEU_TOKEN'; // Substitua pelo seu token da API do WhatsApp

        $client = new Client();

        $response = $client->post('https://api.chat-api.com/instance123/message', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'phone' => $numeroTelefone,
                'body' => $mensagem,
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        /*

        /*
        $user = Socialite::driver('google')->user();

        $email = new Email($user);

        Mail::to($user->email)->send($email);

        */
    
        $cartItems = Cart::where('user_id', $user_id)->delete();
    
        return redirect('/')->with('msg', 'Pedido feito com sucesso');
    }

    public function cancelCartOrder($user_id){
        $cancel = ConfirmOrder::where('user_id', $user_id)->delete();

        return redirect('/cart/'. $user_id);
    }

    public function showOrder($user_id){

        $orders = Order::select('orders.*', 'order_items.product_id', 'order_items.quantity', 
                                'products.product_name', 'products.price', 'products.image', 'products.description', 
                                'users.name', 'users.surname', 'users.contact')
                        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                        ->join('products', 'products.id', '=', 'order_items.product_id')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->where('user_id', $user_id)
                        ->get()
                        ->groupBy('id');

        if($orders->isNotEmpty()){
            return view('order', ['orders' => $orders]);
        } else {
            return redirect('/')->with('msg', 'Nao tem nenhum Pedido');
        }
    
    }

    public function showOrderAdmin(){

        $orders = Order::select('orders.*', 'order_items.product_id', 'order_items.quantity', 
                                'products.product_name', 'products.price', 'products.image', 'products.description', 
                                'users.name', 'users.surname', 'users.contact')
                        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                        ->join('products', 'products.id', '=', 'order_items.product_id')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->get()
                        ->groupBy('id');

        $order_qtys = Order::all();

        $sum = 0;

        if($order_qtys->isNotEmpty()){
            
            foreach($order_qtys as $order_qty){
                $sum += $order_qty->order_qty;
            }
        } 

        if($orders->isNotEmpty()){
            return view('orderAdmin', ['orders' => $orders, 'sum' => $sum]);
        } else {
            $orders = [];
            return view('orderAdmin', ['orders' => $orders]);
        }
    }

    public function showProductAdmin(){
        $products = Product::all();

        $order_qtys = Order::all();
        $sum = 0;

        foreach($order_qtys as $order_qty){
            $sum += $order_qty->order_qty;
        }

        if($products){
            return view('product', compact('products'), compact('sum'));
        } else{
            $products = [];
            return view('product', ['products' => $products, 'sum' => $sum]);
        }
        
    }

    public function updateStatusToExecuting($order_id){

        $order =  Order::find($order_id);
        $order->update(['status' => 'EM ANDAMENTO']);

        return redirect('/view/order')->with('msg', 'Pedido '. $order_id .' Em Preparação');
    }

    public function updateStatusToFinished($order_id){

        $order =  Order::find($order_id);
        $order->update(['status' => 'CONCLUIDO']);

        return redirect('/view/order')->with('msg', 'Pedido '. $order_id .' Concluido');
    }

    public function storeSale(Request $request, $order_id){

        Sale::create([
            'order_id' => $order_id,
            'user_id' => $request->input('user_id'),
            'total' => $request->input('total'),
            'payment_method' => $request->input('payment_method'),
            'order_date' => $request->input('order_date'),
        ]);

        $product_ids = $request->input('product_id');
        $quantities = $request->input('quantity');

        $sale_id = Sale::latest('created_at')->first()->id;
    
        foreach ($product_ids as $key => $product_id) {
            $quantity = $quantities[$key];
            SoldItem::create([
                'sale_id' => $sale_id,
                'product_id' => $product_id,
                'quantity' => $quantity 
            ]);
        }

        $order_items = OrderItem::where('order_id', $order_id)->get();

        foreach($order_items as $order_item){
            $order_item->delete();
        }

        $order = Order::find($order_id);
        $order->delete();

        Statistic::updateOrInsert(
            ['id' => 1],
            ['sales' => \DB::raw('sales + 1')]
        );

        
        return redirect('/view/order')->with('msg', 'Pedido '. $order_id .' Vendido');
    }

    public function showAllProducts(){
        $products = Product::all();
        return view('showAllProducts', compact('products'));
    }

    public function showSales(){
        $sales = Sale::select('sales.*', 'sold_items.product_id', 'sold_items.quantity', 
                        'products.product_name', 'users.name', 'users.surname')
                        ->join('sold_items', 'sold_items.sale_id', '=', 'sales.id')
                        ->join('products', 'products.id', '=', 'sold_items.product_id')
                        ->join('users', 'users.id', '=', 'sales.user_id')
                        ->get()
                        ->groupBy('id');

        $order_qtys = Order::all();
        $sum = 0;

        if($order_qtys->isNotEmpty()){
            
            foreach($order_qtys as $order_qty){
                $sum += $order_qty->order_qty;
            }
        }

        if($sales->isNotEmpty()){
            return view('sales', ['sales' => $sales, 'sum' => $sum]);
        } else {
            $sales = [];
            return view('sales', ['sales' => $sales, 'sum' => $sum]);
        }
    }

    public function editProduct(Request $request, $product_id){
        $product = Product::find($product_id);
        $product->update($request->all());

        return redirect('/view/show-product')->with('msg', 'Produto editado com sucesso');
    }
}