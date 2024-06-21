<style>
    .infos,
    .infos tr,
    .infos td {
        border: 1px solid gray;
        padding: 2px 7px;
    }
</style>


<table style="margin:auto; ">
    <tr>
        <td style="width:90px;">
            <img src="https://eimbox.com/logo/<?php echo $sccode; ?>.png" width="80" />
        </td>
        <td style="width:12px;"></td>
        <td style="text-align:center;">
            <h4 class="font-weight-bold p-0 m-0"><?php echo $scname; ?></h4>
            <div class="m-0 p-0"><?php echo $scaddress; ?></div>
            <div class="text-small">
                <?php echo 'Mobile : ' . $mobile . '.&nbsp;&nbsp;&nbsp;&nbsp; Email : ' . $scmail; ?>
            </div>
            <div class="text-small"><?php echo 'Web : ' . $scweb; ?></div>

            <table style="width:100% ; margin:8px auto; ">
                <tr>
                    <td class="code text-small">Center Code : 415 (School)</td>
                    <td class="code text-small">EIIN : 103187</td>
                    <td class="code text-small">Center Code : 421 (College)</td>
                </tr>
            </table>

        </td>
    </tr>

</table>


<hr style="margin:3px 0; border:1px solid black;">
<table style="width:100%; margin:10px 0;">
    <tr>
        <td>Ref. No. <b></b></td>
        <td style="text-align:right;"><?php echo 'Date : <b>' . date('l, d-m-Y') . '</b>'; ?></td>
    </tr>
</table>

<div class=" font-weight-bold m-0 " style="text-align:center;">
    Student Data Collection Table for Learning Experience Based Assessment
    <br>
    <small class="">
        শিখন অভিজ্ঞতা ভিত্তিক মূল্যায়নের জন্য শিক্ষার্থীর উপাত্ত সংগ্রহের ছক
    </small>
</div>


<div class="mt-3">
    <table style="width:100%" class="table ">
        <tr>
            <td class="infos">
                <b><?php echo $exam; ?></b>
                <div class="text-small m-0 p-0 pt-1">Examination</div>
            </td>

            <td class="infos">
                <b><?php echo $assess; ?></b>
                <div class="text-small m-0 p-0 pt-1">Assessment</div>
            </td>
            <td class="infos" rowspan="2" style="vertical-align:bottom; font-size:9px; text-align:center;">
                <br><br>Teacher's Name & Signature

            </td>
        </tr>

        <!-- <tr>
            <td class="p-0" colspan="3" style="font-size:10px;">&nbsp;</td>
        </tr> -->
        <tr>
            <td class="infos">
                <b><?php echo $classname . ' | ' . $sectionname;
                ; ?></b>
                <div class="text-small m-0 p-0 pt-1">Class | Section</div>
            </td>
            <td class="infos">
                <b><?php echo $subname . ' / ' . $subben;
                ; ?></b>
                <div class="text-small m-0 p-0 pt-1">Subject</div>

            </td>

        </tr>

    </table>
</div>