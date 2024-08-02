<?php
include 'header.php';
if (isset($_GET['id'])) {
    $idq = $_GET['id'];
} else {
    $idq = 0;
}


$full_list = array();
$sql0x = "SELECT * FROM biotree order by id ;";
$result0xqxx = $conn->query($sql0x);
if ($result0xqxx->num_rows > 0) {
    while ($row0x = $result0xqxx->fetch_assoc()) {
        $full_list[] = $row0x;
    }
}





if ($idq > 0) {
    $sql0x = "SELECT * FROM biotree where  id='$idq' ;";
    $result0xq = $conn->query($sql0x);
    if ($result0xq->num_rows > 0) {
        while ($row0x = $result0xq->fetch_assoc()) {
            $gen = $row0x["gen"];
            $clanmember = $row0x["clanmember"];
            $ancestry = $row0x["ancestry"];
            $spouse = $row0x["spouse"];
            $child = $row0x["child_cnt"];
        }
    } else {
        $gen = '';
        $clanmember = '';
        $ancestry = '';
        $spouse = '';
        $child = '';
    }
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body ">
                <div class="row pl-4 d-block">
                    <h4 class="mb-0 pb-0"><small><b>Add New/Edit Clan Member</b></small></h4>
                    <h6 class="text-warning text-small mt-0 pt-0"><small>Member will added inside current
                            <b>Ancestor</b></small></h6>

                </div>
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="col-md-2">
                            <label class="form-label text-small">ID</label>
                            <input type="text" class="form-control bg-dark text-secondary" value="<?php echo $idq; ?>"
                                id="id" disabled />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Gen. No.</label>
                            <input type="text" class="form-control" value="<?php echo $gen; ?>" id="gen" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-small">Name</label>
                            <input type="text" class="form-control" value="<?php echo $clanmember; ?>" id="clanmember" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-small">Ancestry</label>
                            <select class="form-control text-white" id="ancestry">
                                <option value="0">0. (No Name)</option>
                                <?php
                                $gentu = $gen - 1;
                                $sql0x = "SELECT * FROM biotree where gen='$gentu' order by clanmember ;";
                                $result0xt = $conn->query($sql0x);
                                if ($result0xt->num_rows > 0) {
                                    while ($row0x = $result0xt->fetch_assoc()) {
                                        $idx = $row0x["id"];
                                        $ancestryname = $row0x["clanmember"];

                                        if ($idx == $ancestry) {
                                            $sel = 'selected';
                                        } else {
                                            $sel = '';
                                        }
                                        echo '<option value="' . $idx . '" ' . $sel . '>' . $idx . ' &bull; ' . $ancestryname . '</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="col-md-4">
                            <label class="form-label text-small">Spouse</label>
                            <input type="text" class="form-control text-secondary" value="<?php echo $spouse; ?>"
                                id="spouse" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Child</label>
                            <input type="text" class="form-control" value="<?php echo $child; ?>" id="child" />
                        </div>




                        <div class="col-md-2">
                            <label class="form-label text-small " id="stinfo">&nbsp;</label>
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                <button class="btn btn-inverse-success p-2 "
                                    onclick="save(<?php echo $idq; ?>, 0);">Save</button>

                                <button class="btn btn-inverse-danger p-2"
                                    onclick="save(<?php echo $idq; ?>, 5);">Delete</button>

                            </div>
                        </div>
                    </div>
                </div>









            </div>
        </div>
    </div>

    <?php
} else {
    echo '<div id="new-part" hidden></div>';
}

?>









<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bio Tree</h4>
            </p>
            <div class="table-responsive">
                <div id="chain0"></div>

                <table class="table table-dark" id="main-table-search">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID </th>
                            <th> Gen </th>
                            <th> Name </th>
                            <th> Spouse </th>
                            <th> Ancestry </th>
                            <th> Successor </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $sql0x = "SELECT * FROM biotree order by gen, id ;";
                        $sql0x = "SELECT * FROM biotree where gen<=1 order by id;";
                        $result0x = $conn->query($sql0x);
                        if ($result0x->num_rows > 0) {
                            while ($row0x = $result0x->fetch_assoc()) {
                                $id2 = $row0x["id"];
                                $gen2 = $row0x["gen"];
                                $clanmember2 = $row0x["clanmember"];
                                $ancestry2 = $row0x["ancestry"];
                                $spouse2 = $row0x["spouse"];
                                $child2 = $row0x["child_cnt"];

                                $plx = array_search($ancestry2, array_column($full_list, 'clanmember'));
                                if ($plx == '' || $plx == NULL) {
                                    $plx_name = '';
                                } else {
                                    $plx_name = $full_list[$plx]['clanmember'];
                                }

                                ?>
                                <tr id="tr<?php echo $id2; ?>">
                                    <td class="py-1">
                                        <img onclick="expand(<?php echo $gen2; ?>,<?php echo $id2; ?>, 9,<?php echo $ancestry2; ?>);"
                                            src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> <?php echo $id2; ?> </td>
                                    <td> <?php echo $gen2; ?> </td>
                                    <td> <?php echo $clanmember2; ?> </td>
                                    <td> <?php echo $spouse2; ?> </td>
                                    <td> <?php echo $ancestry2 . '. ' . $plx_name; ?> </td>
                                    <td> <?php echo $child2; ?> </td>
                                    <td class="pr-3 text-right">
                                        <button class="btn btn-inverse-warning"
                                            onclick="edit(<?php echo $id2; ?>);">Edit</button>
                                        <button class="btn btn-inverse-success"
                                            onclick="addchild(<?php echo $gen2 + 1; ?>, <?php echo $id2; ?>);">Child</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0 pr-3"></td>
                                    <td colspan="7" id="clan<?php echo $id2; ?>" class="p-0 pr-3">

                                    </td>

                                </tr>
                            <?php }
                        } ?>
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
    document.getElementById('defbtn').innerHTML = 'New Ref.';
    document.getElementById('defmenu').innerHTML = '';

    function defbtn() {
        document.getElementById("new-part").innerHTML += '<input id="gen"><input id="clanmember"><input id="ancestry"><input id="spouse"><input id="child">';
        document.getElementById("gen").value = "";
        document.getElementById("clanmember").value = "";
        document.getElementById("ancestry").value = "";
        document.getElementById("spouse").value = "";;
        document.getElementById("child").value = '';
        save(0, 0);
    }

    function addchild(gen, ancestry) {
        document.getElementById("new-part").innerHTML += '<input id="gen"><input id="clanmember"><input id="ancestry"><input id="spouse"><input id="child">';
        document.getElementById("gen").value = gen;
        document.getElementById("clanmember").value = "";
        document.getElementById("ancestry").value = ancestry;
        document.getElementById("spouse").value = "";;
        document.getElementById("child").value = '';
        save(0, 0);
    }

    function edit(id) {
        window.location.href = 'bio-tree.php?id=' + id;
    }


    function save(id, tail) {
        var gen = document.getElementById("gen").value;
        var clanmember = document.getElementById("clanmember").value;
        var ancestry = document.getElementById("ancestry").value;
        var spouse = document.getElementById("spouse").value;
        var child = document.getElementById("child").value;

        var infor = "id=" + id + "&gen=" + gen + "&clanmember=" + clanmember + "&ancestry=" + ancestry + "&spouse=" + spouse + "&child=" + child + "&tail=" + tail;
        // alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-bio-tree.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);


                if (id == '0' && tail == '0') {
                    window.location.href = 'bio-tree.php?id=' + html;
                } else {
                    window.location.href = 'bio-tree.php';
                }
            }
        });
    }


    function expand(gen, id, tail, ancestry) {
        if (gen == 1) {
            var chain = document.getElementById("chain" + ancestry).innerHTML;
        } else {
            var chain = document.getElementById("chain" + ancestry).innerHTML;
        }

        var infor = "id=" + id + "&gen=" + gen + "&tail=" + tail + "&chain=" + chain;
        $("#clan" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/save-bio-tree.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#clan' + id).html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#clan" + id).html(html);
                // alert(id);
                document.getElementById("tr"+id).style.backgroundColor  = 'black' ;
            }
        });
    }

    $(document).ready(function () {
        $('#main-table-searchx').DataTable();
    });

</script>