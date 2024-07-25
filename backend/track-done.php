<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$step = $_POST['step'];
if($step == 1) {$fld = 'paystructure';} else 
if($step == 2) {$fld = 'attnd';} else 
if($step == 3) {$fld = 'bonus';} else 
if($step == 4) {$fld = 'calc';} else 
if($step == 5) {$fld = 'payoff';} else 
if($step == 6) {$fld = 'dispuch';} else 
if($step == 7) {$fld = 'check';} else 
if($step == 8) {$fld = 'done';} else 
{$fld = 'attnd';}


$query332 = "UPDATE payroll_track set $fld = '4' where id ='$id' and sccode='$sccode' ;";
$conn->query($query332);

echo '*';
