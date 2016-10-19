<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $testimonials; ?>" data-toggle="tooltip" title="<?php echo $button_testimonials; ?>" class="btn btn-default"><i class="fa fa-star-half-o"></i></a>
				<a href="<?php echo $votes; ?>" data-toggle="tooltip" title="<?php echo $button_votes; ?>" class="btn btn-default"><i class="fa fa-heart-o"></i></a>
				<a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default active"><i class="fa fa-cogs"></i></a>
				<a href="<?php echo $widget; ?>" data-toggle="tooltip" title="<?php echo $button_widget; ?>" class="btn btn-default" style="margin-right: 30px;"><i class="fa fa-puzzle-piece"></i></a>
				<button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<?php if ($success) { ?>
		<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-cogs"></i> <?php echo $text_edit; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-settings" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo $tab_settings; ?></a></li>
						<li><a href="#tab-general" data-toggle="tab"><i class="fa fa-globe"></i> <?php echo $tab_general; ?></a></li>
						<li><a href="#tab-email" data-toggle="tab"><i class="fa fa-envelope"></i> <?php echo $tab_email; ?></a></li>
						<li><a href="#tab-coupons" data-toggle="tab"><i class="fa fa-ticket"></i> <?php echo $tab_coupons; ?></a></li>
						<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-comment"></i> <?php echo $tab_help; ?></a></li>
						<li class="right save"><a onclick="document.getElementById('form').submit()" form="form"><i class="fa fa-save"></i> <?php echo $button_save; ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-settings">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-status"><?php echo $entry_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_status) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-informer"><?php echo $entry_informer; ?></label>
									<div class="col-sm-10">
										<div class="btn-group" data-toggle="buttons">
											<?php if ($pvnm_testimonials_informer) { ?>
												<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_informer" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
												<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_informer" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
											<?php } else { ?>
												<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_informer" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
												<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_informer" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-order-statuses"><?php echo $entry_order_statuses; ?></label>
								<div class="col-sm-10">
									<div class="well well-sm" style="height: 150px; overflow: auto;">
										<?php foreach ($order_statuses as $order_status) { ?>
										<div class="checkbox">
											<label>
												<?php if (in_array($order_status['order_status_id'], $pvnm_testimonials_order_statuses)) { ?>
												<input type="checkbox" name="pvnm_testimonials_order_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" />
												<?php echo $order_status['name']; ?>
												<?php } else { ?>
												<input type="checkbox" name="pvnm_testimonials_order_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" />
												<?php echo $order_status['name']; ?>
												<?php } ?>
											</label>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-limit"><?php echo $entry_limit; ?></label>
								<div class="col-sm-10">
									<input type="text" name="pvnm_testimonials_limit" value="<?php echo $pvnm_testimonials_limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-pvnm-testimonials-limit" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-pluses-status"><?php echo $entry_pluses_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_pluses_status == 1) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_pluses_status" value="1" autocomplete="off" checked="checked"><?php echo $text_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_pluses_status" value="2" autocomplete="off"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_pluses_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } elseif ($pvnm_testimonials_pluses_status == 2) { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_pluses_status" value="1" autocomplete="off"><?php echo $text_required; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_pluses_status" value="2" autocomplete="off" checked="checked"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_pluses_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_pluses_status" value="1" autocomplete="off"><?php echo $text_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_pluses_status" value="2" autocomplete="off"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_pluses_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-minuses-status"><?php echo $entry_minuses_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_minuses_status == 1) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_minuses_status" value="1" autocomplete="off" checked="checked"><?php echo $text_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_minuses_status" value="2" autocomplete="off"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_minuses_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } elseif ($pvnm_testimonials_minuses_status == 2) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_minuses_status" value="1" autocomplete="off"><?php echo $text_required; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_minuses_status" value="2" autocomplete="off" checked="checked"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_minuses_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_minuses_status" value="1" autocomplete="off"><?php echo $text_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_minuses_status" value="2" autocomplete="off"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_minuses_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-comment-status"><?php echo $entry_comment_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_comment_status == 1) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_comment_status" value="1" autocomplete="off" checked="checked"><?php echo $text_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_comment_status" value="2" autocomplete="off"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_comment_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } elseif ($pvnm_testimonials_comment_status == 2) { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_comment_status" value="1" autocomplete="off"><?php echo $text_required; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_comment_status" value="2" autocomplete="off" checked="checked"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_comment_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_comment_status" value="1" autocomplete="off"><?php echo $text_required; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_comment_status" value="2" autocomplete="off"><?php echo $text_no_required; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_comment_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-lastname-status"><?php echo $entry_lastname_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_lastname_status) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_lastname_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_lastname_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_lastname_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_lastname_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-order-status"><?php echo $entry_order_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_order_status) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_order_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_order_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_order_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_order_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-delivery-status"><?php echo $entry_delivery_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_delivery_status) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_delivery_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_delivery_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_delivery_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_delivery_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-approval"><?php echo $entry_approval; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_approval) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_approval" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_approval" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_approval" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_approval" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_captcha_status; ?></label>
								<div class="col-sm-10">
										<select name="pvnm_testimonials_captcha_status" id="input-pvnm-testimonials-captcha-status" class="form-control">
											<option value="0"><?php echo $text_none; ?></option>
											<?php foreach ($captchas as $captcha) { ?>
											<?php if ($captcha['value'] == $pvnm_testimonials_captcha_status) { ?>
											<option value="<?php echo $captcha['value']; ?>" selected="selected"><?php echo $captcha['text']; ?></option>
											<?php } else { ?>
											<option value="<?php echo $captcha['value']; ?>"><?php echo $captcha['text']; ?></option>
											<?php } ?>
											<?php } ?>
										</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-vote-status"><?php echo $entry_vote_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_vote_status == 1) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_status" value="1" autocomplete="off" checked="checked"><?php echo $text_all_users; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_status" value="2" autocomplete="off"><?php echo $text_customers; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } elseif ($pvnm_testimonials_vote_status == 2) { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_status" value="1" autocomplete="off"><?php echo $text_all_users; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_status" value="2" autocomplete="off" checked="checked"><?php echo $text_customers; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_status" value="1" autocomplete="off"><?php echo $text_all_users; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_status" value="2" autocomplete="off"><?php echo $text_customers; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-vote-approval"><?php echo $entry_vote_approval; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_vote_approval) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_approval" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_approval" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_approval" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_approval" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-vote-ip"><?php echo $entry_vote_ip; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_vote_ip) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_ip" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_ip" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_vote_ip" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_vote_ip" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-general">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-keyword"><?php echo $entry_keyword; ?></label>
								<div class="col-sm-10">
									<input type="text" name="pvnm_testimonials_keyword" value="<?php echo $pvnm_testimonials_keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-pvnm-testimonials-keyword" class="form-control" />              
								</div>
							</div>
							<ul class="nav nav-tabs" id="language">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-pvnm-testimonials-name<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-pvnm-testimonials-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-pvnm-testimonials-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-pvnm-testimonials-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-pvnm-testimonials-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['description'] : ''; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-feature_1<?php echo $language['language_id']; ?>"><?php echo $entry_feature_1; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][feature_1]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['feature_1'] : ''; ?>" placeholder="<?php echo $entry_feature_1; ?>" id="input-pvnm-testimonials-feature_1<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-feature_2<?php echo $language['language_id']; ?>"><?php echo $entry_feature_2; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][feature_2]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['feature_2'] : ''; ?>" placeholder="<?php echo $entry_feature_2; ?>" id="input-pvnm-testimonials-feature_2<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-feature_3<?php echo $language['language_id']; ?>"><?php echo $entry_feature_3; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][feature_3]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['feature_3'] : ''; ?>" placeholder="<?php echo $entry_feature_3; ?>" id="input-pvnm-testimonials-feature_3<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-feature_4<?php echo $language['language_id']; ?>"><?php echo $entry_feature_4; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][feature_4]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['feature_4'] : ''; ?>" placeholder="<?php echo $entry_feature_4; ?>" id="input-pvnm-testimonials-feature_4<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-feature_5<?php echo $language['language_id']; ?>"><?php echo $entry_feature_5; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_description[<?php echo $language['language_id']; ?>][feature_5]" value="<?php echo isset($pvnm_testimonials_description[$language['language_id']]) ? $pvnm_testimonials_description[$language['language_id']]['feature_5'] : ''; ?>" placeholder="<?php echo $entry_feature_5; ?>" id="input-pvnm-testimonials-feature_5<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="tab-pane" id="tab-email">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-email"><?php echo $entry_email; ?></label>
								<div class="col-sm-10">
									<input type="text" name="pvnm_testimonials_email" value="<?php echo $pvnm_testimonials_email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-pvnm-testimonials-email" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_macros; ?></label>
								<div class="col-sm-10">
									<div class="panel panel-default">
										<table class="table">
											<tr>
												<td>{store_name}</td>
												<td><?php echo $text_store_name; ?></td>
											</tr>
											<tr>
												<td>{store_url}</td>
												<td><?php echo $text_store_url; ?></td>
											</tr>
											<tr>
												<td>{store_logo}</td>
												<td><?php echo $text_store_logo; ?></td>
											</tr>
											<tr>
												<td>{testimonials}</td>
												<td><?php echo $text_testimonials; ?></td>
											</tr>
												<tr>
												<td>{customer}</td>
												<td><?php echo $text_customer; ?></td>
											</tr>
											<tr>
												<td>{coupon}</td>
												<td><?php echo $text_coupon; ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-admin"><?php echo $entry_alert_admin; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_alert_admin) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_alert_admin" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_alert_admin" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_alert_admin" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_alert_admin" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs" id="language-alert-admin">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language-alert-admin<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language-alert-admin<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-admin-subject<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_alert_admin_subject[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($pvnm_testimonials_alert_admin_subject[$language['language_id']]) ? $pvnm_testimonials_alert_admin_subject[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-pvnm-testimonials-alert-admin-subject<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-admin-message<?php echo $language['language_id']; ?>"><?php echo $entry_message; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_alert_admin_message[<?php echo $language['language_id']; ?>][message]" placeholder="<?php echo $entry_message; ?>" id="input-pvnm-testimonials-alert-admin-message<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_alert_admin_message[$language['language_id']]) ? $pvnm_testimonials_alert_admin_message[$language['language_id']]['message'] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-publish"><?php echo $entry_alert_publish; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_alert_publish) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_alert_publish" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_alert_publish" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_alert_publish" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_alert_publish" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs" id="language-alert-publish">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language-alert-publish<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language-alert-publish<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-publish-subject<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_alert_publish_subject[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($pvnm_testimonials_alert_publish_subject[$language['language_id']]) ? $pvnm_testimonials_alert_publish_subject[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-pvnm-testimonials-alert-publish-subject<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-publish-message<?php echo $language['language_id']; ?>"><?php echo $entry_message; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_alert_publish_message[<?php echo $language['language_id']; ?>][message]" placeholder="<?php echo $entry_message; ?>" id="input-pvnm-testimonials-alert-publish-message<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_alert_publish_message[$language['language_id']]) ? $pvnm_testimonials_alert_publish_message[$language['language_id']]['message'] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-response"><?php echo $entry_alert_response; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_alert_response) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_alert_response" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_alert_response" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_alert_response" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_alert_response" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs" id="language-alert-response">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language-alert-response<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language-alert-response<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-response-subject<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_alert_response_subject[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($pvnm_testimonials_alert_response_subject[$language['language_id']]) ? $pvnm_testimonials_alert_response_subject[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-pvnm-testimonials-alert-response-subject<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-alert-response-message<?php echo $language['language_id']; ?>"><?php echo $entry_message; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_alert_response_message[<?php echo $language['language_id']; ?>][message]" placeholder="<?php echo $entry_message; ?>" id="input-pvnm-testimonials-alert-response-message<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_alert_response_message[$language['language_id']]) ? $pvnm_testimonials_alert_response_message[$language['language_id']]['message'] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-customer-motivate"><?php echo $entry_customer_motivate; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_customer_motivate) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_customer_motivate" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_customer_motivate" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_customer_motivate" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_customer_motivate" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs" id="language-customer-motivate">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language-customer-motivate<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language-customer-motivate<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-customer-motivate-subject<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_customer_motivate_subject[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($pvnm_testimonials_customer_motivate_subject[$language['language_id']]) ? $pvnm_testimonials_customer_motivate_subject[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-pvnm-testimonials-customer-motivate-subject<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-customer-motivate-message<?php echo $language['language_id']; ?>"><?php echo $entry_message; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_customer_motivate_message[<?php echo $language['language_id']; ?>][message]" placeholder="<?php echo $entry_message; ?>" id="input-pvnm-testimonials-customer-motivate-message<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_customer_motivate_message[$language['language_id']]) ? $pvnm_testimonials_customer_motivate_message[$language['language_id']]['message'] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm-testimonials-customer-thanks"><?php echo $entry_customer_thanks; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_testimonials_customer_thanks) { ?>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_customer_thanks" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_customer_thanks" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<?php } else { ?>
											<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_customer_thanks" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
											<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_customer_thanks" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs" id="language-customer-thanks">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language-customer-thanks<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language-customer-thanks<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-customer-thanks-subject<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_testimonials_customer_thanks_subject[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($pvnm_testimonials_customer_thanks_subject[$language['language_id']]) ? $pvnm_testimonials_customer_thanks_subject[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-pvnm-testimonials-customer-thanks-subject<?php echo $language['language_id']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm-testimonials-customer-thanks-message<?php echo $language['language_id']; ?>"><?php echo $entry_message; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_testimonials_customer_thanks_message[<?php echo $language['language_id']; ?>][message]" placeholder="<?php echo $entry_message; ?>" id="input-pvnm-testimonials-customer-thanks-message<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($pvnm_testimonials_customer_thanks_message[$language['language_id']]) ? $pvnm_testimonials_customer_thanks_message[$language['language_id']]['message'] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
							<div class="tab-pane" id="tab-coupons">
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupons"><?php echo $entry_coupons; ?></label>
									<div class="col-sm-10">
										<div class="btn-group" data-toggle="buttons">
											<?php if ($pvnm_testimonials_coupons) { ?>
												<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_coupons" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
												<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_coupons" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
											<?php } else { ?>
												<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_coupons" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
												<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_coupons" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-type"><?php echo $entry_coupon_type; ?></label>
									<div class="col-sm-10">
										<select name="pvnm_testimonials_coupon_type" id="input-pvnm-testimonials-coupon-type" class="form-control">
											<option value="P" <?php if ($pvnm_testimonials_coupon_type == 'P') { ?>selected="selected"<?php } ?>><?php echo $text_percent; ?></option>
											<option value="F" <?php if ($pvnm_testimonials_coupon_type == 'F') { ?>selected="selected"<?php } ?>><?php echo $text_amount; ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-discount"><?php echo $entry_coupon_discount; ?></label>
									<div class="col-sm-10">
										<input type="text" name="pvnm_testimonials_coupon_discount" value="<?php echo $pvnm_testimonials_coupon_discount; ?>" placeholder="<?php echo $entry_coupon_discount; ?>" id="input-pvnm-testimonials-coupon-discount" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-total"><?php echo $entry_coupon_total; ?></label>
									<div class="col-sm-10">
										<input type="text" name="pvnm_testimonials_coupon_total" value="<?php echo $pvnm_testimonials_coupon_total; ?>" placeholder="<?php echo $entry_coupon_total; ?>" id="input-pvnm-testimonials-coupon-total" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-shipping"><?php echo $entry_coupon_shipping; ?></label>
									<div class="col-sm-10">
										<div class="btn-group" data-toggle="buttons">
											<?php if ($pvnm_testimonials_coupon_shipping) { ?>
												<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_coupon_shipping" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
												<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_coupon_shipping" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
											<?php } else { ?>
												<label class="btn btn-info"><input type="radio" name="pvnm_testimonials_coupon_shipping" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
												<label class="btn btn-info active"><input type="radio" name="pvnm_testimonials_coupon_shipping" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-product"><?php echo $entry_coupon_product; ?></label>
									<div class="col-sm-10">
										<input type="text" name="product" value="" placeholder="<?php echo $entry_coupon_product; ?>" id="input-pvnm-testimonials-coupon-product" class="form-control" />
										<div id="coupon-product" class="well well-sm">
											<?php foreach ($pvnm_testimonials_coupon_product as $coupon_product) { ?>
											<div id="coupon-product<?php echo $coupon_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $coupon_product['name']; ?>
												<input type="hidden" name="pvnm_testimonials_coupon_product[]" value="<?php echo $coupon_product['product_id']; ?>" />
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-category"><?php echo $entry_coupon_category; ?></label>
									<div class="col-sm-10">
										<input type="text" name="category" value="" placeholder="<?php echo $entry_coupon_category; ?>" id="input-pvnm-testimonials-coupon-category" class="form-control" />
										<div id="coupon-category" class="well well-sm">
											<?php foreach ($pvnm_testimonials_coupon_category as $coupon_category) { ?>
											<div id="coupon-category<?php echo $coupon_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $coupon_category['name']; ?>
												<input type="hidden" name="pvnm_testimonials_coupon_category[]" value="<?php echo $coupon_category['category_id']; ?>" />
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-days"><?php echo $entry_coupon_days; ?></label>
									<div class="col-sm-10">
										<input type="text" name="pvnm_testimonials_coupon_days" value="<?php echo $pvnm_testimonials_coupon_days; ?>" placeholder="<?php echo $entry_coupon_days; ?>" id="input-pvnm-testimonials-coupon-days" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-pvnm-testimonials-coupon-uses"><?php echo $entry_coupon_uses; ?></label>
									<div class="col-sm-10">
										<input type="text" name="pvnm_testimonials_coupon_uses" value="<?php echo $pvnm_testimonials_coupon_uses; ?>" placeholder="<?php echo $entry_coupon_uses; ?>" id="input-pvnm-testimonials-coupon-uses" class="form-control" />
									</div>
								</div>
							</div>
						<div class="tab-pane" id="tab-help">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_developer; ?></label>
								<div class="col-sm-10"><a href="mailto:p0v1n0m@gmail.com" class="btn btn-link">p0v1n0m@gmail.com</a></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_documentation; ?></label>
								<div class="col-sm-10"><a href="https://github.com/p0v1n0m/opencart_perfect_testimonials" target="_blank" class="btn">https://github.com/p0v1n0m/opencart_perfect_testimonials</a></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-pvnm-testimonials-description<?php echo $language['language_id']; ?>, #input-pvnm-testimonials-alert-admin-message<?php echo $language['language_id']; ?>, #input-pvnm-testimonials-alert-publish-message<?php echo $language['language_id']; ?>, #input-pvnm-testimonials-alert-response-message<?php echo $language['language_id']; ?>, #input-pvnm-testimonials-customer-motivate-message<?php echo $language['language_id']; ?>, #input-pvnm-testimonials-customer-thanks-message<?php echo $language['language_id']; ?>').summernote({height: 100});
<?php } ?>

$('#language a:first').tab('show');
$('#language-alert-admin a:first').tab('show');
$('#language-alert-publish a:first').tab('show');
$('#language-alert-response a:first').tab('show');
$('#language-customer-motivate a:first').tab('show');
$('#language-customer-thanks a:first').tab('show');

$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'product\']').val('');
		
		$('#coupon-product' + item['value']).remove();
		
		$('#coupon-product').append('<div id="coupon-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="pvnm_testimonials_coupon_product[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#coupon-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#coupon-category' + item['value']).remove();
		
		$('#coupon-category').append('<div id="coupon-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="pvnm_testimonials_coupon_category[]" value="' + item['value'] + '" /></div>');
	}	
});

$('#coupon-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>
<?php echo $footer; ?>