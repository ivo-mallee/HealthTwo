<!DOCTYPE html>
<html>
    <?php
    include_once('defaults/head.php');
    include("../Modules/Database.php");
    
    $Cards="";
    
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $categoryIDKeyExist =  array_key_exists("categoryID", $queries);
  
    
    
    $TEMPID = $queries["ItemID"];
    
    $stmt = $conn->prepare("SELECT categoryID FROM `categoryitems` WHERE `ID` = $TEMPID");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
   
  
    

    $stmt = $conn->prepare("SELECT * FROM categoryitems WHERE ID = $TEMPID");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    $categoryID = $result[0]['categoryID'];
    
    $stmt = $conn->prepare("SELECT Name FROM categories WHERE ID=$categoryID");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $CATresult = $stmt->fetchAll();  
    $categoryname = $CATresult[0]['Name'];

    $stmt = $conn->prepare("SELECT * FROM itemdescription WHERE CategoryItemID =$TEMPID");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $DESC = "No Description available";
    if ($stmt->rowCount() != 0) {$DESC = $stmt->fetchAll()[0]['ItemDescription']; }

    

    

    
    $itemName = $result[0]["Name"];
    $imagesPath = "/img/categories/Machine Images/$itemName.jpg";
    ?>

<style>
@font-face {
    font-family: myFirstFont;
    src: url(Fonts/RobotoMono-Light.ttf);
  }

.parent {
display: grid;
grid-template-columns: 0.1fr 0.8fr 0.2fr 1fr 0.1fr;
grid-template-rows: repeat(2, 1fr) 10fr;
grid-column-gap: 0px;
grid-row-gap: 0px;
width: 100%;
height: 80vh;
}

.div1 { grid-area: 2 / 2 / 4 / 3; }
.div2 { grid-area: 2 / 4 / 3 / 5; font-family: myFirstFont; font-size: 300%;}
.div3 { grid-area: 3 / 4 / 4 / 5;   word-wrap: break-word; font-family: myFirstFont; font-size: 150%;}
.MachineImage{width: 100%;}

</style>



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
            <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
            <li class="breadcrumb-item"><a href="/categories?categoryID=<?php echo $categoryID;?> "> <?php echo $categoryname;?> </a></li>
            <li class="breadcrumb-item"><a href="/categories/Item?ItemID=<?php echo $TEMPID;?>"><?php echo $itemName ?></a></li>
        </ol>
    </nav>
    <div>
        <div class="parent">
            <div class="div1"> <img src=" <?php echo $imagesPath;?>" class="MachineImage"> </div>
            <div class="div2"><?php echo $itemName; ?></div>
            <div class="div3"><?php echo $DESC; ?></div>
        </div>



    </div>

    <hr>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

