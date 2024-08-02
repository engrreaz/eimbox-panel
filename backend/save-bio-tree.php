<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$tail = $_POST['tail'];

if ($tail == 0) {
    $gen = $_POST['gen'];
    $clanmember = $_POST['clanmember'];
    $spouse = $_POST['spouse'];
    $ancestry = $_POST['ancestry'];
    $child = $_POST['child'];
}



if ($tail == 0) {
    if ($id == 0) {
        $query3g = "INsERT INTO biotree (id, gen, clanmember, ancestry, spouse, child_cnt) 
            VALUES (NULL, '$gen', '$clanmember', '$ancestry', '$spouse', '$child' )";
        $conn->query($query3g);
        $last_id = $conn->insert_id;
        echo $last_id;
    } else {
        $query3g = "update biotree set gen='$gen', clanmember='$clanmember', ancestry='$ancestry', spouse='$spouse', child_cnt='$child'  where id='$id' ;";
        $conn->query($query3g);
    }
} else if ($tail == 2) {
    $query3g = "DELETE FROM biotree where id='$id';";
    $conn->query($query3g);

} else if ($tail == 9) {
    $gen = $_POST['gen'];
    $chain = $_POST['chain'];

    $sql0x = "SELECT * FROM biotree where id = '$id';";
    $result0xnz = $conn->query($sql0x);
    if ($result0xnz->num_rows > 0) {
        while ($row0x = $result0xnz->fetch_assoc()) {
            $nam = $row0x["clanmember"];
        }
    }

    $full_listx = array();
    $sql0x = "SELECT * FROM biotree where ancestry='$id' order by id ;";
    $result0xqxxy = $conn->query($sql0x);
    if ($result0xqxxy->num_rows > 0) {
        while ($row0x = $result0xqxxy->fetch_assoc()) {
            $full_listx[] = $row0x;
        }
    }
    // echo var_dump($full_listx);

    ?>
            <div class="table-responsive">
                <div class="d-block text-wrap text-small  font-weight-bold p-2 text-warning " id="chain<?php echo $id; ?>">
            <?php echo $chain . ' ' . $nam; ?> <i class="mdi mdi-arrow-right"></i>
                </div>
                <table class="table table-dark" id="main-table-search">
                    <thead hidden>
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
                    $genxx = $gen + 1;
                    $sql0x = "SELECT * FROM biotree where gen='$genxx' and ancestry = '$id' order by id;";
                    $result0xn = $conn->query($sql0x);
                    if ($result0xn->num_rows > 0) {
                        while ($row0x = $result0xn->fetch_assoc()) {
                            $id2x = $row0x["id"];
                            $gen2x = $row0x["gen"];
                            $clanmember2x = $row0x["clanmember"];
                            $ancestry2x = $row0x["ancestry"];
                            $spouse2x = $row0x["spouse"];
                            $child2x = $row0x["child_cnt"];

                            $plx_namex = '';
                            $plxx = array_search($ancestry2x, array_column($full_listx, 'id'));
                            $plx_namex = $full_listx[$plxx]['clanmember'];
                            ?>
                                <tr id="tr<?php echo $id2x; ?>">
                                    <td class="py-1 pl-0">
                                        <img onclick="expand(<?php echo $gen2x; ?>,<?php echo $id2x; ?>, 9,<?php echo $id; ?>);"
                                            src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> <?php echo $id2x; ?> </td>
                                    <td> <?php echo $gen2x; ?> </td>
                                    <td> <?php echo $clanmember2x; ?> </td>
                                    <td> <?php echo $spouse2x; ?> </td>
                                    <td> <?php echo $ancestry2x . '. ' . $plx_namex; ?> </td>
                                    <td> <?php echo $child2x; ?> </td>
                                    <td class="pr-0 text-right">

                                        <button class="btn btn-inverse-warning" onclick="edit(<?php echo $id2x; ?>);">Edit</button>
                                        <button class="btn btn-inverse-success"
                                            onclick="addchild(<?php echo $gen2x + 1; ?>, <?php echo $id2x; ?>);">Child</button>
                                    </td>
                                </tr>
                                <tr class="p-0">
                                    <td class="p-0 pr-3"></td>
                                    <td colspan="7" id="clan<?php echo $id2x; ?>" class="p-0 pr-0">

                                    </td>

                                </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
            </div>

    <?php

}

// echo $query3g;