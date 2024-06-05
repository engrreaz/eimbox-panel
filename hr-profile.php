<?php
include 'header.php';

$dismsg = 0;
$cls2 = $sec2 = $roll2 = $rollno = '';
$new = 0; // check new entry or not

if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
} else {
    $tid = 0;
}


$sql5 = "SELECT * FROM teacher where tid='$tid' and sccode='$sccode' ";
$result7 = $conn->query($sql5);
if ($result7->num_rows > 0) {
    while ($row5 = $result7->fetch_assoc()) {
        $tnamee = $row5["tname"];
        $tnameb = $row5["tnameb"];
        $position = $row5["position"];
        $subject = $row5["subjects"];
        $slot = $row5["slots"];
        $jdate = $row5["jdate"];
        $fname = $row5["fname"];
        $mname = $row5["mname"];
        $preadd = $row5["preadd"];
        $dob = $row5["dob"];
        $religion = $row5["religion"];
        $gender = $row5["gender"];
        $email = $row5["email"];
        $phone = $row5["mobile"];
        // $ = $row5[""];



    }
} else {

}



if ($dob == '') {
    $doa = date('Y-01-01');
}

?>
<style>
    .col-form-label {
        color: slategray;
    }
</style>
<h3>HR Profile</h3>



<style>
    h4 {
        font-weight: bold;
    }
</style>


<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <?php
                                $stpth = "https://www.eimbox.com/student/<?php echo $tid;?>.jpg";
                                if (!file_exists($stpth)) {
                                    $stpth = "https://www.eimbox.com/students/noimg.jpg";
                                }
                                ?>
                                <img src="<?php echo $stpth; ?>" style="height:120px;" />




                                <form class="upload-form" action="backend/upload.php" method="post"
                                    enctype="multipart/form-data">

                                    <h1>Upload Form</h1>
                                    <label for="files"><i class="fa-solid fa-folder-open fa-2x"></i>Select files
                                        ...</label>
                                    <input id="files" type="file" name="files[]" multiple>
                                    <div class="progress"></div>
                                    <button type="submit">Upload</button>
                                    <div class="result"></div>
                                </form>

                                <script>
                                    // Declare global variables for easy access 
                                    const uploadForm = document.querySelector('.upload-form');
                                    const filesInput = uploadForm.querySelector('#files');

                                    // Attach onchange event handler to the files input element
                                    filesInput.onchange = () => {
                                        // Append all the file names to the label
                                        uploadForm.querySelector('label').innerHTML = '';
                                        for (let i = 0; i < filesInput.files.length; i++) {
                                            uploadForm.querySelector('label').innerHTML += '<span><i class="fa-solid fa-file"></i>' + filesInput.files[i].name + '</span>';
                                        }
                                    };


                                    // Attach submit event handler to form
                                    uploadForm.onsubmit = event => {
                                        event.preventDefault();
                                        // Make sure files are selected
                                        if (!filesInput.files.length) {
                                            uploadForm.querySelector('.result').innerHTML = 'Please select a file!';
                                        } else {
                                            // Create the form object
                                            let uploadFormDate = new FormData(uploadForm);
                                            // Initiate the AJAX request
                                            let request = new XMLHttpRequest();
                                            // Ensure the request method is POST
                                            request.open('POST', uploadForm.action);
                                            // Attach the progress event handler to the AJAX request
                                            request.upload.addEventListener('progress', event => {
                                                // Add the current progress to the button
                                                uploadForm.querySelector('button').innerHTML = 'Uploading... ' + '(' + ((event.loaded / event.total) * 100).toFixed(2) + '%)';
                                                // Update the progress bar
                                                uploadForm.querySelector('.progress').style.background = 'linear-gradient(to right, #25b350, #25b350 ' + Math.round((event.loaded / event.total) * 100) + '%, #e6e8ec ' + Math.round((event.loaded / event.total) * 100) + '%)';
                                                // Disable the submit button
                                                uploadForm.querySelector('button').disabled = true;
                                            });
                                            // The following code will execute when the request is complete
                                            request.onreadystatechange = () => {
                                                if (request.readyState == 4 && request.status == 200) {
                                                    // Output the response message
                                                    uploadForm.querySelector('.result').innerHTML = request.responseText;
                                                }
                                            };
                                            // Execute request
                                            request.send(uploadFormDate);
                                        }
                                    };



                                </script>






                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <code>ID # <?php echo $tid; ?></code><br>
                        <h4 class=""><?php echo $tnamee; ?></h4>
                        <h5 class=""><?php echo $tnameb; ?></h5>
                        <h6 class=""><?php echo $position; ?> / <?php echo $slot; ?></h6>
                    </div>

                    <div class="col-md-4">
                        <h5 class=""><i class="mdi mdi-book-open-page-variant mdi-18px pr-3"></i><?php echo $subject; ?>
                        </h5>
                        <h6 class=""><i
                                class="mdi mdi-email-open-outline mdi-18px pr-3"></i><small><?php echo $email; ?>
                            </small></h6>
                        <h6 class=""><i class="mdi mdi mdi-phone mdi-18px pr-3"></i><small><?php echo $mobile; ?>
                            </small></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Ramkrishnopur, Bhurbhuria, Homna, Cumilla.
                        </p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Ramkrishnopur, Bhurbhuria, Homna, Cumilla.
                        </p>
                    </div>

                    <div class="col-md-6">
                        <h6 class="">..........................</h6>
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
    document.getElementById('stnameeng').focus();
    $(function () {
        $(".js-select").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    });

</script>

<script>
    document.getElementById('defbtn').innerHTML = 'Edit Profile';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        window.location.href = 'hr-edit.php?tid=<?php echo $tid; ?>';
    }
</script>