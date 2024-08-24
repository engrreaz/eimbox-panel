<?php
include 'header.php';
if ($bup_backup == 0) {
    $hidden = 'hidden';
} else {
    $hidden = '';
}
?>

<style>
    input[type="checkbox"] {
        transform: scale(0.75);
        border-radius: 50%;
    }
</style>

<h3>Data Encryption Settings </h3>
<code>Settings -> Data Repository</code>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">


                <div class="row mb-4">
                    <div class="col-12 d-flex">
                        <div class="col-md-2">
                            Backup
                        </div>
                        <div class="col-md-1 " style="">
                            <input type="checkbox" class="form-control m-0 " id="bup_backup"
                                value="<?php echo $bup_backup; ?>" disabled>
                        </div>
                        <div class="col-md-3">

                        </div>

                        <div class="col-md-6 text-small text-muted">
                            Enable / Disable Backup & Restore Module
                            <br>To activate this features contact with administrator. <b>It may charged you.</b>
                        </div>
                    </div>
                </div>

                <div id="setupblock" <?php echo $hidden; ?>>
                    <div class="row mb-4">
                        <div class="col-12 d-flex">
                            <div class="col-md-2">
                                Encrypt Algorithm
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control " id="algo"
                                    value="<?php echo $bup_algorithm; ?>">
                            </div>
                            <div class="col-md-6 text-small text-muted">
                                Algorithm decide how your data will encrypt and decrept. Higher algorithm level give you
                                highest security.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 d-flex">
                            <div class="col-md-2">
                                Secret Key
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control " id="secret" value="<?php echo $bup_secret; ?>">
                                <button class="btn btn-inverse-info text-secondary  mt-2" onclick="secret(1);">Generate
                                    Key</button>
                            </div>
                            <div class="col-md-6 text-small text-muted">
                                Secret key is a key that makes your data more secure. You may set your secret key by
                                yourself or can generate a random key
                                key you wish. This key is a string that may contain A-Z, a-z, 0-9, dash, underscore
                                (without space).
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 d-flex">
                            <div class="col-md-2">
                                API Key
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control text-muted bg-dark" id="api"
                                    value="<?php echo $bup_api; ?>" readonly>
                                <button class="btn btn-inverse-primary mt-2" onclick="secret(2);">Get API</button>
                            </div>
                            <div class="col-md-6 text-small text-muted">
                                Your Data Encryption API Key (16 Character Long). <br>
                                To generate a new key, press <span class="bg-dark text-secondary  p-1 pr-2 pl-2"><b>Get
                                        API</b></span> button.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 d-flex">
                            <div class="col-md-2">
                                Email Address
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2 bg-primary" id="usr"
                                    value="<?php echo $usr; ?>" disabled />
                                <input type="text" class="form-control mb-2" id="mail2"
                                    value="<?php echo $bup_mail_2; ?>">
                                <input type="text" class="form-control " id="mail3" value="<?php echo $bup_mail_3; ?>">
                            </div>
                            <div class="col-md-6 text-small text-muted">
                                Setup your email address to send backup related information for your alert! If you do
                                not
                                want any mail from us please set blank those field.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 mt-4">
                        <div class="col-12 d-flex">
                            <div class="col-md-2">
                                Backup Period & Storage
                            </div>
                            <div class="col-md-4 d-block">
                                <div class="d-flex ">
                                    <div class="d-block">
                                        <input type="checkbox" class="form-control" id="daily"
                                            value="<?php echo $bup_daily; ?>">
                                        <small>Daily Backup</small>
                                    </div>
                                    <div class="d-block ml-3 mr-3">
                                        <input type="checkbox" class="form-control" id="monthly"
                                            value="<?php echo $bup_monthly; ?>">
                                        <small>Monthly Backup</small>
                                    </div>
                                    <div class="d-block">
                                        <input type="checkbox" class="form-control" id="cloud"
                                            value="<?php echo $bup_cloud; ?>">
                                        <small>Cloud Storage</small>
                                    </div>
                                    <div id="upst"></div>

                                </div>
                                <div class="text-small text-warning p-0">
                                    <small>
                                        Your backed up data will store in multiple server.
                                    </small>
                                </div>
                                <div class="text-small text-muted p-0">
                                    <small>
                                        You may download your data or send to your email address at any time.
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6 text-small text-muted">
                                Daily and Monthly backup will genarate automatically at the end of period (day/month)
                                and automaticall send you those backup file with necessay information.<br>
                                <span class="text-warning">for Cloud Storage you will charged on every MB on daily
                                    basis.</span>
                                <span class="text-info"><br><small>BDT </small>0.00/MB/Day</span>
                            </div>
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
    document.getElementById('defbtn').innerHTML = 'Update Setting';
    document.getElementById('defmenu').innerHTML = '';

    function defbtn() {
        update();
    }
</script>
<script>
    function secret(val) {

        var chars = '';
        var string_length = 0;
        var fld = '';
        if (val == 1) {
            chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz-_";
            string_length = 10 + Math.floor(Math.random() * 15);
            fld = document.getElementById("secret");
        } else {
            chars = "0123456789-ABCDEFGHIJKL-MNOPQRSTUVWXTZ-";
            string_length = 16;
            fld = document.getElementById("api");
        }

        var randomstring = '';
        for (var i = 0; i < string_length; i++) {
            var rnum = Math.floor(Math.random() * chars.length);
            randomstring += chars[rnum];
        }
        fld.value = randomstring;

    }

</script>

<script>
    function update() {
        var algo = document.getElementById("algo").value;
        var secret = document.getElementById("secret").value;
        var api = document.getElementById("api").value;
        var mail2 = document.getElementById("mail2").value;
        var mail3 = document.getElementById("mail3").value;



        var infor = 'algo=' + algo + '&secret=' + secret + '&api=' + api + '&mail2=' + mail2 + '&mail3=' + mail3;

        $("#upst").html("");

        $.ajax({
            type: "POST",
            url: "backend/update-backup-setting.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#upst').html('...');
            },
            success: function (html) {
                $("#upst").html(html);
            }
        });
    }

</script>