@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
              @if (session()->has('error'))
                <div class="alert text-white bg-error" role="alert">
                    <div class="iq-alert-text">{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create Daftar Web JM</h4>
                    </div>
                </div>

                <div class="card-body">
                   
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-12">
                                <label for="nama_database">Nama Web<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="nama_web" name="nama_web"  placeholder="Nama Web" required/>
                              
                                @error('nama_database')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nama_database">Nama Database <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="nama_database" name="nama_database"  placeholder="Nama Database" required/>
                              
                                @error('nama_database')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nama_host">Nama Host<span class="text-danger">*</span></label>
                               <input type="text" class="form-control" id="nama_host" name="nama_host"  placeholder="Nama Host" required/>
                              
                                @error('nama_host')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="port">Port<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="port" name="port"  placeholder="Isi Port " required/>
                              
                                @error('port')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-12">
                                <label for="username">Username <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="username" name="username"  placeholder="Isi Username "  />
                              
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-12">
                                <label for="nama_password">Password <span class="text-danger">*</span></label>
                              <input type="password" class="form-control" id="nama_password" name="nama_password"  placeholder="Isi Password "   onfocus="this.removeAttribute('readonly');" />
                              
                                @error('nama_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit"  id="simpandaftarweb"  class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('webjm') }}">Cancel</a>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script type="module">

    // Inside your JavaScript file
document.getElementById("simpandaftarweb").addEventListener("click", function() {

                    const web_name=document.getElementById('nama_web').value; 
                    const database_name=document.getElementById('nama_database').value; 
                    const nama_host=document.getElementById('nama_host').value; 
                    const nama_port=document.getElementById('port').value; 
                    const password=document.getElementById('nama_password').value; 


                    $.ajax({
                    url: `create_webjm/save`,
                    type: "POST",
                    
                    data: {
                        "nama_web":web_name,
                        "name_database":database_name,
                        "host":nama_host,
                        "port":nama_port,
                        "password":password,
                        "status":1,
                       
                         "_token":"{{ csrf_token()}}",
                         
                    },
                     headers: {
                        
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        
                    },
                   
                   
                    success:function(response){

                          if(response.status='200'){


                           toastr.success('Daftar aplikasi web JM sudah ditambahkan.Terima Kasih');
                          
                           location.href="/webjm";


                          }

                       
                            

                                 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                      console.log("lihat error:", jqXHR.statusText);

                           if( jqXHR.status=='400'){


                           toastr.error('Daftar aplikasi web JM gagal ditambahkan.Ada error kesalahan di request permintaan ' + "'"+errorThrown+"'");
                          }

                    }


                    });

    
});
  
 

      
</script>

@include('components.preview-img-form')
@endsection
