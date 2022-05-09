<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Uygulama Hakkında
|--------------------------------------------------------------------------
|Uygulama bana gönderilensimple projeyle oaralel ilerleyebilecek halde olusturulmustur
|tek ürün ekleneceği için kolonlar elimden geldiğince sade kullanılmaya callısılmısıtır
|e ticaret halinin en kapsamlı hali için modaterapim.com adresinin sifre ve admin adını size iletiyor olacagım
|projede elimden geldiğnce genel yapıları nasıl kullandıgımı göstermeye calıstım
|görüş oldugunuz proje tam olarak 2 saat 22 dakikada kodlanmıstır
|
|PROJEYİ ÇALISTIRMAK İÇİN DB DE TEST EDİLECEKSE
|Kullanıcı Adı :admin@distedavim.com'
|Sifre :admin123
|
|
|php artisan db:seed (ayarlar yapıldıktan sonra )
|sizi yormamak için bilerek middleware de koymadım ama ürün eklerken giriş yapmaz iseniz hata alabilirsiniz
|
|İşlem logları ayrıca crudlogs adlı txtde de yer alacaktır
*/

Route::get('/', function () {
    return view('frondend.login');
});
\Illuminate\Support\Facades\Auth::routes();
//demo user olusturmak için koydydugum rote görmek isterseniz diye bıraktım
Route::get('create-demo-user-just-once',[\App\Http\Controllers\UserController::class,'createStaticUserForDemo']);
//bu kısımda normalde kullanıcının satısları grafikleri yada bizim proje göre yaptıgı satıs aldıgı satıs sipariş grafikleri yer alaması için landing page
Route::get('panel',[\App\Http\Controllers\ProductController::class,'index']);

//ürün işlemleri için route resource olarak kodladım
Route::resource('product','\App\Http\Controllers\ProductController');

//kullanıcı işlemleri için basit bir controller
Route::post('get-product-user',[\App\Http\Controllers\UserController::class,'getProductUser'])->name('get.product.user');
