@extends('backend.layouts.app')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/buttons.bootstrap4.min.css')}}">

@endpush
@section('currentPage','Ürünler')


@section('content')

    <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{route('product.create')}}" class="btn btn-outline-success">Ürün Ekle</a></h3>
            </div>

    <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" >Adı </th>
                    <th scope="col">Durum</th>
                    <th scope="col">Adet</th>
                    <th scope="col">Fiyat </th>
                    <th scope="col">Silinme Tarihi </th>
                    <th  style="width: auto" class="text-center">İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products  as $product)

                    <tr>
                        <td style="width: 5% !important;">{{$product->barcode}}</td>
                        <td style="width:10% !important;">{{$product->name}}   <a class="productUserButton" href="#" data-user-id="{{$product->user_id}}" data-toggle="modal" data-target="#productUserModal"><i class="fa fa-question-circle"></i></a></td>
                        <td style="width: 5% !important; " >
                            <b style="color: {{$product->deleted_at !=null ? 'red' :'green' }}">{{$product->deleted_at != null ? 'SİLİNMİŞ' :'Stokta' }}</b>
                        </td>
                        <td style="width: 5% !important;">{{$product->quantity}} Adet</td>
                        <td style="width: 30% !important;">{{$product->price}} ₺</td>
                        <td style="width: 30% !important;">{{$product->deleted_at  ? $product->deleted_at->format('Y-m-d')  : '-'}} </td>
                        <td class="text-center" style="width: 30% !important;">
                            @if($product->deleted_at  == null)
                            <a class="btn btn-primary" href="{{route('product.edit',$product)}}"><i class="fa fa-edit"></i> Güncelle </a>
                            @endif
                                @if($product->deleted_at  == null)
                                <form id="destroy_form{{$product->id}}" class="d-none" action="{{route('product.destroy',$product->id)}}" method="POST">@csrf @method('delete')</form>

                                    <a href="javascript:{}" onclick=" document.getElementById('destroy_form{{$product->id}}').submit()" class="btn btn-danger  submit-previous-form" title="Delete user"><i class="fas fa-trash"></i> Sil</a>
                                @endif
                                @if($product->deleted_at  == null)
                                        <a href="#">Varyantlar Yakında  </a>
                                @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" >Adı </th>
                    <th scope="col">Durum</th>
                    <th scope="col">Adet</th>
                    <th scope="col">Fiyat </th>
                    <th scope="col">Silinme Tarihi </th>
                    <th  style="width: auto" class="text-center">İşlem</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@include('backend.modals.userProductModal')

    @push('js')
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('backend/js//dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('backend/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('backend/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('backend/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('backend/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('backend/js/jszip.min.js')}}"></script>
        <script src="{{asset('backend/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('backend/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('backend/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('backend/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('backend/js/buttons.colVis.min.js')}}"></script>



        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": true, "autoWidth": false,"ordering":true,
                    "buttons": [ "excel", "pdf", "print", "colvis"],
                    language: {
                        buttons: {
                            colvis: 'Kolonları Gizle',
                            print: 'Yazdır',

                        },
                        lengthMenu: "BİR SAYFADA  _MENU_ KAYIT GÖSTER",
                        zeroRecords: "ARADIĞINIZ KAYITLA EŞLEŞEN BİLGİ YOK ",
                        info: "  _PAGES_ SAYFADAN  _PAGE_ .SAYFADASINIZ ",
                        infoEmpty: "HİÇBİR KAYIT BULUNAMADI ",
                        sSearch: "Ara",
                        paginate: {
                            previous: "ÖNCEKİ SAYFA",
                            next:"SONRAKİ SAYFA",
                        }
                    }
                })
                    .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });




            $('.productUserButton').on('click',function (){

                var user_id=$(this).data('user-id');
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{route('get.product.user')}}",
                    type: "POST",
                    data:{
                        _token:_token,
                        userId:user_id,
                    },
                    success: function (productUserDetail) {

                        var userEmail=productUserDetail.email;
                        $('#userMail').text('Ürünü Ekleyen  email :  '+ userEmail);



                    }
                });



            })
        </script>

    @endpush



@endsection
