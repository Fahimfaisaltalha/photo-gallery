<?php
include 'includes/header.php';

// Fetch all images from database ordered by latest first 
$sql="SELECT * FROM images ORDER BY upload_date DESC";
$stmt=$pdo->query($sql);
$images=$stmt->fetchAll();
?>
<!-- Page Header -->
<div class="my-4 text-center">
    <h1 class="display-4">Photo Gallery</h1>
    <p class="lead">View our collection of beautiful images</p>
</div>

<!-- Gallery Grid -->
<div class="row">
<?php
if(count($images) > 0){
    foreach($images as $image){ 
    ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <!-- Fixed image size using Bootstrap's img-fluid and custom height -->
                <div style="height: 250px; overflow: hidden;">
                    <img src="assets/images/<?php echo $image['filename']; ?>" 
                         class="card-img-top img-fluid h-100 w-100" 
                         style="object-fit: cover;"
                         alt="<?php echo $image['title']; ?>">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $image['title'] ?></h5>
                    <p class="card-text text-muted"><?php echo $image['description'] ?></p>
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
    <!-- Display message when no images found -->
    <div class="alert alert-info text-center" role="alert">
        <i class="fas fa-info-circle me-2"></i>No images found.
    </div>
<?php }?>
</div>

<?php
include 'includes/footer.php';
?>