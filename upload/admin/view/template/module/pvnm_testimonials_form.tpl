<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $testimonials; ?>" data-toggle="tooltip" title="<?php echo $button_testimonials; ?>" class="btn btn-default active"><i class="fa fa-star-half-o"></i></a>
        <a href="<?php echo $votes; ?>" data-toggle="tooltip" title="<?php echo $button_votes; ?>" class="btn btn-default"><i class="fa fa-heart-o"></i></a>
        <a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default"><i class="fa fa-cogs"></i></a>
        <a href="<?php echo $widget; ?>" data-toggle="tooltip" title="<?php echo $button_widget; ?>" class="btn btn-default" style="margin-right: 30px;"><i class="fa fa-puzzle-piece"></i></a>
        <button type="submit" form="form-pvnm-testimonial" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-star-half-o"></i> <?php echo $heading_title_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pvnm-testimonial" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_customer; ?></label>
            <div class="col-sm-10"><p class="form-control-static"><a href="<?php echo $customer_href; ?>" target="_blank"><?php echo $customer_name; ?></a></p></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_order; ?></label>
            <div class="col-sm-10"><p class="form-control-static"><a href="<?php echo $order_href; ?>" target="_blank"><?php echo $order_id; ?></a></p></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_city; ?></label>
            <div class="col-sm-10"><p class="form-control-static"><?php echo $city; ?></p></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_shipping; ?></label>
            <div class="col-sm-10"><p class="form-control-static"><?php echo $shipping; ?></p></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_date_added; ?></label>
            <div class="col-sm-10"><p class="form-control-static"><?php echo $date_added; ?></p></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pvnm-testimonials-pluses-status"><?php echo $entry_rating; ?></label>
            <div class="col-sm-10">
              <div class="btn-group" data-toggle="buttons">
                <?php if ($rating == 1) { ?>
                  <label class="btn btn-info active"><input type="radio" name="rating" value="1" autocomplete="off" checked="checked">1</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="2" autocomplete="off">2</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="3" autocomplete="off">3</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="4" autocomplete="off">4</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="5" autocomplete="off">5</label>
                <?php } elseif ($rating == 2) { ?>
                  <label class="btn btn-info"><input type="radio" name="rating" value="1" autocomplete="off">1</label>
                  <label class="btn btn-info active"><input type="radio" name="rating" value="2" autocomplete="off" checked="checked">2</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="3" autocomplete="off">3</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="4" autocomplete="off">4</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="5" autocomplete="off">5</label>
                <?php } elseif ($rating == 3) { ?>
                  <label class="btn btn-info"><input type="radio" name="rating" value="1" autocomplete="off">1</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="2" autocomplete="off">2</label>
                  <label class="btn btn-info active"><input type="radio" name="rating" value="3" autocomplete="off" checked="checked">3</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="4" autocomplete="off">4</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="5" autocomplete="off">5</label>
                <?php } elseif ($rating == 4) { ?>
                  <label class="btn btn-info"><input type="radio" name="rating" value="1" autocomplete="off">1</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="2" autocomplete="off">2</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="3" autocomplete="off">3</label>
                  <label class="btn btn-info active"><input type="radio" name="rating" value="4" autocomplete="off" checked="checked">4</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="5" autocomplete="off">5</label>
                <?php } else { ?>
                  <label class="btn btn-info"><input type="radio" name="rating" value="1" autocomplete="off">1</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="2" autocomplete="off">2</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="3" autocomplete="off">3</label>
                  <label class="btn btn-info"><input type="radio" name="rating" value="4" autocomplete="off">4</label>
                  <label class="btn btn-info active"><input type="radio" name="rating" value="5" autocomplete="off" checked="checked">5</label>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pvnm-testimonial-plus"><?php echo $entry_plus; ?></label>
            <div class="col-sm-10">
              <textarea name="plus" rows="5" placeholder="<?php echo $entry_plus; ?>" id="input-pvnm-testimonial-plus" class="form-control"><?php echo $plus; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pvnm-testimonial-minus"><?php echo $entry_minus; ?></label>
            <div class="col-sm-10">
              <textarea name="minus" rows="5" placeholder="<?php echo $entry_minus; ?>" id="input-pvnm-testimonial-minus" class="form-control"><?php echo $minus; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pvnm-testimonial-comment"><?php echo $entry_comment; ?></label>
            <div class="col-sm-10">
              <textarea name="comment" rows="5" placeholder="<?php echo $entry_comment; ?>" id="input-pvnm-testimonial-comment" class="form-control"><?php echo $comment; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pvnm-testimonial-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <div class="btn-group" data-toggle="buttons">
                <?php if ($status) { ?>
                  <label class="btn btn-info active"><input type="radio" name="status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                  <label class="btn btn-info"><input type="radio" name="status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                <?php } else { ?>
                  <label class="btn btn-info"><input type="radio" name="status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                  <label class="btn btn-info active"><input type="radio" name="status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-pvnm-testimonial-answer"><?php echo $entry_answer; ?></label>
            <div class="col-sm-10">
              <textarea name="answer" rows="5" placeholder="<?php echo $entry_answer; ?>" id="input-pvnm-testimonial-answer" class="form-control"><?php echo $answer; ?></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
