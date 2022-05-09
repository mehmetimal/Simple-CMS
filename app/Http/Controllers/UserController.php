<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
     * register kısmı istenmediği için seedere koymak için yine de bu metodu demo amaclı bırakıyorum kalabilir
     * laravel custom paketleri de override edebildiğimin bir örneği olarak
     */
    public function  createStaticUserForDemo(){
        return User::create([
            //'name' => $data['name'],
            'email' => 'admin@distedavim.com',
            'password' => Hash::make('admin123')
        ]);
    }
    /*
    * Ürünü Kimin Yüklediğine ait bilgiyi ajax ile döndüren metoddur
    * Sadece Ajax yazım seklimi de gösterebilmek adına farklılık amacıyla yazılmıstır
    */
    public  function getProductUser(Request $request){

        $user = User::where('id',$request->userId)->first();
        return response()->json($user);
    }
}
