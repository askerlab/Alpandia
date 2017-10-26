<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('QueryInterface');
		$this->AwesomeApp = 'Alpandia';
		$this->__content = self::isAuth() ? 
			$this->session->userdata('__content') : false;
		$this->__userdata = $this->QueryInterface->getUserDetail($this->__content['unique_id']);
		$this->avatar = array(
				'admin' => base_url().'images/avatar/admin.png',
				'operator' => base_url().'images/avatar/engineer.png'
			);
	}

	/**
	 * Halaman awal ketika website dibuka
	 */
	public function index()
	{
		if ( ! self::isAuth()) redirect('auth');

			
		$isAdmin = ( strtolower($this->__content['actor']->name) == 'admin') ? true : false;

		$totalUrl = $isAdmin ?
			$this->QueryInterface->getUrl() :
			$this->QueryInterface->getUrlBySelf($this->__content['id']);
		
		$submitToday = $isAdmin ?
			$this->QueryInterface->getUrlByToday() :
			$this->QueryInterface->getUrlByToday($this->__content['id']);

		$urlRecorded = $isAdmin ?
			$this->QueryInterface->getUrl('URL_RECORDED') :
			$this->QueryInterface->getUrlBySelf($this->__content['id'], 'URL_RECORDED');

		$urlProgress = $isAdmin ?
			$this->QueryInterface->getUrl('DOWNLOAD_IN_PROGRESS') :
			$this->QueryInterface->getUrlBySelf($this->__content['id'], 'DOWNLOAD_IN_PROGRESS');

		$urlSuccess = $isAdmin ?
			$this->QueryInterface->getUrl('DOWNLOAD_COMPLETED') :
			$this->QueryInterface->getUrlBySelf($this->__content['id'], 'DOWNLOAD_COMPLETED');

		$urlFailed = $isAdmin ?
			$this->QueryInterface->getUrl('DOWNLOAD_FAILED') :
			$this->QueryInterface->getUrlBySelf($this->__content['id'], 'DOWNLOAD_FAILED');

		$data['base_url'] = base_url();
		$data['showdata'] = array(
				'TotalUser' => count($this->QueryInterface->getUser()),
				'TotalURL' => $totalUrl,
				'URLSubmitToday' => $submitToday,
				'URLRecorded' => $urlRecorded,
				'URLProgress' => $urlProgress,
				'URLSuccess' => $urlSuccess,
				'URLFailed' => $urlFailed,
			);

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer', $data);
	}

	public function indexSegment($action)
	{
		$getdata = $this->input->get();
		$postdata = $this->input->post();

		switch ( trimLower($action)) {
			/**
			 * Authentikasi untuk melakukan login atau register.
			 */
			case 'auth':
				if ( isset($getdata['method']))
				{
					if ( ! $postdata)
					{
						redirect();
					}
					else
					{
						switch ( trimLower($getdata['method'])) 
						{
							case 'login':	
								$data = array(
										'username' => $postdata['username'],
										'password' => $postdata['password']
									);

								$response = $this->QueryInterface->auth($data, 'login');

								if ( ! $response['return'])
								{
									$this->session->set_flashdata('sessionMessage', "Username atau Password salah!");
									redirect('auth');
								}

								$sessionData = array(
										'auth' => TRUE,
										'__content' => $response['data']
									);

								$this->session->set_userdata($sessionData);

								redirect();
							break;
							
							case 'register':
								$data = array(
										'full_name' => $postdata['fullName'],
										'username' => $postdata['username'],
										'email' => $postdata['email'],
										'password' => $postdata['password']
									);

								$response = $this->QueryInterface->auth($data, 'register');

								$responseMessage = $response['return'] ? 
									"Selamat, anda berhasil mendaftarkan diri. Silahkan login" :
									"Username atau Email sudah digunakan.";

								$this->session->set_flashdata('sessionMessage' , $responseMessage);

								redirect('auth');
							break;

							default:
								// ERROR
								show_404();
							break;
						}
					}
				}
				else
				{
					$this->load->view('auth/authentication');
				}
			break;

			case 'do_action':
				if ( ! self::isAuth()) redirect('auth');
				if ( ! isset($getdata['method'])) redirect();

				switch ( trimLower($getdata['method'])) 
				{
					case 'url_submit':
						if ( ! $postdata) redirect();

						$data = array(
								'link' => $postdata['url'],
								'description' => $postdata['description'],
								'submitted_by' => $this->__content['id'],
								'modified_by' => $this->__content['id']
							);

						if ( ! validUrl($postdata['url']))
						{
							$this->session->set_flashdata('sessionMessage', 'URL yang dimasukkan tidak valid.');
							redirect('url/submit');
						}

						$this->QueryInterface->postUrl($data, 'insert');
						redirect('url/manage');
						break;

					case 'url_delete':
						if ( ! $getdata['uid']) redirect();

						$data = array(
								'uid' => $getdata['uid']
							);

						$this->QueryInterface->postUrl($data, 'delete');

						redirect('url/manage');
					break;
					
					case 'url_edit':
						if ( ! $postdata) redirect();

						if ( ! validUrl($postdata['url']))
						{
							$this->session->set_flashdata('sessionMessage', 'URL yang dimasukkan tidak valid.');
							redirect('url/edit?uid='.$postdata['__uuid']);
						}

						$data = array(
								'url' => $postdata['url'],
								'uid' => $postdata['__uuid'],
								'description' => $postdata['description'],
								'modified_by' => $this->__content['id']
							);

						$this->QueryInterface->postUrl($data, 'update');

						redirect('url/manage');
					break;

					case 'update_profile':
						if ( ! $postdata) redirect();

						$email = base64_decode($postdata['__e']);

						$dataUpdate = array(
								'full_name' => $postdata['fullName']
							);

						$this->db->set($dataUpdate);
						$this->db->where( array('email' => $email));
						$this->db->update('user');

						$message = ( $this->__userdata->full_name == $postdata['fullName']) ?
							'Tidak ada perubahan data' : 'Berhasil mengubah data';

						$this->session->set_flashdata('sessionMessage', $message);
						
						redirect('edit-profile');
					break;

					case 'update_password':
						if ( ! $postdata) redirect();

						$messages = array(
								1 => 'Password lama salah!',
								2 => 'Password baru dan password konfirmasi tidak sama!',
								3 => 'Berhasil mengubah password'
							);

						$adminpwd = $this->__content['password'];

						$message = ( $adminpwd != md5($postdata['oldpwd'])) ?
							$messages[1] : ( $postdata['firstNew'] != $postdata['secondNew']? 
								$messages[2] : $messages[3] );

						$dataUpdate = array(
								'password' => md5($postdata['firstNew'])
							);

						$message == $messages[3] ? 
							$this->db->update('user', $dataUpdate , array('unique_id' => $this->__content['unique_id'])) 
							: null;

						$this->session->set_flashdata('sessionMessage', $message);

						redirect('ubah-password');
					break;

					case 'user_add':
						if ( ! self::isAuth()) redirect('auth');
						if ( ! $postdata) redirect('user/add');

						$selectUser = $this->db
							->from('user')
							->where('username' , $postdata['username'])
							->or_where('email' , $postdata['email'])
							->get();

						$row = $selectUser->num_rows();

						if ( $row > 0) 
						{
							$this->session->set_flashdata('sessionMessage', 'Username atau Email sudah digunakan. Silahkan coba lagi');
							redirect('user/add');
						}
						else
						{
							$x = explode('/' , $postdata['tipe']);
							$today = date('Y-m-d H:i:s');

							$dataInsert = array(
									'unique_id' => generate_key(),
 									'full_name' => $postdata['fullName'],
									'email' => $postdata['email'],
									'id_actor' => $x[1],
									'username' => $postdata['username'],
									'password' => md5($postdata['password']),
									'created_at' => $today,
									'user_status' => 1,
									'added_by' => $this->__content['id'],
									'added_at' => $today,
									'modified_by' => 0,
									'modified_at' => $today,
									'last_login' => $today
								);

							$this->db->insert('user', $dataInsert);

							$this->session->set_flashdata('sessionMessage', 'Berhasil menambah user');
							redirect('user/manage');
						}
					break;

					default:
						$this->load->view('errors/custom_404');
					break;
				}
			break;

			case 'edit-profile':
				if ( ! self::isAuth()) redirect('auth');

				$data['userdata'] = $this->__content;
				$data['base_url'] = base_url();
				$this->load->view('templates/header', $data);
				$this->load->view('self_profile', $data);
				$this->load->view('templates/footer', $data);
			break;

			case 'ubah-password':
				if ( ! self::isAuth()) redirect('auth');

				$data['base_url'] = base_url();
				$this->load->view('templates/header', $data);
				$this->load->view('self_pwd', $data);
				$this->load->view('templates/footer', $data);
			break;

			case 'logout':
				session_destroy();
				redirect();
			break;

			/**
			 * Apakah route sesuai yang diharapkan? 
			 * Jika tidak maka akan menampilkan error
			 */
			default:
				$this->load->view('errors/custom_404');
			break;
		}
	}

	public function userSegment($action)
	{
		if ( ! self::isAuth()) redirect('auth');

		switch( trimLower($action))
		{
			case 'manage':
				$data['base_url'] = base_url();
				$data['users'] = $this->QueryInterface->getUser();
				$this->load->view('templates/header', $data);
				$this->load->view('user/manage', $data);
				$this->load->view('templates/footer', $data);
			break;

			case 'add':
				$data['base_url'] = base_url();
				$data['tipeUser'] = $this->QueryInterface->getActor();
				$this->load->view('templates/header', $data);
				$this->load->view('user/add', $data);
				$this->load->view('templates/footer', $data);
			break;

			default:
				$this->load->view('errors/custom_404');
			break;
		}
	}

	public function urlSegment($action)
	{
		if ( ! self::isAuth()) redirect('auth');
		
		$getdata = $this->input->get();
		$postdata = $this->input->post();

		switch ( trimLower($action)) 
		{
			case 'manage':
				$data['base_url'] = base_url();
				$data['dataUrl'] = $this->QueryInterface->getUrlBySubmitted(
						$this->__content['id']
					);
				$this->load->view('templates/header', $data);
				$this->load->view('url_manage', $data);
				$this->load->view('templates/footer', $data);
			break;

			case 'submit':
				$data['base_url'] = base_url();
				$this->load->view('templates/header', $data);
				$this->load->view('url_submit', $data);
				$this->load->view('templates/footer', $data);
			break;

			case 'edit':
				if ( ! $getdata['uid']) redirect();

				$data['base_url'] = base_url();
				$data['detail'] = $this->QueryInterface->getUrlDetail($getdata['uid']);
				$this->load->view('templates/header', $data);
				$this->load->view('url_edit', $data);
				$this->load->view('templates/footer', $data);
			break;

			case 'transkrip':
				$template = isset($getdata['uid']) ? 'url_transkrip' : 'url/transkrip';

				$data['base_url'] 	= base_url();
				$data['detail'] 	= $this->QueryInterface->getUrlDetail(@$getdata['uid']);
				$data['transkrip']	= $this->QueryInterface->getTranskrip($this->__content['id']);

				$this->load->view('templates/header', $data);
				$this->load->view($template, $data);
				$this->load->view('templates/footer', $data);
			break;

			default:
				$this->load->view('errors/custom_404');
			break;
		}
	}

	/**
	 * Apakah session *auth* sudah terdaftar?
	 * @return boolean [description]
	 */
	private function isAuth()
	{
		return $this->session->userdata('auth') ? true : false;
	}
}
