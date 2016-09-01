<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $testimonials; ?>" data-toggle="tooltip" title="<?php echo $button_testimonials; ?>" class="btn btn-default"><i class="fa fa-star-half-o"></i></a>
				<a href="<?php echo $votes; ?>" data-toggle="tooltip" title="<?php echo $button_votes; ?>" class="btn btn-default"><i class="fa fa-heart-o"></i></a>
				<a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default"><i class="fa fa-cogs"></i></a>
				<a href="<?php echo $widget; ?>" data-toggle="tooltip" title="<?php echo $button_widget; ?>" class="btn btn-default active" style="margin-right: 30px;"><i class="fa fa-puzzle-piece"></i></a>
				<button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
						<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-comment"></i> <?php echo $tab_help; ?></a></li>
					</ul>
					<div class="tab-content">
					<div class="tab-pane active" id="tab-settings">
						<div class="row">
								<div class="col-md-2">
										<ul class="nav nav-pills nav-stacked">
											<?php foreach ($modules as $module) { ?>
												<li id="module-<?php echo $module['module_id']; ?>" class="module"><a href="#tab-module-<?php echo $module['module_id']; ?>" data-toggle="tab"><?php echo $module['setting']['name']; ?><span style="display: block; float: right;"><i class="fa fa-remove" onclick="$('#module-<?php echo $module['module_id']; ?>').remove(); $('#tab-module-<?php echo $module['module_id']; ?>').remove(); $('form').append('<input type=\'hidden\' name=\'delete[]\' value=\'<?php echo $module['module_id']; ?>\' />'); $('.nav-stacked .module:first-child a').trigger('click'); return false;" style="color: red;"></i></span></a></li>
											<?php } ?>
											<li class="add"><a id="module-add" onclick="addModule();" style="cursor: pointer;"><?php echo $button_add; ?><span style="display: block; float: right;"><i class="fa fa-plus" style="color: green;"></i></span></a></li>
										</ul>
								</div>
								<div class="col-md-10">
										<div class="tab-content">
											<?php foreach ($modules as $module) { ?>
												<div class="tab-pane" id="tab-module-<?php echo $module['module_id']; ?>">
														<input type="hidden" name="module[<?php echo $module['module_id']; ?>][module_id]" value="<?php echo $module['module_id']; ?>" />
														<div class="form-group">
																<label class="col-sm-2 control-label" for="input-name<?php echo $module['module_id']; ?>"><?php echo $entry_name; ?></label>
																<div class="col-sm-10">
																		<input type="text" name="module[<?php echo $module['module_id']; ?>][name]" value="<?php echo $module['setting']['name']; ?>" placeholder="" id="input-name<?php echo $module['module_id']; ?>" class="form-control" />
																</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="input-rating-status<?php echo $module['module_id']; ?>"><?php echo $entry_rating_status; ?></label>
															<div class="col-sm-10">
																<div class="btn-group" data-toggle="buttons" id="input-rating-status<?php echo $module['module_id']; ?>">
																<?php if ($module['setting']['rating_status'] == 1) { ?>
																<label class="btn btn-info active"><input type="radio" name="module[<?php echo $module['module_id']; ?>][rating_status]" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
																<label class="btn btn-info"><input type="radio" name="module[<?php echo $module['module_id']; ?>][rating_status]" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
																<?php } else { ?>
																<label class="btn btn-info"><input type="radio" name="module[<?php echo $module['module_id']; ?>][rating_status]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
																<label class="btn btn-info active"><input type="radio" name="module[<?php echo $module['module_id']; ?>][rating_status]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
																<?php } ?>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="input-testimonials-status<?php echo $module['module_id']; ?>"><?php echo $entry_testimonials_status; ?></label>
															<div class="col-sm-10">
																<div class="btn-group" data-toggle="buttons" id="input-testimonials-status<?php echo $module['module_id']; ?>">
																<?php if ($module['setting']['testimonials_status'] == 1) { ?>
																<label class="btn btn-info active"><input type="radio" name="module[<?php echo $module['module_id']; ?>][testimonials_status]" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
																<label class="btn btn-info"><input type="radio" name="module[<?php echo $module['module_id']; ?>][testimonials_status]" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
																<?php } else { ?>
																<label class="btn btn-info"><input type="radio" name="module[<?php echo $module['module_id']; ?>][testimonials_status]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
																<label class="btn btn-info active"><input type="radio" name="module[<?php echo $module['module_id']; ?>][testimonials_status]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
																<?php } ?>
																</div>
															</div>
														</div>
														<div class="form-group">
																<label class="col-sm-2 control-label" for="input-testimonials-title<?php echo $module['module_id']; ?>"><?php echo $entry_testimonials_title; ?></label>
																<div class="col-sm-10">
																	<?php foreach ($languages as $language) { ?>
																		<div class="input-group pull-left">
																		<span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> </span>
																		<input type="text" name="module[<?php echo $module['module_id']; ?>][testimonials_title][<?php echo $language['language_id']; ?>]" value="<?php echo $module['setting']['testimonials_title'][$language['language_id']]; ?>" placeholder="" id="input-testimonials-title<?php echo $module['module_id']; ?>" class="form-control" />
																		</div>
																	<?php } ?>
																</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="input-testimonials-limit<?php echo $module['module_id']; ?>"><?php echo $entry_testimonials_limit; ?></label>
															<div class="col-sm-10">
																<input type="text" name="module[<?php echo $module['module_id']; ?>][testimonials_limit]" value="<?php echo $module['setting']['testimonials_limit']; ?>" placeholder="<?php echo $entry_testimonials_limit; ?>" id="input-testimonials-limit<?php echo $module['module_id']; ?>" class="form-control" />
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="input-status<?php echo $module['module_id']; ?>"><?php echo $entry_status; ?></label>
															<div class="col-sm-10">
																<div class="btn-group" data-toggle="buttons" id="input-status<?php echo $module['module_id']; ?>">
																<?php if ($module['setting']['status'] == 1) { ?>
																<label class="btn btn-info active"><input type="radio" name="module[<?php echo $module['module_id']; ?>][status]" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
																<label class="btn btn-info"><input type="radio" name="module[<?php echo $module['module_id']; ?>][status]" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
																<?php } else { ?>
																<label class="btn btn-info"><input type="radio" name="module[<?php echo $module['module_id']; ?>][status]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
																<label class="btn btn-info active"><input type="radio" name="module[<?php echo $module['module_id']; ?>][status]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
																<?php } ?>
																</div>
															</div>
														</div>
												</div>
											<?php } ?>
										</div>
								</div>
						</div>
					</div>
					<div class="tab-pane" id="tab-help">
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $text_documentation; ?></label>
							<div class="col-sm-10"><a href="https://github.com/p0v1n0m/opencart_perfect_testimonials" target="_blank" class="btn">https://github.com/p0v1n0m/opencart_perfect_testimonials</a></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $text_developer; ?></label>
							<div class="col-sm-10"><a href="mailto:p0v1n0m@gmail.com" class="btn">p0v1n0m@gmail.com</a></div>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
