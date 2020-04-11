@extends('template')
@section('title')
Checkout Pembelian
@endsection
@section('link')

@endsection
@section('content')

<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            
                            
                            <div class="accordion__title">
                                Informasi Pengiriman
                            </div>
                            <div class="accordion__body">
                                <div class="bilinfo">
                                    
                                        <div class="row">
                                           
                                            {{csrf_field()}}
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">Nama Lengkap</label>
                                                    <input class="input-value" required type="text" name="nama_lengkap" value="{{$user->nama}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">No Telepon</label>
                                                    <input class="input-value" required type="text" name="no_telp" value="{{$user->no_telp}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input mt-0">
                                                    <label for="">Kabupaten</label>
                                                    <select name="kabupaten" id="Kabupaten" class="input-value" required>
                                                        <option value="" data-ongkir=''>- Pilih kabupaten</option>
                                                        @foreach($kab as $value)
                                                            <option data-ongkir='{{$value->ongkir}}' value="{{$value->nama}}">{{$value->nama}} (Ongkos kirim : Rp.{{number_format($value->ongkir)}})</option>
                                                        @endforeach
                                                        <input class="input-value" type="hidden" name="ongkir" id="Ongkir" >
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">Alamat Pengiriman</label>
                                                    <input class="input-value" required type="text" name="alamat">
                                                </div>
                                            </div>
                                           
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Pembelian</h5>
                    <div class="order-details__item">
                        @php
                            $total = 0;
                        @endphp
                        @foreach(Session::get('cart') as $item)
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <img src="{!!url("storage/foto/".$item['foto'])!!}" width="58px" height="70px" alt="ordered item">
                            </div>
                            <div class="single-item__content">
                                <a href="{{route('detail-ikan',$item['id'])}}">{{$item['nama_ikan']}}</a>
                                <span class="price">Rp. {{number_format($item['harga'])}}</span>
                            </div>
                            <div class="single-item__remove">
                                <span class="price" style="font-size:14px">{{$item['qty']}}</span>
                            </div>
                            
                        </div>
                        @php
                            $total += $item['harga'] * $item['qty'];
                        @endphp
                        @endforeach
                    </div>
                    <div class="order-details__count" >
                        <div class="order-details__count__single">
                            <h5>sub total</h5>
                            <span class="price" style="width:50%;">Rp. <span class="harga">{{number_format($total)}}</span></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Ongkos Kirim</h5>
                            <span class="price" style="width:50%;">Rp. <span class="ongkir">0</span></span>
                        </div>
                       
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price" style="width:50%;">Rp. <span class="grand_total">{{number_format($total)}}</span></span>
                    </div>
                    <ul class="payment__btn">
                        <li class="active"><a  href="#" class="btn-submit">Selesai</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    $('#Kabupaten').change(function(){
        var ongkir = $(this).children('option:selected').attr('data-ongkir') == ""? 0:$(this).children('option:selected').attr('data-ongkir');
        $('#Ongkir').val(ongkir)
        
        $('.ongkir').text(formatNumber(parseInt(ongkir)));
        var total = parseInt("{{$total}}")
        var grand = total + parseInt(ongkir);
        $('.grand_total').text(formatNumber(grand))
    })

    $('.btn-submit').on('click', function(){
            var checkrequired = $('input,textarea,select').filter('[required]:visible')
            var isValid = true;
            
            $(checkrequired).each( function() {
                    if ($(this).parsley().validate() !== true) isValid = false;
            });
            if(!isValid){
                return;
            }
            
            urlsnya = '{{route('pembelian')}}';
            _token = $('input[name=_token]').val();
            form = $('.input-value, input[name=_token]');
            var arr= {};
            $.each(form,function(k,value){
                arr[value.name] = value.value;
            });
            arr['total'] = "{{$total}}"
            
             
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                
                dataType: 'json',
                data: arr,
                url: urlsnya,
            })
            .done(function(response) {
                var url = '{{ route("pembayaran", ":id") }}';
                    url = url.replace(':id', response);
                    window.location = url;
            })
            .fail(function() {
                $.alert('process fail');
            })
            .always(function() {
                console.log("complete");
            });
        });
})
</script>


@endsection