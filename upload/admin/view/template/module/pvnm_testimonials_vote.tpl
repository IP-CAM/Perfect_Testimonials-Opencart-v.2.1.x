<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $testimonials; ?>" data-toggle="tooltip" title="<?php echo $button_testimonials; ?>" class="btn btn-default"><i class="fa fa-star-half-o"></i></a>
        <a href="<?php echo $votes; ?>" data-toggle="tooltip" title="<?php echo $button_votes; ?>" class="btn btn-default active"><i class="fa fa-heart-o"></i></a>
        <a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default"><i class="fa fa-cogs"></i></a>
        <a href="<?php echo $widget; ?>" data-toggle="tooltip" title="<?php echo $button_widget; ?>" class="btn btn-default" style="margin-right: 30px;"><i class="fa fa-puzzle-piece"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-pvnm-testimonials-list').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-heart-o"></i> <?php echo $text_votes; ?></h3>
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
                <label class="control-label" for="input-type"><?php echo $entry_type; ?></label>
                <select name="filter_type" id="input-type" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_type) { ?>
                  <option value="1" selected="selected"><?php echo $text_positive; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_positive; ?></option>
                  <?php } ?>
                  <?php if (!$filter_type && !is_null($filter_type)) { ?>
                  <option value="0" selected="selected"><?php echo $text_negative; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_negative; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-ip"><?php echo $entry_ip; ?></label>
                <input type="text" name="filter_ip" value="<?php echo $filter_ip; ?>" placeholder="<?php echo $entry_ip; ?>" id="input-ip" class="form-control" />
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-pvnm-testimonials-list">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'v.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-center"><?php if ($sort == 'v.type') { ?>
                    <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_type; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_type; ?>"><?php echo $column_type; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'v.testimonial_id') { ?>
                    <a href="<?php echo $sort_testimonial_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_testimonial_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_testimonial_id; ?>"><?php echo $column_testimonial_id; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer_id; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'v.ip') { ?>
                    <a href="<?php echo $sort_ip; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ip; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_ip; ?>"><?php echo $column_ip; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-center"><?php if ($sort == 'v.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?>
                  </td>
                </tr>
              </thead>
              <tbody>
                <?php if ($pvnm_votes) { ?>
                <?php foreach ($pvnm_votes as $vote) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($vote['vote_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $vote['vote_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $vote['vote_id']; ?>" />
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php echo $vote['date_added']; ?></td>
                  <?php if ($vote['type'] == 1) { ?>
                    <td class="text-center"><i class="fa fa-thumbs-up" style="color: #8fbb6c; font-size: 22px;"></i></td>
                  <?php } else { ?>
                    <td class="text-center"><i class="fa fa-thumbs-down" style="color: #f56b6b; font-size: 22px;"></i></td>
                  <?php } ?>
                  <td class="text-left"><a href="<?php echo $vote['testimonial_href']; ?>" target="_blank"><?php echo $vote['testimonial_id']; ?></a></td>
                  <?php if ($vote['customer_id']) { ?>
                    <td class="text-left"><a href="<?php echo $vote['customer_href']; ?>" target="_blank"><?php echo $vote['customer_name']; ?></a></td>
                  <?php } else { ?>
                    <td class="text-left"><?php echo $text_guest; ?></td>
                  <?php } ?>
                  <td class="text-left"><?php echo $vote['ip']; ?></td>
                  <td class="text-center vote-status-<?php echo $vote['vote_id']; ?>">
                    <div class="btn-group" data-toggle="buttons">
                      <?php if ($vote['status'] == 1) { ?>
                        <label class="btn btn-xs btn-success active" onclick="changeStatus('<?php echo $vote['vote_id']; ?>');"><input type="radio" name="vote_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                        <label class="btn btn-xs btn-default" onclick="changeStatus('<?php echo $vote['vote_id']; ?>');"><input type="radio" name="vote_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                      <?php } else { ?>
                        <label class="btn btn-xs btn-default" onclick="changeStatus('<?php echo $vote['vote_id']; ?>');"><input type="radio" name="vote_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                        <label class="btn btn-xs btn-warning active" onclick="changeStatus('<?php echo $vote['vote_id']; ?>');"><input type="radio" name="vote_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                      <?php } ?>
                    </div>
                  </td>
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
    var url = 'index.php?route=module/pvnm_testimonials/votes&token=<?php echo $token; ?>';

    var filter_date_added = $('input[name=\'filter_date_added\']').val();

    if (filter_date_added) {
      url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
    }

    var filter_customer = $('input[name=\'filter_customer\']').val();

    if (filter_customer) {
      url += '&filter_customer=' + encodeURIComponent(filter_customer);
    }

    var filter_ip = $('input[name=\'filter_ip\']').val();

    if (filter_ip) {
      url += '&filter_ip=' + encodeURIComponent(filter_ip);
    }

    var filter_status = $('select[name=\'filter_status\']').val();

    if (filter_status != '*') {
      url += '&filter_status=' + encodeURIComponent(filter_status);
    }
    
    var filter_type = $('select[name=\'filter_type\']').val();
    
    if (filter_type != '*') {
      url += '&filter_type=' + encodeURIComponent(filter_type);
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
<script type="text/javascript"><!--
  function changeStatus(vote_id) {
    $.ajax({
      url: 'index.php?route=module/pvnm_testimonials/changeVoteStatus&token=<?php echo $token; ?>',
      type: 'post',
      data: 'vote_id=' + vote_id,
      dataType: 'json',
      success: function(json) {
        if ($('.vote-status-' + vote_id + ' .btn:first-child').hasClass('btn-default')) {
          $('.vote-status-' + vote_id + ' .btn:first-child').removeClass('btn-default').addClass('btn-success');
          $('.vote-status-' + vote_id + ' .btn:last-child').removeClass('btn-warning').addClass('btn-default');
        } else {
          $('.vote-status-' + vote_id + ' .btn:first-child').removeClass('btn-success').addClass('btn-default');
          $('.vote-status-' + vote_id + ' .btn:last-child').removeClass('btn-default').addClass('btn-warning');
        }

        if (json['success']) {
          $('.vote-status-' + vote_id).addClass('success');
        }

        if (json['error']) {
          $('.vote-status-' + vote_id).addClass('danger');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
//--></script>
<?php echo $footer; ?>
