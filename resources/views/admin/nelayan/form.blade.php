@extends('admin.template')
@section('title')
Nelayan
@endsection

@section('breadcumb')
Nelayan
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Form Nelayan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" id="form" action="{{ (!isset($inputuser['id'])) ? route('nelayan.store') : route('nelayan.update', ['id' => $inputuser['id']]) }}">
                                {{csrf_field()}}

                                @isset($inputuser['id'])
                                    {{ method_field('PUT')}}
                                @endisset
                                <b>Data User</b>
                                <hr>
                                
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="Nama" name="nama" required value=" {{ old('nama', $inputuser['nama']) }} ">
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="Email" name="email" required value=" {{ old('email', $inputuser['email']) }} ">
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="Username" name="username" required value=" {{ old('username', $inputuser['username']) }} ">
                                </div>
                                <div class="form-group form-password">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control col-md-6 input-value" id="Password" name="password" required>
                                </div>
                                @isset($inputuser['id'])
                                <a  class="btn btn-warning change">Ubah Password</a>
                                <hr class="form-newpassword" hidden>
                                <div class="form-group form-newpassword" hidden>
                                    <label for="">Password Baru</label>
                                    <input type="password" class="form-control col-md-6 input-value" id="PasswordBaru" name="passwordbaru" >
                                </div>
                                <div class="form-group form-newpassword" hidden>
                                    <label for="">Konfirmasi Password</label>
                                    <input type="password" class="form-control col-md-6 input-value" id="KonPassword" name="konpassword" >
                                    <span class="pesan" style="color:red;" hidden>Password tidak sama, silahkan coba lagi</span>
                                </div>
                                <a  class="btn btn-warning cancel-change form-newpassword" hidden>Batal Ubah Password</a>
                                @endisset

                                @if(!$inputuser['username'])
                                <br>
                                <br>
                                <b>Data Tambak</b>
                                <hr>
                                <input type="hidden" class="form-control col-md-6 input-value" id="idtambak" name="idtambak" required>
                                <div class="form-group">
                                    <label for="">Nama Tambak</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="NamaTambak" name="nama_tambak" required>
                                </div>
                                <div id="imagePreview">
                                   
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control col-md-6 input-value foto" id="Foto" accept="image/x-png,image/gif,image/jpeg" name="foto" required>
                                </div>
                                <div class="form-group">
                                    <label for="">No Telepon</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="No_Telp" name="no_telp" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control col-md-6 input-value" id="Alamat" name="alamat" required>
                                </div>
                                        
                                @endif
                                

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
    $(document).ready(function(){
        $('.linelayan').addClass('active');
        @if(session('error'))
            toastr.error("{!! session('error') !!}")
       @endif
        $('.change').click(function(){
            $(this).hide();
            $('.form-newpassword').removeAttr('hidden');
            $('.cancel-change').show()
        })
        $('.cancel-change').click(function(){
            $(this).hide();
            $('.change').show();
            $('.form-newpassword').attr('hidden','hidden');
        })
    })
   
</script>
    
@endsection
