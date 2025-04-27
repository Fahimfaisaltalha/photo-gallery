<?php
include 'includes/header.php';

// Initialize variables for form handling
$error='';
$success='';

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    if(empty($title) || empty($description) || empty($image['name'])) {
        $error="Please fill in all fields.";
    }

    $target_dir ='assets/images/';
    if(!file_exists($target_dir)){
        mkdir($target_dir, 0777, true);
    }
    
    $file=$image['name'];
    $new_name = uniqid() . $file;
    $target_file = $target_dir . $new_name;

    if($image['size'] > 5000000) {
        $error="File size is too large. Maximum size is 5MB.";
    } else {
        if(move_uploaded_file($image['tmp_name'], $target_file)) {
            $sql = "INSERT INTO images (title, description, filename) VALUES (:title, :description, :filename)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'title' => $title, 
                'description' => $description, 
                'filename' => $new_name
            ]);
            $success="Photo uploaded successfully.";
            $title='';
            $description='';
        } else {
            $error="Error uploading file.";
        } 
    }
}
?>
<!-- Page Header -->
<div class="my-4 text-center">
    <h1 class="display-4">Upload New Photo</h1>
    <p class="lead">Share your beautiful moments with us</p>
</div>

<!-- Success/Error Messages -->
<?php if($success): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($error): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Upload Form -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body p-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">Select Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                        <div class="form-text">Maximum file size: 5MB</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Upload Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>