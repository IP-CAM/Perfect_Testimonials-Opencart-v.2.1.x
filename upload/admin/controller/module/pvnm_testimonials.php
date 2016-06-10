<?php
class ControllerModulePvnmTestimonials extends Controller {
	private $error = array();

    public function index() {
        $this->load->language('module/pvnm_testimonials');

        $this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/pvnm_testimonials');
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_modify()) {
			if (isset($this->request->post['pvnm_testimonials_keyword']) && trim($this->request->post['pvnm_testimonials_keyword']) == '') {
				$this->model_module_pvnm_testimonials->deleteKeyword();
			} elseif (isset($this->request->post['pvnm_testimonials_keyword'])) {
				$this->model_module_pvnm_testimonials->deleteKeyword();
				$this->model_module_pvnm_testimonials->saveKeyword($this->request->post['pvnm_testimonials_keyword']);
			}

			$this->model_setting_setting->editSetting('pvnm_testimonials', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_testimonials'] = $this->language->get('button_testimonials');
		$data['button_votes'] = $this->language->get('button_votes');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_widget'] = $this->language->get('button_widget');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_email'] = $this->language->get('tab_email');
		$data['tab_help'] = $this->language->get('tab_help');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_required'] = $this->language->get('text_required');
		$data['text_no_required'] = $this->language->get('text_no_required');
		$data['text_all_users'] = $this->language->get('text_all_users');
		$data['text_customers'] = $this->language->get('text_customers');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_store_name'] = $this->language->get('text_store_name');
		$data['text_store_url'] = $this->language->get('text_store_url');
		$data['text_store_logo'] = $this->language->get('text_store_logo');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_testimonials'] = $this->language->get('text_testimonials');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_developer'] = $this->language->get('text_developer');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_approval'] = $this->language->get('entry_approval');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_order_statuses'] = $this->language->get('entry_order_statuses');
		$data['entry_pluses_status'] = $this->language->get('entry_pluses_status');
		$data['entry_minuses_status'] = $this->language->get('entry_minuses_status');
		$data['entry_comment_status'] = $this->language->get('entry_comment_status');
		$data['entry_lastname_status'] = $this->language->get('entry_lastname_status');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_delivery_status'] = $this->language->get('entry_delivery_status');
		$data['entry_vote_status'] = $this->language->get('entry_vote_status');
		$data['entry_vote_approval'] = $this->language->get('entry_vote_approval');
		$data['entry_vote_ip'] = $this->language->get('entry_vote_ip');
		$data['entry_captcha_status'] = $this->language->get('entry_captcha_status');
		$data['entry_feature_1'] = $this->language->get('entry_feature_1');
		$data['entry_feature_2'] = $this->language->get('entry_feature_2');
		$data['entry_feature_3'] = $this->language->get('entry_feature_3');
		$data['entry_feature_4'] = $this->language->get('entry_feature_4');
		$data['entry_feature_5'] = $this->language->get('entry_feature_5');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_alert_admin'] = $this->language->get('entry_alert_admin');
		$data['entry_alert_publish'] = $this->language->get('entry_alert_publish');
		$data['entry_alert_response'] = $this->language->get('entry_alert_response');
		$data['entry_customer_motivate'] = $this->language->get('entry_customer_motivate');
		$data['entry_customer_thanks'] = $this->language->get('entry_customer_thanks');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['entry_macros'] = $this->language->get('entry_macros');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
   		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['testimonials'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['votes'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['widget'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL');
		$data['action'] = $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pvnm_testimonials_status'])) {
			$data['pvnm_testimonials_status'] = $this->request->post['pvnm_testimonials_status'];
		} else {
			$data['pvnm_testimonials_status'] = $this->config->get('pvnm_testimonials_status');
		}

		if (isset($this->request->post['pvnm_testimonials_approval'])) {
			$data['pvnm_testimonials_approval'] = $this->request->post['pvnm_testimonials_approval'];
		} else { 
			$data['pvnm_testimonials_approval'] = $this->config->get('pvnm_testimonials_approval');
		}

		if (isset($this->request->post['pvnm_testimonials_limit'])) {
			$data['pvnm_testimonials_limit'] = $this->request->post['pvnm_testimonials_limit'];
		} else { 
			$data['pvnm_testimonials_limit'] = $this->config->get('pvnm_testimonials_limit');
		}

		if (isset($this->request->post['pvnm_testimonials_email'])) {
			$data['pvnm_testimonials_email'] = $this->request->post['pvnm_testimonials_email'];
		} elseif ($this->config->get('pvnm_testimonials_email')) {
			$data['pvnm_testimonials_email'] = $this->config->get('pvnm_testimonials_email');
		} elseif ($this->config->get('config_email')) {
			$data['pvnm_testimonials_email'] = $this->config->get('config_email');
		}

		if (isset($this->request->post['pvnm_testimonials_order_statuses'])) {
			$data['pvnm_testimonials_order_statuses'] = $this->request->post['pvnm_testimonials_order_statuses'];
		} elseif ($this->config->get('pvnm_testimonials_order_statuses')) {
			$data['pvnm_testimonials_order_statuses'] = $this->config->get('pvnm_testimonials_order_statuses');
		} elseif ($this->config->get('config_complete_status')) {
			$data['pvnm_testimonials_order_statuses'] = $this->config->get('config_complete_status');
		} else {
			$data['pvnm_testimonials_order_statuses'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_pluses_status'])) {
			$data['pvnm_testimonials_pluses_status'] = $this->request->post['pvnm_testimonials_pluses_status'];
		} else { 
			$data['pvnm_testimonials_pluses_status'] = $this->config->get('pvnm_testimonials_pluses_status');
		}

		if (isset($this->request->post['pvnm_testimonials_minuses_status'])) {
			$data['pvnm_testimonials_minuses_status'] = $this->request->post['pvnm_testimonials_minuses_status'];
		} else { 
			$data['pvnm_testimonials_minuses_status'] = $this->config->get('pvnm_testimonials_minuses_status');
		}

		if (isset($this->request->post['pvnm_testimonials_comment_status'])) {
			$data['pvnm_testimonials_comment_status'] = $this->request->post['pvnm_testimonials_comment_status'];
		} else { 
			$data['pvnm_testimonials_comment_status'] = $this->config->get('pvnm_testimonials_comment_status');
		}

		if (isset($this->request->post['pvnm_testimonials_lastname_status'])) {
			$data['pvnm_testimonials_lastname_status'] = $this->request->post['pvnm_testimonials_lastname_status'];
		} else { 
			$data['pvnm_testimonials_lastname_status'] = $this->config->get('pvnm_testimonials_lastname_status');
		}

		if (isset($this->request->post['pvnm_testimonials_order_status'])) {
			$data['pvnm_testimonials_order_status'] = $this->request->post['pvnm_testimonials_order_status'];
		} else { 
			$data['pvnm_testimonials_order_status'] = $this->config->get('pvnm_testimonials_order_status');
		}

		if (isset($this->request->post['pvnm_testimonials_delivery_status'])) {
			$data['pvnm_testimonials_delivery_status'] = $this->request->post['pvnm_testimonials_delivery_status'];
		} else { 
			$data['pvnm_testimonials_delivery_status'] = $this->config->get('pvnm_testimonials_delivery_status');
		}

		if (isset($this->request->post['pvnm_testimonials_vote_status'])) {
			$data['pvnm_testimonials_vote_status'] = $this->request->post['pvnm_testimonials_vote_status'];
		} else { 
			$data['pvnm_testimonials_vote_status'] = $this->config->get('pvnm_testimonials_vote_status');
		}

		if (isset($this->request->post['pvnm_testimonials_vote_approval'])) {
			$data['pvnm_testimonials_vote_approval'] = $this->request->post['pvnm_testimonials_vote_approval'];
		} else { 
			$data['pvnm_testimonials_vote_approval'] = $this->config->get('pvnm_testimonials_vote_approval');
		}

		if (isset($this->request->post['pvnm_testimonials_vote_ip'])) {
			$data['pvnm_testimonials_vote_ip'] = $this->request->post['pvnm_testimonials_vote_ip'];
		} else { 
			$data['pvnm_testimonials_vote_ip'] = $this->config->get('pvnm_testimonials_vote_ip');
		}

		if (isset($this->request->post['pvnm_testimonials_captcha_status'])) {
			$data['pvnm_testimonials_captcha_status'] = $this->request->post['pvnm_testimonials_captcha_status'];
		} else {
			$data['pvnm_testimonials_captcha_status'] = $this->config->get('pvnm_testimonials_captcha_status');
		}

		$keyword = $this->model_module_pvnm_testimonials->getKeyword();

		if (!empty($keyword)) {
			$data['pvnm_testimonials_keyword'] = $keyword;
		} else {
			$data['pvnm_testimonials_keyword'] = '';
		}

		if (isset($this->request->post['pvnm_testimonials_description'])) {
			$data['pvnm_testimonials_description'] = $this->request->post['pvnm_testimonials_description'];
		} elseif ($this->config->get('pvnm_testimonials_description')) {
			$data['pvnm_testimonials_description'] = $this->config->get('pvnm_testimonials_description');
		} else {
			$data['pvnm_testimonials_description'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_alert_admin'])) {
			$data['pvnm_testimonials_alert_admin'] = $this->request->post['pvnm_testimonials_alert_admin'];
		} else { 
			$data['pvnm_testimonials_alert_admin'] = $this->config->get('pvnm_testimonials_alert_admin');
		}

		if (isset($this->request->post['pvnm_testimonials_alert_admin_subject'])) {
			$data['pvnm_testimonials_alert_admin_subject'] = $this->request->post['pvnm_testimonials_alert_admin_subject'];
		} elseif ($this->config->get('pvnm_testimonials_alert_admin_subject')) {
			$data['pvnm_testimonials_alert_admin_subject'] = $this->config->get('pvnm_testimonials_alert_admin_subject');
		} else {
			$data['pvnm_testimonials_alert_admin_subject'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_alert_admin_message'])) {
			$data['pvnm_testimonials_alert_admin_message'] = $this->request->post['pvnm_testimonials_alert_admin_message'];
		} elseif ($this->config->get('pvnm_testimonials_alert_admin_message')) {
			$data['pvnm_testimonials_alert_admin_message'] = $this->config->get('pvnm_testimonials_alert_admin_message');
		} else {
			$data['pvnm_testimonials_alert_admin_message'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_alert_publish'])) {
			$data['pvnm_testimonials_alert_publish'] = $this->request->post['pvnm_testimonials_alert_publish'];
		} else { 
			$data['pvnm_testimonials_alert_publish'] = $this->config->get('pvnm_testimonials_alert_publish');
		}

		if (isset($this->request->post['pvnm_testimonials_alert_publish_subject'])) {
			$data['pvnm_testimonials_alert_publish_subject'] = $this->request->post['pvnm_testimonials_alert_publish_subject'];
		} elseif ($this->config->get('pvnm_testimonials_alert_publish_subject')) {
			$data['pvnm_testimonials_alert_publish_subject'] = $this->config->get('pvnm_testimonials_alert_publish_subject');
		} else {
			$data['pvnm_testimonials_alert_publish_subject'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_alert_publish_message'])) {
			$data['pvnm_testimonials_alert_publish_message'] = $this->request->post['pvnm_testimonials_alert_publish_message'];
		} elseif ($this->config->get('pvnm_testimonials_alert_publish_message')) {
			$data['pvnm_testimonials_alert_publish_message'] = $this->config->get('pvnm_testimonials_alert_publish_message');
		} else {
			$data['pvnm_testimonials_alert_publish_message'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_alert_response'])) {
			$data['pvnm_testimonials_alert_response'] = $this->request->post['pvnm_testimonials_alert_response'];
		} else { 
			$data['pvnm_testimonials_alert_response'] = $this->config->get('pvnm_testimonials_alert_response');
		}

		if (isset($this->request->post['pvnm_testimonials_alert_response_subject'])) {
			$data['pvnm_testimonials_alert_response_subject'] = $this->request->post['pvnm_testimonials_alert_response_subject'];
		} elseif ($this->config->get('pvnm_testimonials_alert_response_subject')) {
			$data['pvnm_testimonials_alert_response_subject'] = $this->config->get('pvnm_testimonials_alert_response_subject');
		} else {
			$data['pvnm_testimonials_alert_response_subject'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_alert_response_message'])) {
			$data['pvnm_testimonials_alert_response_message'] = $this->request->post['pvnm_testimonials_alert_response_message'];
		} elseif ($this->config->get('pvnm_testimonials_alert_response_message')) {
			$data['pvnm_testimonials_alert_response_message'] = $this->config->get('pvnm_testimonials_alert_response_message');
		} else {
			$data['pvnm_testimonials_alert_response_message'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_customer_motivate'])) {
			$data['pvnm_testimonials_customer_motivate'] = $this->request->post['pvnm_testimonials_customer_motivate'];
		} else { 
			$data['pvnm_testimonials_customer_motivate'] = $this->config->get('pvnm_testimonials_customer_motivate');
		}

		if (isset($this->request->post['pvnm_testimonials_customer_motivate_subject'])) {
			$data['pvnm_testimonials_customer_motivate_subject'] = $this->request->post['pvnm_testimonials_customer_motivate_subject'];
		} elseif ($this->config->get('pvnm_testimonials_customer_motivate_subject')) {
			$data['pvnm_testimonials_customer_motivate_subject'] = $this->config->get('pvnm_testimonials_customer_motivate_subject');
		} else {
			$data['pvnm_testimonials_customer_motivate_subject'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_customer_motivate_message'])) {
			$data['pvnm_testimonials_customer_motivate_message'] = $this->request->post['pvnm_testimonials_customer_motivate_message'];
		} elseif ($this->config->get('pvnm_testimonials_customer_motivate_message')) {
			$data['pvnm_testimonials_customer_motivate_message'] = $this->config->get('pvnm_testimonials_customer_motivate_message');
		} else {
			$data['pvnm_testimonials_customer_motivate_message'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_customer_thanks'])) {
			$data['pvnm_testimonials_customer_thanks'] = $this->request->post['pvnm_testimonials_customer_thanks'];
		} else { 
			$data['pvnm_testimonials_customer_thanks'] = $this->config->get('pvnm_testimonials_customer_thanks');
		}

		if (isset($this->request->post['pvnm_testimonials_customer_thanks_subject'])) {
			$data['pvnm_testimonials_customer_thanks_subject'] = $this->request->post['pvnm_testimonials_customer_thanks_subject'];
		} elseif ($this->config->get('pvnm_testimonials_customer_thanks_subject')) {
			$data['pvnm_testimonials_customer_thanks_subject'] = $this->config->get('pvnm_testimonials_customer_thanks_subject');
		} else {
			$data['pvnm_testimonials_customer_thanks_subject'] = array();
		}

		if (isset($this->request->post['pvnm_testimonials_customer_thanks_message'])) {
			$data['pvnm_testimonials_customer_thanks_message'] = $this->request->post['pvnm_testimonials_customer_thanks_message'];
		} elseif ($this->config->get('pvnm_testimonials_customer_thanks_message')) {
			$data['pvnm_testimonials_customer_thanks_message'] = $this->config->get('pvnm_testimonials_customer_thanks_message');
		} else {
			$data['pvnm_testimonials_customer_thanks_message'] = array();
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$this->load->model('extension/extension');

		$data['captchas'] = array();

		$extensions = $this->model_extension_extension->getInstalled('captcha');

		foreach ($extensions as $code) {
			$this->load->language('captcha/' . $code);

			if ($this->config->has($code . '_status')) {
				$data['captchas'][] = array(
					'text'  => $this->language->get('heading_title'),
					'value' => $code
				);
			}
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_testimonials.tpl', $data));
    }

	public function testimonials() {
		$this->load->language('module/pvnm_testimonials');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/pvnm_testimonials');

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}

		if (isset($this->request->get['filter_rating'])) {
			$filter_rating = $this->request->get['filter_rating'];
		} else {
			$filter_rating = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_answer'])) {
			$filter_answer = $this->request->get['filter_answer'];
		} else {
			$filter_answer = null;
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
			
		$url = '';

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_rating'])) {
			$url .= '&filter_rating=' . $this->request->get['filter_rating'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_answer'])) {
			$url .= '&filter_answer=' . $this->request->get['filter_answer'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_list'),
			'href' => $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['testimonials'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['votes'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['widget'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/pvnm_testimonials/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['pvnm_testimonials'] = array();

		$filter_data = array(
			'filter_date_added' => $filter_date_added,
			'filter_customer'   => $filter_customer,
			'filter_rating'   	=> $filter_rating,
			'filter_status'   	=> $filter_status,
			'filter_answer'   	=> $filter_answer,
			'sort'            	=> $sort,
			'order'           	=> $order,
			'start'           	=> ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           	=> $this->config->get('config_limit_admin')
		);

		$testimonials_total = $this->model_module_pvnm_testimonials->getTestimonialsTotal($filter_data);

		$results = $this->model_module_pvnm_testimonials->getTestimonials($filter_data);
 
    	foreach ($results as $result) {
			$data['pvnm_testimonials'][] = array(
				'testimonial_id'  => $result['testimonial_id'],
				'customer_name'   => $result['customer'],
				'customer_href'   => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'], 'SSL'),
				'order_href'  	  => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'], 'SSL'),
				'order_id'  	  => $result['order_id'],
				'city'            => $result['city'],
				'shipping'        => $result['shipping'],
				'rating'          => $result['rating'],
				'status'          => $result['status'],
				'answer'          => $result['answer'],
				'date_added'      => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'        => isset($this->request->post['selected']) && in_array($result['testimonial_id'], $this->request->post['selected']),
				'href'          => $this->url->link('module/pvnm_testimonials/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $result['testimonial_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_testimonials'] = $this->language->get('button_testimonials');
		$data['button_votes'] = $this->language->get('button_votes');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_widget'] = $this->language->get('button_widget');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_customer_id'] = $this->language->get('column_customer_id');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_rating'] = $this->language->get('column_rating');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_answer'] = $this->language->get('column_answer');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_answer'] = $this->language->get('entry_answer');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_yes'] = $this->language->get('text_yes');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_rating'])) {
			$url .= '&filter_rating=' . $this->request->get['filter_rating'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_answer'])) {
			$url .= '&filter_answer=' . $this->request->get['filter_answer'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_date_added'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . '&sort=t.date_added' . $url, 'SSL');
		$data['sort_customer'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$data['sort_order_id'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . '&sort=t.order_id' . $url, 'SSL');
		$data['sort_rating'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . '&sort=t.rating' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . '&sort=t.status' . $url, 'SSL');
		$data['sort_answer'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . '&sort=t.answer' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_rating'])) {
			$url .= '&filter_rating=' . $this->request->get['filter_rating'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_answer'])) {
			$url .= '&filter_answer=' . $this->request->get['filter_answer'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $testimonials_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonials_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($testimonials_total - $this->config->get('config_limit_admin'))) ? $testimonials_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $testimonials_total, ceil($testimonials_total / $this->config->get('config_limit_admin')));

		$data['filter_date_added'] = $filter_date_added;
		$data['filter_customer'] = $filter_customer;
		$data['filter_rating'] = $filter_rating;
		$data['filter_status'] = $filter_status;
		$data['filter_answer'] = $filter_answer;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_testimonials_list.tpl', $data));
	}

	public function delete() { 
		$this->load->language('module/pvnm_testimonials');

		$this->load->model('module/pvnm_testimonials');

		if (isset($this->request->post['selected']) && $this->validate_modify()) {
			foreach ($this->request->post['selected'] as $testimonial_id) {
				$this->model_module_pvnm_testimonials->deleteTestimonial($testimonial_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->testimonials();
	}

	public function edit() {
		$this->load->language('module/pvnm_testimonials');

		$this->load->model('module/pvnm_testimonials');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_modify()) {
			$this->model_module_pvnm_testimonials->editTestimonial($this->request->post, $this->request->get['testimonial_id']);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->change();
	}

	protected function change() {
		$this->document->setTitle($this->language->get('heading_title_list'));

		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_title_edit'] = $this->language->get('heading_title_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['button_testimonials'] = $this->language->get('button_testimonials');
		$data['button_votes'] = $this->language->get('button_votes');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_widget'] = $this->language->get('button_widget');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_order'] = $this->language->get('entry_order');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_plus'] = $this->language->get('entry_plus');
		$data['entry_minus'] = $this->language->get('entry_minus');
		$data['entry_comment'] = $this->language->get('entry_comment');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_answer'] = $this->language->get('entry_answer');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_list'),
			'href' => $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['testimonials'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['votes'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['widget'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['testimonial_id'])) {
			$data['action'] = $this->url->link('module/pvnm_testimonials/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $this->request->get['testimonial_id'] . $url, 'SSL');

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title_edit'),
				'href' => $this->url->link('module/pvnm_testimonials/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $this->request->get['testimonial_id'] . $url, 'SSL')
			);
		}

		$data['token'] = $this->session->data['token'];

      	$testimonial_info = $this->model_module_pvnm_testimonials->getTestimonial($this->request->get['testimonial_id']);

		if (!empty($testimonial_info)) {
			$data['customer_href'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $testimonial_info['customer_id'], 'SSL');
			$data['customer_name'] = $testimonial_info['firstname'] . ' ' . $testimonial_info['lastname'];
			$data['order_href'] =$this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $testimonial_info['order_id'], 'SSL');
			$data['order_id'] = $testimonial_info['order_id'];
		} else {
			$data['customer_href'] = '';
			$data['customer_name'] = '';
			$data['order_href'] = '';
			$data['order_id'] = '';
		}

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($testimonial_info)) {
			$data['city'] = $testimonial_info['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->request->post['shipping'])) {
			$data['shipping'] = $this->request->post['shipping'];
		} elseif (!empty($testimonial_info)) {
			$data['shipping'] = $testimonial_info['shipping'];
		} else {
			$data['shipping'] = '';
		}

		if (isset($this->request->post['date_added'])) {
			$data['date_added'] = date($this->language->get('date_format_short'), strtotime($this->request->post['date_added']));
		} elseif (!empty($testimonial_info)) {
			$data['date_added'] = date($this->language->get('date_format_short'), strtotime($testimonial_info['date_added']));
		} else {
			$data['date_added'] = '';
		}

		if (isset($this->request->post['rating'])) {
			$data['rating'] = $this->request->post['rating'];
		} elseif (!empty($testimonial_info)) {
			$data['rating'] = $testimonial_info['rating'];
		} else {
			$data['rating'] = '';
		}

		if (isset($this->request->post['plus'])) {
			$data['plus'] = $this->request->post['plus'];
		} elseif (!empty($testimonial_info)) {
			$data['plus'] = $testimonial_info['plus'];
		} else {
			$data['plus'] = '';
		}

		if (isset($this->request->post['minus'])) {
			$data['minus'] = $this->request->post['minus'];
		} elseif (!empty($testimonial_info)) {
			$data['minus'] = $testimonial_info['minus'];
		} else {
			$data['minus'] = '';
		}

		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (!empty($testimonial_info)) {
			$data['comment'] = $testimonial_info['comment'];
		} else {
			$data['comment'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($testimonial_info)) {
			$data['status'] = $testimonial_info['status'];
		} else {
			$data['status'] = null;
		}

		if (isset($this->request->post['answer'])) {
			$data['answer'] = $this->request->post['answer'];
		} elseif (!empty($testimonial_info)) {
			$data['answer'] = $testimonial_info['answer'];
		} else {
			$data['answer'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_testimonials_form.tpl', $data));
	}

	public function votes() {
		$this->load->language('module/pvnm_testimonials');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/pvnm_testimonials');

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}

		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'v.date_added';
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
			
		$url = '';

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_votes'),
			'href' => $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['testimonials'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['votes'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['widget'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/pvnm_testimonials/deleteVotes', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['pvnm_votes'] = array();

		$filter_data = array(
			'filter_date_added' => $filter_date_added,
			'filter_customer'   => $filter_customer,
			'filter_ip'   		=> $filter_ip,
			'filter_status'   	=> $filter_status,
			'filter_type'   	=> $filter_type,
			'sort'            	=> $sort,
			'order'           	=> $order,
			'start'           	=> ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           	=> $this->config->get('config_limit_admin')
		);

		$votes_total = $this->model_module_pvnm_testimonials->getVotesTotal($filter_data);

		$results = $this->model_module_pvnm_testimonials->getVotes($filter_data);
 
    	foreach ($results as $result) {
			$data['pvnm_votes'][] = array(
				'vote_id'  		   => $result['vote_id'],
				'date_added'       => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'type'  		   => $result['type'],
				'testimonial_id'   => $result['testimonial_id'],
				'testimonial_href' => $this->url->link('module/pvnm_testimonials/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $result['testimonial_id'], 'SSL'),
				'customer_id'      => $result['customer_id'],
				'customer_name'    => $result['customer'],
				'customer_href'    => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'], 'SSL'),
				'ip'               => $result['ip'],
				'status'           => $result['status']
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_testimonials'] = $this->language->get('button_testimonials');
		$data['button_votes'] = $this->language->get('button_votes');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_widget'] = $this->language->get('button_widget');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_type'] = $this->language->get('column_type');
		$data['column_testimonial_id'] = $this->language->get('column_testimonial_id');
		$data['column_customer_id'] = $this->language->get('column_customer_id');
		$data['column_ip'] = $this->language->get('column_ip');
		$data['column_status'] = $this->language->get('column_status');
		$data['text_votes'] = $this->language->get('text_votes');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_positive'] = $this->language->get('text_positive');
		$data['text_negative'] = $this->language->get('text_negative');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_guest'] = $this->language->get('text_guest');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_date_added'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . '&sort=v.date_added' . $url, 'SSL');
		$data['sort_type'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . '&sort=v.type' . $url, 'SSL');
		$data['sort_testimonial_id'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . '&sort=v.testimonial_id' . $url, 'SSL');
		$data['sort_customer'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$data['sort_ip'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . '&sort=v.ip' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . '&sort=v.status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $votes_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($votes_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($votes_total - $this->config->get('config_limit_admin'))) ? $votes_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $votes_total, ceil($votes_total / $this->config->get('config_limit_admin')));

		$data['filter_date_added'] = $filter_date_added;
		$data['filter_customer'] = $filter_customer;
		$data['filter_ip'] = $filter_ip;
		$data['filter_status'] = $filter_status;
		$data['filter_type'] = $filter_type;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_testimonials_vote.tpl', $data));
	}

	public function deleteVotes() { 
		$this->load->language('module/pvnm_testimonials');

		$this->load->model('module/pvnm_testimonials');

		if (isset($this->request->post['selected']) && $this->validate_modify()) {
			foreach ($this->request->post['selected'] as $vote_id) {
				$this->model_module_pvnm_testimonials->deleteVotes($vote_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->votes();
	}

	public function changeVoteStatus() {
		$this->load->language('module/pvnm_testimonials');

		$this->load->model('module/pvnm_testimonials');

		$json = array();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_modify()) {
			$this->model_module_pvnm_testimonials->changeVoteStatus($this->request->post['vote_id']);

			$json['success'] = $this->language->get('text_success');
		} else {
			$json['error'] = $this->error['warning'];
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

    protected function validate_modify() {
        if (!$this->user->hasPermission('modify', 'module/pvnm_testimonials')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {
        $this->load->model('module/pvnm_testimonials');

        $this->model_module_pvnm_testimonials->install();
    }

    public function uninstall() {
        $this->load->model('module/pvnm_testimonials');

        $this->model_module_pvnm_testimonials->uninstall();
    }
}
