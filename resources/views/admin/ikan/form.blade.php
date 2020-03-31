@extends('admin.template')
@section('title')
Ikan
@endsection

@section('breadcumb')
Ikan
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Form Ikan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" id="form" action="{{ (!isset($input['id'])) ? route('ikan.store') : route('ikan.update', ['id' => $input['id']]) }}">
                                {{csrf_field()}}

                                @isset($input['id'])
                                    {{ method_field('PUT')}}
                                @endisset
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" class="form-control input-value col-md-6" id="Kode" name="kode" required value=" {{ old('kode', $input['kode']) }} ">
                                </div>
                                <div class="form-group">
                                    <label for="">Tambak</label>
                                    <select name="tambak_id" class="form-control col-md-6">
                                        <option value=""> - Pilih Tambak </option>
                                        @foreach($tambak as $option)
                                            <option value=" {{ $option->id }} " {{ ($option->id == $input['tambak_id']) ? 'selected' : '' }} > {{ $option->nama_tambak }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Nama Ikan</label>
                                    <input type="text" class="form-control input-value col-md-6" id="NamaIkan" name="nama_ikan" required value=" {{ old('nama_ikan', $input['nama_ikan']) }} ">
                                </div>

                                <div class="form-group">
                                    <label for="">Harga</label>
                                   
                                    <input type="text" class="form-control input-value col-md-4" id="Harga" name="harga" onkeypress="return isNumberKey(event)" required value=" {{ old('harga', $input['harga']) }} ">
                                        
                                    
                                </div>
                                <div class="form-group">
                                    <label for="">Berat</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control input-value col-md-4" id="Berat" name="berat" onkeypress="return isNumberKey(event)" required value=" {{ old('berat', $input['berat']) }} ">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" id="Deskirpsi" class="form-control input-value col-md-6" cols="30" rows="10" required>{{ old('deskripsi', $input['deskripsi']) }}</textarea>
                                </div>
                                
                                
                                @if($input['foto'])
                                
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <img src="{{ url('storage/foto/'. $input['foto']) }}" class="img-fluid" style="width:200px; height:200px;">
                                    </div>
                                </div>

                                @endif
                                
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control input-value col-md-4 foto" id="Foto" accept="image/x-png,image/gif,image/jpeg" name="foto">
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Simpan" class="btn btn-primary float-right">
                                </div>
                                        
                            </form>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>
        $('.liikan').addClass('active');
        @if(session('error'))
            toastr.error("{!! session('error') !!}")
       @endif
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        
    </script>
@endsection