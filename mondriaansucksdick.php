<?php 
include("/Modules/Database.php");

$Cards="";


$fileName = "loopband.jpg";
$Part1 = "
<div class='col-sm-4 col-md-3'>
<div class='card'>
    <div class='card-body text-center'>
        <a href='/categories/4'>";
            
            
$Part2  = "'/>
        </a>
        <div class='card-title mb-3'>Loopband</div>
    </div></div></div>
";


$Cards ="$Cards $Part1 $fileName $Part2";
