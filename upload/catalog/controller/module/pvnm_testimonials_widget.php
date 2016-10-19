<?php
class ControllerModulePvnmTestimonialsWidget extends Controller {
	public function index($setting) {
		if ($setting['rating_status'] || $setting['testimonials_status']) {
			$this->load->language('information/pvnm_testimonials');

			$this->load->model('module/pvnm_testimonials');

			$this->document->addStyle('catalog/view/javascript/pvnm/testimonials/testimonials.css');

			$data['module_id'] = $setting['module_id'];
			$data['home'] = $this->url->link('information/pvnm_testimonials');
			$data['text_rating'] = $this->language->get('text_rating');
			$data['heading_title'] = $setting['testimonials_title'][$this->config->get('config_language_id')];
			$data['text_plus'] = $this->language->get('text_plus');
			$data['text_minus'] = $this->language->get('text_minus');
			$data['text_comment'] = $this->language->get('text_comment');
			$data['pluses_status'] = $this->config->get('pvnm_testimonials_pluses_status');
			$data['minuses_status'] = $this->config->get('pvnm_testimonials_minuses_status');
			$data['comment_status'] = $this->config->get('pvnm_testimonials_comment_status');

			$data['rating_text'] = '';
			$data['rating_stars'] = 0;
			$data['testimonials'] = array();

			$cache_data = $this->cache->get('pvnm_testimonials_widget.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . (int)$data['module_id']);

			if ($cache_data && $setting['cache']) {
				$data['rating_text'] = $cache_data['rating_text'];
				$data['rating_stars'] = $cache_data['rating_stars'];
				$data['testimonials'] = $cache_data['testimonials'];
			} else {
				$cache_data = array();

				if ($setting['rating_status']) {
					$testimonials = $this->model_module_pvnm_testimonials->getTestimonialsTotal();

					if ($testimonials['total'] > 0) {
						if ($testimonials['total'] == 1) {
							$data['rating_text'] = sprintf($this->language->get('text_rating_one'), $testimonials['total']);
						} else {
							$data['rating_text'] = sprintf($this->language->get('text_rating_other'), $testimonials['total']);
						}

						$rating_stars = 0;

						if (isset($testimonials['ratings'])) {
							foreach ($testimonials['ratings'] as $rating) {
								$rating_stars += array_sum($rating);
							}
						}

						$data['rating_stars'] = round(($rating_stars / $testimonials['total']), 1);
					}
				}

				if ($setting['testimonials_status']) {
					$filter_data = array(
						'rating'		=> '',
						'sort'			=> 't.' . $setting['sort'],
						'order'			=> 'DESC',
						'start'			=> 0,
						'limit'			=> $setting['testimonials_limit']
					);

					$results = $this->model_module_pvnm_testimonials->getTestimonials($filter_data);

					foreach ($results as $result) {
						if ($this->config->get('pvnm_testimonials_lastname_status')) {
							$author = $result['firstname'] . ' ' . $result['lastname']{0} . '***' . substr($result['lastname'], 1, 1);
						} else {
							$author = $result['firstname'] . ' ' . $result['lastname'];
						}

						$data['testimonials'][] = array(
							'testimonial_id'	=> (int)$result['testimonial_id'],
							'author'					=> $author,
							'rating'					=> (int)$result['rating'],
							'plus'						=> html_entity_decode($result['plus'], ENT_QUOTES, 'UTF-8'),
							'minus'						=> html_entity_decode($result['minus'], ENT_QUOTES, 'UTF-8'),
							'comment'					=> html_entity_decode($result['comment'], ENT_QUOTES, 'UTF-8')
						);
					}
				}

				if ($setting['cache']) {
					$data['module']['rating_text'] = $data['rating_text'];
					$data['module']['rating_stars'] = $data['rating_stars'];
					$data['module']['testimonials'] = $data['testimonials'];

					$this->cache->set('pvnm_testimonials_widget.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$data['module_id'], $data['module']);
				} else {
					$this->cache->delete('pvnm_testimonials_widget.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$data['module_id']);
				}
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/pvnm_testimonials_widget.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/pvnm_testimonials_widget.tpl', $data);
			} else {
				return $this->load->view('default/template/module/pvnm_testimonials_widget.tpl', $data);
			}
		}
	}
}