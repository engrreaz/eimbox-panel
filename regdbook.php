<?php
include 'header.php';



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
                            <td><label onclick="refbook();" class="badge badge-primary">View Book</label></td>
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
    function refbook(){
        window.location.href = 'refbook.php';
    }

   
</script>