<?php if (isset($module_id)) { ?>
$('#module-<?php echo $module_id; ?> a').trigger('click');
<?php } else { ?>
$('.nav-stacked .module:first-child a').trigger('click');
<?php } ?>

var module_row = <?php echo $module_row; ?>;

function addModule() {  
		html  = '<div class="tab-pane" id="tab-module-' + module_row + '">';
		html += '   <div class="form-group">';
		html += '       <label class="col-sm-2 control-label" for="input-name' + module_row + '"><?php echo $entry_name; ?></label>';
		html += '       <div class="col-sm-10">';
		html += '           <input type="text" name="module[' + module_row + '][name]" value="<?php echo $text_tab_module; ?> ' + module_row + '" placeholder="" id="input-name' + module_row + '" class="form-control" />';
		html += '       </div>';
		html += '   </div>';
		html += '   <div class="form-group">';
		html += '       <label class="col-sm-2 control-label" for="input-rating-status' + module_row + '"><?php echo $entry_rating_status; ?></label>';
		html += '       <div class="col-sm-10">';
		html += '           <div class="btn-group" data-toggle="buttons" id="input-rating-status' + module_row + '">';
		html += '               <label class="btn btn-info"><input type="radio" name="module[' + module_row + '][rating_status]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>';
		html += '               <label class="btn btn-info active"><input type="radio" name="module[' + module_row + '][rating_status]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>';
		html += '           </div>';
		html += '       </div>';
		html += '   </div>';
		html += '   <div class="form-group">';
		html += '       <label class="col-sm-2 control-label" for="input-testimonials-status' + module_row + '"><?php echo $entry_testimonials_status; ?></label>';
		html += '       <div class="col-sm-10">';
		html += '           <div class="btn-group" data-toggle="buttons" id="input-testimonials-status' + module_row + '">';
		html += '               <label class="btn btn-info"><input type="radio" name="module[' + module_row + '][testimonials_status]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>';
		html += '               <label class="btn btn-info active"><input type="radio" name="module[' + module_row + '][testimonials_status]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>';
		html += '           </div>';
		html += '       </div>';
		html += '   </div>';
		html += '   <div class="form-group">';
		html += '       <label class="col-sm-2 control-label" for="input-testimonials-title' + module_row + '"><?php echo $entry_testimonials_title; ?></label>';
		html += '       <div class="col-sm-10">';
		<?php foreach ($languages as $language) { ?>
		html += '           <div class="input-group pull-left">';
		html += '               <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> </span>';
		html += '               <input type="text" name="module[' + module_row + '][testimonials_title][<?php echo $language['language_id']; ?>]" value="" placeholder="" id="input-testimonials-title' + module_row + '" class="form-control" />';
		html += '           </div>';
		<?php } ?>
		html += '       </div>';
		html += '   </div>';
		html += '   <div class="form-group">';
		html += '       <label class="col-sm-2 control-label" for="input-testimonials-limit' + module_row + '"><?php echo $entry_testimonials_limit; ?></label>';
		html += '       <div class="col-sm-10">';
		html += '           <input type="text" name="module[' + module_row + '][testimonials_limit]" value="1" placeholder="" id="input-testimonials-limit' + module_row + '" class="form-control" />';
		html += '       </div>';
		html += '   </div>';
		html += '   <div class="form-group">';
		html += '       <label class="col-sm-2 control-label" for="input-status' + module_row + '"><?php echo $entry_status; ?></label>';
		html += '       <div class="col-sm-10">';
		html += '           <div class="btn-group" data-toggle="buttons" id="input-status' + module_row + '">';
		html += '               <label class="btn btn-info"><input type="radio" name="module[' + module_row + '][status]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>';
		html += '               <label class="btn btn-info active"><input type="radio" name="module[' + module_row + '][status]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>';
		html += '           </div>';
		html += '       </div>';
		html += '   </div>';
		html += '</div>';

		$('.row .tab-content').append(html);

		$('.nav-stacked .add').before('<li id="module-' + module_row + '" class="module"><a href="#tab-module-' + module_row + '" data-toggle="tab"><?php echo $text_tab_module; ?> ' + module_row + '<span style="display: block; float: right;"><i class="fa fa-remove" onclick="$(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); $(\'.nav-stacked .module:first-child a\').trigger(\'click\'); return false;" style="color: red;"></i></span></a></li>');

		$('#module-' + module_row + ' a').trigger('click');

		module_row++;
}
//--></script>
<?php echo $footer; ?>