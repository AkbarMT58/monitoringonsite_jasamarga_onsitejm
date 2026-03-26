<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    table {
        border-collapse: collapse;
    }

    th {
        background: #ccc;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    tr:nth-child(even) {
        background: #efefef;
    }

    tr:hover {
        background: #d1d1d1;
    }

    .logo_box {

        border: 1px normal #white;




    }

    .logo_box_blank {

        border: 1px normal #white;


    }
</style>

<body>



    <?php
    
    $imagePath = 'https://media.licdn.com/dms/image/v2/D4E0BAQEr07EMQUHmgA/company-logo_200_200/company-logo_200_200/0/1689567978427?e=2147483647&v=beta&t=FjgCWmtrOR1iE8A24JVCDwt-f7f9q9YaeZvzzzeQZ_o';
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);
    $imageUrl = 'data:image/png;base64,' . $base64Image;
  
    ?>


    <div class="header_proforma">

        <div style="margin-left:50px;">

            <img src="{{ $imagePath }}" style="width: 80px;" />

            <br>
            <br>
            <hr />
            <label><br><br>Silakan konfirmasi pengajuan cuti karyawan Onsite JM Kuantum di link {{url('cuti/create_cuti')}} .</label>
            <br>


        </div>















    </div>
</body>

</html>
