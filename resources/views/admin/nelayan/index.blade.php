@extends('admin.template')
@section('title')
Nelayan
@endsection

@section('breadcumb')
Nelayan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
@endsection

@section('content')

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.nelayan.form')
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary btn-submit">Simpan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Data Nelayan
                    </div>
                    <div class="card-tools">
                        <a  href="#"data-toggle="modal" data-target="#modal-lg" class="btn btn-primary btn-tambah">Tambah Data <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <br>
                    <div>
                      <table id="Table" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <!-- <th>Foto</th> -->
                            
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
      
                        </tbody>
                       
                      </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>

    $(document).ready(function(){
        $('.linelayan').addClass('active');
        console.log($('#Foto').prop('files'))
       
    })
    var Filefoto;
    $('#Foto').change(function(){
        var fileInput = this;
            console.log(fileInput.files[0])
            Filefoto = fileInput.files[0];
        var filePath = fileInput.value;
        
        
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" width="250px" heighth="250px"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
    })
    var Table =  $('#Table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                ajax: '{!! route('nelayan.datatable') !!}',
                columns:[
                  {'data': 'nama'},
                  {'data': 'email'},
                  {'data': 'no_telp'},
                  {'data': 'alamat'},
                  {
                    data:"iduser",
                    
                    render: function(data, type, row){
                      
                        var button = `<a class="btn btn-warning btn-edit" data-id=":id"><i class="fa fa-edit text-white"></i></a>
                                      <a class="btn btn-danger btn-delete" data-id=":idhapus"><i class="fa fa-trash text-white"></i></a>
                        `
                                button = button.replace(':id',data);
                                button = button.replace(':idhapus',data);
                        return button;
                    }
                  }
                  
                ],
                "order": [[1,'asc']],
    
                rowId: 'id',
               
            });

    $('.btn-tambah').on('click', function(){
        $('.input-value').val("");
    })
    $('.btn-submit').on('click', function(){
            var checkrequired = $('input,textarea,select').filter('[required]:visible')
            var isValid = true;
            
            $(checkrequired).each( function() {
                    if ($(this).parsley().validate() !== true) isValid = false;
            });
            if(!isValid){
                return;
            }
            
            urlsnya = '{{route('nelayan.store')}}';
            _token = $('.form_content').find('input[name=_token]').val();
            form = $('.form_content').find('.input-value');
            var arr= {};
           
            var file = new FormData();
             file.append('file', Filefoto);
             $.each(form,function(k,value){
                file.append(value.name,value.value);
               
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                contentType: false,
                processData: false,
                dataType: 'json',
                data: file,
                url: urlsnya,
            })
            .done(function(response) {
                if(response == 1){
                    toastr.success('Data berhasil disimpan')
                    Table.ajax.reload();
                    $('#modal-lg').modal('hide');
                    $('.input-value').val("");
                    $(checkrequired).each( function() {
                        $(this).parsley().reset();
                    });
                }
            })
            .fail(function() {
                $.alert('process fail');
            })
            .always(function() {
                console.log("complete");
            });
        });

        $(document).on('click', '.btn-edit', function(){
            
            var id = this.attributes['data-id'].value;

            $('.form-password').remove();
            $('#Foto').removeAttr('required');


            var urlsnya = '{{ route("nelayan.edit", ['id'=>":id"]) }}';
            urlsnya = urlsnya.replace(':id', id);
            $.ajax({
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                url: urlsnya,
            })
            .done(function(response){
                console.log(response[0])
                $('#modal-lg').modal()
                $('#iduser').val(response[0]['iduser'])
                $('#Nama').val(response[0]['nama'])
                $('#Username').val(response[0]['username'])
                $('#Email').val(response[0]['email'])
                $('#NamaTambak').val(response[0]['nama_tambak'])
                $('#No_Telp').val(response[0]['no_telp'])
                $('#Alamat').val(response[0]['alamat'])
                $('#imagePreview').append(`<img src="{{asset('img/')}}/`+response[0]['foto']+`" width="250px" heighth="250px"/>`)
            })
        })

        $(document).on('click', '.btn-delete', function(){
            var id = this.attributes['data-id'].value;
            var urlsnya = '{{ route("nelayan.destroy", ":id") }}';
                urlsnya = urlsnya.replace(':id', id);
            $.confirm({
                theme: 'material',
                title: 'Warning!',
                content: 'Apakah anda yakin ingin menghapus data ?',
                buttons: {
                    Yes: function () {
                        $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}",
                            _method: 'DELETE'
                        },
                        url: urlsnya,
                        })
                        .done(function(response) {
                            if(response == 1) {
                                toastr.error('Data berhasil dihapus')
                                Table.ajax.reload();
                            }
                        })
                        .fail(function() {
                            $.alert('Delete process fail');
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