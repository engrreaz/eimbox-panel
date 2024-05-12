<style>
    .a {
        font-size: 20px;
        font-weight: 700;
        font-style: normal;
        line-height: 24px;
    }

    .b {
        font-size: 15px;
        font-weight: 400;
        font-style: normal;
        line-height: 18px;
    }

    .c {
        font-size: 12px;
        font-weight: 400;
        font-style: italic;
        line-height: 16px;
    }

    .code {text-align:center; font-size:11px; font-weight:700;}
</style>

<table style="margin:auto; width:100%;">
    <tr>
        <td style="text-align:center;">
            <img src="https://eimbox.com/logo/<?php echo $sccode; ?>.png" width="80" />
        </td>
    </tr>
    <tr>
        
        <td style="text-align:center;">
            <div class="a"><?php echo $scname; ?></div>
            <div class="b"><?php echo $scaddress; ?></div>
            <div class="c"><?php echo 'Mobile : ' . $mobile . '.&nbsp;&nbsp;&nbsp;&nbsp; Email : ' . $scmail; ?></div>
            <div class="c"><?php echo 'Web : ' . $scweb; ?></div>

            <table style="width:100% ; margin:8px auto;">
                <tr>
                    <td class="code">Center Code : 415 (School)</td>
                    <td class="code">EIIN : 103187</td>
                    <td class="code">Center Code : 421 (College)</td>
                </tr>
            </table>

        </td>
    </tr>

</table>


<hr style="margin:3px 0; border:1px solid black;">
