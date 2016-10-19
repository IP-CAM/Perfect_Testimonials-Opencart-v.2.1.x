<?php
class ControllerModulePvnmTestimonialsWidget extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/pvnm_testimonials_widget');

		$this->load->model('extension/module');
		$this->load->model('localisation/language');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!empty($this->request->post['module'])) {
				foreach ($this->request->post['module'] as $key => $module) {
					if (!isset($module['module_id'])) {
						$module_data = $this->request->post['module'][$key];

						$module_data['module_id'] = $this->model_extension_module->addModule('pvnm_testimonials_widget', $this->request->post['module'][$key]);

						$this->model_extension_module->editModule($module_data['module_id'], $module_data);
					} else {
						$this->model_extension_module->editModule($module['module_id'], $this->request->post['module'][$key]);
					}
				}
			}

			if (!empty($this->request->post['delete'])) {
				foreach ($this->request->post['delete'] as $delete) {
					$this->model_extension_module->deleteModule($delete);
				}
			}

			$this->session->data['success'] = $this->language->get('text_success');

			if (!isset($this->request->get['module_id']) || empty($this->request->post['module'])) {
				$this->response->redirect($this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->response->redirect($this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL'));
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_testimonials'] = $this->language->get('button_testimonials');
		$data['button_votes'] = $this->language->get('button_votes');
		$data['button_settings'] = $this->language->get('button_settings');
		$data['button_widget'] = $this->language->get('button_widget');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add'] = $this->language->get('button_add');
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_help'] = $this->language->get('tab_help');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_developer'] = $this->language->get('text_developer');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_tab_module'] = $this->language->get('text_tab_module');
		$data['text_sort_date'] = $this->language->get('text_sort_date');
		$data['text_sort_rating'] = $this->language->get('text_sort_rating');
		$data['text_sort_usefulness'] = $this->language->get('text_sort_usefulness');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_rating_status'] = $this->language->get('entry_rating_status');
		$data['entry_testimonials_status'] = $this->language->get('entry_testimonials_status');
		$data['entry_testimonials_title'] = $this->language->get('entry_testimonials_title');
		$data['entry_testimonials_limit'] = $this->language->get('entry_testimonials_limit');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_cache'] = $this->language->get('entry_cache');

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

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['testimonials'] = $this->url->link('module/pvnm_testimonials/testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['votes'] = $this->url->link('module/pvnm_testimonials/votes', 'token=' . $this->session->data['token'], 'SSL');
		$data['settings'] = $this->url->link('module/pvnm_testimonials', 'token=' . $this->session->data['token'], 'SSL');
		$data['widget'] = $this->url->link('module/pvnm_testimonials_widget', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id'])) {
			$data['module_id'] = $this->request->get['module_id'];
		}

		$data['modules'] = array();

		$modules = $this->model_extension_module->getModulesByCode('pvnm_testimonials_widget');

		if (!empty($modules)) {
			foreach ($modules as $module) {
				$setting = json_decode($module['setting'], true);

				$data['modules'][] = array(
					'module_id' => $module['module_id'],
					'name'      => $module['name'],
					'setting'   => $setting
				);

				$setting = '';
			}
		}

		sort($data['modules']);

		$data['module_row'] = 1;

		if (count($data['modules']) + 1 > $data['module_row']) {
			$data['module_row'] = count($data['modules']) + 1;
		}

		$data['token'] = $this->session->data['token'];
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pvnm_testimonials_widget.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/pvnm_testimonials_widget')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}