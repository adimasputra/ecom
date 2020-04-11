@extends('template')
@section('title')
Chart Pembelian
@endsection
@section('link')

@endsection
@section('content')
{{-- {{dd(Session::get('cart'))}} --}}
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">Nama</th>
                                    <th class="product-name">Tambak</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-price">Berat</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-name">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!Session::get('cart'))
                                    <td colspan="8"><div class="text-center"><span>Tidak ada barang</span></div></td>
                                @else
                                @php
                                    $total = 0;
                                @endphp
                                    @foreach(Session::get('cart') as $item)
                                        <tr class="rowcart">
                                            <td class="product-thumbnail"><a href="#"><img src="{!!url("storage/foto/".$item['foto'])!!}" alt="product img" /></a></td>
                                            <td class="product-name"><a href="{{route('detail-ikan',$item['id'])}}">{{$item['nama_ikan']}}</a></td>
                                            <td class="product-name"><a href="#">{{$item['tambak']}}</a></a></td>
                                            <td class="product-subtotal">Rp. <span class="amount harga">{{number_format($item['harga'])}}</span></td>
                                            <td class="product-price"><span class="amount">{{$item['berat']}}</span></td>
                                            <td class="product-quantity"><input type="number" class="qty" value="{{$item['qty']}}" /></td>
                                            <td class="product-subtotal">Rp. <span class="subtotal">{{number_format($item['harga'] * $item['qty'])}}</span></td>
                                            <td class="product-name"><div class="btn btn-primary btn-update hide" data-id="{{$item['id']}}">Update</div>&nbsp;<div class="btn btn-danger btn-hapus" data-id="{{$item['id']}}">Hapus</div></td>
                                        </tr>
                                        @php
                                            $total += $item['harga'] * $item['qty'];
                                        @endphp
                                    @endforeach
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                    @if(Session::get('cart'))
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="{{route('home')}}">Lanjut Belanja</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    
                                    <a href="{{route('checkout')}}">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="htc__cart__total">
                                
                                <div class="cart__desk__list">
                                    <ul class="cart__desc">
                                        <li>cart total</li>
                                        <li>Belum ongkos kirim</li>
                                        
                                    </ul>
                                    <ul class="cart__price">
                                        <li>Rp. {{number_format($total)}}</li>
                                        
                                    </ul>
                                </div>
                                <div class="cart__total">
                                    <span>order total</span>
                                    <span>Rp. {{number_format($total)}}</span>
                                </div>
                                <ul class="payment__btn">
                                    <li class="active"><a href="{{route('checkout')}}">checkout</a></li>
                                    <li><a href="{{route('home')}}">Lanjut Belanja</a></li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.qty').keyup(function(){
                
                row = $(this).closest('.rowcart');
                btn = $(row).find('.btn-update');
                harga = $(row).find('.harga');
                subtotal = $(row).find('.subtotal');
                total = parseInt($(this).val() == ""? 0:$(this).val()) * parseInt($(harga).text());
                $(subtotal).text(total);
                $(btn).removeClass('hide');
            });
            
        })
        $(document).on('click', '.btn-hapus', function(){
                var id = this.attributes['data-id'].value;
                var urlsnya = '{{ route("deletecart", ":id") }}';
                    urlsnya = urlsnya.replace(':id', id);
                $.confirm({
                    theme: 'material',
                    title: 'Warning!',
                    content: 'Apakah anda yakin ingin menghapus barang ?',
                    buttons: {
                        Yes: function () {
                            $.ajax({
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                id: id,
                                "_token": "{{ csrf_token() }}",
                                
                            },
                            url: urlsnya,
                            })
                            .done(function(response) {
                                if(response == 1) {
                                    location.reload();
                                }
                            })
                            .fail(function() {
                                $.alert('Delete process fail');
                            })
                            .always(function() {
                                console.log("complete");
                            });
                        },
                        No: function () {
                        return;
                        }
                    }
                });
            });

            $(document).on('click', '.btn-update', function(){
                var id = this.attributes['data-id'].value;
                btn = this;
                row = $(this).closest('.rowcart');
                input = $(row).find('.qty');
                var qty = $(input).val();
                if(qty == 0){
                    $.alert('Quantiti tidak boleh 0');
                    return;
                }
                
                var urlsnya = '{{ route("updatecart", ":id") }}';
                    urlsnya = urlsnya.replace(':id', id);
              
                $.ajax({
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                    qty:qty,
                    "_token": "{{ csrf_token() }}",
                    
                },
                url: urlsnya,
                })
                .done(function(response) {
                    if(response == 1) {
                        $(btn).addClass('hide')
                        location.reload()
                    }
                })
                .fail(function() {
                    $.alert('Delete process fail');
                })
                .always(function() {
                    console.log("complete");
                });
                        
                        
            });
    </script>
@endsection