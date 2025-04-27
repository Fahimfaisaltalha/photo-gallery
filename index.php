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
    foreach($images as $image){ 
    ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/<?php echo $image['filename']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $image['title'] ?></h5>
                    <p class="card-text"><?php echo $image['description'] ?></p>
                    <p class="card-text"><small class="text-muted">
                        <?php echo date('M-d-Y', strtotime($image['upload_date'])); ?>
                    </small></p>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>
    <div class="alert alert-info" role="alert">
        No images found.
    </div>
<?php }?>
</div>

<?php
include 'includes/footer.php';
?>