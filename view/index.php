<?php
$player = URL . 'player?s=';

?>
<header class="bg-gradient py-5">
	<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div class="col-lg-9">
				<h1 class="display-4 text-white mt-5 mb-2 font-weight-bold">
					<button class='play' style="cursor: default;"></button>
					SkyLive
				</h1>
				<p class="lead mb-5 text-white-50">Decentralized livestreams on Sia Skynet<br>
			</div>
			<div class="col-lg-3"> <?php
				if (isset($_GET['subscribed'])) { ?>
						<p class="lead text-white">Succesful subscription,<br> thank you!<br>
					</form> <?php
				} else { ?>
					<form id="subscribe" action="subscribe.php" method="post">
						<p class="lead text-white-50">Subscribe for newsletter<br>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Enter address">
						</div>
						<button type="submit" class="btn btn-primary float-right">Subscribe</button>
					</form> <?php
				} ?>
			</div> <?php
			if (time() >= 1593792000) { ?>
				<div href="register" class="position-absolute text-white" style="top: 5px; right: 15px;">
					<a class="text-white" href="register">Get beta access</a> | 
					<a class="text-white" href="login">Login</a>
				</div>
				 <?php
			} ?>
		</div>
	</div>
</header>

<!-- Page Content -->
<div class="container-fluid">
	<div class="row mt-5 mr-2 ml-2"> <?php
		while ($row = $streams_stmt->fetch(PDO::FETCH_ASSOC)) { ?>
			<div class="col-md-3 mb-5">
				<div class="card h-100 shadow">
					<a href="<?= $player . $row['streamid']?>" class="position-relative text-center"> <?php
						date_default_timezone_set('UTC');
						$current = time();
						if ($row['started'] == 0) { ?>
							<div class="ribbon ribbon-green">Upcoming event (<script>printDateTime(<?= $row['scheule_time'] ?>)</script>)</div> <?php
						} else if ($row['finished'] == 0) { ?>
							<div class="ribbon ribbon-red">On air</div> <?php
						} ?>
						<img class="card-img-top video-thumbnail-max-16-9" src="<?= image_print($row['streamid'], 600) ?>" alt="">
					</a>
					<div class="card-body">
						<a href="<?= $player . $row['streamid']?>">
							<h4 class="card-title"><?= $row['title'] ?></h4>
						</a>
						<div class="card-text">
							<?= $row['description'] ?>
						</div>
					</div>
				</div>
			</div> <?php
		}
		$streams_stmt = null; ?>
	</div>
	<!-- /.row -->

</div>
<!-- /.container -->

<script>

$('.video-thumbnail-max-16-9').each(function(i, obj) {
    let width = $(obj).parent().width()
	let max_height = width / 16 * 9
	$(obj).css('max-height', max_height + 'px')
});
</script>