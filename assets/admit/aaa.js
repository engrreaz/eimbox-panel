
    function crud(id, tail) {
        var eng = document.getElementById('peng').value;
        var ben = document.getElementById('pben').value;
        var month = document.getElementById('monmon').value;
        var inin = document.getElementById('inin').checked;
        var exex = document.getElementById('exex').checked;
        var infor = "id=" + id + "&tail=" + tail + "&eng=" + eng + "&ben=" + ben + "&month=" + month + "&inin=" + inin + "&exex=" + exex;
        // alert(infor);ddd
        $("#gex").html("");

        $.ajax({
            url: "backend/crud-set-finance.php", type: "POST", data: infor, cache: false,
            beforeSend: function () {
                $("#gex").html('<span class=""><small></small></span>');
            },
            success: function (html) {
                $("#gex").html(html);
                window.location.href = 'st-payment-setup.php';
                // if (document.getElementById("div" + tail).innerHTML == 'insert') {
                //     window.location.href = 'st-payment-setup.php';
                // }
                // document.getElementById(tail).style.borderColor = 'green';

            }
        });
    }
