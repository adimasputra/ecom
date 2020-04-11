@extends('template')
@section('title')
Pembayaran
@endsection
@section('link')
<style>
    .payment__btn li button:hover, .payment__btn li.active button{
        background: #212121 none repeat scroll 0 0;
        color: #fff;
    }
    .payment__btn li button {
    background: #ebebeb none repeat scroll 0 0;
    color: #3f3f3f;
    display: block;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    height: 65px;
    line-height: 65px;
    text-align: center;
    text-transform: uppercase;
    transition: all 0.4s ease 0s;
}
</style>
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
                                Pembayaran
                            </div>
                            <div class="accordion__body">
                                <div class="bilinfo">
                                    
                                        <div class="row">
                                        <form action="{{route('pembayaran.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="col-md-4">
                                                <div class="single-input">
                                                    <label for="">Tanggal Pembayaran</label>
                                                    <input class="input-value form-control" required type="date" value="{{$pembayaran['tanggal_pembayaran']}}" name="tanggal_pembayaran" >
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <br>
                                                    @if($pembayaran['bukti_pembayaran'] != "")
                                                
                                                        
                                                    <img src="{{ url('storage/foto/'. $pembayaran['bukti_pembayaran']) }}" class="img-fluid" style="width:300px; height:200px;">
                                                        
                                                    @endif
                                                    <br>
                                                    <label for="">Bukti Pembayaran</label>
                                                    <input type="file" class="input-value " id="Foto" accept="image/x-png,image/gif,image/jpeg" name="bukti">
                                                    <input class="input-value" type="hidden" name="pembelian_id" value="{{$pembelian->id}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="single-input">
                                                    <button  type="submit" class="fr__btn">Selesai</button>
                                                </div>
                                            </div>
                                           
                                        </form>
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
                        
                        @foreach($detail as $item)
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <img src="{!!url("storage/foto/".$item->ikan->foto)!!}" width="58px" height="70px" alt="ordered item">
                            </div>
                            <div class="single-item__content">
                                <a href="{{route('detail-ikan',$item->ikan->id)}}">{{$item->ikan->nama_ikan}}</a>
                                {{-- <span class="price">Rp. {{number_format($item->ikan->harga)}}</span> --}}
                            </div>
                            <div class="single-item__remove">
                                <span class="price" style="font-size:14px">{{$item->qty}}</span>
                            </div>
                            
                        </div>
                        
                        @endforeach
                    </div>
                    
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price" style="width:50%;">Rp. <span class="grand_total">{{number_format($pembelian->total_nominal)}}</span></span>
                    </div>
                    
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>


@endsection