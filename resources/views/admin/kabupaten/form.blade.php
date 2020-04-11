@extends('admin.template')
@section('title')
Kabupaten
@endsection

@section('breadcumb')
Form Kabupaten
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Form Kabupaten
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" id="form" action="{{ (!isset($input['id'])) ? route('kabupaten.store') : route('kabupaten.update', ['id' => $input['id']]) }}">
                                {{csrf_field()}}

                                @isset($input['id'])
                                    {{ method_field('PUT')}}
                                @endisset
                               
                               
                               
                                <div class="form-group">
                                    <label for="">Nama Kabupaten</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="Nama" name="nama" required value=" {{ old('nama', $input['nama']) }} ">
                                </div>

                                <div class="form-group">
                                    <label for="">Jumlah Ongkir</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="Ongkir" name="ongkir" required value=" {{ old('ongkir', $input['ongkir']) }} ">
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