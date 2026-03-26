<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\Zap;
use App\Models\PerformaAksesLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class ZAPController extends Controller
{
    public function index(){

        return view('zap.index', ['total_paid' => Order::sum('pay'),
            'total_due' => Order::sum('due'),
            'complete_orders' => Order::where('order_status', 'complete')->get(),
            'products' => Product::orderBy('product_store')->take(5)->get(),
            'new_products' => Product::orderBy('buying_date')->take(2)->get(),
        ]);
    }

    public function create()
    {
       

        $row = (int) request('row', 10);

       
        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('zap.zap', [
            'performatesting' => Zap::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);
    }

    public function edit(Int $id)
    {
    
        $performatesting = Zap::select('*')->where('id',$id)->get();

        return view('zap.edit', [
            'performatesting' => $performatesting,
        ]);

      
    }

    public function create_zap(){

        $row = (int) request('row', 10);


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('zap.create', [
            'performatesting' => Zap::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);



    }



    function zap_simpan(Request $request){

          
            try{

                $file_zap_input="file_zap";

                $file_dokumen_=$request->file($file_zap_input);
                $fileName_ = md5(rand(0,9999)).'.'.$file_dokumen_->getClientOriginalExtension();
                $path_ = public_path() . '/assets/images/dokumen/zap';
                $file_dokumen_->move($path_, $fileName_);
               

            
                $zap=[

                    "employee_id"=>(int)("2"),
                    "kategori_aplikasi"=>$request->input('nama_app'),
                    "tipe_aplikasi"=>$request->input('tipe_web'),
                    "akses"=>$request->input('akses'),
                    "high"=>$request->input('high'),
                    "medium"=>$request->input('medium'),
                    "low"=>$request->input('low'),
                    "informational"=>$request->input('informational'),
                    "keterangan"=>$request->input('keterangan'),
                    "link_capture"=>$request->input('link_capture'),
                    "file_zap_name"=>$fileName_,
                    "solusi_troubleshoot"=>$request->input('troubleshoot'),
                    "status_zap"=>$request->input('status_zap'),
                    "tanggal_cetak"=>$request->input('tanggal_cetak'),
                    "created_at"=>$request->input('tanggal_cetak'),
                      
                ];

                Zap::insert($zap);

        
            return response()->json(['data'=>$zap,'status'=> 200], 200);

        }catch(\Exception $e){
           
            return Redirect::route('zap')->with('error', 'ZAP Created failed to save!');
           
        }


  

            

    }


    

    function zap_update(Request $request){


        try{

            $file_zap_input="file_zap";

            $file_dokumen_=$request->file($file_zap_input);

            if( $file_dokumen_==""){

                $fileName_ =$request->input('file_zap_old');



            }else{

            $fileName_ = md5(rand(0,9999)).'.'.$file_dokumen_->getClientOriginalExtension();
            $path_ = public_path() . '/assets/images/dokumen/zap';
            $file_dokumen_->move($path_, $fileName_);


            }
            
            
           

            date_default_timezone_set("Asia/Jakarta");
            $waktu = date("d-m-Y-H:i:s");
    
            $zap=[

                "employee_id"=>(int)("2"),
                "kategori_aplikasi"=>$request->input('app_name'),
                "tipe_aplikasi"=>$request->input('tipe_web'),
                "akses"=>$request->input('akses'),
                "high"=>$request->input('high'),
                "medium"=>$request->input('medium'),
                "low"=>$request->input('low'),
                "informational"=>$request->input('informational'),
                "keterangan"=>$request->input('keterangan'),
                "link_capture"=>$request->input('link_capture'),
                "file_zap_name"=>$fileName_,
                "solusi_troubleshoot"=>$request->input('troubleshoot'),
                "status_zap"=>$request->input('status_zap'),
                "updated_at"=>$request->input('tanggal_cetak'),
                  
            ];

        
          Zap::where('id', $request->id)->update($zap);


        return Redirect::route('zap_index')->with('success', 'ZAP has been Updated!');

    }catch(\Exception $e){
       
        return Redirect::route('performa_index')->with('error', 'ZAP failed to update!');
       
    }






    }


    function zap_report(Request $request){

        $row = (int) request('row', 10);

        $data_=Zap::sortable()->select('*')->orderBy('id', 'asc')->get();

        $data = [

            'data'  =>$data_,
           

        ];


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }



        $pdf = PDF::loadView('reports.report_zap', $data);
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

       
    
        $pdf = $pdf->download('laporan_zap.pdf');

       

    
        


         return $pdf;

    }


    function hapus_removezap($id){

        $kode_id=$id;

        Zap::where('id',$kode_id)->delete();

        return Redirect::route('zap_index')->with('success', 'ZAP with id '.$kode_id.' has been deleted!');

    }




}
