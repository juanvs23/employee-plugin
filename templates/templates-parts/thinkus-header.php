<?php
$thinkus_header = get_query_var('thinkus_header');
$title = $thinkus_header['title'];
$image = $thinkus_header['image'];
$description = $thinkus_header['description'];


?>
<header class="page-header">
<img src="<?php echo $image;?>" class="header-image"  alt="<?php echo $title; ?>" >
<div class="text-container">
	<div class="text-wrapper">
		<div class="text-content">
			<h1 class="archive-offer-title">
				<?php echo $title; ?>
			</h1>
			<div class="archive-offer-description">
				<?php echo $description; ?>
			</div>
		</div>
	</div>
</div>		
</header><!-- .page-header -->