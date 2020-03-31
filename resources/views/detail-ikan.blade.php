@extends('template')
@section('title')
{{$ikan->nama_ikan}} | Detail
@endsection
@section('link')
<style>
.a {
    color:#c43b68 !important;
}
</style>
@endsection
@section('content')
<section class="htc__product__details bg__white ptb--100">
    <!-- Start Product Details Top -->
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <!-- Start Product Big Images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <img src="{!!url("storage/foto/".$ikan->foto)!!}" width="510px" height="510px" alt="full-image">
                                </div>
                               
                            </div>
                        </div>
                        <!-- End Product Big Images -->
                        <!-- Start Small images -->
                        {{-- <ul class="product__small__images" role="tablist">
                            <li role="presentation" class="pot-small-img active">
                                <a href="#img-tab-1" role="tab" data-toggle="tab">
                                    <img src="images/product-2/sm-img-3/3.jpg" alt="small-image">
                                </a>
                            </li>
                            <li role="presentation" class="pot-small-img">
                                <a href="#img-tab-2" role="tab" data-toggle="tab">
                                    <img src="images/product-2/sm-img-3/1.jpg" alt="small-image">
                                </a>
                            </li>
                            <li role="presentation" class="pot-small-img">
                                <a href="#img-tab-3" role="tab" data-toggle="tab">
                                    <img src="images/product-2/sm-img-3/2.jpg" alt="small-image">
                                </a>
                            </li>
                        </ul> --}}
                        <!-- End Small images -->
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="ht__product__dtl">
                        <h2>{{$ikan->nama_ikan}}</h2>
                        <div class="pull-right">
                            <a class="fr__btn" href="{{route('insertcart',$ikan->id)}}">Pesan</a>
                        </div>
                        <h6>Tambak: <span>{{$ikan->tambak->nama_tambak}}</span></h6>
                        {{-- <ul class="rating">
                            <li><i class="icon-star icons"></i></li>
                            <li><i class="icon-star icons"></i></li>
                            <li><i class="icon-star icons"></i></li>
                            <li class="old"><i class="icon-star icons"></i></li>
                            <li class="old"><i class="icon-star icons"></i></li>
                        </ul> --}}
                        <ul  class="pro__prize">
                            <li>Rp. {{number_format($ikan->harga)}}</li>
                        </ul>
                        <p class="pro__info">{{$ikan->deskripsi}}</p>
                        <div class="ht__pro__desc">
                            <div class="sin__desc">
                                <p><span>Berat:</span> {{$ikan->berat}} Kg</p>
                            </div>
                            {{-- <div class="sin__desc align--left">
                                <p><span>color:</span></p>
                                <ul class="pro__color">
                                    <li class="red"><a href="#">red</a></li>
                                    <li class="green"><a href="#">green</a></li>
                                    <li class="balck"><a href="#">balck</a></li>
                                </ul>
                                <div class="pro__more__btn">
                                    <a href="#">more</a>
                                </div>
                            </div>
                            <div class="sin__desc align--left">
                                <p><span>size</span></p>
                                <select class="select__size">
                                    <option>s</option>
                                    <option>l</option>
                                    <option>xs</option>
                                    <option>xl</option>
                                    <option>m</option>
                                    <option>s</option>
                                </select>
                            </div> --}}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Details Top -->
</section>
<section class="htc__product__area--2 pb--100 product-details-res">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Produk Lainnya</h2>
                    <p>Produk lainnya dari tambak yang sama</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product__wrap clearfix">
               
                <!-- Start Single Product -->
                @foreach($other as $item)
                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                        <div class="category">
                            <div class="ht__cat__thumb">
                                <a href="{{route('detail-ikan',$item->id)}}">
                                    <img src="{!!url("storage/foto/".$item->foto)!!}" width="290px" height="290px" alt="product images">
                                </a>
                            </div>
                            
                            <div class="fr__product__inner">
                                <h4><a href="product-details.html">{{$item->nama_ikan}}</a></h4>
                                <ul class="fr__pro__prize">
                                    
                                    <li>Rp. {{number_format($item->harga)}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <!-- End Single Product -->

            </div>
        </div>
    </div>
</section>
@endsection