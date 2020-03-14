@extends('template')
@section('title')
Login
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
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                        @endif
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Sign In</h2>
                            <p>Silahkan Masuk ke Dalam Akun</p>
                        </div>
                        <br>
                        <br>
                    <form action="{{route('login.submit')}}" class="form-horizontal col-md-offset-3" method="POST">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group col-md-9 ">
                                    <button class="btn btn-primary form-control" type="submit">Login</button>
                                </div>
                            </div>
                            
                        </form>
                        <br>
                         <span>Belum punya akun? <a href="{{route('register')}}"class="a">Daftar Sekarang</a></span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection