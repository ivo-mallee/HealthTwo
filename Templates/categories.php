<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
include("../Modules/Database.php");

$Cards="";

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$categoryIDKeyExist =  array_key_exists("categoryID", $queries);



if (!$categoryIDKeyExist) {$imagesPath = "/img/categories/"; $stmt = $conn->prepare("SELECT * FROM categories");}
if ($categoryIDKeyExist) {$imagesPath = "/img/categories/Machine Images/"; $categoryID = $queries['categoryID']; $stmt = $conn->prepare("SELECT * FROM categoryitems WHERE categoryID = $categoryID");}
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$result = $stmt->fetchAll();

$category="";
if ($categoryIDKeyExist) {
$stmt = $conn->prepare("SELECT * FROM categories WHERE ID = $categoryID");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$TEMP = $stmt->fetchAll()[0]['Name'];
$category = "<li class='breadcrumb-item'><a href='/categories?categoryID=$categoryID'>$TEMP </a></li>";
}




for ($i =0; $i<count($result); $i++) {

$name = $result[$i]['Name']; 
$ID = $result[$i]['ID']; 
$filePath = "$imagesPath$name.jpg";
$TEMPID = $result[$i]['ID'];


if (!$categoryIDKeyExist) {$link = "/categories?categoryID=$ID";}
if ($categoryIDKeyExist) {$link = "/categories/Item?ItemID=$TEMPID";}

$P1 = '<div class="col-sm-4 col-md-3">';
$P2 = '<div class="card">';
$P3 =     '<div class="card-body text-center">';
$P4 =         "<a href='$link'>";
$P5 =             "<img class='product-img img-responsive center-block' src='$filePath'/>";
$P6 =         '</a>';
$P7 =         "<div class='card-title mb-3'> $name </div>";
$P8 =     '</div>';
$P9 = '</div>';
$P10 = '</div>';

$card = "$P1$P2$P3$P4$P5$P6$P7$P8$P9$P10";
$Cards="$Cards $card";
}



?>

<body>
<div class="container">
    <?php
    include_once('defaults/header.php');
    include_once('defaults/menu.php');
    include_once('defaults/pictures.php');
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/categories">categories</a></li>
            <?php echo $category?>
        </ol>
    </nav>
    <div class="row gy-3 ">


            <?php echo $Cards?>

    </div>

    <hr>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

