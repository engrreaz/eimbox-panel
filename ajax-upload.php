
<form class="upload-form" name="uploadform" action="backend/upload.php" method="post" enctype="multipart/form-data">
    <input type="text" value="<?php echo $datamon; ?>" name="datam" hidden />
    <input type="text" value="<?php echo $dest_file_name; ?>" name="destfilename" hidden />
    <label for="files"><i class="fa-solid fa-folder-open fa-2x"></i>Select files
        ...</label>
    <input id="files" class="form-control" type="file" name="files[]" multiple>
    <div class="progress lightmode"></div>
    <button type="submit" id="uploadfile" class="btn btn-inverse-primary mt-2 pt-2">Upload</button>
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
            uploadForm.querySelector('label').innerHTML += '<span><i class="mdi mdi-file"></i>' + filesInput.files[i].name + '</span>';
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
            uploadForm.querySelector('label').innerHTML = '<button type="submit">Upload</button>';
        }
    };
</script>