@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Signature</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('signatures.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @foreach($signatures as $data_signature)
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-12">
                                <input type="text" id="id" name="id" value="{{$data_signature->id}}" hidden/>
                                <label for="name">Nama Karyawan <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="employee_id" name="employee_id" value="{{ old('employee_id') }}"  >
                                
                                <option value="0">--Pilih Nama Karyawan--</option>

                            
                                @foreach($employees as $datakaryawan)

                                 <option value="{{$datakaryawan->id}}" {{ old('id') ? 'selected' : '' }}{{$datakaryawan->id==$data_signature->employee_id ? 'selected' : '' }} >{{$datakaryawan->name}}</option>

                                
                                @endforeach
                               

                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="slug">Kategori Jabatan <span class="text-danger">*</span></label>
                            
                                <select  class="form-control" id="kategori_jabatan" name="kategori_jabatan" value="{{ old('kategori_jabatan') }}"  >
                              

                                @if($data_signature->kategori_jabatan=='1')


                                <option value="1">Web Functional Support</option>

                                @elseif($data_signature->kategori_jabatan=='2')
                                <option value="2">Support</option>
                                 @elseif($data_signature->kategori_jabatan=='3')
                                <option value="3">Admin Compliance</option>
                                 @elseif($data_signature->kategori_jabatan=='4')
                                <option value="4">Supervisor Onsite Kuantum</option>
                                 @elseif($data_signature->kategori_jabatan=='5')
                                <option value="5">Manajer/Direktur Onsite Kuantum</option>
                                 @elseif($data_signature->kategori_jabatan=='6')
                                <option value="6">Supervisor ITE JM</option>
                                 @elseif($data_signature->kategori_jabatan=='7')
                                <option value="7">Manajer/Direktur ITE JM</option>
                                @else 

                                {{''}}

                              
                                @endif

                                <option value="1">Web Functional Support</option>

                                <option value="2">Support</option>
                                
                                <option value="3">Admin Compliance</option>
                                
                                <option value="4">Supervisor Onsite Kuantum</option>
                                
                                <option value="5">Manajer/Direktur Onsite Kuantum</option>
                                
                                <option value="6">Supervisor ITE JM</option>
                                
                                <option value="7">Manajer/Direktur ITE JM</option>


                        
                                


                               </select>

                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-12">
                                <label for="slug">TTD Upload <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="ttd_link" id="ttd_link" accept="image/*" />
                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-12">
                                <label for="slug">Preview TTD <span class="text-danger">*</span></label>
                                <img src="{{url('assets/images/dokumen/signatures')}}{{'/'}}{{$data_signature->ttd_link}}" width="200px"/>
                                
                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('signatures') }}">Cancel</a>
                        </div>
                    </form>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g,"-");
        slug.value = preslug.toLowerCase();
    });
</script>

@include('components.preview-img-form')
@endsection
