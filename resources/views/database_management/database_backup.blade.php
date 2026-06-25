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
        </div>
        <div class="col-lg-4">
            <div class="card card-transparent card-block card-stretch card-height border-none">
                <div class="card-body p-0 mt-lg-2 mt-0">
                    <h3 class="mb-3"> </h3>
                    <p class="mb-0 mr-4">Dashboard Management Web JM </p>
                    <div class="row">

                    <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link Database Management" href="{{route('database_index')}}">Dashboard Management Disini <i class="ri-time-line"></i>
                                    </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="card card-block card-stretch card-height alert alert-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div class="icon iq-icon-box-2 bg-info-light">
                                    <img src="../assets/images/product/danger.png" class="img-fluid" alt="image">
                                </div>
                                <div>
                                    <p class="mb-2">Belum TK</p>
                                    <h4> {{ $total_paid }} x</h4>
                                </div>
                            </div>
                            <div class="iq-progress-bar mt-2">
                                <span class="bg-info iq-progress progress-1" data-percent="85">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div class="icon iq-icon-box-2 bg-danger-light">
                                    <img src="../assets/images/product/warning.png" class="img-fluid" alt="image">
                                </div>
                                <div>
                                    <p class="mb-2">Sudah TK</p>
                                    <h4> {{ $total_due }} x</h4>
                                </div>
                            </div>
                            <div class="iq-progress-bar mt-2">
                                <span class="bg-danger iq-progress progress-1" data-percent="70">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div class="icon iq-icon-box-2 bg-danger-light">
                                    <img src="../assets/images/product/warning.png" class="img-fluid" alt="image">
                                </div>
                                <div>
                                    <p class="mb-2">Proses</p>
                                    <h4> {{ $total_due }} x</h4>
                                </div>
                            </div>
                            <div class="iq-progress-bar mt-2">
                                <span class="bg-danger iq-progress progress-1" data-percent="70">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Overview</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton001"
                                data-toggle="dropdown">
                                This Month<i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton001">
                                <a class="dropdown-item" href="#">Year</a>
                                <a class="dropdown-item" href="#">Month</a>
                                <a class="dropdown-item" href="#">Week</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                 <div id="piechart_3d"></div>
                  
                    
                </div>
            </div>
        </div>
       
        <div class="col-lg-8" hidden>
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Top Products</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006"
                                data-toggle="dropdown">
                                This Month<i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton006">
                                <a class="dropdown-item" href="#">Year</a>
                                <a class="dropdown-item" href="#">Month</a>
                                <a class="dropdown-item" href="#">Week</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled row top-product mb-0">
                    @foreach ($products as $product)
                        <li class="col-lg-3">
                            <div class="card card-block card-stretch card-height mb-0">
                                <div class="card-body">
                                    <div class="bg-warning-light rounded">
                                        <img src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/default.webp') }}" class="style-img img-fluid m-auto p-3" alt="image">
                                    </div>
                                    <div class="style-text text-left mt-3">
                                        <h5 class="mb-1">{{ $product->product_name }}</h5>
                                        <p class="mb-0">{{ $product->product_store }} Item</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4" hidden>
            <div class="card card-transparent card-block card-stretch mb-4">
                <div class="card-header d-flex align-items-center justify-content-between p-0">
                    <div class="header-title">
                        <h4 class="card-title mb-0">New Products</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div><a href="#" class="btn btn-primary view-btn font-size-14">View All</a></div>
                    </div>
                </div>
            </div>
            @foreach ($new_products as $product)
            <div class="card card-block card-stretch card-height-helf">
                <div class="card-body card-item-right">
                    <div class="d-flex align-items-top">
                        <div class="bg-warning-light rounded">
                            <img src="../assets/images/product/04.png" class="style-img img-fluid m-auto" alt="image">
                        </div>
                        <div class="style-text text-left">
                            <h5 class="mb-2">{{ $product->product_name }}</h5>
                            <p class="mb-2">Stock : {{ $product->product_store }}</p>
                            <p class="mb-0">Price : ${{ $product->selling_price }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection

<script>

    window.addEventListener('DOMContentLoaded', () => {

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Keep a global reference to redraw on window resize
        let chart;
        let data;
        let options;

        function drawChart() {
            // 2. Define your customized dataset
            data = google.visualization.arrayToDataTable([
                ['Selia', 'Hours per Day'],
                ['Csirt',     11],
                ['JMlink',      2],
                ['JmGuest',  2],
                ['Jmtm', 2],
                ['Jdih',7],
                ['Silapmen', 2],
                ['Jimms', 2],
                ['JMrise', 7]
            ]);

            // 3. Configure layout and custom colors
            options = {
                title: 'Database Management Backup Web JM',
                is3D: true, // Enables the 3D effect
                backgroundColor: 'transparent',
                legend: { 
                    position: 'bottom', 
                    alignment: 'center',
                    textStyle: { color: '#333', fontSize: 14 }
                },
                // Custom colors assigned to the slices
                colors: ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099'],
                chartArea: {
                    left: '5%',
                    top: '10%',
                    width: '90%',
                    height: '75%'
                },
                 animation: {
            animateRotate: true, // Animasi rotasi saat pertama kali dimuat
            animateScale: true,  // Animasi pembesaran dari tengah
            duration: 2500       // Durasi animasi 2.5 detik
        }
            };

            // 4. Instantiate and draw the chart inside the target div
            chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }

        // 5. Force the chart to recalculate width and redraw on window resize
        window.addEventListener('resize', function() {
            if (chart && data && options) {
                chart.draw(data, options);
            }
        });



      });
</script>

@section('specificpagescripts')
<!-- Table Treeview JavaScript -->
<script src="{{ asset('assets/js/table-treeview.js') }}"></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('assets/js/customizer.js') }}"></script>
<!-- Chart Custom JavaScript -->
<script async src="{{ asset('assets/js/chart-custom.js') }}"></script>
@endsection
