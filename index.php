<?php
session_start();
require "./editing/image_class.php";
require "./likes/likes_class.php";
$image = new Image;
$like = new Like;
$allImages = $image->allPictures();
// if ()
if (isset($_SESSION["username"]))
$userId = $image->findUserFromId($_SESSION["username"]);
// $imageId = $image->getImageId();
// if (isset($_POST['like-button']) && $_POST['like-button'] === 'submit') {
	// var_dump("coucou");

	// $image->likeImage($userId, 22);
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="camagru.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<script src="https://kit.fontawesome.com/82e513fc69.js"></script>
	<title>Camagru</title>
</head>
<body>
	<?php include_once 'navigation.php'; ?>
	<div class="modal" id="myModal">
		<div class="modal-background"></div>
		<div class="modal-card">
			<header class="modal-card-head">
			<p class="modal-card-title">Modal title</p>
			<button id="detailClose" class="delete" aria-label="close"></button>
			</header>
			<section class="modal-card-body">
				<div class="modal-wrapper columns">
					<div class="modal-image is-one-half column">
						<img id="image-modal" src="" alt="">
					</div>
					<div id="comm-list" class="modal-comment column">
					</div>
				</div>
			</section>
			<footer class="modal-card-foot">
				<div class=" columns">
					<div class="modal-foot-wrapper">
						<div class="column is-one-fifth ">
							<div class="modal-foot-wrapper-left">
								<div class="modal-foot-wrapper-left-elem">
									<i id="like-button" class="far fa-heart has-text-danger" ></i>
								</div>
								<p id="nb_likes_modal" class="modal-foot-wrapper-left-elem font-likes"></p>
							</div>
						</div>
						<div class="column modal-comment-input">
							<div class="">
								<div class="field has-addons">
									<div class="control">
										<input id="comment-content" class="input is-rounded is-medium" type="text" placeholder="Your comment">
									</div>
									<div class="control">
										<button id="comment-button" class="button is-primary is-rounded is-medium" onclick="getComment()">Send</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</footer>
		</div>
	</div>
	<div class="block">
		<div class="container gallery-container">
			<div class="columns is-multiline ">
				<?php
				if (empty($allImages)) {
					echo "<div >";
					echo "<p class='empty-gallery'>This gallery is a bit empty... Start taking pictures ! </p>";
					echo '<iframe src="https://giphy.com/embed/xCi8WUWPdAPi8" max-width="480" max-height="295" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>';
					echo "</div>";
				}
				else {
					foreach ($allImages as $image) {
				?>
				<div class="column is-narrow">
					<div id="detailImage" data-target="#myModal" class="card modal-button" style="max-width: 300px; max-height: 300px;">
						<div id="dom-index" class="img-gallery img-container">
							<figure  class="image is-square ">
							<?php
								$path = substr($image[0], 1);
								echo "<img src='$path'>";
							?>
								<div class="overlay">
									<div class="gallery-icon-wrapper">
										<span class="gallery-icon">
											<i class="fa fa-heart"></i>
											<span id="nb_likes"><?= $like->likesCounter($like->findIdFromPath($path)) ?></span>
										</span>
										<span class="gallery-icon">
											<i class="fa fa-comment"></i>
											<span>3</span>
										</span>
									</div>
								</div>
							</figure>
						</div>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="gallery.js"></script>
</body>
</html>
