<?php
session_start();
require "image_class.php";
if (!isset($_SESSION['username']))
	header('Location: ../users/login.php');
$image = new Image;
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
	if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
	{
		$userId = $image->findUserFromId($_SESSION["username"]);
		$image->upload();
	}
}
$userId = $image->findUserFromId($_SESSION["username"]);
$allImagesFromCurrentUser = $image->allPicturesOfUser($userId);
if (isset($_POST['savePicture']) && $_POST['savePicture'] === 'Save Picture') {
	$userId = $image->findUserFromId($_SESSION["username"]);
    $image->overlay($_POST['picture'], $_POST['chosen-filter'], $userId);
}
$userId = $image->findUserFromId($_SESSION["username"]);
if (isset($_GET['delete']) && $_GET['delete'] === "deletePicture" && isset($_GET['image_id']) && isset($_GET['image_name'])) {
	$image->deletePictureFromDB($userId, $_GET['image_id'], $_GET['image_name']);
}
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
</head>
<body>
    <?php include_once '../navigation.php'; ?>
	<div class="edit-container">
		<div class="edit-wrapper">
			<div class="columns is-3-desktop edit-wrapper-columns">
				<div class="column is-9 edit-left box" style="margin-bottom: 0px;">
					<div class="edit-left-top">
					<h2 class="subtitle">📥 Upload a picture OR 📸 take a new one! </h2>
						<div class="columns ">
							<div class="column is-four-fifths edit-left-image" >
							<div class="webcam" id="webcam">
								<img id="live-filter-1" class="live-filter" hidden src="../img/filters/1.png" alt="" style="width: 50%; height:50%;">
								<img id="live-filter-2" class="live-filter" hidden src="../img/filters/2.png" alt="" style="width: 50%; height:50%;">
								<img id="live-filter-3" class="live-filter" hidden src="../img/filters/3.png" alt="" style="width: 50%; height:50%;">
								<img id="live-filter-4" class="live-filter" hidden src="../img/filters/4.png" alt="" style="width: 50%; height:50%;">
								<img id="live-filter-5" class="live-filter" hidden src="../img/filters/5.png" alt="" style="width: 50%; height:50%;">
								<video id="video" autoplay></video>
								<canvas id="canvas" hidden ></canvas>
								<img hidden id="output" width="" />
								<?php if (file_exists("montage.jpg")) { ?>
								<img src="montage.jpg" alt="">
								<?php }; ?>
							</div>
							</div>
							<div class="column">
								<div class="edit-left-buttons">
									<div class="modal" id="modal-upload">
										<div class="modal-background"></div>
											<div class="modal-card">
											<header class="modal-card-head">
												<p class="modal-card-title">Upload the image of your choice</p>
												<button id="modal-close" class="delete" aria-label="close" onclick="closeModal();"></button>
											</header>
											<section class="modal-card-body">
												<form method="POST" action="" enctype="multipart/form-data">
													<div>
													<span>Upload a File:</span>
													<input type="file" name="uploadedFile" />
													</div>
													<input type="submit" name="uploadBtn" value="Upload" onclick="displayUpload(this);"/>
												</form>
											</section>
											<footer class="modal-card-foot">
												<button class="button is-success">Save changes</button>
												<button id="cancel-close" class="button" onclick="closeModal();">Cancel</button>
											</footer>
										</div>
									</div>
									<div class="edit-left-button">
										<button id="showModal" class="button button-edit" style="background-color: #180989; color: white;" onclick="uploadAppear();"><i class="fas fa-file-upload" style="margin-right: 5px;"></i>Upload</button>
										<!-- <form hidden id="upload-form" method="POST" action="" enctype="multipart/form-data"> -->
											<div hidden id="upload-form">
											<input id="file" type="file" accept="image/*" onchange="loadFile(event)" name="uploadedFile" />
											<input type="submit" name="uploadBtn" value="Upload" onclick="displayUpload(this);"/>
											</div>
										<!-- </form> -->
									</div>
									<div class="edit-left-button ">
										<button id="snap"  class="button button-edit" disabled name="newPicture" value="Take Picture" onclick="displayPicture();" style="background-color: #180989; color: white;"><i class="fas fa-camera" style="margin-right: 5px;"></i>New</button>
									</div>
									<div class="edit-left-button ">
										<form action="" name="upload_image" method="POST" enctype="multipart/form-data">
											<input hidden type="hidden" name="picture" id="image_to_post" /> <!-- envoyer l'image  -->
											<input id="chosen-filter" name="chosen-filter" type="hidden" value="">
											<button id="save" class="button button-edit" disabled name="savePicture" value="Save Picture" style="background-color: #A91E8E; color: white;"><i class="fas fa-save" style="margin-right: 5px;"></i>Save</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="columns filters-wrapper">
							<div class="column is-four-fifths" >
								<h2 class="subtitle" style="margin-top: 3vh;">✨ Pimp it with filters</h2>
								<div class="level filters-wrapper">
									<button class="image-box" id="filter-1">
										<img src="../img/filters/1.png" alt="">
									</button>
									<button class="image-box" id="filter-2">
										<img src="../img/filters/2.png" alt="" width="100px">
									</button>
									<button class="image-box" id="filter-3">
										<img src="../img/filters/3.png" alt="" width="100px">
									</button>
									<button class="image-box" id="filter-4">
										<img src="../img/filters/4.png" alt="" width="100px">
									</button>
									<button class="image-box" id="filter-5">
										<img src="../img/filters/5.png" alt="" width="100px">
									</button>
								</div>
								</div>
						</div>
					</div>
				</div>
				<div class="column"></div>
				<div class="column is-2 edit-right box">
					<div class=" edit-right-wrapper">
					<h2 class="subtitle">🌈 Your creations</h2>
					<?php
						if (empty($allImagesFromCurrentUser)) {
							echo "<div >";
							echo "<p class='empty-gallery'>This gallery is a bit empty... Start taking pictures ! </p>";
							echo '<iframe src="https://giphy.com/embed/xCi8WUWPdAPi8" max-width="480" max-height="295" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>';
							echo "</div>";
						}
						else {
							foreach ($allImagesFromCurrentUser as $image)
							{
								echo "<div class='gallery-item'>";
								echo '<form action="" method="get">';
								echo "<input hidden name='image_id' value='$image[id]'>";
								echo "<input hidden name='image_name' value='$image[file]'>";
								echo '<button type="submit" name="delete" value="deletePicture" class="delete delete-picture"></button>';
								echo '</form>';
								echo "<img src='$image[file]' class='' >";
								echo "</div>";
								echo "<hr>";
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<?php include_once '../footer.php'; ?>
    </div>
	<script type="text/javascript" src="edit.js"></script>
</body>
</html>
