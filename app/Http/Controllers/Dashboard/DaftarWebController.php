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
use App\Models\DaftarWebJM;
use Illuminate\Support\Facades\File;

class DaftarWebController extends Controller
{
    public function index(){

      
        $row = (int) request('row', 10);
        return view('daftarwebjm.index', [
            'backups' => DaftarWebJM::sortable()
                ->select('*')
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query())
                ,
               
        ]);
    }

    public function create_webjm()
    {
       

        $row = (int) request('row', 10);

       
        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('daftarwebjm.create', [
            'backups' => DaftarWebJM::sortable()
                ->select('*')
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);
    }

    public function edit(Int $id)
    {
    
        $daftarwebjm = DaftarWebJM::select('*')->where('id',$id)->get();

        return view('daftarwebjm.edit', [
            'daftarwebjm' => $daftarwebjm,
        ]);

      
    }


    function daftarweb_simpan(Request $request){

          
            try{

                date_default_timezone_set("Asia/Jakarta");
                $waktu = date("d-m-Y-H:i:s");
    
                $daftarwebjm=[

                    "name_web"=>$request->input('nama_web'),
                    "name_database"=>$request->input('name_database'),
                    "host"=>$request->input('host'),
                    "port"=>$request->input('port'),
                    "username"=>$request->input('username'),
                    "password"=>$request->input('password'),
                    "status"=>$request->input('status'),
                    "created_at"=>$waktu,
                     
                ];

                DaftarWebJM::insert($daftarwebjm);

        
            return response()->json(['data'=>$daftarwebjm,'status'=> 200], 200);
            

        }catch(\Exception $e){
           
           // return Redirect::route('create_webjm')->with('error', 'Daftar Web JM Created failed to save!');

             return response()->json([
            'status' => 'error',
            'message' => 'Ada kesalahan data'
        ], 400); // 400 Bad Request
           
        }
     

    }


    

    function daftarweb_update(Request $request){


        try{

            date_default_timezone_set("Asia/Jakarta");
            $waktu = date("d-m-Y-H:i:s");

            $id_= $request->id;
    
            
                $daftarwebjm=[

                    "name_web"=>$request->nama_web,
                    "name_database"=>$request->nama_database,
                    "host"=>$request->nama_host,
                    "port"=>$request->port,
                    "username"=>$request->username,
                    "password"=>$request->nama_password,
                    "status"=>$request->status,
                    "updated_at"=>$waktu,
     
                ];
        
          DaftarWebJM::where('id', $id_)->update($daftarwebjm);


        return Redirect::route('webjm')->with('success', 'Daftar Web JM sudah diupdate!');

    }catch(\Exception $e){
       
        return Redirect::route('webjm')->with('error', 'Daftar Web JM gagal mengupdate!');
       
    }






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


    function hapus_remove_daftarweb($id){

        $kode_id=$id;

        DaftarWebJM::where('id',$kode_id)->delete();

        return Redirect::route('webjm')->with('success', 'Daftar Web JM sudah dihapus!');

    }


    // Proses backup database dengan progress
    public function backupDatabase(Request $request)
    {
        try {

             date_default_timezone_set("Asia/Jakarta");
             $waktu = date("Y-m-d_H-i-s");
  
            $backupHistory = BackupHistory::create([
                'backup_name' => 'backup_monitoring_onsite_' . $waktu . '.sql',
                'backup_path' => '',
                'status' => 'processing',
                'backup_started_at' => now(),
            ]);

            // Simpan progress ke session
            session(['backup_progress' => 10]);
            session(['backup_id' => $backupHistory->id]);

            // Konfigurasi database
            $dbHost = env('DB_HOST', 'localhost');
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
                // 'mysqldump -u %s -p %s -h %s  %s > %s ',
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
            // Simulasi request untuk backup
            $backupHistory = BackupHistory::create([
                'backup_name' => 'scheduled_backup_' . date('Y-m-d_H-i-s') . '.sql',
                'backup_path' => '',
                'status' => 'processing',
                'backup_started_at' => now(),
            ]);

            // Konfigurasi database
            $dbHost = env('DB_HOST', 'localhost');
            $dbPort = env('DB_PORT', '3306');
            $dbName = env('DB_DATABASE', 'monitoring_onsite');
            $dbUser = env('DB_USERNAME', 'root');
            $dbPass = env('DB_PASSWORD', '');
            $backupPath = storage_path('app/backups/');

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
