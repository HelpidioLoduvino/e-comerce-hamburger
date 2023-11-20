<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\Statistic;

class UserController extends Controller
{

    public function show($id){
        $user = User::find($id);       
        return view('profile', ['user' => $user]);
    }

    public function profile($id){
        $user = User::find($id);      
        return view('adminProfile', ['user' => $user]);
    }

    public function store(Request $request){

        $contact = $request->input('contact');

        if(strlen($contact)  < 9){
            return redirect('/')->with('msg', 'Contacto Incorrecto!');
        } else {
            User::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'password' => Hash::make($request->input('password')),
                'type' => $request->input('type')
            ]);
    
            Statistic::updateOrInsert(
                ['id' => 1],
                ['clients' => \DB::raw('clients + 1')]
            );
    
            return redirect('/')->with('msg', 'Dados inseridos com sucesso!');
        }

      
    }

    
    public function login (Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            session(['id' =>$user->id, 'type' => $user->type]);
            $sessionType = session('type');
            switch($sessionType){
                case 'client':
                    return redirect('/')->with('msg', 'Login Com Sucesso');
                    break;
                case 'manager':
                    return redirect('/view/home')->with('msg','Admin Logado Com Sucesso');
                    break;
                default:
                return view('/')->with('error', 'Erro ao Fazer Login');
                    break;
            }
        } else {
            return redirect('/')->with('msg', 'Email ou Senha Incorrecta!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->update($request->all());

        return redirect('/my-profile/'. $user_id)->with('msg', 'Perfil atualizado com sucesso.');
    }

    public function showClient(){
        $clients = User::where('type', 'client')->get();
        $order_qtys = Order::all();
        $sum = 0;

        foreach($order_qtys as $order_qty){
            $sum += $order_qty->order_qty;
        }
        
        if($clients->isNotEmpty()){
            return view('client', compact('clients', 'sum'));
        } else {
            $clients = [];
            return view('client', compact('clients', 'sum'));
        }
       
    }
    
    
    /*

    public function destroy($id)
    {

        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
    
    public function edit($id)
    {
        $user = User::find($id);

        return view('profile', compact('user'));
    }
    */
}