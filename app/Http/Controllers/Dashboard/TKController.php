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

class TKController extends Controller
{
    public function index(){

        return view('transfer_knowledge.index', ['total_paid' => Order::sum('pay'),
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

        return view('transfer_knowledge.tk', [
            'transfer_knowledge' => TK::sortable()
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

    public function create_tk(){

        $row = (int) request('row', 10);


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('transfer_knowledge.create', [
            'transfer_knowledge' => TK::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);



    }



    function tk_simpan(Request $request){

          
            try{

                $file_tk_input_1="dokumen_link_1";
                $file_tk_input_2="dokumen_link_2";

                $file_dokumen_1=$request->file($file_tk_input_1);
                $fileName_1 = md5(rand(0,9999)).'.'.$file_dokumen_1->getClientOriginalExtension();
                $path_1 = public_path() . '/assets/images/dokumen/tk';
                $file_dokumen_1->move($path_1, $fileName_1);



                $file_dokumen_2=$request->file($file_tk_input_2);
                $fileName_2 = md5(rand(0,9999)).'.'.$file_dokumen_2->getClientOriginalExtension();
                $path_2 = public_path() . '/assets/images/dokumen/tk';
                $file_dokumen_2->move($path_2, $fileName_2);


            
                $tk=[

                    "employee_id"=>(int)("2"),
                    "kategori_aplikasi"=>$request->input('nama_app'),
                    "tipe_aplikasi"=>$request->input('tipe_web'),
                    "catatan"=>$request->input('catatan'),
                    "framework"=>$request->input('framework'),
                    
                    "dokumen_link_1"=>$request->input('dokumen_link_1'),
                    "dokumen_link_2"=>$request->input('dokumen_link_2'),
                    
                    "keterangan"=>$request->input('keterangan'),
        
                    "status_tk"=>$request->input('status_tk'),
                    "bahasa_pemograman"=>$request->input('bahasa_pemograman'),
                    "tanggal_cetak"=>$request->input('tanggal_cetak'),
                    "created_at"=>$request->input('tanggal_cetak'),



                      
                ];

                TK::insert($tk);

        
            return response()->json(['data'=>$tk,'status'=> 200], 200);

        }catch(\Exception $e){
           
            return Redirect::route('tk')->with('error', 'TK Created failed to save!');
           
        }


  

            

    }


    

    function tk_update(Request $request){


        try{

            $file_tk_input="file_tk";

            $file_dokumen_=$request->file($file_tk_input);

            if( $file_dokumen_==""){

                $fileName_ =$request->input('file_tk_old');



            }else{

            $fileName_ = md5(rand(0,9999)).'.'.$file_dokumen_->getClientOriginalExtension();
            $path_ = public_path() . '/assets/images/dokumen/tk';
            $file_dokumen_->move($path_, $fileName_);


            }
            
            
           

            date_default_timezone_set("Asia/Jakarta");
            $waktu = date("d-m-Y-H:i:s");
    
                
                $tk=[

                    "employee_id"=>(int)("2"),
                    "kategori_aplikasi"=>$request->input('nama_app'),
                    "tipe_aplikasi"=>$request->input('tipe_web'),
                    "catatan"=>$request->input('catatan'),
                    "framework"=>$request->input('framework'),
                    "dokumen_manual_book"=>$request->input('manual_book'),
                    "dokumen_link_1"=>$request->input('dokumen_link_1'),
                    "dokumen_link_2"=>$request->input('dokumen_link_2'),
                    "keterangan"=>$request->input('keterangan'),
                    "status_tk"=>$request->input('status_tk'),
                    "bahasa_pemograman"=>$request->input('bahasa_pemograman'),
                    "tanggal_cetak"=>$request->input('tanggal_cetak'),
                    "updated_at"=>$request->input('tanggal_cetak'),
     
                ];
        
          TK::where('id', $request->id)->update($tk);


        return Redirect::route('tk_index')->with('success', 'TK has been Updated!');

    }catch(\Exception $e){
       
        return Redirect::route('tk_index')->with('error', 'TK failed to update!');
       
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


    function hapus_removetk($id){

        $kode_id=$id;

        TK::where('id',$kode_id)->delete();

        return Redirect::route('tk_index')->with('success', 'TK with id '.$kode_id.' has been deleted!');

    }




}
