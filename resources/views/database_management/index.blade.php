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
                    <h4 class="mb-3">Dashboard Management Backup List</h4>
                    <p class="mb-0"> 16 Web App JM<br>
                         </p>
                </div>
                
            </div>
             <div class="card-body">
                        <!-- Alert Messages -->
                        <div id="alertMessage"></div>
                        
                        <!-- Info Card -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Informasi:</strong> Backup otomatis dijadwalkan setiap jam 2 malam. 
                            File backup disimpan di folder <code> : storage/app/backups/</code>
                        </div>

                </div>
             </div>
                <div class="col-md-3 mb-5">

               <input type="date" class="form-control" id="dateFrom"  placeholder="Tanggal Dari"/>

                </div>

                <div class="col-md-3 mb-5">

                <input type="date" class="form-control" id="dateTo"  placeholder="Tanggal Dari"/>

                </div>
                <div class="col-md-5 mb-5">

                <a  class="btn btn-danger add-list"><i class="ri-file-pdf-fill" ></i> Search</a>

              
                
                <a id="btnBackup" class="btn btn-primary add-list"><i class="fa-solid fa-plus"></i>Backup Now</a>
                <a class="btn btn-success add-list mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link TK" href="{{route('database')}}">Kembali <i class="ri-arrow-left-circle-fill"></i>
                </a>

                </div>

        

      <div class="col-lg-12">

       <div class="col-md-3 mb-5">

       Aktivasi Backup Otomatik :
       <br>
       <br>

    <label class="sliderLabel">
	<input type="checkbox" checked/>
	<span class="slider">
	<span class="sliderOn">ON</span>
	<span class="sliderOff">OFF</span>
	<span class="sliderBlock"></span>
	</span>
	</label>
                </div>

     </div>
        
      



               
    
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No</th>
                                        <th>Nama Backup</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>Ukuran File</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                       @forelse($backups as $index => $backup)
                                    <tr>
                                        <td>{{ $backups->firstItem() + $index }}</td>
                                        <td>
                                            <small>{{ $backup->backup_name }}</small>
                                        </td>
                                        <td>
                                            <small>{{ $backup->backup_completed_at ? $backup->backup_completed_at->format('d/m/Y H:i:s') : '-' }}</small>
                                            <br>
                                            <small class="text-muted">Mulai: {{ $backup->backup_started_at ? $backup->backup_started_at->format('H:i:s') : '-' }}</small>
                                        </td>
                                        <td>{{ $backup->file_size ?? '-' }}</td>
                                        <td>{{ $backup->backup_duration_seconds ? $backup->backup_duration_seconds . ' detik' : '-' }}</td>
                                        <td>
                                            @if($backup->status == 'success')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Sukses
                                                </span>
                                            @elseif($backup->status == 'failed')
                                                <span class="badge bg-danger" title="{{ $backup->error_message }}">
                                                    <i class="fas fa-times-circle"></i> Gagal
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-spinner fa-spin"></i> Proses
                                                </span>
                                            @endif
                                        </td>
                                         @csrf
                                        <td>
                                            <div  role="group">
                                                @if($backup->status == 'success')
                                                    <a href="{{ route('backup.download', $backup->id) }}" 
                                                       class="badge bg-success" 
                                                       title="Download">Download
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <a 
                                                            class="badge bg-danger btn-delete" 
                                                            data-id="{{ $backup->id }}"
                                                            data-name="{{ $backup->backup_name }}"
                                                            title="Hapus">Hapus
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="fas fa-database fa-3x text-muted mb-3"></i>
                                            <p class="mb-0">Belum ada data backup</p>
                                            <small class="text-muted">Klik tombol "Backup Now" untuk memulai backup pertama</small>
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

<!-- Modal Progress Loading -->
    <div id="progressModal" class="progress-loading">
        <div class="progress-content">
            <h5 class="mb-3">
                <i class="fas fa-spinner fa-spin me-2"></i>
                Sedang Backup Database...
            </h5>
            <div class="progress mb-3" style="height: 30px;">
                <div id="progressBar" class="progress-bar progress-bar-custom bg-success progress-bar-striped progress-bar-animated" 
                     role="progressbar" 
                     style="width: 0%">
                    0%
                </div>
            </div>
            <p class="text-muted mb-0" id="progressText">
                <i class="fas fa-hourglass-half me-1"></i>
                Mohon tunggu, proses backup sedang berjalan...
            </p>
        </div>
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
                
                read_daftarwebjm();

                
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
                            }, 2000);
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
                                setTimeout(() => location.reload(), 3000);
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


    function read_daftarwebjm(){

            
                
                        $.ajax({
                        url: `backup/process`,
                        type: 'GET',
                      
                         headers: {
                        
                       
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        
                        },
                       success: function(response) {
                        console.log("lihat daftar:",response);

                        if (response.success) {
                            // Start polling for progress
                            showAlert('success', response.message);
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


                        })


            }

                       
                    
                  
              

               


                



            


           


           
    
     });


</script>

@endsection
