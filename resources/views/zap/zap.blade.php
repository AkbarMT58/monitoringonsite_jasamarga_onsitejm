@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">ZAP Web JM List</h4>
                    <p class="mb-0">ZAP 16 Web App JM<br>
                         </p>
                </div>
                
            </div>
        </div>


       
     
                <div class="col-md-3 mb-5">

               <input type="date" class="form-control" id="dateFrom"  placeholder="Tanggal Dari"/>

                </div>

                <div class="col-md-3 mb-5">

                <input type="date" class="form-control" id="dateTo"  placeholder="Tanggal Dari"/>

                </div>
                <div class="col-md-3 mb-5">



                <a onclick="laporan_zap()" class="btn btn-danger add-list"><i class="ri-file-pdf-fill" ></i> Print</a>

                </div>
                <div class="col-md-3 mb-5">

                <a href="{{ route('create_zap') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus mr-3"></i>Add +</a>
                <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link ZAP " href="{{route('zap')}}">Kembali <i class="ri-arrow-left-circle-fill"></i>
                </a>

                </div>



               
                  
                    
                    
               

        {{-- <div class="col-lg-12">
            <form action="{{ route('customers.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Row:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search customer" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Nama Aplikasi</th>
                            <th>High</th>
                            <th>Medium</th>
                           
                            <th>Low</th>
                            <th>Link Capture</th>
                            <th>Tanggal Cetak</th>
                            <th>Dokumen ZAP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($performatesting as $testing)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>@if($testing->kategori_aplikasi=='1'){{'SELIA'}}@elseif($testing->kategori_aplikasi=='2'){{'CSIRT'}}@elseif($testing->kategori_aplikasi=='3'){{'JMGUEST'}}@elseif($testing->kategori_aplikasi=='4'){{'JMLINK'}}@elseif($testing->kategori_aplikasi=='5'){{'JM INNOV'}}@elseif($testing->kategori_aplikasi=='6'){{'JIMMS'}}@else {{'belum terdaftar'}} @endif </td>
                            <td>{{$testing->high}}   <img src="../assets/images/product/danger.png" width="20px" height="30px" class="img-fluid" alt="image"></td>
                            <td> {{$testing->medium}}  <img src="../assets/images/product/warning.png" width="20px" height="30px" class="img-fluid" alt="image"></td>
                            <td>{{ $testing->low }}<img src="../assets/images/product/down.png"  width="20px" height="30px" class="img-fluid" alt="image"></td>
                           
                            <td>{{ $testing->link_capture}}</td>
                            <td>{{ $testing->tanggal_cetak}}</td>
                            <td><a href="{{url('assets/images/dokumen/zap')}}{{'/'}}{{$testing->file_zap_name}}" target="_blank"  class=" btn btn-danger"><i class="ri-file-pdf-fill"></i>PDF</a></td>
                            <td>
                               
                                    @csrf
                                    <div class="d-flex align-items-center list-action">
                                        <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                          href="{{ route('zap.edit', $testing->id) }}"><i class="ri-pencil-line mr-0"></i>
                                        </a>
                                        <a href="{{url('zap/delete')}}{{'/'}}{{$testing->id}}" type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ri-delete-bin-line mr-0"></i></a>
                                    </div>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $performatesting->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>

    function laporan_performatesting(){

                $.ajax({
                url: `laporan_performa`,
                data: {
                    "tanggal_Dari": "",
                    "tanggal_Ke":"",
                    "_token":"{{ csrf_token()}}",

                },
                
                type: "POST",
              
                xhrFields: {
            responseType: 'blob'
        },
                success:function(response, status, xhr){


                    console.log("lihat data pdf:",response);

                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');

                        if (disposition) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                        }
                        var linkelem = document.createElement('a');
                        try {
                                                var blob = new Blob([response], { type: 'application/octet-stream' });

                            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                window.navigator.msSaveBlob(blob, filename);
                            } else {
                                var URL = window.URL || window.webkitURL;
                                var downloadUrl = URL.createObjectURL(blob);

                                if (filename) {
                                    // use HTML5 a[download] attribute to specify filename
                                    var a = document.createElement("a");

                                    // safari doesn't support this yet
                                    if (typeof a.download === 'undefined') {
                                        window.location = downloadUrl;
                                    } else {
                                        a.href = downloadUrl;
                                        a.download = filename;
                                        document.body.appendChild(a);
                                        a.target = "_blank";
                                        a.click();
                                    }
                                } else {
                                    window.location = downloadUrl;
                                }
                            }

                        } catch (ex) {
                            console.log(ex);
                        }

                        toastr.success('Report Berhasil Didownload.Terima Kasih');




}


                });

}



function laporan_zap(){

$.ajax({
url: `laporan_zap`,
data: {
    "tanggal_Dari": "",
    "tanggal_Ke":"",
    "_token":"{{ csrf_token()}}",

},

type: "POST",
xhrFields: {
responseType: 'blob'
},
success:function(response, status, xhr){


    console.log("lihat data pdf:",response);

        var filename = "";
        var disposition = xhr.getResponseHeader('Content-Disposition');

        if (disposition) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
        }
        var linkelem = document.createElement('a');
        try {
                                var blob = new Blob([response], { type: 'application/octet-stream' });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");

                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.target = "_blank";
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }
            }

        } catch (ex) {
            console.log(ex);
        }

        toastr.success('Report ZAP Berhasil Didownload.Terima Kasih');




}


});

}



</script>

@endsection
