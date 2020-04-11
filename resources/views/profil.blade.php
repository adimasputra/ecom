@extends('template')
@section('title')
Profil
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
                            
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
                            <div class="accordion__title">
                                Profil
                            </div>
                            <div class="accordion__body">
                                <div class="bilinfo">
                                    
                                        <div class="row">
                                        <form action="{{route('profil.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">Nama Lengkap</label>
                                                    <input class="input-value form-control" required type="text" name="nama_pelanggan" value="{{Auth::guard('pelanggan')->user()->nama}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">Email</label>
                                                    <input class="input-value form-control" required type="email" name="email" value="{{Auth::guard('pelanggan')->user()->email}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">No Telepon</label>
                                                    <input class="input-value form-control" required type="text" name="no_telp" value="{{Auth::guard('pelanggan')->user()->no_telp}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <label for="">Alamat</label>
                                                    <input class="input-value form-control" required type="text" name="alamat" value="{{Auth::guard('pelanggan')->user()->alamat}}" required>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <div class="single-input">
                                                    <button  type="submit" class="fr__btn">Simpan</button>
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
                    
                    <div class="order-details__item">
                        
                       
                        <div class="single-item">
                            <a href="{{route('list.pembelian')}}" style="font-weight:700;">List Pembelian</a>
                        </div>
                        <hr>
                        <div class="single-item">
                            <a href="{{route('cart')}}" style="font-weight:700;">Cart Pembelian</a>
                        </div>
                      
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