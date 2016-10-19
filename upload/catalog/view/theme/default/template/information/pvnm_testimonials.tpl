<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	</ul>
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<h1><?php echo $heading_title; ?></h1>
			<div class="row text-center">
				<div class="col-md-4 col-md-push-4">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<p class="lead"><?php echo $text_rating; ?></p>
									<hr>
									<span class="store-rating-text label label-success"><?php echo $rating_stars; ?></span>
									<span class="store-rating-stars"><span style="width: <?php echo $rating_stars * 25; ?>px;"></span></span>
									<hr>
									<span><?php echo $rating_text; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-md-pull-4">
					<div class="row">
						<div class="col-md-12">
							<p class="store-rating-filter"><?php echo $text_filter; ?></p>
						</div>
						<?php foreach ($ratings as $rating) { ?>
						<div class="col-md-12">
							<a <?php if ($rating['value'] == $store_rating) { ?>href="<?php echo $home; ?>" class="active"<?php } else { ?>href="<?php echo $rating['href']; ?>" class="store-rating-item"<?php } ?>">
								<span class="testimonial-rating-stars"><span style="width: <?php echo $rating['value'] * 19; ?>px;"></span></span>
								<div class="store-rating-progress progress">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $rating['text']*100/$max_rating; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rating['text']*100/$max_rating; ?>%"></div>
								</div>
								<span class="label label-info"><?php echo $rating['text']; ?></span>
								<span class="store-rating-remove"><i class="fa fa-times"></i></span>
							</a>
						</div>
						<?php } ?>
						<br>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<p class="store-customer-name"><?php echo $customer_name; ?>,</p>
							<p><?php echo $more; ?></p>
							<?php if (isset($free_orders)) { ?>
							<div class="form-group">
								<select name="pvnm_testimonial_order" class="form-control">
									<?php foreach ($free_orders as $free_order) { ?>
									<option value="<?php echo $free_order['order_id']; ?>" data-city="<?php echo $free_order['shipping_city']; ?>" data-shipping="<?php echo $free_order['shipping_method']; ?>"><?php echo $text_order; ?><?php echo $free_order['order_id']; ?></option>
									<?php } ?>
								<select>
							</div>
							<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#pvnmTestimonial"><?php echo $text_button; ?></button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<p><?php echo $description; ?></p>
				</div>
			</div>
			<br>
			<?php if ($testimonials) { ?>
			<div class="row">
				<div class="col-md-12">
				<div class="btn-group btn-group-justified input-group">
					<label class="input-group-addon"><?php echo $text_sort; ?></label>
					<?php foreach ($sorts as $sorts) { ?>
					<div class="btn-group btn-group-sm">
						<a class="btn btn-default <?php if ($sorts['value'] == $sort) { ?>active<?php } ?>" href="<?php echo $sorts['href']; ?>">
						<span>
							<?php echo $sorts['text']; ?> 
							<?php if ($sorts['value'] == $sort) { ?>
							<i class="fa fa-chevron-<?php if ($sorts['order'] == 'DESC') { ?>up<?php } else { ?>down<?php } ?>"></i>
							<?php } ?>
						</span>
						</a>
					</div>
					<?php } ?>
				</div>
				</div>
			</div>
			<hr>
			<?php foreach ($testimonials as $testimonial) { ?>
			<div class="row testimonial-item">
				<div class="col-md-12" id="testimonial<?php echo $testimonial['testimonial_id']; ?>">
					<div class="row">
						<div class="col-xs-6 testimonial-height">
							<span class="store-customer-name"><i class="fa fa-user fa-fw"></i> <?php echo $testimonial['author']; ?></span>
							<span class="testimonial-date"><?php echo $testimonial['date_added']; ?></span>
							<a href="<?php echo $home; ?>#testimonial<?php echo $testimonial['testimonial_id']; ?>"><i class="fa fa-link"></i></a>
						</div>
						<div class="col-xs-6 text-right testimonial-height">
							<span class="label label-<?php if ($testimonial['rating'] == 1) { ?>danger<?php } elseif ($testimonial['rating'] == 2) { ?>warning<?php } elseif ($testimonial['rating'] == 3) { ?>default<?php } elseif ($testimonial['rating'] == 4) { ?>primary<?php } else { ?>success<?php } ?>"><?php echo $testimonial['rating_name']; ?></span>
							<span class="testimonial-rating-stars"><span style="width: <?php echo $testimonial['rating'] * 19; ?>px;"></span></span>
						</div>
					</div>
					<br>
					<div class="row">
						<?php if ($order_status > 0 || $delivery_status > 0) { ?>
						<div class="col-md-4 col-md-push-8">
							<div class="panel panel-default">
								<?php if ($order_status > 0) { ?>
								<div class="panel-heading"><?php echo $text_order_info; ?></div>
								<div class="panel-body">
									<?php foreach ($testimonial['products'] as $product) { ?>
									<div class="media">
										<a class="pull-left" href="<?php echo $product['href']; ?>">
											<img class="thumbnail media-object" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
										</a>
										<div class="media-body"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
										<span>x <span class="label label-default"><?php echo $product['quantity']; ?></span></span>
									</div>
									<?php } ?>
								</div>
								<?php } ?>
								<?php if ($delivery_status > 0) { ?>
								<div class="panel-footer">
									<span><?php echo $text_city; ?> <strong><?php echo $testimonial['city']; ?></strong></span>
									<br>
									<span><?php echo $text_shipping; ?> <strong><?php echo $testimonial['shipping']; ?></strong></span>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="col-md-8 col-md-pull-4">
						<?php } else { ?>
						<div class="col-md-12">
						<?php } ?>
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
					<?php if ($testimonial['answer']) { ?>
					<div class="row">
						<div class="col-md-12">
							<hr>
							<p class="testimonial-answer bg-info"><strong><?php echo $text_answer; ?></strong> <?php echo $testimonial['answer']; ?></p>
						</div>
					</div>
					<?php } ?>
					<?php if ($vote_status && $testimonial['vote_status']) { ?>
					<div class="row">
						<div class="col-md-5 col-md-offset-5 col-xs-9">
							<div class="testimonial-result-<?php echo $testimonial['testimonial_id']; ?>"></div>
						</div>
						<div class="col-md-2 col-xs-3 text-right">
							<div class="testimonial-vote testimonial-vote-<?php echo $testimonial['testimonial_id']; ?>">
								<span><i class="fa fa-thumbs-o-up" onclick="testimonial.vote('<?php echo $testimonial['testimonial_id']; ?>', '1');"></i> <span><?php echo $testimonial['vote_yes']; ?></span></span>
								<span><i class="fa fa-thumbs-o-down" onclick="testimonial.vote('<?php echo $testimonial['testimonial_id']; ?>', '0');"></i> <span><?php echo $testimonial['vote_no']; ?></span></span>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<hr>
			<?php } ?>
			<div class="row">
				<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
				<div class="col-sm-6 text-right"><?php echo $results; ?></div>
			</div>
			<?php } else { ?>
			<p><?php echo $text_empty; ?></p>
			<?php } ?>
			<script type="text/javascript"><!--
			$(function(){
				$('#testimonial-rating').raty({
					target     : '#testimonial-hint',
					targetKeep : true,
					hints      : ['<?php echo $text_star1; ?>', '<?php echo $text_star2; ?>', '<?php echo $text_star3; ?>', '<?php echo $text_star4; ?>', '<?php echo $text_star5; ?>'],
					targetType : 'hint',
					path       : 'catalog/view/javascript/pvnm/testimonials/'
				});

				$('#testimonial_captcha .col-sm-2').removeClass('col-sm-2').addClass('col-sm-3');
				$('#testimonial_captcha .col-sm-10').removeClass('col-sm-10').addClass('col-sm-9');
			});
			//--></script>
			<?php if (isset($free_orders)) { ?>
			<div class="modal fade" id="pvnmTestimonial" tabindex="-1" role="dialog" aria-labelledby="pvnmTestimonialLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="pvnmTestimonialLabel"><?php echo $text_heading; ?></h4>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
								<div class="form-group required">
									<label class="col-sm-3 control-label" for="input-pvnm-testimonial-rating"><?php echo $text_rating; ?></label>
									<div class="col-sm-9">
										<div id="testimonial-rating"></div>
										<span class="label label-default" id="testimonial-hint"></span>
									</div>
								</div>
								<div class="form-group <?php if ($pluses_status == 0) { ?>hidden<?php } elseif ($pluses_status == 1) { ?>required<?php } ?>">
									<label class="col-sm-3 control-label" for="input-pvnm-testimonial-plus"><?php echo $text_plus; ?></label>
									<div class="col-sm-9">
										<textarea name="pvnm_testimonial_plus" class="form-control" id="input-pvnm-testimonial-plus" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group <?php if ($minuses_status == 0) { ?>hidden<?php } elseif ($minuses_status == 1) { ?>required<?php } ?>">
									<label class="col-sm-3 control-label" for="input-pvnm-testimonial-minus"><?php echo $text_minus; ?></label>
									<div class="col-sm-9">
										<textarea name="pvnm_testimonial_minus" class="form-control" id="input-pvnm-testimonial-minus" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group <?php if ($comment_status == 0) { ?>hidden<?php } elseif ($comment_status == 1) { ?>required<?php } ?>">
									<label class="col-sm-3 control-label" for="input-pvnm-testimonial-comment"><?php echo $text_comment; ?></label>
									<div class="col-sm-9">
										<textarea name="pvnm_testimonial_comment" class="form-control" id="input-pvnm-testimonial-comment" rows="5"></textarea>
									</div>
								</div>
								<div id="testimonial_captcha"><?php echo $captcha; ?></div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="testimonial.add();"><?php echo $text_button; ?></button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php echo $content_bottom; ?>
		</div>
		<?php echo $column_right; ?>
	</div>
</div>
<?php echo $footer; ?>