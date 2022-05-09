<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withTrashed()->get();
        return view ('backend.product.index')->with([
            'products'=>$products
        ]);
    }

    public function create()
    {
        return view('backend.product.create');
    }


    public function store(ProductStoreRequest $request)
    {
        $barcode =$this->generateUniqueCode();
        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->product_price,
            'quantity'=>$request->quantity,
            'barcode'=>$barcode,
            'user_id'=>Auth::id()
        ]);
        $product->addMedia($request->img)->toMediaCollection('products');
        Log::channel('crudLogs')->info(' Ürün Ekleme  :  ' . Auth::user()->email .' Kullanicisi   ' .' Ürün Ekledi '. 'Kullanici ip :'.\request()->getClientIp()     );

         return back()->with([
             'message'=>'Ürün Başarıyla Eklendi'
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view ('backend.product.edit')->with([
            'product'=>$product,
        ]);
    }


    public function update(ProductStoreRequest $request, Product $product)
    {

        //farklı bir kullanıcı update edeceği bir durum olursa user_id de update edilebilir ?
        $request->flash();
        $product = $product->update([
            'name'=>$request->name,
            'price'=>$request->product_price,
            'quantity'=>$request->quantity,
        ]);
        //update sırasında bazen kullanıcı resim secmek istemeyebilir resim varsa güncelle yoksa aynı bırak
        if ($request->has('img')){
            $product->addMedia($request->img)->toMediaCollection('products');

        }
        Log::channel('crudLogs')->info(' Ürün Güncelleme   :  ' . Auth::user()->email .' Kullanicisi   ' .' Ürün Güncelledi '.'Ürün idsi'.$product->id. 'Kullanici ip :'.\request()->getClientIp()     );

        return back()->with([
            'message'=>'Ürün Basarıyla Guncellendi'
        ]);

    }


    public function destroy($product_id )
    {
        $product_with_media_for_package = Product::findOrFail($product_id);
        Log::channel('crudLogs')->info(' Ürün Silme   :  ' . Auth::user()->email .' Kullanicisi   ' .' Ürün Sildi '.'Ürün İdsi '. $product_with_media_for_package->id. 'Kullanici ip :'.\request()->getClientIp()     );

        $product_with_media_for_package->delete();
        Media::where('model_id',$product_id)->delete();
        return  back()->with([
            'message'=>'Ürün Başarıyla Silindi'
        ]);
    }
    public function generateUniqueCode(){
        do {
            $code = random_int(100000, 999999);
        } while (Product::where("barcode", "=", $code)->first());

        return $code;
    }

}
