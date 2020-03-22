@extends('admin.template')
@section('title')
Tambak
@endsection

@section('breadcumb')
Tambak
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Form Tambak
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" id="form" action="{{ (!isset($input['id'])) ? route('tambak.store') : route('tambak.update', ['id' => $input['id']]) }}">
                                {{csrf_field()}}

                                @isset($input['id'])
                                    {{ method_field('PUT')}}
                                @endisset
                               
                                <div class="form-group">
                                    <label for="">Pemilik Tambak</label>
                                    <select name="user_id" class="form-control">
                                        <option value=""> - Pilih Tambak </option>
                                        @foreach($user as $option)
                                            <option value=" {{ $option->id }} " {{ ($option->id == $input['user_id']) ? 'selected' : '' }} > {{ $option->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Tambak</label>
                                    <input type="text" class="form-control input-value" id="NamaTambak" name="nama_tambak" required value=" {{ old('nama_tambak', $input['nama_tambak']) }} ">
                                </div>

                                <div class="form-group">
                                    <label for="">No Telepon</label>
                                    <input type="text" class="form-control input-value" id="No_Telp" name="no_telp" required value=" {{ old('no_telp', $input['no_telp']) }} ">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control input-value" id="Alamat" name="alamat" required value=" {{ old('alamat', $input['alamat']) }} ">
                                </div>

                                @if(file_exists(public_path().'/storage/foto/'.$input['foto']))
                                
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <img src="{{ url('storage/foto/'. $input['foto']) }}" class="img-fluid">
                                    </div>
                                </div>

                                @endif
                                
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control input-value foto" id="Foto" accept="image/x-png,image/gif,image/jpeg" name="foto">
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