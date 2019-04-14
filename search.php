<?php

include("config.php");
	

	if (isset($_GET["term"])) {
		$term = $_GET["term"];
	}
	else {
		exit("You must enter a search term");
	}


	$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>You have searched <?php echo $term; ?> | Dhroove - Search Engine for Love</title>
	<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="headerContent">
				<div class="logoContainer">
			 		<a href="index.php">
			 			<img src="assets/img/dhroovelogo.png" alt="Dhroove" title="Dhroove - Search Engine for Love">
			 		</a>
			 	</div>

			 	<div class="searchContainer">
			 		<form action="search.php" method="GET">
			 			<div class="searchBarContainer">
			 				<input type="text" name="term" class="searchBox" value='<?php echo $term; ?>'>
			 				<button class="searchButton">
			 					<img src="assets/img/iconSearch.png" alt="iconSearch">
			 				</button>
			 			</div>
			 		</form>
			 	</div>
			</div>

			<div class="tabsContainer">
				<ul class="tabList">
					<li class="<?php echo $type == 'sites' ? 'active' : ''; ?>">
						<a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
							Sites
						</a>
					</li>
					<li class="<?php echo $type == 'images' ? 'active' : ''; ?>">
						<a href='<?php echo "search.php?term=$term&type=images"; ?>'>
							Images
						</a>
					</li>
			
				</ul>
			</div>
		</div>


		<div class="mainResultsSection">
			
		</div>
	</div>
</body>
</html>