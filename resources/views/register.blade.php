@extends('template')
@section('title')
Daftar
@endsection
@section('link')
<style>
.a {
    color:#c43b68 !important;
}
</style>
@endsection
@section('content')
<section class="htc__category__area ptb--100" >
    <div class="container">
        <div class="row d-flex justify-content-center" >
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Sign Up</h2>
                            <p>Daftar Akun Baru</p>
                        </div>
                        <br>
                        <br>
                     <form action="{{route('register.submit')}}" class="form-horizontal col-md-offset-3" method="post" >
                        {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" required name="nama">
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" required name="email">
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" required name="username">
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="">Password</label>
                                    <input type="password"id="password"  class="form-control" required name="password">
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="">Konfirmasi Password</label>
                                    <input type="password" id="cpassword" class="form-control" required name="confirmpassword">
                                    <span class="pesan" style="color:red;" hidden>Password tidak sama, silahkan coba lagi</span>
                                </div>
                                <div class="form-group col-md-9 ">
                                    <button class="btn btn-primary submit form-control" type="submit">Daftar</button>
                                </div>
                            </div>
                            
                        </form>
                        <br>
                         <span>Sudah punya akun? <a href="{{route('login')}}" class="a">Login Sekarang</a></span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#cpassword').keyup(function(){
            if($(this).val() != $('#password').val() && $(this).val() != ""){
                $('.pesan').show();
                $('.submit').prop('disabled',true);
            }
            else{
                $('.pesan').hide();
                $('.submit').prop('disabled',false);
            }
        })
    })
</script>
@endsection