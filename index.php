<?php
session_start();
require "./editing/image_class.php";
$image = new Image;
$allImages = $image->allPictures();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="camagru.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/82e513fc69.js"></script>
	<title>Camagru</title>
</head>
<body>
	<?php include_once 'navigation.php'; ?>
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
					<div class="card" style="max-width: 300px; max-height: 300px;">
						<div class="img-gallery img-container">
							<figure class="image is-square ">
							<?php
								$path = substr($image[0], 1);
								echo "<img src='$path' class='' >";
							?>
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
</body>
</html>
