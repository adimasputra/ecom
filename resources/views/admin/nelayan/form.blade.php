<div class="row">
    <div class="col-md-12 form_content">
    <form method="post" enctype="multipart/form-data" id="form" action="{{route('nelayan.store')}}">
        {{csrf_field()}}
        <b>Data User</b>
        <hr>
        <input type="hidden" class="form-control input-value" id="iduser" name="iduser" required>
        <div class="col-md-6 form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control input-value" id="Nama" name="nama" required>
        </div>
       
        <div class="col-md-6 form-group">
            <label for="">Email</label>
            <input type="text" class="form-control input-value" id="Email" name="email" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="">Username</label>
            <input type="text" class="form-control input-value" id="Username" name="username" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="">Password</label>
            <input type="text" class="form-control input-value" id="Password" name="password" required>
        </div>
        <br>
        <br>
        <b>Data Tambak</b>
        <hr>
        <input type="hidden" class="form-control input-value" id="idtambak" name="idtambak" required>
        <div class="col-md-6 form-group">
            <label for="">Nama Tambak</label>
            <input type="text" class="form-control input-value" id="NamaTambak" name="nama_tambak" required>
        </div>
        <div id="imagePreview">
           
        </div>
        <div class="col-md-6 form-group">
            <label for="">Foto</label>
            <input type="file" class="form-control input-value" id="Foto" class="file" accept="image/x-png,image/gif,image/jpeg" name="foto" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="">No Telepon</label>
            <input type="text" class="form-control input-value" id="No_Telp" name="no_telp" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="">Alamat</label>
            <input type="text" class="form-control input-value" id="Alamat" name="alamat" required>
        </div>
                
    </div> 
    </form>
       
            
</div>
<script>
    
</script>