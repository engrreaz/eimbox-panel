<?php
include 'header.php';

$month = $_GET['m'] ?? 0;
$year = $_GET['y'] ?? 0;

$refno = $_GET['ref'] ?? 0;
$undef = $_GET['undef'] ?? 99;

?>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Register of Institution</h4>
            <p class="card-description"> Add class <code>.table-dark</code>
            </p>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Register Name </th>
                            <th> Dept. </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-1">
                                <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                            </td>
                            <td> Refernce Book </td>
                            <td> All </td>
                            <td><label class="badge badge-primary">View Book</label></td>
                        </tr>
       
             
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>







<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;


    function edit(id, taill) {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew=' + id + tail;
    }

</script>