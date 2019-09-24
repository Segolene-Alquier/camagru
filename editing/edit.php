<?php
session_start();
require "image_class.php";
if (!isset($_SESSION['username']))
	header('Location: ../users/login.php');
$image = new Image;
$userId = $image->findUserFromId($_SESSION["username"]);
$allImagesFromCurrentUser = $image->allPicturesOfUser($userId);
if (isset($_POST['savePicture']) && $_POST['savePicture'] === 'Save Picture') {
	$userId = $image->findUserFromId($_SESSION["username"]);
	$image->overlay($_POST['picture'], $_POST['chosen-filter'], $userId);
}
if (isset($_POST['savePicture2']) && $_POST['savePicture2'] === 'Save Picture') {
	$userId = $image->findUserFromId($_SESSION["username"]);
	$image->overlay($_POST['uploadedFile'], $_POST['chosen-filter'], $userId);
}
$userId = $image->findUserFromId($_SESSION["username"]);
if (isset($_GET['delete']) && $_GET['delete'] === "deletePicture" && isset($_GET['image_id']) && isset($_GET['image_name'])) {
	if ($image->pictureBelongsToUser($userId, $_GET['image_id']))
		$image->deletePictureFromDB($userId, $_GET['image_id'], $_GET['image_name']);
	else
		echo "The picture you wish to delete doesn't belong to you, nice try!";
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
							</div>
							</div>
							<div class="column">
								<div class="edit-left-buttons">
									<div class="edit-left-button">
										<button disabled id="showModal" class="button button-edit" style="background-color: #180989; color: white;" onclick="uploadAppear();"><i class="fas fa-file-upload" style="margin-right: 5px;"></i>Upload</button>
											<div hidden id="upload-form">
												<input id="file" type="file" accept="image/*" onchange="loadFile(event)" name="uploadedFile" />
											</div>
									</div>
									<div class="edit-left-button ">
										<button id="snap"  class="button button-edit" disabled name="newPicture" value="Take Picture" onclick="displayPicture();" style="background-color: #180989; color: white;"><i class="fas fa-camera" style="margin-right: 5px;"></i>New</button>
									</div>
									<div class="edit-left-button ">
										<form action="" name="upload_image" method="POST" enctype="multipart/form-data">
											<input hidden type="hidden" name="picture" id="image_to_post" value=""/> <!-- envoyer l'image  -->
											<input id="chosen-filter" name="chosen-filter" type="hidden" value="">
											<input id="uploaded-file" name="uploadedFile" type="hidden" value="">
											<button hidden id="save" class="button button-edit"  name="savePicture" value="Save Picture" style="background-color: #A91E8E; color: white; display: none;"><i class="fas fa-save" style="margin-right: 5px;"></i>Save</button>
											<button hidden id="saveUP" class="button button-edit" name="savePicture2" value="Save Picture" style="background-color: #A91E8E; color: white; display: none;"><i class="fas fa-save" style="margin-right: 5px;" ></i>SaveUP</button>
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
