<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\TK;
use App\Models\PerformaAksesLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BackupHistory;
use Illuminate\Support\Facades\File;
use App\Models\DaftarWebJM;
use App\Models\Existing;
use Carbon\Carbon;


class DatabaseManagementController extends Controller
{
    public function index(){

        return view('database_management.database_backup', [
            'total_paid' => Order::sum('pay'),
            'total_due' => Order::sum('due'),
            'complete_orders' => Order::where('order_status', 'complete')->get(),
            'products' => Product::orderBy('product_store')->take(5)->get(),
            'new_products' => Product::orderBy('buying_date')->take(2)->get(),
             'backups' =>BackupHistory::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
       

        $row = (int) request('row', 10);

       
        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('database_management.index', [
            'backups' => BackupHistory::sortable()
                ->select('*')
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);
    }

    public function edit(Int $id)
    {
    
        $performatesting = TK::select('*')->where('id',$id)->get();

        return view('transfer_knowledge.edit', [
            'performatesting' => $performatesting,
        ]);

      
    }

    public function create_backup(Request $request){

      try {
            $backupHistory = BackupHistory::create([
                'backup_name' => 'backup_' . date('Y-m-d_H-i-s') . '.sql',
                'backup_path' => '',
                'status' => 'processing',
                'backup_started_at' => now(),
            ]);

            // Simpan progress ke session
            session(['backup_progress' => 10]);
            session(['backup_id' => $backupHistory->id]);

            // Konfigurasi database
            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbPort = env('DB_PORT', '3306');
            $dbName = env('DB_DATABASE', 'monitoring_onsite');
            $dbUser = env('DB_USERNAME', 'root');
            $dbPass = env('DB_PASSWORD', '');
            $backupPath = storage_path('app/backups/');

            // Buat direktori backup jika belum ada
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            session(['backup_progress' => 30]);

            $backupFileName = $backupHistory->backup_name;
            $backupFileFullPath = $backupPath . $backupFileName;

            // Backup menggunakan mysqldump
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s --port=%s %s > %s 2>&1',
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbHost),
                escapeshellarg($dbPort),
                escapeshellarg($dbName),
                escapeshellarg($backupFileFullPath)
            );

            session(['backup_progress' => 60]);

            // Eksekusi command backup
            $output = [];
            $returnVar = null;
            exec($command, $output, $returnVar);

            session(['backup_progress' => 90]);

            if ($returnVar === 0 && File::exists($backupFileFullPath)) {
                // Hitung ukuran file
                $fileSize = File::size($backupFileFullPath);
                $fileSizeFormatted = $this->formatFileSize($fileSize);

                // Hitung durasi backup
                $duration = now()->diffInSeconds($backupHistory->backup_started_at);

                // Update history backup
                $backupHistory->update([
                    'backup_path' => 'backups/' . $backupFileName,
                    'file_size' => $fileSizeFormatted,
                    'status' => 'success',
                    'backup_completed_at' => now(),
                    'backup_duration_seconds' => $duration
                ]);

                session(['backup_progress' => 100]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Backup database berhasil!',
                    'backup_id' => $backupHistory->id
                ]);
            } else {
                throw new \Exception('Gagal melakukan backup: ' . implode("\n", $output));
            }

        } catch (\Exception $e) {
            if (isset($backupHistory)) {
                $backupHistory->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'backup_completed_at' => now()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


    function read_masterdata_daftarwebjm(){

     $get_datawebjm=DaftarWebJM::orderBy('created_at', 'desc')->get();

     
    return response()->json(['data'=>$get_datawebjm,'status'=> 200], 200);
            

    }


    function tk_report(Request $request){

        $row = (int) request('row', 10);

        $data_=TK::sortable()->select('*')->orderBy('id', 'asc')->get();

        $data = [

            'data_'  =>$data_,
           

        ];


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }



        $pdf = PDF::loadView('reports.report_tk', $data);
        $pdf=  $pdf->set_option('isRemoteEnabled', true);
        $pdf=  $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        // Parameters
        $x          = 400;
        $y          = 550;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
        $font       = $pdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 10;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $pdf->getCanvas()->page_text(
        $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

       
    
        $pdf = $pdf->download('laporan_tk.pdf');

       
         return $pdf;

    }


    function hapus_removetk($id){

        $kode_id=$id;

        TK::where('id',$kode_id)->delete();

        return Redirect::route('tk_index')->with('success', 'TK with id '.$kode_id.' has been deleted!');

    }


    public function startBackup(Request $request){

    try {


   
       // 1. Cek apakah tabel/data sudah ada
        // if (count(Existing::all())!=0) {
        //     return response()->json([
        //         'success' => 'false',
        //         'message' => 'Kondisi sudah ada, data tidak ditambahkan.'
        //     ], 500);
        // }else{

   
        // $this->backupDatabase($request);

      
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Data berhasil dimasukkan.'
        // ], 200);

        // }

    // if (count($existing_data) == 0) {

    //  $this->backupDatabase($request);

    // return response()->json([
    //                         'success' => true,
    //                         'message' => 'Backup database berhasil!',
                        
    //                     ]);
  
    //  }
    
    // elseif (!empty($existing_backup)) {

    //       return response()->json([
    //                     'success' => false,
    //                     'message' => 'Error: ' . 'Database sudah ada dan hanya mengupdate database di tanggal,bulan,tahun yang sama'
    //                 ], 500);

        
    // }
    
    // else {
    //         // Logika jika database SUDAH ADA ISI
          
    //         return response()->json([
    //                     'success' => false,
    //                     'message' => 'Error: ' . 'Ada kesalahan dalam backup'
    //                 ], 500);

    //     }

      
      
     

    } catch (\Exception $e) {
           
              return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);

        }


    }


    // Proses backup database dengan progress
    public function backupDatabase(Request $request)
    {
        try {

        
            date_default_timezone_set("Asia/Jakarta");
            $tgl = date("d");
            $month = date("m");
            $years = date("Y");

            $existing_tgl_bln_thn=Existing::where('dd','=',$tgl)->where('mm','=',$month)->where('yy','=',$years)->get();
            $existing_backup=Existing::where('dd',$tgl)->where('mm',$month)->where('yy',$years)->where('status','success')->get();
            $existing_data=BackupHistory::all();
            $get_datawebjm=DaftarWebJM::orderBy('created_at', 'desc')->get();

             if(count($existing_data)== 0){

            for ($i = 0; $i < count($get_datawebjm); $i++) {

            $db_App=$get_datawebjm[$i]['name_web'];
            $db_backup_id=$get_datawebjm[$i]['id'];
            $db_HOST=$get_datawebjm[$i]['host'];
            $db_PORT=$get_datawebjm[$i]['port'];
            $db_Name=$get_datawebjm[$i]['name_database'];
            $db_User =$get_datawebjm[$i]['username'];
            $db_Pass =$get_datawebjm[$i]['password'];

             date_default_timezone_set("Asia/Jakarta");
             $waktu = date("Y-m-d_H-i-s");


             $databackup=[
                'app_id'=>$db_backup_id,
                'backup_name' => 'backup_monitoring_onsite_' .$db_App .'_' .$waktu . '.sql',
                'backup_path' => '',
                'status' => 'processing',
                'backup_started_at' => now(),
            ];



             $backupHistory = BackupHistory::create($databackup);

            // Simpan progress ke session
            session(['backup_progress' => 10]);
            session(['backup_id' => $backupHistory->id]);

            // Konfigurasi database
            $dbHost = $db_HOST;
            $dbPort = $db_PORT;
            $dbName = $db_Name;
            $dbUser = $db_User;
            $dbPass = $db_Pass;
            $backupPath = storage_path('app/backups/');

            // Buat direktori backup jika belum ada
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            session(['backup_progress' => 30]);

            $backupFileName = $backupHistory->backup_name;
            $backupFileFullPath = $backupPath . $backupFileName;

            // Backup menggunakan mysqldump
            $command = sprintf(
                
                 'mysqldump --user=%s --password=%s --host=%s %s > %s',
               
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbHost),
                escapeshellarg($dbName),
                escapeshellarg($backupFileFullPath)
            );

        
            session(['backup_progress' => 60]);

            // Eksekusi command backup
            $output = [];
            $returnVar = null;
            exec($command, $output, $returnVar);

            session(['backup_progress' => 90]);

            if ($returnVar === 0 && File::exists($backupFileFullPath)) {
                // Hitung ukuran file
                $fileSize = File::size($backupFileFullPath);
                $fileSizeFormatted = $this->formatFileSize($fileSize);

                // Hitung durasi backup
                $duration = now()->diffInSeconds($backupHistory->backup_started_at);
               
                // Update history backup
                $backupHistory->update([
                    'app_id'=>$get_datawebjm[$i]['id'],
                    'backup_path' => 'backups/' . $backupFileName,
                    'file_size' => $fileSizeFormatted,
                    'status' => 'success',
                    'backup_completed_at' => now(),
                    'backup_duration_seconds' => $duration
                ]);

                
                session(['backup_progress' => 100]);


                //  return response()->json([
                //     'success' => true,
                //     //  'data'=> $databackup,
                //     'message' => 'Backup database berhasil!',
                //      'backup_id' => $backupHistory->id
                // ]);


        
            
            } 
            
             
            
            }
           
             
             }

              elseif(count($existing_tgl_bln_thn)!=0){


                return response()->json([
                'success' => false,
                'message' => 'Error: ' . 'Database sudah ada atau exist!'
            ], 500);
           

              }elseif(count($existing_tgl_bln_thn)==0){

              for ($i = 0; $i < count($get_datawebjm); $i++) {

            $db_App=$get_datawebjm[$i]['name_web'];
            $db_backup_id=$get_datawebjm[$i]['id'];
            $db_HOST=$get_datawebjm[$i]['host'];
            $db_PORT=$get_datawebjm[$i]['port'];
            $db_Name=$get_datawebjm[$i]['name_database'];
            $db_User =$get_datawebjm[$i]['username'];
            $db_Pass =$get_datawebjm[$i]['password'];

             date_default_timezone_set("Asia/Jakarta");
             $waktu = date("Y-m-d_H-i-s");


             $databackup=[
                'app_id'=>$db_backup_id,
                'backup_name' => 'backup_monitoring_onsite_' .$db_App .'_' .$waktu . '.sql',
                'backup_path' => '',
                'status' => 'processing',
                'backup_started_at' => now(),
            ];



             $backupHistory = BackupHistory::create($databackup);

            // Simpan progress ke session
            session(['backup_progress' => 10]);
            session(['backup_id' => $backupHistory->id]);

            // Konfigurasi database
            $dbHost = $db_HOST;
            $dbPort = $db_PORT;
            $dbName = $db_Name;
            $dbUser = $db_User;
            $dbPass = $db_Pass;
            $backupPath = storage_path('app/backups/');

            // Buat direktori backup jika belum ada
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            session(['backup_progress' => 30]);

            $backupFileName = $backupHistory->backup_name;
            $backupFileFullPath = $backupPath . $backupFileName;

            // Backup menggunakan mysqldump
            $command = sprintf(
                
                 'mysqldump --user=%s --password=%s --host=%s %s > %s',
               
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbHost),
                escapeshellarg($dbName),
                escapeshellarg($backupFileFullPath)
            );

        
            session(['backup_progress' => 60]);

            // Eksekusi command backup
            $output = [];
            $returnVar = null;
            exec($command, $output, $returnVar);

            session(['backup_progress' => 90]);

            if ($returnVar === 0 && File::exists($backupFileFullPath)) {
                // Hitung ukuran file
                $fileSize = File::size($backupFileFullPath);
                $fileSizeFormatted = $this->formatFileSize($fileSize);

                // Hitung durasi backup
                $duration = now()->diffInSeconds($backupHistory->backup_started_at);
               
                // Update history backup
                $backupHistory->update([
                    'app_id'=>$get_datawebjm[$i]['id'],
                    'backup_path' => 'backups/' . $backupFileName,
                    'file_size' => $fileSizeFormatted,
                    'status' => 'success',
                    'backup_completed_at' => now(),
                    'backup_duration_seconds' => $duration
                ]);
                
                session(['backup_progress' => 100]);

                //  return response()->json([
                //     'success' => true,
                //      'data'=> $databackup,
                //     'message' => 'Backup database berhasil!',
                //      'backup_id' => $backupHistory->id
                // ]);
            
            } 
            
          
            
            }

               return response()->json([
                'success' => true,
                'message' => 'Database berhasil disimpan!'
            ], 200);
           



             }
                        
             else{

                return response()->json([
                'success' => false,
                'message' => 'Error: ' . 'Ada Kesalahan Sistem!'
            ], 500);


             }
            
    
        } catch (\Exception $e) {
            if (isset($backupHistory)) {
                $backupHistory->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'backup_completed_at' => now()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }

    }
    


        // Get progress backup
    public function getProgress()
    {
        $progress = session('backup_progress', 0);
        $backupId = session('backup_id', null);
        
        if ($backupId) {
            $backup = BackupHistory::find($backupId);
            if ($backup && $backup->status !== 'processing') {
                session()->forget(['backup_progress', 'backup_id']);
            }
        }
        
        return response()->json([
            'progress' => $progress,
            'backup_id' => $backupId
        ]);
    }

        // Download backup file
    public function downloadBackup($id)
    {
        $backup = BackupHistory::findOrFail($id);
        
        if ($backup->status !== 'success') {
            return back()->with('error', 'File backup tidak tersedia.');
        }
        
        $filePath = storage_path('app/' . $backup->backup_path);
        
        if (!File::exists($filePath)) {
            return back()->with('error', 'File backup tidak ditemukan.');
        }
        
        return response()->download($filePath, $backup->backup_name);
    }

     // Delete backup file
    public function deleteBackup($id)
    {
        try {
            $backup = BackupHistory::findOrFail($id);
            
            if ($backup->backup_path && File::exists(storage_path('app/' . $backup->backup_path))) {
                File::delete(storage_path('app/' . $backup->backup_path));
            }
            
            $backup->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Backup berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus backup: ' . $e->getMessage()
            ], 500);
        }
    }

    // Format file size
    private function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Method untuk command scheduler (dipanggil setiap jam 2 malam)
    public function scheduledBackup()
    {
        try {
            
            $get_datawebjm=DaftarWebJM::orderBy('created_at', 'desc')->get();
            // Simulasi request untuk backup
            $backupHistory = BackupHistory::create([
                'backup_name' => 'scheduled_backup_' . date('Y-m-d_H-i-s') . '.sql',
                'backup_path' => '',
                'status' => 'processing',
                'backup_started_at' => now(),
            ]);

            // Konfigurasi database
            // $dbHost = env('DB_HOST', 'localhost');
            // $dbPort = env('DB_PORT', '3306');
            // $dbName = env('DB_DATABASE', 'monitoring_onsite');
            // $dbUser = env('DB_USERNAME', 'root');
            // $dbPass = env('DB_PASSWORD', '');
            // $backupPath = storage_path('app/backups/');

           for ($i = 0; $i < count($get_datawebjm); $i++) {

            $db_App=$get_datawebjm[$i]['name_web'];
            $db_backup_id=$get_datawebjm[$i]['id'];
            $db_HOST=$get_datawebjm[$i]['host'];
            $db_PORT=$get_datawebjm[$i]['port'];
            $db_Name=$get_datawebjm[$i]['name_database'];
            $db_User =$get_datawebjm[$i]['username'];
            $db_Pass =$get_datawebjm[$i]['password'];


            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            $backupFileName = $backupHistory->backup_name;
            $backupFileFullPath = $backupPath . $backupFileName;

            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s --port=%s %s > %s 2>&1',
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbHost),
                escapeshellarg($dbPort),
                escapeshellarg($dbName),
                escapeshellarg($backupFileFullPath)
            );

            $output = [];
            $returnVar = null;
            exec($command, $output, $returnVar);

            if ($returnVar === 0 && File::exists($backupFileFullPath)) {
                $fileSize = File::size($backupFileFullPath);
                $fileSizeFormatted = $this->formatFileSize($fileSize);
                $duration = now()->diffInSeconds($backupHistory->backup_started_at);

                $backupHistory->update([
                    'app_id'=>$get_datawebjm[$i]['id'],
                    'backup_path' => 'backups/' . $backupFileName,
                    'file_size' => $fileSizeFormatted,
                    'status' => 'success',
                    'backup_completed_at' => now(),
                    'backup_duration_seconds' => $duration
                ]);

                Log::info('Scheduled backup completed successfully: ' . $backupFileName);
            } else {
                throw new \Exception('Backup failed: ' . implode("\n", $output));
            }
            }

        } catch (\Exception $e) {
            if (isset($backupHistory)) {
                $backupHistory->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'backup_completed_at' => now()
                ]);
            }
            Log::error('Scheduled backup failed: ' . $e->getMessage());
        }
    }






}
