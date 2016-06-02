<?php 
class ModelModulePvnmTestimonials extends Model {
	public function getKeyword() {
		$query = $this->db->query("SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'information/pvnm_testimonials'");

		if (isset($query->row['keyword'])) {
			return $query->row['keyword'];
		}
	}

	public function saveKeyword($keyword) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information/pvnm_testimonials', keyword = '" . $this->db->escape($keyword) . "'");
	}

	public function deleteKeyword() {
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information/pvnm_testimonials'");
	}

	public function getTestimonials($data = array()) {
		$sql = "SELECT t.*, CONCAT(c.firstname, ' ', c.lastname) AS customer FROM " . DB_PREFIX . "pvnm_testimonials t LEFT JOIN " . DB_PREFIX . "customer c ON (t.customer_id = c.customer_id) WHERE t.testimonial_id > 0";

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(t.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (isset($data['filter_rating']) && !is_null($data['filter_rating'])) {
			$sql .= " AND t.rating = '" . (int)$data['filter_rating'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND t.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_answer']) && !is_null($data['filter_answer'])) {
			if ($data['filter_answer'] == 1) {
				$sql .= " AND t.answer NOT LIKE ''";
			} elseif ($data['filter_answer'] == 0) {
				$sql .= " AND t.answer LIKE ''";
			}
		}

		$sort_data = array(
			't.date_added',
			'customer',
			't.order_id',
			't.rating',
			't.status',
			't.answer'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY t.date_added";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTestimonialsTotal($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "pvnm_testimonials t LEFT JOIN " . DB_PREFIX . "customer c ON (t.customer_id = c.customer_id) WHERE t.testimonial_id > 0";

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(t.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (isset($data['filter_rating']) && !is_null($data['filter_rating'])) {
			$sql .= " AND t.rating = '" . (int)$data['filter_rating'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND t.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_answer']) && !is_null($data['filter_answer'])) {
			if ($data['filter_answer'] == 1) {
				$sql .= " AND t.answer NOT LIKE ''";
			} elseif ($data['filter_answer'] == 0) {
				$sql .= " AND t.answer LIKE ''";
			}
		}

		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

	public function getTestimonial($testimonial_id) {
		$query = $this->db->query("SELECT t.*, c.firstname, c.lastname FROM `" . DB_PREFIX . "pvnm_testimonials` t LEFT JOIN `" . DB_PREFIX . "customer` c ON (t.customer_id = c.customer_id) WHERE t.testimonial_id = '" . (int)$testimonial_id . "'");
		
		return $query->row;
	}

	public function editTestimonial($data, $testimonial_id) {
        $query = $this->db->query("SELECT t.status, t.answer, c.email, CONCAT(c.firstname, ' ', c.lastname) AS customer FROM `" . DB_PREFIX . "pvnm_testimonials` t LEFT JOIN `" . DB_PREFIX . "customer` c ON (t.customer_id = c.customer_id) WHERE t.testimonial_id = '" . (int)$testimonial_id . "'");

        if ($this->config->get('pvnm_testimonials_alert_publish') == 1 && $query->row['status'] == 0) {
            $testimonials_name = $this->config->get('pvnm_testimonials_description');

            $input = array(
                '{store_name}',
                '{store_url}',
                '{store_logo}',
                '{customer}',
                '{testimonials}'
            );

		    $output = array(
				'store_name'	=> $this->config->get('config_name'),
				'store_url'     => '<a href="' . HTTP_SERVER . '">' . $this->config->get('config_name') . '</a>',
				'store_logo'	=> '<a href="' . HTTP_SERVER . '"><img src="' . HTTP_SERVER . 'image/' . $this->config->get('config_logo') . '" / ></a>',
				'customer'		=> $query->row['customer'],
                'testimonials'  => '<a href="' . $this->url->link('information/pvnm_testimonials') . '">' . $testimonials_name[(int)$this->config->get('config_language_id')]['name'] . '</a>'
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

			$mail->setTo($query->row['email']);
			$mail->setFrom($this->config->get('pvnm_testimonials_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($alert_publish_subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->send();
		}

        if ($this->config->get('pvnm_testimonials_alert_response') == 1 && $query->row['answer'] == '' && $data['answer'] != '') {
            $testimonials_name = $this->config->get('pvnm_testimonials_description');

            $input = array(
                '{store_name}',
                '{store_url}',
                '{store_logo}',
                '{customer}',
                '{testimonials}'
            );

		    $output = array(
				'store_name'	=> $this->config->get('config_name'),
				'store_url'     => '<a href="' . HTTP_SERVER . '">' . $this->config->get('config_name') . '</a>',
				'store_logo'	=> '<a href="' . HTTP_SERVER . '"><img src="' . HTTP_SERVER . 'image/' . $this->config->get('config_logo') . '" / ></a>',
				'customer'		=> $query->row['customer'],
                'testimonials'  => '<a href="' . $this->url->link('information/pvnm_testimonials') . '">' . $testimonials_name[(int)$this->config->get('config_language_id')]['name'] . '</a>'
	        );

		    $alert_response_subject = $this->config->get('pvnm_testimonials_alert_response_subject');
		    $alert_response_message = $this->config->get('pvnm_testimonials_alert_response_message');

            $alert_response_subject = html_entity_decode(trim(str_replace($input, $output, $alert_response_subject[(int)$this->config->get('config_language_id')]['subject'])));
            $alert_response_message = html_entity_decode(str_replace($input, $output, $alert_response_message[(int)$this->config->get('config_language_id')]['message']));

			$html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">' . "\n";
			$html .= '<html>' . "\n";
			$html .= '  <head>' . "\n";
			$html .= '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . "\n";
			$html .= '    <title>' . $alert_response_subject . '</title>' . "\n";
			$html .= '  </head>' . "\n";
			$html .= '  <body>' . $alert_response_message . '</body>' . "\n";
			$html .= '</html>' . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($query->row['email']);
			$mail->setFrom($this->config->get('pvnm_testimonials_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($alert_response_subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($html);
			$mail->send();
		}

		$this->db->query("UPDATE " . DB_PREFIX . "pvnm_testimonials SET rating = '" . (int)$data['rating'] . "', comment = '" . $this->db->escape($data['comment']) . "', plus = '" . $this->db->escape($data['plus']) . "', minus = '" . $this->db->escape($data['minus']) . "', status = '" . (int)$data['status'] . "', answer = '" . $this->db->escape($data['answer']) . "' WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}

	public function deleteTestimonial($testimonial_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pvnm_testimonials WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pvnm_testimonials_vote WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}

	public function getVotes($data = array()) {
		$sql = "SELECT v.*, CONCAT(c.firstname, ' ', c.lastname) AS customer FROM " . DB_PREFIX . "pvnm_testimonials_vote v LEFT JOIN " . DB_PREFIX . "customer c ON (v.customer_id = c.customer_id) WHERE v.vote_id > 0";

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(v.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_ip'])) {
			$sql .= " AND v.ip = '" . $this->db->escape($data['filter_ip']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND v.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
			$sql .= " AND v.type = '" . (int)$data['filter_type'] . "'";
		}

		$sort_data = array(
			'v.date_added',
			'v.type',
			'v.testimonial_id',
			'customer',
			'v.ip',
			'v.status'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY v.date_added";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getVotesTotal($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "pvnm_testimonials_vote v LEFT JOIN " . DB_PREFIX . "customer c ON (v.customer_id = c.customer_id) WHERE v.vote_id > 0";

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(v.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_ip'])) {
			$sql .= " AND v.ip = '" . $this->db->escape($data['filter_ip']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND v.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
			$sql .= " AND v.type = '" . (int)$data['filter_type'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function deleteVotes($vote_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pvnm_testimonials_vote WHERE vote_id = '" . (int)$vote_id . "'");
	}

	public function changeVoteStatus($vote_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "pvnm_testimonials_vote SET status = status^1 WHERE vote_id = '" . (int)$vote_id . "'");
	}

	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pvnm_testimonials (
			testimonial_id int(11) NOT NULL AUTO_INCREMENT,
			customer_id int(11) NOT NULL, 
			order_id int(11) NOT NULL, 
			city varchar(255) NOT NULL, 
			shipping varchar(255) NOT NULL, 
			rating int(1) NOT NULL, 
			comment text, 
			plus text, 
		    minus text, 
			status tinyint(1) NOT NULL default '0', 
			date_added datetime NOT NULL default '0000-00-00 00:00:00', 
			vote int(11) NOT NULL default '0', 
			answer text, 
			PRIMARY KEY (testimonial_id), 
			UNIQUE (order_id) 
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pvnm_testimonials_vote (
			vote_id int(11) NOT NULL AUTO_INCREMENT, 
			testimonial_id int(11) NOT NULL, 
			customer_id int(11) NOT NULL, 
			type tinyint(1) NOT NULL, 
			ip varchar(40) NOT NULL, 
			status tinyint(1) NOT NULL default '0', 
			date_added datetime NOT NULL default '0000-00-00 00:00:00', 
			PRIMARY KEY (vote_id) 
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "pvnm_testimonials");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "pvnm_testimonials_vote");
	}
}
