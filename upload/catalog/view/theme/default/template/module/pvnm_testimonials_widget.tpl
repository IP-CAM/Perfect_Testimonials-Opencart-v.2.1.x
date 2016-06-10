<?php if ($rating_stars) { ?>
<div class="row text-center">
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-body">
			<a href="<?php echo $href; ?>" class="lead"><?php echo $text_rating; ?></a>
			<hr>
			<span class="store-rating-text label label-success"><?php echo $rating_stars; ?></span>
			<span class="store-rating-stars"><span style="width: <?php echo $rating_stars * 25; ?>px;"></span></span>
			<hr>
			<span><?php echo $rating_text; ?></span>
		  </div>
		</div>
	</div>
</div>
<?php } ?>
<?php if ($testimonials) { ?>
<h3><?php echo $heading_title; ?></h3>
<?php foreach ($testimonials as $testimonial) { ?>
<div class="row testimonial-item">
	<div class="col-md-12">
	  <div class="row">
	    <div class="col-xs-6 testimonial-height">
	    	<span class="store-customer-name"><i class="fa fa-user fa-fw"></i> <?php echo $testimonial['author']; ?></span>
		</div>
	    <div class="col-xs-6 text-right testimonial-height">
			<span class="testimonial-rating-stars"><span style="width: <?php echo $testimonial['rating'] * 19; ?>px;"></span></span>
		</div>
	  </div>
	  <br>
	  <div class="row">
	    <div class="col-md-12">
		  <?php if ($pluses_status > 0) { ?>
			<p><strong><?php echo $text_plus; ?></strong> <?php echo $testimonial['plus']; ?></p>
		  <?php } ?>
		  <?php if ($minuses_status > 0) { ?>
			<p><strong><?php echo $text_minus; ?></strong> <?php echo $testimonial['minus']; ?></p>
		  <?php } ?>
		  <?php if ($comment_status > 0) { ?>
			<p><strong><?php echo $text_comment; ?></strong> <?php echo $testimonial['comment']; ?></p>
		  <?php } ?>
		</div>
	  </div>
	</div>
</div>
<hr>
<?php } ?>
<?php } ?>
