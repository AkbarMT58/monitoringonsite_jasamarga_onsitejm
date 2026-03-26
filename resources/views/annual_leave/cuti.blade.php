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
                    <h4 class="mb-3">Cuti All JM List</h4>
                    <p class="mb-0">Total Cuti<br>
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

                <a href="{{ route('cuti_index') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus mr-3"></i>Add +</a>
                <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link Cuti" href="{{route('cuti')}}">Kembali <i class="ri-arrow-left-circle-fill"></i>
                </a>

                </div>



               
                  
                    
                    
               

        <div class="col-lg-12">
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
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search  Nama" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20"></i>Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> 

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            
                            <th>Jumlah Cuti</th>
                            <th>Sisa Cuti</th>
                            <th>Alasan Cuti</th>
                            <th>Tanggal Cetak</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($cuti_all as $data)
                        <tr>
                            <td>{{$loop->iteration  }}</td>
                            <td>{{$data->employee->name}}</td>
                            <td>{{$data->jumlah_pengajuan_cuti}}</td>
                            <td>{{$data->sisa_cuti}} </td>
                            <td>{{ $data->alasan_cuti }}</td>
                            <td>{{ $data->tanggal_cetak}}</td>
                           
                            <td>
                               
                                    @csrf
                                    <div class="d-flex align-items-center list-action">
                                          <a class="btn btn-danger mr-2" data-toggle="tooltip" data-placement="top" onclick="printCuti({{$data->id}},1)" title="" data-original-title="Print PDF"
                                          ><i class="ri-file-pdf-fill" ><br><span style="font-size:10px;font-color:black;">JM PDF</span></i>
                                           <a class="btn btn-danger mr-2" data-toggle="tooltip" data-placement="top" onclick="printCuti({{$data->id}},2)" title="" data-original-title="Print PDF"
                                          ><i class="ri-file-pdf-fill" ><br><span style="font-size:10px;font-color:black;"> Kuantum PDF </span></i>
                                        <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                          href="{{ route('cuti.edit', $data->id) }}"><i class="ri-pencil-line mr-0"></i>
                                       
                                        </a>
                                        <a href="{{url('cuti/delete')}}{{'/'}}{{$data->id}}" type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ri-delete-bin-line mr-0"></i></a>
                                         <a href="{{url('cuti/send_email_atachment_kuantum')}}{{'/'}}{{$data->employee_id}}{{'/'}}{{$data->id}}{{'/'}}{{'2'}}" type="submit" class="btn btn-primary mr-2 border-none" onclick="return confirm('Are you sure you want to send email to kuantum for confirmation?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kirim Ke Kuantum"> Send Kuantum <i class="ri-mail-send-line"></i></a>
                                          <a href="{{url('cuti/send_email_atachment_jm')}}{{'/'}}{{$data->employee_id}}{{'/'}}{{$data->id}}{{'/'}}{{'1'}}" type="submit" class="btn btn-success mr-2 border-none" onclick="return confirm('Are you sure you want to send email to jasa marga for confirmation?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kirim Ke JM"> Send JM <i class="ri-mail-send-line"></i></a>
                                    </div>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
              {{ $cuti_all->links() }}
           
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


function printCuti(id_,kode_pt){
console.log("lihat id:", id_);

$.ajax({
url: `laporan_cuti`,
data: {
    "id":id_,
    "kode_pt":kode_pt,
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

        toastr.success('Report Pengajuan Cuti Berhasil Didownload.Terima Kasih');




}


});


}



</script>

@endsection
