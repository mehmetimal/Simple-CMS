<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Ürün ekleme validasyon işlemleri için yazılmıs sınıfıtır eger ekleme varsa resim zorunlu ekleme yoksa resim zorunlu olmayacak sekilde alttaki kodda ayarlanmısıtır
        $store_rule_for_image= request()->isMethod('POST') ? 'required|mimes:jpeg,png,jpg,gif' :'' ;

        return [
            'name'=>'required|string',
            'quantity'=>'numeric|min:1',
            'product_price'=>'numeric',
            'img'=> $store_rule_for_image
        ];
    }
}
