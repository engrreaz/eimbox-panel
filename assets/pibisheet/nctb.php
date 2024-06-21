<table style="width:100%">
    <tr>
        <td colspan="3" style="text-align:center;">
            <h3 class="text-center font-weight-bold">Student Data Collection Table for Learning Experience Based
                Assessment</h3>
            <h3><b><?php echo $exam . ' ' . $assess; ?></b></h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="rndbox">
                <table>
                    <tr>
                        <td style="vertical-align:top;">Institute Name : &nbsp;&nbsp;&nbsp;</td>
                        <td style="vertical-align:top;">
                            <h5><b><?php echo $scname; ?></b></h5>
                            <small style="line-height:9px;"><?php echo $scaddress; ?></small>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td>
            <div class="rndbox">
                <table>
                    <tr>
                        <td>
                            <b><?php echo date('d/m/Y'); ?></b><br><small>Date</small>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="height:10px;"></td>
    </tr>
    <tr>
        <td>
            <div class="rndbox sh">
                <table>
                    <tr>
                        <td style="vertical-align:top;">Class : </td>
                        <td style="vertical-align:top;">
                            <b><?php echo $classname . ' | ' . $sectionname;
                            ; ?></b>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td>
            <div class="rndbox sh">
                <table>
                    <tr>
                        <td style="vertical-align:top;">Subject : </td>
                        <td style="vertical-align:top;">
                            <b><?php echo $subname . '<br>' . $subben;
                            ; ?></b>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td>

            <div class="rndbox sh">
                <table>
                    <tr>
                        <td style="vertical-align:bottom; font-size:9px; text-align:center;">
                            <br><br><br>Teacher's Name & Signature
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>

</table>