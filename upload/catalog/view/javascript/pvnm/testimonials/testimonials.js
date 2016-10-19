var testimonial = {
	'add': function() {
		$.ajax({
			url: 'index.php?route=information/pvnm_testimonials/add',
			type: 'post',
			data: 'order_id=' + encodeURIComponent($('select[name=\'pvnm_testimonial_order\']').val()) + '&city=' + encodeURIComponent($('select[name=\'pvnm_testimonial_order\'] option:selected').data('city')) + '&shipping=' + encodeURIComponent($('select[name=\'pvnm_testimonial_order\'] option:selected').data('shipping')) + '&rating=' + encodeURIComponent($('#testimonial-rating input[name=\'score\']').val()) + '&comment=' + encodeURIComponent($('textarea[name=\'pvnm_testimonial_comment\']').val()) + '&plus=' + encodeURIComponent($('textarea[name=\'pvnm_testimonial_plus\']').val()) + '&minus=' + encodeURIComponent($('textarea[name=\'pvnm_testimonial_minus\']').val()) + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
			dataType: 'json',
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['error']) {
					$('#pvnmTestimonial .modal-footer').prepend('<div class="alert alert-danger text-left"><i class="fa fa-check-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'); // !!!
				}

				if (json['success']) {
					$('#pvnmTestimonial .modal-footer').html('<div class="alert alert-success text-left"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'vote': function(testimonial_id, type) {
		$.ajax({
			url: 'index.php?route=information/pvnm_testimonials/vote',
			type: 'post',
			data: 'testimonial_id=' + testimonial_id + '&type=' + type,
			dataType: 'json',
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['error']) {
					$('.testimonial-result-' + testimonial_id).append('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				if (json['success']) {
					$('.testimonial-vote-' + testimonial_id + ' > span:first-child span').html(json['vote_yes']);
					$('.testimonial-vote-' + testimonial_id + ' > span:last-child span').html(json['vote_no']);
					$('.testimonial-result-' + testimonial_id).append('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}