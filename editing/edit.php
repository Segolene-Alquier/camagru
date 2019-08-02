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
// if (isset($_POST['newPicture']) && $_POST['newPicture'] == 'Take Picture')
// {
// 		$image->takePicture(#canvas);

// }
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
							<div class="webcam">

								<video id="video" width="500" height="500" autoplay></video>
								<canvas id="canvas" width="500" height="500"></canvas>

								<!-- <img src="montage.jpg" alt=""> -->
							</div>
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
												<?php
													// if (isset($_SESSION['message']) && $_SESSION['message'])
													// {
													// printf('<b>%s</b>', $_SESSION['message']);
													// unset($_SESSION['message']);
													// }
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
												<button id="cancel-close" class="button">Cancel</button>
											</footer>
										</div>

									</div>
									<div class="edit-left-button">
										<button id="showModal" class="button button-edit" disabled style="background-color: rgb(58, 44, 200); color: white;"><i class="fas fa-file-upload" style="margin-right: 5px;"></i>Upload</button>
									</div>
									<div class="edit-left-button ">
										<button id="snap"  class="button button-edit" disabled name="newPicture" value="Take Picture" style="background-color: rgb(58, 44, 200); color: white;"><i class="fas fa-camera" style="margin-right: 5px;"></i>New</button>
									</div>
									<div class="edit-left-button ">
										<button id="save"  class="button button-edit" disabled name="savePicture" value="Save Picture" style="background-color: #A91E8E; color: white;"><i class="fas fa-save" style="margin-right: 5px;"></i>Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="columns ">
							<div class="column is-four-fifths" >
								<h2 class="subtitle">✨ Pimp it with filters</h2>
								<div class="level filters-wrapper">
									<button class="image-box" id="filter-1">
										<img src="../img/filter-cat.png" alt="">
									</button>
									<button class="image-box" id="filter-2">
										<img src="../img/filter-crown.png" alt="" width="100px">
									</button>
									<button class="image-box" id="filter-3">
										<img src="../img/filter-dog.png" alt="" width="100px">
									</button>
									<button class="image-box" id="filter-4">
										<img src="../img/filter-hearts.png" alt="" width="100px">
									</button>
									<button class="image-box" id="filter-5">
										<img src="../img/filter-rainbow.png" alt="" width="100px">
									</button>
									<form action="" method="POST">
										<input id="chosen-filter" name="chosen" type="hidden" value="">
										<input type="submit" class="button is-link" value="Submit">
									</form>
									<p>
										<?php

										if ($_SERVER["REQUEST_METHOD"] == "POST" )
										{
											$filter = $_POST['chosen'];
											echo $filter;
										}
										else
											echo "nothing";
											 ?>
									</p>
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
	<?php if (isset($namejs)) {?>
	<div class="debug"> <?php var_dump($namejs); ?> </div>
	<?php }; ?>
	<script type="text/javascript" src="edit.js"></script>
</body>
</html>
