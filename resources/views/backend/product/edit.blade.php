@extends('backend.layouts.app')
@section('currentPage','Urun Ekleme ')



<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
    <style>
        .select2-container--default .select2-search--inline .select2-search__field {border: none !important;}
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {margin-left: 0px !important;}
        .custom-file-input ~ .custom-file-label::after {
            content:"EKLE" !important;
        }

        .upload_link{
            text-decoration:none;
        }
        .upload{
            display:none
        }
        .big-checkbox {width: 17px; height: 17px;}
    </style>
    <div class="container">
        <div class="container-fluid">
            <form   enctype="multipart/form-data" action="{{route('product.update',$product)}}" method="POST">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                @endif
                <input class="form-control    form-control-lg mb-3 mt-2" value="{{old('name',$product->name)}}" name="name" type="text" placeholder="Ürün adı " >
                <div class="row">
                    <div class="col">
                        <input value="{{old('price',$product->price)}}" id="product_price" type="text" name="product_price"
                               data-inputmask="'alias': 'numeric','negative':false,
                                                  'groupSeparator': '.', 'autoGroup': false, 'digits': 2,
                                                  'digitsOptional': true, 'suffix': '₺ ', 'placeholder': '0'"
                               class="form-control" placeholder="Ürün Fiyatı">

                    </div>
                    <div class="col">
                        <input name="quantity" value="{{old('quantity',$product->quantity)}}" type="number" class="form-control" min="1" placeholder="Ürün Adedi">
                    </div>
                </div>


                <label>Ürün Kategorisi Eklenecek (Kalnoy Nested Set Kullanılacaktır ) <small > Daha Fazla Detay İçin Modaterapim.com</small></label>
                <div class="row ">
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img id="image" style="width: 288px;height: 432px" class="card-img-top" src="{{$product->getFirstMediaUrl('products')}}" alt="Card image cap">
                            <div class="card-body">
                                <input class="upload"   onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" id="upload" name="img" type="file"/>
                                <p class="card-text"><a  class="upload_link" onclick="event.preventDefault();document.getElementById('upload').click('click')"   href="#"><i class="fas fa-plus"></i> <b> KAPAK RESİM GÖRÜNTÜLE </b> </a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">

                        <select  name="attribute_ids[]" class="form-control form-control-lg mb-3 attributes"  multiple="multiple" >
                            <option disabled >Her Ürünün Normalde Özellikleri  Burada secili gelmeli  demo oldugu için koymadım (ATTRİBUTE -RENK-MATERYAL VB OLAMALIDIR DEMO PROJESİ OLDUGUNDAN EKLENMEMİŞTİR detaylar modaterapim.com) </option>

                        </select>


                    </div>
                </div>
                <button type="submit" class="btn btn-success mb-5">Ürün Ekle </button>

            </form>


        </div>
    </div>





    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>


    <script>
        $('input').inputmask({removeMaskOnSubmit: true});
        $( document ).ready(function() {
            $('.categories').select2();
            $('.attributes').select2({
                placeholder:'Arama Filtresi Seçiniz'
            });
        });

    </script>
@endsection
