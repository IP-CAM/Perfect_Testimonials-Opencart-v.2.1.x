<?php 
class ControllerInformationPvnmTestimonials extends Controller {
  	public function index() {
		$this->load->language('information/pvnm_testimonials');
		
		$this->load->model('module/pvnm_testimonials');
		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/javascript/pvnm_testimonials/testimonials.css');
		$this->document->addScript('catalog/view/javascript/pvnm_testimonials/testimonials.js');
		$this->document->addScript('catalog/view/javascript/pvnm_testimonials/jquery.raty.js');

		$localisations = $this->config->get('pvnm_testimonials_description');
		$localisations = $localisations[$this->config->get('config_language_id')];

		$this->document->setTitle($localisations['meta_title']);
		$this->document->setDescription($localisations['meta_description']);
		$this->document->setKeywords($localisations['meta_keyword']);

		if (isset($this->request->get['rating'])) {
			$store_rating = $this->request->get['rating'];
		} else {
			$store_rating = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 't.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} elseif ($this->config->get('pvnm_testimonials_limit')) {
			$limit = $this->config->get('pvnm_testimonials_limit');
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $localisations['name'],
			'href' => $this->url->link('information/pvnm_testimonials')
		);

    	$data['heading_title'] = $localisations['name'];
		$data['text_star1'] = $localisations['feature_1'];
		$data['text_star2'] = $localisations['feature_2'];
		$data['text_star3'] = $localisations['feature_3'];
		$data['text_star4'] = $localisations['feature_4'];
		$data['text_star5'] = $localisations['feature_5'];
		$data['text_heading'] = $this->language->get('text_heading');
    	$data['text_rating'] = $this->language->get('text_rating');
    	$data['text_rating_one'] = $this->language->get('text_rating_one');
    	$data['text_rating_other'] = $this->language->get('text_rating_other');
    	$data['text_filter'] = $this->language->get('text_filter');
    	$data['text_guest'] = $this->language->get('text_guest');
    	$data['text_order'] = $this->language->get('text_order');
    	$data['text_button'] = $this->language->get('text_button');
    	$data['text_sort'] = $this->language->get('text_sort');
    	$data['text_order_info'] = $this->language->get('text_order_info');
		$data['text_city'] = $this->language->get('text_city');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_comment'] = $this->language->get('text_comment');
		$data['text_answer'] = $this->language->get('text_answer');
    	$data['text_empty'] = $this->language->get('text_empty');
    	$data['text_success'] = $this->language->get('text_success');

		$data['description'] = html_entity_decode($localisations['description'], ENT_QUOTES, 'UTF-8');
		$data['home'] = $this->url->link('information/pvnm_testimonials');
		$data['pluses_status'] = $this->config->get('pvnm_testimonials_pluses_status');
		$data['minuses_status'] = $this->config->get('pvnm_testimonials_minuses_status');
		$data['comment_status'] = $this->config->get('pvnm_testimonials_comment_status');
		$data['order_status'] = $this->config->get('pvnm_testimonials_order_status');
		$data['delivery_status'] = $this->config->get('pvnm_testimonials_delivery_status');
		$data['vote_status'] = $this->config->get('pvnm_testimonials_vote_status');

		if ($this->config->get('pvnm_testimonials_vote_status') == 1) {
			$data['vote_status'] = $this->config->get('pvnm_testimonials_vote_status');
		} elseif ($this->config->get('pvnm_testimonials_vote_status') == 2 && $this->customer->isLogged()) {
			$data['vote_status'] = $this->config->get('pvnm_testimonials_vote_status');
		} else {
			$data['vote_status'] = null;
		}

		$url = '';

		if (isset($this->request->get['rating'])) {
			$url .= '&rating=' . $this->request->get['rating'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if ($this->customer->isLogged()) {
			$customer = $this->model_module_pvnm_testimonials->getCustomerInfo();

			$data['customer_name'] = $customer['firstname'] . ' ' . $customer['lastname'];
			$data['more'] = $this->language->get('text_sorry');
		} else {
			$data['customer_name'] = $this->language->get('text_guest');
			$data['more'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		}

		if (!empty($customer['free_orders'])) {
			$data['free_orders'] = $customer['free_orders'];
			$data['more'] = $this->language->get('text_more');
		} else {
			$data['free_orders'] = null;
		}

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
		} else {
			$data['rating_text'] = '';

			$data['rating_stars'] = 0;
		}

		$data['testimonials'] = array();

		$filter_data = array(
			'rating'    		 => $store_rating, 
			'sort'               => $sort,
			'order'              => $order,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$results = $this->model_module_pvnm_testimonials->getTestimonials($filter_data);

		$votes = $this->model_module_pvnm_testimonials->getVotes();

		foreach ($results as $result) {
			$vote_status = $this->config->get('pvnm_testimonials_vote_status');

			if ($this->customer->getId() == $result['customer_id']) {
				$vote_status = null;
				$author = $this->language->get('text_my_testimonial');
			} elseif ($this->config->get('pvnm_testimonials_lastname_status') == 1) {
				$author = $result['firstname'] . ' ' . $result['lastname']{0} . '***' . substr($result['lastname'], 1, 1);
			} else {
				$author = $result['firstname'] . ' ' . $result['lastname'];
			}

			$vote_1 = array();

			$vote_0 = array();

			foreach ($votes as $vote) {
				if ($vote['testimonial_id'] == $result['testimonial_id']) {
					if ($vote['type'] == 1) {
						$vote_1[] = array($vote['type']);
					} elseif ($vote['type'] == 0) {
						$vote_0[] = array($vote['type']);
					}
				}

				$vote_yes = count($vote_1);

				$vote_no = count($vote_0);
			}

			if (!isset($vote_yes)) {
				$vote_yes = 0;
			}

			if (!isset($vote_no)) {
				$vote_no = 0;
			}

		    $products = array();

			$products_data = $this->model_module_pvnm_testimonials->getOrderProducts($result['order_id']);

			foreach ($products_data as $product) {
				$products[] = array(
					'product_id'       => $product['product_id'],
					'image'    	 	   => $this->model_tool_image->resize($product['image'], 50, 50),
					'name'    	 	   => $product['name'],
					'model'    		   => $product['model'],
					'quantity'		   => $product['quantity'],
					'href'        	   => $this->url->link('product/product', 'product_id=' . $product['product_id'])
				);
			}

			$data['testimonials'][] = array(
				'testimonial_id'	=> (int)$result['testimonial_id'],
				'customer_id'		=> (int)$result['customer_id'],
				'order_id'			=> (int)$result['order_id'],
				'author'        	=> $author,
				'date_added' 		=> date('d.m.Y', strtotime($result['date_added'])),
				'rating'     	    => (int)$result['rating'],
				'rating_name'       => $data['text_star' . $result['rating']],
				'products'        	=> $products,
				'city'        	    => $result['city'],
				'shipping'        	=> $result['shipping'],
				'plus' 				=> html_entity_decode($result['plus'], ENT_QUOTES, 'UTF-8'),
				'minus'				=> html_entity_decode($result['minus'], ENT_QUOTES, 'UTF-8'),
				'comment'			=> html_entity_decode($result['comment'], ENT_QUOTES, 'UTF-8'),
				'answer'			=> html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8'),
				'vote_status'		=> $vote_status,
				'vote_yes'			=> $vote_yes,
				'vote_no'			=> $vote_no
			);
		}

		$url = '';

		if (isset($this->request->get['rating'])) {
			$url .= '&rating=' . $this->request->get['rating'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sorts'] = array();

		if (isset($this->request->get['sort']) && isset($this->request->get['order'])) {
			if ($this->request->get['sort'] == 't.date_added' && $this->request->get['order'] == 'DESC') {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_sort_date'),
					'value' => 't.date_added',
					'order' => 'ASC',
					'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.date_added&order=ASC' . $url)
				);
			} else {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_sort_date'),
					'value' => 't.date_added',
					'order' => 'DESC',
					'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.date_added&order=DESC' . $url)
				);
			}

			if ($this->request->get['sort'] == 't.rating' && $this->request->get['order'] == 'DESC') {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_sort_rating'),
					'value' => 't.rating',
					'order' => 'ASC',
					'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.rating&order=ASC' . $url)
				);
			} else {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_sort_rating'),
					'value' => 't.rating',
					'order' => 'DESC',
					'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.rating&order=DESC' . $url)
				);
			}

			if ($this->request->get['sort'] == 't.vote' && $this->request->get['order'] == 'DESC') {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_sort_vote'),
					'value' => 't.vote',
					'order' => 'ASC',
					'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.vote&order=ASC' . $url)
				);
			} else {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_sort_vote'),
					'value' => 't.vote',
					'order' => 'DESC',
					'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.vote&order=DESC' . $url)
				);
			}
		} else {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_sort_date'),
				'value' => 't.date_added',
				'order' => 'ASC',
				'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.date_added&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_sort_rating'),
				'value' => 't.rating',
				'order' => 'DESC',
				'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.rating&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_sort_vote'),
				'value' => 't.vote',
				'order' => 'DESC',
				'href'  => $this->url->link('information/pvnm_testimonials', '&sort=t.vote&order=DESC' . $url)
			);
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['ratings'] = array();

		$filter_ratings = array(
			'1' => array(),
			'2' => array(),
			'3' => array(),
			'4' => array(),
			'5' => array()
		);

		if (isset($testimonials['ratings'])) {
			$testimonials_ratings = $testimonials['ratings'] + $filter_ratings;
		} else {
			$testimonials_ratings = $filter_ratings;
		}

		$data['ratings'][] = array(
			'text'  => count($testimonials_ratings[5]),
			'value' => 5,
			'href'  => $this->url->link('information/pvnm_testimonials', '&rating=5' . $url)
		);

		$data['ratings'][] = array(
			'text'  => count($testimonials_ratings[4]),
			'value' => 4,
			'href'  => $this->url->link('information/pvnm_testimonials', '&rating=4' . $url)
		);

		$data['ratings'][] = array(
			'text'  => count($testimonials_ratings[3]),
			'value' => 3,
			'href'  => $this->url->link('information/pvnm_testimonials', '&rating=3' . $url)
		);

		$data['ratings'][] = array(
			'text'  => count($testimonials_ratings[2]),
			'value' => 2,
			'href'  => $this->url->link('information/pvnm_testimonials', '&rating=2' . $url)
		);

		$data['ratings'][] = array(
			'text'  => count($testimonials_ratings[1]),
			'value' => 1,
			'href'  => $this->url->link('information/pvnm_testimonials', '&rating=1' . $url)
		);

		$url = '';

		if (isset($this->request->get['rating'])) {
			$url .= '&rating=' . $this->request->get['rating'];
			
			$testimonials['total'] = count($testimonials_ratings[$this->request->get['rating']]);
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $testimonials['total'];
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('information/pvnm_testimonials', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonials['total']) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($testimonials['total'] - $limit)) ? $testimonials['total'] : ((($page - 1) * $limit) + $limit), $testimonials['total'], ceil($testimonials['total'] / $limit));

		if ($page == 1) {
		    $this->document->addLink($this->url->link('information/pvnm_testimonials', '', 'SSL'), 'canonical');
		} elseif ($page == 2) {
		    $this->document->addLink($this->url->link('information/pvnm_testimonials', '', 'SSL'), 'prev');
		} else {
		    $this->document->addLink($this->url->link('information/pvnm_testimonials', 'page='. ($page - 1), 'SSL'), 'prev');
		}

		if ($limit && ceil($testimonials['total'] / $limit) > $page) {
		    $this->document->addLink($this->url->link('information/pvnm_testimonials', 'page='. ($page + 1), 'SSL'), 'next');
		}

		$data['store_rating'] = $store_rating;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['max_rating'] = 1;

		foreach ($data['ratings'] as $rating) {
			if ($data['max_rating'] < $rating['text']) {
				$data['max_rating'] = $rating['text'];
			}
		}

		if ($this->config->get($this->config->get('pvnm_testimonials_captcha_status') . '_status')) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('pvnm_testimonials_captcha_status'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if ($this->config->get('pvnm_testimonials_status') == 1) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/pvnm_testimonials.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/pvnm_testimonials.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/pvnm_testimonials.tpl', $data));
			}
		} else {
			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/pvnm_testimonials')
			);

			$data['heading_title'] = $this->language->get('text_error');
			$data['text_error'] = $this->language->get('text_error');
			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
  	}

	public function add() {
		$this->load->language('information/pvnm_testimonials');

		$this->load->model('module/pvnm_testimonials');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->config->get($this->config->get('pvnm_testimonials_captcha_status') . '_status')) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('pvnm_testimonials_captcha_status') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if ($this->config->get('pvnm_testimonials_comment_status') == 1 && ((utf8_strlen($this->request->post['comment']) < 5) || (utf8_strlen($this->request->post['comment']) > 1000))) {
				$json['error'] = $this->language->get('error_comment');
			}

			if ($this->config->get('pvnm_testimonials_minuses_status') == 1 && ((utf8_strlen($this->request->post['minus']) < 5) || (utf8_strlen($this->request->post['minus']) > 1000))) {
				$json['error'] = $this->language->get('error_minus');
			}

			if ($this->config->get('pvnm_testimonials_pluses_status') == 1 && ((utf8_strlen($this->request->post['plus']) < 5) || (utf8_strlen($this->request->post['plus']) > 1000))) {
				$json['error'] = $this->language->get('error_plus');
			}

			if (empty($this->request->post['rating'])) {
				$json['error'] = $this->language->get('error_rating');
			}

			if ((!isset($json['error'])) && ($this->customer->getId() > 0)) {
				if ($this->config->get('pvnm_testimonials_approval') == 1) {
					$status = 0;
				} else {
					$status = 1;
				}

				$post_data = array(
					'customer_id'       => $this->customer->getId(),
					'order_id'        	=> $this->request->post['order_id'],
					'city'              => $this->request->post['city'],
					'shipping'          => $this->request->post['shipping'],
					'rating'            => $this->request->post['rating'],
					'comment'           => $this->request->post['comment'],
					'plus'              => $this->request->post['plus'],
					'minus'             => $this->request->post['minus'],
					'status'            => $status
				);

				$this->model_module_pvnm_testimonials->addTestimonial($post_data);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function vote() {
		$this->load->language('information/pvnm_testimonials');
		
		$this->load->model('module/pvnm_testimonials');

		$json = array();

		$set_cookie = 'pvnm_testimonials_vote_' . $this->request->post['testimonial_id'];

		if ($this->config->get('pvnm_testimonials_vote_status') == 1) {
	    	if ($this->config->get('pvnm_testimonials_vote_ip') == 1) {
	    		$ip_control = $this->model_module_pvnm_testimonials->checkVote($this->request->post['testimonial_id'], $this->request->server['REMOTE_ADDR']);
	    	}

	    	if (isset($ip_control)) {
	    		$json['error'] = $this->language->get('error_vote');
	    	} elseif (!isset($this->request->cookie[$set_cookie]) && !isset($ip_control)) {
		  		setcookie('pvnm_testimonials_vote_' . $this->request->post['testimonial_id'], base64_encode(serialize($_SERVER['REMOTE_ADDR'] . $this->request->post['testimonial_id'] . $this->request->post['type'])), time() + 60 * 60 * 24 * 999, '/', $this->request->server['HTTP_HOST']);

				if ($this->config->get('pvnm_testimonials_vote_approval') == 1) {
					$status = 0;
				} else {
					$status = 1;
				}

				$post_data = array(
					'testimonial_id'     => $this->request->post['testimonial_id'], 
					'customer_id'        => $this->customer->getId(),
					'type'               => $this->request->post['type'],
					'ip'             	 => $this->request->server['REMOTE_ADDR'],
					'status'             => $status
				);

				$this->model_module_pvnm_testimonials->addVote($post_data);
				
				if ($this->request->post['type'] == 1) {
					$this->model_module_pvnm_testimonials->upVote($this->request->post['testimonial_id']);
				} else {
					$this->model_module_pvnm_testimonials->downVote($this->request->post['testimonial_id']);
				}

				$vote_1 = array();
				
				$vote_0 = array();

				$votes = $this->model_module_pvnm_testimonials->getVotes(array('testimonial_id' => $this->request->post['testimonial_id']));

				foreach ($votes as $vote) {
					if ($vote['type'] == 1) {
						$vote_1[] = array($vote['type']);
					} elseif ($vote['type'] == 0) {
						$vote_0[] = array($vote['type']);
					}

					$json['vote_yes'] = count($vote_1);

					$json['vote_no'] = count($vote_0);
				}

				$json['success'] = $this->language->get('text_success_vote');
	    	} else {
				$json['error'] = $this->language->get('error_vote');
			}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}
}
