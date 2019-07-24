<?php

// creer restriction login

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
	<div class="section">
		<div class="edit-wrapper">
			<div class="columns">
				<div class="column is-four-fifths edit-left">
					<div class="edit-left-top">
						<div class="columns edit-left-wrapper" >
							<div class="column is-four-fifths edit-left-image" >
								<!-- coucou -->
							</div>
							<div class="column">
								<div class="edit-left-buttons">
									<div class="edit-left-button">
										<button class="button button-edit" style="background-color: rgb(58, 44, 200); color: white;">Upload</button>
									</div>
									<div class="edit-left-button ">
										<button class="button button-edit" style="background-color: rgb(58, 44, 200); color: white;">New</button>
									</div>

								</div>

							</div>
						</div>

					</div>

					<div class="edit-left-filters">
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
				<div class="column edit-right">
					<div class="box edit-right-wrapper">
						<img src="../img/cliff.jpg" alt="">
						<img src="../img/cliff.jpg" alt="">
						<img src="../img/cliff.jpg" alt="">

					</div>
				</div>
			</div>
		</div>
    </div>
</body>
</html>
