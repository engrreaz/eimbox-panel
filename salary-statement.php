<?php
include 'inc.php';
include 'backend/func.php';
// $tkn = $_GET['token']; 

$x=0;
$month = $_GET['m'];
$year = $_GET['y'];
$o = $_GET['o'];
$x = $_GET['x'];
$mtxts = $year . '-' . $month . '-01';
$mtxt = date('F', strtotime($mtxts)) . ', ' . $year;

$refno = '';
$mpodate = '2025-12-31';
$smcdate = '2026-02-15';
$pfbankname='';
$pfbrname = '';

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css?v=a">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <script>
        function hideall(id) {
            alert(id);
            document.getElementById("toptable" + id).innerHTML = "1";
            document.getElementById("midtable" + id).innerHTML = "2";
            document.getElementById("bottomtable" + id).innerHTML = "3";
        }
    </script>


    <style>
        .pic {
            width: 45px;
            height: 45px;
            padding: 1px;
            border-radius: 50%;
            border: 1px solid var(--dark);
            margin: 5px;
        }

        marg {
            width: 12px;
        }

        @media print {
            .noprint {
                display: none !important;
            }

            body {

                color: black !important;
                padding: 12mm !important;
            }
        }


        .a {
            font-size: 20px;
            font-weight: 700;
            font-style: normal;
            line-height: 24px;
        }

        .b {
            font-size: 15px;
            font-weight: 400;
            font-style: normal;
            line-height: 18px;
        }

        .c {
            font-size: 12px;
            font-weight: 400;
            font-style: italic;
            line-height: 16px;
        }

        .top {
            font-size: 16x;
            width: 70px;
            text-align: center;
            font-weight: 700;
        }

        .gen {
            font-size: 16px;
            text-align: center;
            font-weight: 400;
            padding: 5px 0;
        }

        .x {
            font-size: 12px;
            font-weight: 400;
            font-style: normal;
            line-height: 15px;
        }

        .y {
            font-size: 14px;
            font-weight: 600;
            font-style: normal;
            line-height: 15px;
        }

        #boxtbl tr,
        #boxtbl td {
            border: 1px solid gray;
        }

        thead {
            display: table-header-group;
        }

        .gap {
            vertical-align: top;
            padding: 2px 5px 2px 2px;
        }

        .gap small {
            font-size: 10px;
        }

        .rndbox {
            border: 1px solid gray;
            border-radius: 4px;
            height: 62px;
            padding: 8px;
            margin: 0 5px;
        }

        .rndbox table {
            width: 100%;
            ;
        }

        .sh {
            height: 62px;
        }

        .sh2 {
            height: 40px;
            text-align: center;
        }

        .sh3 {
            height: 50px;
            text-align: center;
            line-height: 15px;
        }

        .itl {
            font-size: 10px;
            font-style: italic;
        }

        .topic tr,
        .topic td {
            border: 1px solid gray;
            text-align: justify;
            padding: 5px;
            vertical-align: top;
        }

        .ttl {
            font-size: 1.25rem;
            text-align: center;
            line-height: 1.5rem;
            width: 25%;
        }

        .ttlb {
            font-size: 1.15rem;
            text-align: center;
            line-height: 1.25rem;
        }

        .ttleng {
            font-size: 1.1rem;
            text-align: center;
            line-height: 1.25rem;
            width: 25%;
        }

        .sct {
            text-align: center;
        }

        .tsign {
            height: 15mm;
        }

        #item td,
        #item th {
            border: 1px solid black;
            padding: 3px 5px;
        }

        th {
            font-size: 13px;
            padding: 3px 5px;
        }

        .tsing:before {
            content: ' ';
            display: block;
            position: absolute;
            height: 15mm;
            background-image: url('https://eimbox.com/sign/105673.png');
        }

        .mpo-table {
            font-size: 11px;
            text-align: center;
            border: 1px solid black;
            padding: 1px;
        }

        .mpo-tables th {
            border: 1px solid black;
            font-size: 11px;
            text-align: center;
        }

        .pop {
            width: 33%;
            text-align: center;
            vertical-align: bottom;
            font-size: 11px;
            font-style: italic;
            border: 0px solid red;
        }

        .code {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
        }
    </style>
</head>

<body style="background:white; margin:0 !important; padding:0 !important; font-family: Segoe UI, SutonnyOMJ ;">

    <main>


        <?php
        if ($o == 1) {
            include 'backend/bank/bank-page-8.php';  // TOP Sheet
            include 'backend/bank/bank-page-1.php';  // MPO Bill (Govt. Forwading)
            include 'backend/bank/bank-page-2.php';  // MPO Dispuch 

            include 'backend/bank/bank-page-4.php';  // Salary Details school
            include 'backend/bank/bank-page-5.php';  // Bank - Salary Sheet
            include 'backend/bank/bank-page-6.php';  // Bank - PF Sheet
            include 'backend/bank/bank-page-7.php';  // Expenditure  List....
        } else {
            include 'backend/bank/bank-page-3.php';  //  Check Top Sheet
        }



        ?>













    </main>
    <div style="height:52px;"></div>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        document.getElementById("cnt").innerHTML = "<?php echo $cnt; ?>";

        function go() {
            var cls = document.getElementById("classname").value;
            var sec = document.getElementById("sectionname").value;
            var sub = document.getElementById("subject").value;
            var assess = document.getElementById("assessment").value;
            var exam = document.getElementById("exam").value;
            let tail = '?exam=' + exam + '&cls=' + cls + '&sec=' + sec + '&sub=' + sub + '&assess=' + assess;
            if (cls == 'Six' || cls == 'Seven') {
                window.location.href = "pibiprint.php" + tail;
            } else {
                alert("Select Class Six/Seven Only");
            }
        }  
    </script>

    <script>
        function prnt(id) {
            if (id == 0) {
                $('.level').hide();
                $('.topic').hide();
            } else if (id == 1) {
                $('.level').hide();
                $('.topic').show();
            } else if (id == 2) {
                $('.level').show();
                $('.topic').show();
            }
        }
    </script>

    <script>
        function fetchsection() {
            var cls = document.getElementById("classname").value;

            var infor = "user=<?php echo $rootuser; ?>&cls=" + cls;
            $("#sectionblock").html("");

            $.ajax({
                type: "POST",
                url: "fetchsection.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#sectionblock').html('<span class=""><center>Fetching Section Name....</center></span>');
                },
                success: function (html) {
                    $("#sectionblock").html(html);
                }
            });
        }
    </script>

    <script>
        function fetchsubject() {
            var cls = document.getElementById("classname").value;
            var sec = document.getElementById("sectionname").value;

            var infor = "sccode=<?php echo $sccode; ?>&cls=" + cls + "&sec=" + sec;
            $("#subblock").html("");

            $.ajax({
                type: "POST",
                url: "fetchsubject.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#subblock').html('<span class="">Retriving Subjects...</span>');
                },
                success: function (html) {
                    $("#subblock").html(html);
                }
            });
        }

        function print() {
            window.print();
        }
    </script>

    <script>
        var x = <?php echo $x;?>;
        if( x == 1) {
            window.print();
        }
    </script>



</body>

</html>