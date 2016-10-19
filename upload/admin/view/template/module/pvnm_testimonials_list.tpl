<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $testimonials; ?>" data-toggle="tooltip" title="<?php echo $button_testimonials; ?>" class="btn btn-default active"><i class="fa fa-star-half-o"></i></a>
				<a href="<?php echo $votes; ?>" data-toggle="tooltip" title="<?php echo $button_votes; ?>" class="btn btn-default"><i class="fa fa-heart-o"></i></a>
				<a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default"><i class="fa fa-cogs"></i></a>
				<a href="<?php echo $widget; ?>" data-toggle="tooltip" title="<?php echo $button_widget; ?>" class="btn btn-default" style="margin-right: 30px;"><i class="fa fa-puzzle-piece"></i></a>
				<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('form').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
				<h3 class="panel-title"><i class="fa fa-star-half-o"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<div class="well">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
								<div class="input-group date">
									<input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
							</div>
							<div class="form-group">
								<label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
								<select name="filter_status" id="input-status" class="form-control">
									<option value="*"></option>
									<?php if ($filter_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<?php } ?>
									<?php if (!$filter_status && !is_null($filter_status)) { ?>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
								<input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" for="input-answer"><?php echo $entry_answer; ?></label>
								<select name="filter_answer" id="input-answer" class="form-control">
									<option value="*"></option>
									<?php if ($filter_answer) { ?>
									<option value="1" selected="selected"><?php echo $text_yes; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_yes; ?></option>
									<?php } ?>
									<?php if (!$filter_answer && !is_null($filter_answer)) { ?>
									<option value="0" selected="selected"><?php echo $text_no; ?></option>
									<?php } else { ?>
									<option value="0"><?php echo $text_no; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-rating"><?php echo $entry_rating; ?></label>
								<select name="filter_rating" id="input-rating" class="form-control">
									<option value="*"></option>
									<option value="1" <?php if ($filter_rating == '1') { ?>selected="selected"<?php } ?>>1</option>
									<option value="2" <?php if ($filter_rating == '2') { ?>selected="selected"<?php } ?>>2</option>
									<option value="3" <?php if ($filter_rating == '3') { ?>selected="selected"<?php } ?>>3</option>
									<option value="4" <?php if ($filter_rating == '4') { ?>selected="selected"<?php } ?>>4</option>
									<option value="5" <?php if ($filter_rating == '5') { ?>selected="selected"<?php } ?>>5</option>
								</select>
							</div>
							<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
						</div>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
									<td class="text-left"><?php if ($sort == 't.date_added') { ?>
										<a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
										<?php } ?>
									</td>
									<td class="text-left"><?php if ($sort == 'customer') { ?>
										<a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer_id; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_customer; ?>"><?php echo $column_customer_id; ?></a>
										<?php } ?>
									</td>
									<td class="text-left"><?php if ($sort == 't.order_id') { ?>
										<a href="<?php echo $sort_order_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_order_id; ?>"><?php echo $column_order_id; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"><?php if ($sort == 't.rating') { ?>
										<a href="<?php echo $sort_rating; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_rating; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_rating; ?>"><?php echo $column_rating; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"><?php if ($sort == 't.status') { ?>
										<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"><?php if ($sort == 't.answer') { ?>
										<a href="<?php echo $sort_answer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_answer; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_answer; ?>"><?php echo $column_answer; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"></td>
								</tr>
							</thead>
							<tbody>
								<?php if ($pvnm_testimonials) { ?>
								<?php foreach ($pvnm_testimonials as $testimonial) { ?>
								<tr>
									<td class="text-center"><?php if (in_array($testimonial['testimonial_id'], $selected)) { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $testimonial['testimonial_id']; ?>" checked="checked" />
										<?php } else { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $testimonial['testimonial_id']; ?>" />
										<?php } ?>
									</td>
									<td class="text-left"><?php echo $testimonial['date_added']; ?></td>
									<td class="text-left"><a href="<?php echo $testimonial['customer_href']; ?>" target="_blank"><?php echo $testimonial['customer_name']; ?></a></td>
									<td class="text-left"><a href="<?php echo $testimonial['order_href']; ?>" target="_blank"><?php echo $testimonial['order_id']; ?></a></td>
									<td class="text-center"><img src="view/image/pvnm_testimonials/testimonial-star-<?php echo $testimonial['rating']; ?>.png" /></td>
									<?php if ($testimonial['status'] == 1) { ?>
										<td class="text-center"><span class="label label-success"><?php echo $text_enabled; ?></span></td>
									<?php } else { ?>
										<td class="text-center"><span class="label label-warning"><?php echo $text_disabled; ?></span></td>
									<?php } ?>
									<?php if ($testimonial['answer']) { ?>
										<td class="text-center"><span class="label label-success"><?php echo $text_yes; ?></span></td>
									<?php } else { ?>
										<td class="text-center"><span class="label label-default"><?php echo $text_no; ?></span></td>
									<?php } ?>
									<td class="text-right"><a href="<?php echo $testimonial['href']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
					<div class="col-sm-6 text-right"><?php echo $results; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=module/pvnm_testimonials/testimonials&token=<?php echo $token; ?>';

	var filter_date_added = $('input[name=\'filter_date_added\']').val();

	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}

	var filter_customer = $('input[name=\'filter_customer\']').val();

	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}

	var filter_rating = $('select[name=\'filter_rating\']').val();

	if (filter_rating != '*') {
		url += '&filter_rating=' + encodeURIComponent(filter_rating);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	var filter_answer = $('select[name=\'filter_answer\']').val();
	
	if (filter_answer != '*') {
		url += '&filter_answer=' + encodeURIComponent(filter_answer);
	} 
	
	location = url;
});
//--></script>
<script type="text/javascript"><!--
$('input[name=\'filter_customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer\']').val(item['label']);
	}
});
//--></script>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<?php echo $footer; ?>