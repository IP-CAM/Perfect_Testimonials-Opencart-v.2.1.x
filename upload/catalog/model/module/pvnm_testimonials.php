<?php
class ModelModulePvnmTestimonials extends Model {
	public function getTestimonials($data = array()) {
		if ($data['start'] < 0) {
			$data['start'] = 0;
		}

		if ($data['limit'] < 1) {
			$data['limit'] = 5;
		}		

		$sql = "SELECT c.firstname, c.lastname, t.testimonial_id, t.customer_id, t.order_id, t.city, t.shipping, t.rating, t.plus, t.minus, t.comment, t.date_added, t.status, t.answer FROM `" . DB_PREFIX . "pvnm_testimonials` t LEFT JOIN `" . DB_PREFIX . "customer` c ON (t.customer_id = c.customer_id) WHERE t.status = 1";

		if (!empty($data['rating'])) {
			$sql .= " AND t.rating = '" . (int)$data['rating'] . "'";
		}

		$sql .= " ORDER BY";

		$sort_data = array(
			't.date_added',
			't.rating',
			't.vote'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 't.rating') {
				$sql .= " t.rating";
			} elseif ($data['sort'] == 't.vote') {
				$sql .= " t.vote";
			} else {
				$sql .= " t.date_added";
			}
		} else {
			$sql .= " t.date_added";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'] . "";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTestimonialsTotal() {
		$data = array();

		$query = $this->db->query("SELECT rating FROM " . DB_PREFIX . "pvnm_testimonials WHERE status = '1'");

		$data['total'] = $query->num_rows;

		if (!empty($query->rows)) {
			foreach ($query->rows as $row) {
				$data['ratings'][$row['rating']][] = $row['rating'];
			}
		}

		return $data;
	}

	public function addTestimonial($data = array()) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pvnm_testimonials SET customer_id = '" . (int)$data['customer_id'] . "', order_id = '" . (int)$data['order_id'] . "', city = '" .  $this->db->escape($data['city']) . "', shipping = '" . $this->db->escape($data['shipping']) . "', rating = '" . (int)$data['rating'] . "', comment = '" .  $this->db->escape($data['comment']) . "', plus = '" .  $this->db->escape($data['plus']) . "', minus = '" .  $this->db->escape($data['minus']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		if ($this->config->get('pvnm_testimonials_alert_admin')) {
			$testimonials_name = $this->config->get('pvnm_testimonials_description');

			$input = array(
				'{store_name}',
				'{store_url}',
				'{store_logo}',
				'{customer}',
				'{testimonials}'
			);

			$output = array(
				'store_name'		=> $this->config->get('config_name'),
				'store_url'			=> '<a href="' . HTTP_SERVER . '">' . $this->config->get('config_name') . '</a>',
				'store_logo'		=> '<a href="' . HTTP_SERVER . '"><img src="' . HTTP_SERVER . 'image/' . $this->config->get('config_logo') . '" / ></a>',
				'customer'			=> $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
				'testimonials' 	=> '<a href="' . $this->url->link('information/pvnm_testimonials') . '">' . $testimonials_name[(int)$this->config->get('config_language_id')]['name'] . '</a>'
			);

			$alert_admin_subject = $this->config->get('pvnm_testimonials_alert_admin_subject');
			$alert_admin_message = $this->config->get('pvnm_testimonials_alert_admin_message');

			$alert_admin_subject = html_entity_decode(trim(str_replace($input, $output, $alert_admin_subject[(int)$this->config->get('config_language_id')]['subject'])));
			$alert_admin_message = html_entity_decode(str_replace($input, $output, $alert_admin_message[(int)$this->config->get('config_language_id')]['message']));

