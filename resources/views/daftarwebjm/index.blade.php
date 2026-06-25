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
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Daftar Web JM List</h4>
                    <p class="mb-0">Master data web jm </p>
                </div>
                <div>
                <a href="{{ route('create_webjm') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus mr-3"></i>Add New Web</a>
                <a href="{{ route('daftarwebjm.index') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash mr-3"></i>Clear Search</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('employees.index') }}" method="get">
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
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search web jm" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-fa search font-size-20">Search</i></button>
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
                            <th>No</th>
                                        <th>Nama Web JM</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>Nama Database</th>
                                        <th>Host </th>
                                        <th>Port</th>
                                        <th>Username & Password</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                   
                       @forelse($backups as $index => $backup)
                                    <tr>
                                        <td>{{ $backups->firstItem() + $index }}</td>
                                        <td>
                                            <small>{{ $backup->name_web }}</small>
                                        </td>
                                        <td>
                                            <small>{{ $backup->created_at->toIso8601String()  ??  '-' }}</small>
                                            <br>
                                            
                                        </td>
                                        <td>{{ $backup->name_web ?? '-' }}</td>
                                        <td>{{ $backup->host ?? '-' }}</td>
                                        <td>{{ $backup->port ?? '-' }}</td>
                                        <td>

                                        {{ $backup->username ?? '-' }}

                                        <br>
                                            
                                        <input type="password" value="{{ $backup->password ?? '-' }}" readonly /></td>
                                        <td>

                                           @if($backup->status == '1')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Aktif
                                                </span>
                                            @elseif($backup->status == '0')
                                                <span class="badge bg-danger" title="{{ $backup->error_message }}">
                                                    <i class="fas fa-times-circle"></i> Tidak Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-spinner fa-spin"></i> Proses
                                                </span>
                                            @endif


                                        </td>
                                        <td>

                                        <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                        href="{{ route('webjm.edit', $backup->id) }}">Edit<i class="ri-pencil-line mr-0"></i>
                                        </a>
                                        <a class="badge bg-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                        href="{{ route('webjm.destroy', $backup->id) }}">Hapus<i class="ri-delete-bin-line mr-0"></i>
                                        </a>


                                        </td>
                                       
                                         @csrf
                                       
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="fas fa-database fa-3x text-muted mb-3"></i>
                                            <p class="mb-0">Belum ada data </p>
                                            <small class="text-muted">Klik tombol "Add +" untuk memulai penambahan daftar web jm</small>
                                        </td>
                                    </tr>
                                    @endforelse                    </tbody>
                </table>
            </div>
            {{ $backups->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>


<script type="module">

     $(document).ready(function() {

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



function laporan_tk(){

$.ajax({
url: `laporan_tk`,
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


 let progressInterval = null;
            
            // Backup button click
            $('#btnBackup').click(function() {
                startBackup();
            });
            
            function startBackup() {
                // Show progress modal
                $('#progressModal').fadeIn();
                updateProgress(0);
                
                $.ajax({
                    url: `backup/process`,
                  
                    type: 'POST',
                    headers: {
                        
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        
                    },

                    
                    success: function(response) {
                        if (response.success) {
                            // Start polling for progress
                            progressInterval = setInterval(checkProgress, 1000);
                        } else {
                            hideProgressModal();
                            showAlert('danger', response.message);
                        }
                    },
                    error: function(xhr) {
                        hideProgressModal();
                        let errorMsg = xhr.responseJSON?.message || 'Terjadi kesalahan saat backup';
                        showAlert('danger', errorMsg);
                    }
                });
            }
            
            function checkProgress() {
                $.ajax({
                    url: `backup/progress`,
                    type: 'GET',
                    success: function(response) {
                        updateProgress(response.progress);
                        
                        // If progress is 100% or backup_id is null, stop polling
                        if (response.progress >= 100 || !response.backup_id) {
                            clearInterval(progressInterval);
                            setTimeout(function() {
                                hideProgressModal();
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function() {
                        clearInterval(progressInterval);
                        hideProgressModal();
                        showAlert('danger', 'Gagal mendapatkan progress backup');
                    }
                });
            }
            
            function updateProgress(percent) {
                $('#progressBar').css('width', percent + '%').text(percent + '%');
                
                let text = '';
                if (percent < 30) {
                    text = 'Mempersiapkan backup...';
                } else if (percent < 60) {
                    text = 'Meng-export data database...';
                } else if (percent < 90) {
                    text = 'Menyimpan file backup...';
                } else {
                    text = 'Menyelesaikan proses backup...';
                }
                $('#progressText').html('<i class="fas fa-hourglass-half me-1"></i>' + text);
            }
            
            function hideProgressModal() {
                $('#progressModal').fadeOut();
                updateProgress(0);
            }
            
            function showAlert(type, message) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                $('#alertMessage').html(alertHtml);
                
                setTimeout(() => {
                    $('.alert').fadeOut();
                }, 5000);
            }
            
            // Delete backup
            $('.btn-delete').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                
                if (confirm(`Apakah Anda yakin ingin menghapus backup "${name}"?`)) {
                    $.ajax({
                        url: `backup/delete/${id}`,
                        type: 'DELETE',
                        headers: {
                        'Content-Type': 'application/json',
                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                showAlert('success', response.message);
                                setTimeout(() => location.reload(), 1500);
                            } else {
                                showAlert('danger', response.message);
                            }
                        },
                        error: function() {
                            showAlert('danger', 'Gagal menghapus backup');
                        }
                    });
                }
            });
    
     });


</script>

@endsection
