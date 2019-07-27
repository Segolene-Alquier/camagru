<?php
session_start();
// creer restriction login
require "image_class.php";
// var_dump($_SESSION["username"]);
$image = new Image;
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
	if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
	{
		$image->findUserFromId($_SESSION["username"]);
		$image->upload();
	}
}
// $allImagesFromCurrentUser = $image->showByUserId($userdata['id']);
// if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['image_id']))
// 	$image->delete($userdata['id'], $_GET['image_id']);
// else
// 		{
// 			$message = 'There is some error in the file upload. Please check the following error.<br>';
// 			$message .= 'Error:' . $_FILES['uploadedFile']['error'];
// 		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit picture</title>
    <link rel="stylesheet" type="text/css" href="../camagru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
</head>
<body>
    <?php include_once '../navigation.php'; ?>
	<div class="section">
		<div class="edit-wrapper">
			<div class="columns">
				<div class="column is-four-fifths edit-left box">
					<div class="edit-left-top">
					<h2 class="subtitle">📥 Upload a picture OR 📸 take a new one! </h2>
						<div class="columns ">
							<div class="column is-four-fifths edit-left-image" >
							</div>
							<div class="column">
								<div class="edit-left-buttons">
								<div class="modal">
									<div class="modal-background"></div>
										<div class="modal-card">
										<header class="modal-card-head">
											<p class="modal-card-title">Upload the image of your choice</p>
											<button id="modal-close" class="delete" aria-label="close"></button>
										</header>
										<section class="modal-card-body">
											<!-- <form action="uploader.php" method="post" enctype="multipart/form-data" class="button button-edit">
												Upload
												<input class="file-input" type="file" name="fileToUpload" id="fileToUpload">
												<input type="submit" value="Upload Image" name="submit">
											</form> -->
											<?php
												if (isset($_SESSION['message']) && $_SESSION['message'])
												{
												printf('<b>%s</b>', $_SESSION['message']);
												unset($_SESSION['message']);
												}
											?>
											<form method="POST" action="" enctype="multipart/form-data">
												<div>
												<span>Upload a File:</span>
												<input type="file" name="uploadedFile" />
												</div>

												<input type="submit" name="uploadBtn" value="Upload" />
											</form>
										</section>
										<footer class="modal-card-foot">
											<button class="button is-success">Save changes</button>
											<button class="button">Cancel</button>
										</footer>
									</div>
								</div>
									<div class="edit-left-button">
										<button id="showModal" class="button button-edit" style="background-color: rgb(58, 44, 200); color: white;"><i class="fas fa-file-upload" style="margin-right: 5px;"></i>Upload</button>
									</div>
									<div class="edit-left-button ">
										<button class="button button-edit" style="background-color: rgb(58, 44, 200); color: white;"><i class="fas fa-camera" style="margin-right: 5px;"></i>New</button>
									</div>

								</div>
							</div>
						</div>
						<div class="columns ">
							<div class="column is-four-fifths" >
								<h2 class="subtitle">✨ Pimp it with filters</h2>
								<div class="level filters-wrapper">
									<div class="image-box">
										<img src="../img/filter-cat.png" alt="">
									</div>
									<div class="image-box">
										<img src="../img/filter-crown.png" alt="" width="100px">
									</div>
									<div class="image-box">
										<img src="../img/filter-dog.png" alt="" width="100px">
									</div>
									<div class="image-box">
										<img src="../img/filter-hearts.png" alt="" width="100px">
									</div>
									<div class="image-box">
										<img src="../img/filter-rainbow.png" alt="" width="100px">
									</div>
								</div>
								</div>
						</div>
					</div>
				</div>
				<div class="column edit-right">
					<div class="box edit-right-wrapper">
					<h2 class="subtitle">🌈 Your creations</h2>
						<img src="../img/cliff.jpg" alt="">
						<img src="../img/cliff.jpg" alt="">
						<img src="../img/cliff.jpg" alt="">
					</div>
				</div>
			</div>
		</div>
    </div>
	<script>
		$("#showModal").click(function() {
		$(".modal").addClass("is-active");
		});

		$("#modal-close").click(function() {
		$(".modal").removeClass("is-active");
		});
	</script>
</body>
</html>