			$html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">' . "\n";
			$html .= '<html>' . "\n";
			$html .= '  <head>' . "\n";
			$html .= '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . "\n";
			$html .= '    <title>' . $alert_admin_subject . '</title>' . "\n";
			$html .= '  </head>' . "\n";
			$html .= '  <body>' . $alert_admin_message . '</body>' . "\n";
			$html .= '</html>' . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('pvnm_testimonials_email'));
			$mail->setFrom($this->config->get('pvnm_testimonials_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($alert_admin_subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->send();
		}

		if ($this->config->get('pvnm_testimonials_alert_publish') && !$this->config->get('pvnm_testimonials_approval')) {
			$testimonials_name = $this->config->get('pvnm_testimonials_description');

			$input = array(
				'{store_name}',
				'{store_url}',
				'{store_logo}',
				'{customer}',
				'{testimonials}'
			);

			$output = array(
				'store_name'		=> $this->config->get('config_name'),
				'store_url'			=> '<a href="' . HTTP_SERVER . '">' . $this->config->get('config_name') . '</a>',
				'store_logo'		=> '<a href="' . HTTP_SERVER . '"><img src="' . HTTP_SERVER . 'image/' . $this->config->get('config_logo') . '" / ></a>',
				'customer'			=> $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
				'testimonials' 	=> '<a href="' . $this->url->link('information/pvnm_testimonials') . '">' . $testimonials_name[(int)$this->config->get('config_language_id')]['name'] . '</a>'
			);

			$alert_publish_subject = $this->config->get('pvnm_testimonials_alert_publish_subject');
			$alert_publish_message = $this->config->get('pvnm_testimonials_alert_publish_message');

			$alert_publish_subject = html_entity_decode(trim(str_replace($input, $output, $alert_publish_subject[(int)$this->config->get('config_language_id')]['subject'])));
			$alert_publish_message = html_entity_decode(str_replace($input, $output, $alert_publish_message[(int)$this->config->get('config_language_id')]['message']));

			$html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">' . "\n";
			$html .= '<html>' . "\n";
			$html .= '  <head>' . "\n";
			$html .= '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . "\n";
			$html .= '    <title>' . $alert_publish_subject . '</title>' . "\n";
			$html .= '  </head>' . "\n";
			$html .= '  <body>' . $alert_publish_message . '</body>' . "\n";
			$html .= '</html>' . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->customer->getEmail());
			$mail->setFrom($this->config->get('pvnm_testimonials_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($alert_publish_subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->send();
		}

		if ($this->config->get('pvnm_testimonials_customer_thanks')) {
			$testimonials_name = $this->config->get('pvnm_testimonials_description');

			if ($this->config->get('pvnm_testimonials_coupons')) {
				$this->load->language('information/pvnm_testimonials');

				$coupon = mt_rand(1000000, 9999999999) . $data['customer_id'];

				$coupon_data = array(
					'name'						=> $this->language->get('text_coupon_name') . $query->row['order_id'],
					'code'						=> $coupon,
					'discount'				=> $this->config->get('pvnm_testimonials_coupon_discount'),
					'type'						=> $this->config->get('pvnm_testimonials_coupon_type'),
					'total'						=> $this->config->get('pvnm_testimonials_coupon_total'),
					'logged'					=> 1,
					'shipping'				=> $this->config->get('pvnm_testimonials_coupon_shipping'),
					'date_start'			=> date('Y-m-d'),
					'date_end'				=> date('Y-m-d', strtotime('now +' . $this->config->get('pvnm_testimonials_coupon_days') . ' days')),
					'uses_total'			=> $this->config->get('pvnm_testimonials_coupon_uses'),
					'uses_customer'		=> $this->config->get('pvnm_testimonials_coupon_uses'),
					'status'					=> 1,
					'coupon_product'	=> $this->config->get('pvnm_testimonials_coupon_product'),
					'coupon_category'	=> $this->config->get('pvnm_testimonials_coupon_category')
				);

				$this->addCoupon($coupon_data);
			} else {
				$coupon = '';
			}

			$input = array(
				'{store_name}',
				'{store_url}',
				'{store_logo}',
				'{customer}',
				'{testimonials}',
				'{coupon}'
			);

			$output = array(
				'store_name'		=> $this->config->get('config_name'),
				'store_url'			=> '<a href="' . HTTP_SERVER . '">' . $this->config->get('config_name') . '</a>',
				'store_logo'		=> '<a href="' . HTTP_SERVER . '"><img src="' . HTTP_SERVER . 'image/' . $this->config->get('config_logo') . '" / ></a>',
				'customer'			=> $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
				'testimonials' 	=> '<a href="' . $this->url->link('information/pvnm_testimonials') . '">' . $testimonials_name[(int)$this->config->get('config_language_id')]['name'] . '</a>',
				'coupon'				=> $coupon
			);

			$customer_thanks_subject = $this->config->get('pvnm_testimonials_customer_thanks_subject');
			$customer_thanks_message = $this->config->get('pvnm_testimonials_customer_thanks_message');

			$customer_thanks_subject = html_entity_decode(trim(str_replace($input, $output, $customer_thanks_subject[(int)$this->config->get('config_language_id')]['subject'])));
			$customer_thanks_message = html_entity_decode(str_replace($input, $output, $customer_thanks_message[(int)$this->config->get('config_language_id')]['message']));

			$html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">' . "\n";
			$html .= '<html>' . "\n";
			$html .= '  <head>' . "\n";
			$html .= '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . "\n";
			$html .= '    <title>' . $customer_thanks_subject . '</title>' . "\n";
			$html .= '  </head>' . "\n";
			$html .= '  <body>' . $customer_thanks_message . '</body>' . "\n";
			$html .= '</html>' . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->customer->getEmail());
			$mail->setFrom($this->config->get('pvnm_testimonials_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($customer_thanks_subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->send();
		}
	}

	public function checkVote($testimonial_id, $ip) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pvnm_testimonials_vote WHERE testimonial_id = '" . (int)$testimonial_id . "' AND ip = '" . $this->db->escape($ip) . "'");

		if ($query->num_rows > 0) {
			return $query->num_rows;
		}
	}

	public function addVote($data = array()) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pvnm_testimonials_vote SET testimonial_id = '" . (int)$data['testimonial_id'] . "', customer_id = '" . (int)$data['customer_id'] . "', type = '" . (int)$data['type'] . "', ip = '" . $this->db->escape($data['ip']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}

	public function upVote($testimonial_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "pvnm_testimonials SET vote = vote + 1 WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}

	public function downVote($testimonial_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "pvnm_testimonials SET vote = vote - 1 WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}

	public function getVotes($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "pvnm_testimonials_vote WHERE status = 1";

		if (!empty($data['testimonial_id'])) {
			$sql .= " AND testimonial_id = '" . (int)$data['testimonial_id']. "'";
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCustomerInfo() {
		$implode = array();
		$data = array();

		foreach ($this->config->get('pvnm_testimonials_order_statuses') as $order_status_id) {
			$implode[] = "o.order_status_id = '" . (int)$order_status_id . "'";
		}

		$query = $this->db->query("SELECT c.firstname, c.lastname, c.email, a.city, COUNT(o.order_id) AS orders, COUNT(DISTINCT t.testimonial_id) AS testimonials FROM `" . DB_PREFIX . "customer` c LEFT JOIN `" . DB_PREFIX . "order` o ON (c.customer_id = o.customer_id) LEFT JOIN `" . DB_PREFIX . "address` a ON (c.address_id = a.address_id) LEFT JOIN `" . DB_PREFIX . "pvnm_testimonials` t ON (c.customer_id = t.customer_id) WHERE c.customer_id = '" . (int)$this->customer->getId() . "' AND c.status = 1 AND c.approved = 1 AND (" . implode(" OR ", $implode) . ")");

		$data = $query->row;

		if (($query->row['orders'] - $query->row['testimonials']) > 0) {
			$query_orders = $this->db->query("SELECT DISTINCT o.order_id, o.shipping_city, o.shipping_method FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = '" . (int)$this->customer->getId() . "' AND (" . implode(" OR ", $implode) . ") AND o.order_id NOT IN (SELECT DISTINCT order_id FROM `" . DB_PREFIX . "pvnm_testimonials`)");

			$data['free_orders'] = $query_orders->rows;
		}

		return $data;
	}

	public function getOrderProducts($order_id) {
		$query = $this->db->query("SELECT op.product_id, op.name, op.model, op.quantity, op.price, op.total, op.tax, p.image FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "product p ON op.product_id = p.product_id WHERE op.order_id = '" . (int)$order_id . "'");

		return $query->rows;
	}

	public function addCoupon($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "coupon SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$coupon_id = $this->db->getLastId();

		if (isset($data['coupon_product'])) {
			foreach ($data['coupon_product'] as $product_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "coupon_product SET coupon_id = '" . (int)$coupon_id . "', product_id = '" . (int)$product_id . "'");
			}
		}

		if (isset($data['coupon_category'])) {
			foreach ($data['coupon_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "coupon_category SET coupon_id = '" . (int)$coupon_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		return $coupon_id;
	}
}