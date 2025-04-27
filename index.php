<?php
include 'includes/header.php';
$sql="SELECT * FROM images ORDER BY upload_date DESC";
$stmt=$pdo->query($sql);
$images=$stmt->fetchAll();
?>
<div class="my-4">
    <h1>Photo Gallery</h1>
</div>

<div class="row">
<?php
if(count($images) > 0){
    ?>

    <?php foreach($images as $image){ 
        ?>
        <div class="card" style="width: 18rem;">
        <img src="assets/images/<?php echo $image['filename']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $image['title'] ?></h5>
            <p class="card-text"><?php echo date('M-D-Y', strtotime($image['upload_date'])); ?></p>
            
        </div>
    </div>
<?php
    }
}else{
    ?>
    <div class="alert alert-info" role="alert">
        No images found.
    </div>
<?php }?>

</div>




<?php
include 'includes/footer.php';
?>