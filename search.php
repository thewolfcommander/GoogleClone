<?php

include("config.php");
include("classes/SiteResultsProvider.php");
	

	if (isset($_GET["term"])) {
		$term = $_GET["term"];
	}
	else {
		exit("You must enter a search term");
	}


	$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>You have searched <?php echo $term; ?> | Dhroove - Search Engine for Love</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- <link rel="stylesheet" href="assets/css/style_spare.css"> -->

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>

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

			 				<input type="hidden" name="type" value="<?php echo $type; ?>">
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
			<?php
			$resultsProvider = new SiteResultsProvider($con);

			$pageLimit = 20;

			$numResults = $resultsProvider->getNumResults($term);

			echo "<p class='resultsCount'>$numResults results found</p>";

			echo $resultsProvider->getResultsHtml($page, $pageLimit, $term);
			?>
		</div>

		<div class="paginationContainer">
			<div class="pageButtons">
				<div class="pageNumberContainer">
					<img src="assets/img/pageStart.png" alt="PageStart">
				</div>

				<?php 

				$pagesToShow = 10;
				$numPages = ceil($numResults/$pageLimit);
				$pagesLeft = min($pagesToShow, $numPages);

				$currentPage = $page - floor($pagesToShow/2);

				if ($currentPage < 1) {
					$currentPage = 1;
				}

				if ($currentPage + $pagesLeft > $numPages +1) {
					$currentPage = $numPages +1 - $pagesLeft;
				}

				while($pagesLeft != 0 && $currentPage <= $numPages) {
					
					if ($currentPage == $page) {
						echo "<div class='pageNumberContainer'>
							<img src='assets/img/pageSelected.png'>

							<span class='pageNumber'><strong>$currentPage</strong></span>
						</div>";
					}

					else {
						echo "<div class='pageNumberContainer'>
						<a href='search.php?term=$term&type=$type&page=$currentPage'>
							<img src='assets/img/page.png'>

							<span class='pageNumber'>$currentPage</span>
							</a>
						</div>";
					}

					$currentPage++;
					$pagesLeft--;
				} 

				?>


				<div class="pageNumberContainer">
					<img src="assets/img/pageEnd.png" alt="PageEnd">
				</div>
			</div>
		</div>
	</div>
</body>
</html>