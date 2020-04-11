@extends('template')
@section('title')
List Pembelian
@endsection
@section('link')

@endsection
@section('content')

<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Invoice</th>
                                    <th class="product-name">Tanggal</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-name">Status Pembelian</th>
                                    <th class="product-name">Status Pembayaran</th>
                                    <th class="product-name">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(!$pembelian)
                                    <td colspan="8"><div class="text-center"><span>Tidak ada pembelian</span></div></td>
                                @else
                               
                                    @foreach($pembelian as $item)
                                        <tr class="rowcart">
                                            <td class="product-name">{{$item->invoice}}</td>
                                            <td class="product-name">{{$item->tanggal_pembelian}}</td>
                                            <td class="product-subtotal">Rp. <span class="amount harga">{{number_format($item->total_nominal)}}</span></td>
                                            <td class="product-name">
                                                @if($item->status_pembelian == 1)
                                                    Sedang Disiapkan
                                                @elseif($item->status_pembelian == 2)
                                                    Sedang Dikirim
                                                @elseif($item->status_pembelian == 3)
                                                    Selesai
                                                @elseif($item->status_pembelian == 4)
                                                    Batal
                                                @endif
                                            </td>
                                            
                                            <td class="product-name">
                                                @if($item->pembayaran == null)
                                                    Belum Dibayar
                                                @else
                                                    Bukti telah dikirim
                                                @endif
                                            </td>
                                            
                                        <td class="product-name">
                                            @if($item->status_pembelian != 4)
                                                <a href="{{route('pembayaran',$item->id)}}"><div class="btn btn-warning">Lihat</div></a>
                                            @endif
                                            
                                            @if($item->pembayaran == null && $item->status_pembelian != 4)
                                            
                                            <div class="btn btn-danger btn-batal" data-id="{{$item->id}}">Batalkan</div></td>
                                            @endif
                                        </tr>
                                       
                                    @endforeach
                                @endif
                               
                            </tbody>
                        </table>
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
        $(document).on('click', '.btn-batal', function(){
                var id = this.attributes['data-id'].value;

                
                var urlsnya = '{{ route("pembayaran.batal", ":id") }}';
                    urlsnya = urlsnya.replace(':id', id);
              
                    $.confirm({
                    theme: 'material',
                    title: 'Warning!',
                    content: 'Apakah anda yakin ingin membatalkan pembelian ?',
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
                                $.alert('process fail');
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
    </script>
        
@endsection