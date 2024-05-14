<?php
include 'header.php';


if (isset($_GET['level'])) {
    $level = $_GET['level'];
} else {
    $level = 'teacher';
}




?>

<h3 class="d-print-none">Users Management Tool</h3>
<p class="d-print-none">
    <code>Administration <i class="mdi mdi-arrow-right"></i> Users</code>
</p>


<div class="row d-print-none" id="ren">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div id="alladmit">


                            <style>
                                * {
                                    font-family: "Noto Sans Bengali", sans-serif;
                                }

                                #main-table td {
                                    border: 1px solid black;
                                }

                                .txt-right {
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 14px;
                                    padding: 5px;
                                    border: 1px solid gray !important;
                                }

                                .ooo {
                                    padding: 3px 0;
                                }
                            </style>

                            <div style="text-align: right; margin-bottom:15px;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-<?php if ($level == 'all') {
                                        echo 'info';
                                    } else {
                                        echo 'primary';
                                    }
                                    ; ?>" onclick="go(1);">
                                        <i class="mdi mdi-heart-outline"></i> All
                                    </button>
                                    <button type="button" class="btn btn-<?php if ($level == 'committee') {
                                        echo 'info';
                                    } else {
                                        echo 'primary';
                                    }
                                    ; ?>" onclick="go(2);">
                                        <i class="mdi mdi-heart-outline"></i> Committee
                                    </button>
                                    <button type="button" class="btn btn-<?php if ($level == 'teacher') {
                                        echo 'info';
                                    } else {
                                        echo 'primary';
                                    }
                                    ; ?>" onclick="go(3);">
                                        <i class="mdi mdi-heart-outline"></i> Teacher
                                    </button>
                                    <button type="button" class="btn btn-<?php if ($level == 'guardian') {
                                        echo 'info';
                                    } else {
                                        echo 'primary';
                                    }
                                    ; ?>" onclick="go(4);">
                                        <i class="mdi mdi-calendar"></i> Guardian
                                    </button>
                                    <button type="button" class="btn btn-<?php if ($level == 'student') {
                                        echo 'info';
                                    } else {
                                        echo 'primary';
                                    }
                                    ; ?>" onclick="go(5);">
                                        <i class="mdi mdi-clock"></i> Student
                                    </button>
                                    <button type="button" class="btn btn-<?php if ($level == 'guest') {
                                        echo 'info';
                                    } else {
                                        echo 'primary';
                                    }
                                    ; ?>" onclick="go(6);">
                                        <i class="mdi mdi-clock"></i> Guest
                                    </button>
                                </div>
                            </div>

                            <table class="table table-bordered"
                                style="width:100%; border:1px solid gray !important; border-collapse:collapse;"
                                id="main-table">
                                <thead>
                                    <tr>
                                        <td class="txt-right">#</td>
                                        <td class="txt-right">Email</td>
                                        <td class="txt-right">Level</td>
                                        <td class="txt-right">Name</td>
                                        <td class="txt-right"></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($level == 'all') {
                                        $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1 order by id";
                                    } else if ($level == 'committee') {
                                        $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1 and (userlevel='committee' ) order by id";
                                    } else if ($level == 'teacher') {
                                        $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1 and (userlevel='Teacher' or userlevel='Administrator') order by id";
                                    } else if ($level == 'guardian') {
                                        $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1  and userlevel='Guardian' order by id";
                                    } else if ($level == 'student') {
                                        $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1  and userlevel='Student' order by id";
                                    } else if ($level == 'guest') {
                                        $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1  and userlevel='Guest' order by id";
                                    }

                                    // $sql0 = "SELECT * FROM usersapp where sccode='$sccode' and status=1  order by id";
                                    $result0 = $conn->query($sql0);
                                    if ($result0->num_rows > 0) {
                                        while ($row0 = $result0->fetch_assoc()) {
                                            $email = $row0["email"];
                                            $userlevel = $row0["userlevel"];
                                            $photo = $row0["photourl"];
                                            $profilename = $row0["profilename"];

                                            if ($photo == 'null') {
                                                $photo = 'assets/images/no-img.png';
                                            }
                                            ?>
                                            <tr>
                                                <td style="text-align:center; padding : 3px 5px; border:1px solid gray;"
                                                    class="">
                                                    <img class="img-xs rounded-circle" src="<?php echo $photo; ?>" alt="" />
                                                </td>
                                                <td style="padding : 3px 10px; border:1px solid gray;">
                                                    <?php echo $email; ?>
                                                </td>
                                                <td style="padding : 3px 10px; border:1px solid gray;">
                                                    <?php echo $userlevel; ?>
                                                </td>
                                                <td style="padding : 3px 10px; border:1px solid gray;">
                                                    <?php echo $profilename; ?>
                                                </td>
                                                <td style="padding : 3px ; border:1px solid gray;">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="perm('<?php echo $email; ?>');">
                                                        <i class="mdi mdi-clock"></i></button>


                                                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                                                </td>



                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function reload() {
        window.location.href = uri;
    }

    function go(cat) {
        var b = '';
        if (cat == 1) { b = 'all'; }
        else if (cat == 2) { b = 'committee'; }
        else if (cat == 3) { b = 'teacher'; }
        else if (cat == 4) { b = 'guardian'; }
        else if (cat == 5) { b = 'student'; }
        else if (cat == 6) { b = 'guest'; }
        window.location.href = 'users.php?&level=' + b;
    }
    function perm(email){
        window.location.href = 'users-permission.php?&useremail=' + email;
    }
</script>


<script>
    function issue(stid) {
        var year = document.getElementById("year").value;
        var sec = document.getElementById("sec").value;
        var infor = "stid=" + stid + "&year=" + year + "&sec=" + sec;

        $("#btn" + stid).html("");

        $.ajax({
            type: "POST",
            url: "issue-testimonial.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#btn' + stid).html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#btn" + stid).html(html);
            }
        });
    }
</script>


<script>
    function fetchs(e) {
        if (e.key == 'Enter') {
            var br = document.getElementById("boardroll").value;
            var infor = "br=" + br;

            $("#sscspan").html("");

            $.ajax({
                type: "POST",
                url: "backend/fetch-board-roll.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#sscspan').html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#sscspan").html(html);
                    var st = document.getElementById("sscspan").innerHTML;

                    if (st == 'Something went wrong.') {
                        document.getElementById("sscspan").innerHTML = '<code>' + st + '</code><br>Data Missing or Multiple Entry Found.';
                    } else {
                        document.getElementById("stname").value = st;
                        document.getElementById("sscspan").innerHTML = '';
                        document.getElementById("gpagla").focus();
                    }
                }
            });
        }
    }


    function svs(e) {
        if (e.key == 'Enter') {
            savessc();
        }
    }


    function savessc() {
        var br = document.getElementById("boardroll").value;
        var gpgl = document.getElementById("gpagla").value;
        var infor = "br=" + br + "&gpgl=" + gpgl;

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-board-result.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                var st = parseInt(document.getElementById("boardroll").value) + 1;
                document.getElementById("boardroll").value = st;
                document.getElementById("gpagla").value = '';
                document.getElementById("boardroll").focus();

            }
        });
    }
</script>