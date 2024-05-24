</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->



<footer class="footer d-print-none">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">a paperless school management
            system</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © eimbox.com 2024</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<div id="logstatus"></div>

<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- Plugin js for this page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
<script src="assets/js/file-upload.js"></script>
<script src="assets/js/typeahead.js"></script>
<script src="assets/js/select2.js"></script>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#example');
</script>



<?php
// } else {
//         include 'access-denied.php';
// }
?>
    <script>
        if (<?php echo $permission; ?> == 0) {
            document.getElementById("full-page").style.display = "none";
            document.write('<div>Access-Denied</div>');
            document.write('<div><?php echo $permission . '...' . $key . '///';?></div>');

        } else {
            document.getElementById("full-page").style.display = "flex";

        }
        document.write('<div><?php echo $permission . '...' . $key . '///';?></div>');
    </script>
</body>

</html>



<script>
    function loger() {
        var infor = "page=<?php echo $curfile; ?>" ;
        $("#logstatus").html("----");
        $.ajax({
            type: "POST",
            url: "backend/save-log.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#logstatus').html('<span>***</span>');
            },
            success: function (html) {
            }
        });
    }

    const element = document.getElementById("logstatus");
    setInterval(function () {
        var infor = "page=<?php echo $curfile; ?>" ;

        $("#logstatus").html("----");

        $.ajax({
            type: "POST",
            url: "backend/save-log.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#logstatus').html('<span></span>');
            },
            success: function (html) {
                $('#logstatus').html(html);
            }
        });
    }, 1000);
</script>


