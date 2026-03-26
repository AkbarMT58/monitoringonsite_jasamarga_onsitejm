<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\PerformaTesting;
use App\Models\PerformaAksesLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class PerformaTestingController extends Controller
{
    public function index(){

        return view('performa_testing.index', ['total_paid' => Order::sum('pay'),
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

        return view('performa_testing.performa_index', [
            'performatesting' => PerformaTesting::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);
    }

    public function edit(Int $id)
    {
    
        $performatesting = PerformaTesting::select('*')->where('id',$id)->get();

        return view('performa_testing.edit', [
            'performatesting' => $performatesting,
        ]);

      
    }

    public function create_performa(){

        $row = (int) request('row', 10);


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('performa_testing.create', [
            'performatesting' => PerformaTesting::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);



    }



    function performa_testing_simpan(Request $request){

          
            try{

                date_default_timezone_set("Asia/Jakarta");
                $waktu = date("d-m-Y-H:i:s");

                $utc=$request->input('tanggal_cetak');
                $time = strtotime($utc .' UTC');
                $dateInLocal = date("Y-m-d H:i:s", $time);


              
                $performa_testing=[

                    "employee_id"=>(int)("2"),
                    "checker_by"=>"Akbar",
                    "kategori_aplikasi"=>$request->input('nama_app'),
                    "tipe_web"=>$request->input('tipe_web'),
                    "akses"=>$request->input('akses'),
                    "performa_mobile"=>$request->input('performa_mobile'),
                    "performa_desktop"=>$request->input('performa_desktop'),
                    "keterangan"=>$request->input('keterangan'),
                    "link_capture"=>$request->input('link_capture'),
                    "jam_pengecekan"=>$request->input('jam_pengecekan'),
                    "tanggal_cetak"=>$request->input('tanggal_cetak'),
                    "tools"=>$request->input('tools'),
                    
                ];

            PerformaTesting::insert($performa_testing);

            return response()->json(['data'=>$performa_testing,'status'=> 200], 200);

        }catch(\Exception $e){
           
            return Redirect::route('performa_index')->with('error', 'Performance Testing failed to save!');
           
        }


  

            

    }


    

    function performa_testing_update(Request $request){


        try{

            date_default_timezone_set("Asia/Jakarta");
            $waktu = date("d-m-Y-H:i:s");
    

            $performa_testing=[
                "employee_id"=>(int)("2"),
                "tools"=>"https://pagespeed.web.dev/analysis?url=https%3A%2F%2Fselia.jasamarga.co.id%2F",
                "checker_by"=>"Akbar",
                "kategori_aplikasi"=>$request->input('app_name'),
                "tipe_web"=>$request->input('tipe_web'),
                "akses"=>$request->input('akses'),
                "performa_mobile"=>$request->input('nilai_mobile'),
                "performa_desktop"=>$request->input('nilai_desktop'),
                "keterangan"=>$request->input('keterangan'),
                "link_capture"=>$request->input('link_capture'),
                "jam_pengecekan"=>$request->input('jam_pengecekan'),
                "tanggal_cetak"=>$request->input('tanggal_cetak'),
                "tools"=>$request->input('web_name'),
                "updated_at"=>$waktu
            ];

        
          PerformaTesting::where('id', $request->id)->update($performa_testing);


        return Redirect::route('performa_index')->with('success', 'Performace Testing has been Updated!');

    }catch(\Exception $e){
       
        return Redirect::route('performa_index')->with('error', 'Performance Testing failed to update!');
       
    }






    }


    function performa_testing_report(Request $request){

        $row = (int) request('row', 10);

        $data_=PerformaTesting::sortable()->select('*')->orderBy('id', 'asc')->get();

        $data = [

            'data'                =>$data_,
           

        ];


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }



        $pdf = PDF::loadView('reports.report_performatesting', $data);
        $pdf=  $pdf->setPaper('A4', 'landscape');
        $pdf=  $pdf->set_option('isRemoteEnabled', true);
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

       
    
        $pdf = $pdf->download('laporan_performa.pdf');

         return $pdf;

    }


    function hapus_removeperforma($id){

        $kode_id=$id;

        PerformaTesting::where('id',$kode_id)->delete();

        return Redirect::route('performa_index')->with('success', 'Performa Testing with id '.$kode_id.' has been deleted!');

    }




}
