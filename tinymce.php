<?php
include 'header.php';



?>


<?php
$allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
$allowedTags .= '<li><ol><ul><span><div><br><ins><del>';
// Should use some proper HTML filtering here.
if ($_POST['elm1'] != '') {
    $sHeader = '<h1>Ah, content is king.</h1>';
    $sContent = strip_tags(stripslashes($_POST['elm1']), $allowedTags);
} else {
    $sHeader = '<h1>Nothing submitted yet</h1>';
    $sContent = '<p>Start typing...</p>';
    $sContent .= '<p><img width="107" height="108" border="0" src="/mediawiki/images/badge.png"';
    $sContent .= 'alt="TinyMCE button"/>This rover has crossed over</p>';
}
?>

<script language="javascript" type="text/javascript" src="/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
    tinyMCE.init({
        theme: "advanced",
        mode: "exact",
        elements: "elm1",
        theme_advanced_toolbar_location: "top",
        theme_advanced_buttons1: "bold,italic,underline,strikethrough,separator,"
            + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
            + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2: "link,unlink,anchor,image,separator,"
            + "undo,redo,cleanup,code,separator,sub,sup,charmap",
        theme_advanced_buttons3: "",
        height: "350px",
        width: "600px"
    });
</script>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Register of Institution</h4>
            <p class="card-description"> Add class <code>.table-dark</code>
            </p>
            <div class="table-responsive">
                <?php echo $sHeader; ?>
                <h2>Sample using TinyMCE and PHP</h2>
                <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
                    <textarea id="elm1" name="elm1" rows="15" cols="80"><?php echo $sContent; ?></textarea>
                    <br />
                    <input type="submit" name="save" value="Submit" />
                    <input type="reset" name="reset" value="Reset" />
                </form>
            </div>
        </div>
    </div>
</div>







<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function refbook() {
        window.location.href = 'refbook.php';
    }


</script>