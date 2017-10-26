<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QueryInterface extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Authentikasi untuk login atau register
	 * @param  array $data   	data yang di initialize
	 * @param  string $method 	login atau register (const)
	 * @return array        	return array data 
	 */
	public function auth($data, $method)
	{
		switch( trimLower($method))
		{
			case 'login':
				$query = $this->db->get_where('user' , array(
						'username' => $data['username'],
						'password' => md5($data['password'])
					));

				$row = $query->num_rows();

				if ( $row > 0)
				{
					foreach($query->result() as $data)
					{
						$initActor = $data->id_actor;

						if ( $initActor != 0 )
						{
							$actor = $this->db->get_where('actor', array(
									'id' => $data->id_actor
								));
						}

						$result = array(
								'id' => $data->id,
								'unique_id' => $data->unique_id,
								'actor' => $initActor != 0 ? $actor->result()[0] : 0,
								'full_name' => $data->full_name,
								'username' => $data->username,
								'password' => $data->password,
								'email' => $data->email,
								'user_status' => array(
										'code' => $data->user_status,
										'detail' => $data->user_status != 0 ?
											'Aktif' : 'Tidak Aktif'
									),
								'created_at' => $data->created_at, 
								'added' => array(
										'at' => $data->added_at,
										'by' => $data->added_by
									),
								'modified' => array(
										'at' => $data->modified_at,
										'by' => $data->modified_by
									),
								'last_login' => $data->last_login
							);

						$dataUpdate = array(
								'last_login' => date('Y-m-d H:i:s')
							);

						$this->db->where('username' , $data->username);
						$this->db->update('user', $dataUpdate);
					}
				}

				return array(
						'return' => $row > 0 ? true : false,
						$row > 0 ? 'data' : 'error_message' => 
						$row > 0 ? $result : 'Username atau Password salah'
					);
			break;

			case 'register':
				$query = $this->db
					->from('user')
					->where('username' , $data['username'])
					->or_where('email' , $data['email'])
					->get();

				$row = $query->num_rows();

				$today = date('Y-m-d H:i:s');

				$data = array(
						'unique_id' => generate_key(),
						'id_actor' => 2,
						'full_name' => $data['full_name'],
						'username' => $data['username'],
						'password' => md5($data['password']),
						'email' => $data['email'],
						'created_at' => $today,
						'user_status' => 1,
						'added_by' => 0,
						'added_at' => $today,
						'modified_by' => 0,
						'modified_at' => $today,
						'last_login' => $today
					);

				$row == 0 ? $this->db->insert('user', $data) : null;

				return array(
						'return' => ! $row > 0 ? true : false,
						! $row > 0 ? 'message' : 'error_message' => 
						! $row > 0 ? 'Berhasil menambah user' : 'Username atau Email sudah digunakan'
					);
			break;
		}
	}

	public function postUrl($data , $method)
	{
		$today = date('Y-m-d H:i:s');

		switch( trimLower($method))
		{
			case 'insert':
				$newData = array(
						'user_id' => $data['submitted_by'],
						'created_at' => $today
					);
				$newTranskrip = $this->db->insert('transcript', $newData);

				if ( $newTranskrip)
				{
					$selectTranskrip = $this->db->get_where('transcript' , array(
							'created_at' => $newData['created_at']
						))->result()[0];
				}

				$dataInsert = array(
						'id_transcript' => $selectTranskrip->id,
						'unique_id' => generate_key(),
						'link' => $data['link'],
						'description' => $data['description'],
						'download_status' => 'URL_RECORDED',
						'submitted_by' => $data['submitted_by'],
						'submitted_at' => $today,
						'modified_by' => $data['modified_by'],
						'modified_at' => $today
					);

				$this->db->insert('url' , $dataInsert);
			break;

			case 'delete':
				$checkUrl = self::getUrlDetail($data['uid']);

				if ( $checkUrl['return'])
				{
					$data = $checkUrl['data'];

					$this->db->delete('transcript' , array(
							'id' => $data['transkrip']['id']
						));

					$this->db->delete('url' , array(
							'unique_id' => $data['unique_id']
						));
				}
			break;

			case 'update':
				$dataUpdate = array(
						'unique_id' => generate_key(),
						'link' => $data['url'],
						'description' => $data['description'],
						'modified_by' => $data['modified_by'],
						'modified_at' => date('Y-m-d H:i:s')
					);

				$this->db->where('unique_id', $data['uid']);
				$this->db->update('url' , $dataUpdate);
			break;
		}
	}

	public function getUrlDetail($unique)
	{
		$query = $this->db->get_where('url' , array(
				'unique_id' => $unique
			));

		$row = $query->num_rows();

		if ( $row > 0 )
		{
			foreach($query->result() as $x)
			{
				$getTranskrip = $this->db->get_where('transcript', array(
						'id' => $x->id_transcript
					))->result()[0];

				$data = array(
						'id' => $x->id,
						'transkrip' => array(
								'id' => $getTranskrip->id,
								'video' => $getTranskrip->file_video,
								'audio' => $getTranskrip->file_audio,
								'text' => $getTranskrip->file_text,
								'created_at' => $getTranskrip->created_at 
							),
						'unique_id' => $x->unique_id,
						'link' => $x->link,
						'description' => $x->description,
						'download_status' => $x->download_status
					);
			}
		}

		return array(
				'return' => $row > 0 ? true : false,
				$row > 0 ? 'data' : 'error_message' =>
				$row > 0 ? $data : 'Detail URL tidak ditemukan'
			);
	}

	public function getUrlBySubmitted($submitted)
	{
		$query = $this->db
			->from('url')
			->order_by('submitted_at DESC')
			->where('submitted_by' , $submitted)
			->get();

		$row = $query->num_rows();

		if ( $row > 0)
		{
			$data = null;

			foreach($query->result() as $x)
			{
				$getTranskrip = $this->db->get_where('transcript', array(
						'id' => $x->id_transcript
					))->result()[0];

				$data[] = array(
						'id' => $x->id,
						'transkrip' => array(
								'id' => $getTranskrip->id,
								'video' => $getTranskrip->file_video,
								'audio' => $getTranskrip->file_audio,
								'text' => $getTranskrip->file_text,
								'created_at' => $getTranskrip->created_at 
							),
						'unique_id' => $x->unique_id,
						'link' => $x->link,
						'description' => $x->description,
						'download_status' => $x->download_status
					);
			}
		}

		return array(
				'return' => $row > 0 ? true : false,
				$row > 0 ? 'data' : 'error_message' =>
				$row > 0 ? $data : 'URL masih kosong!'
			);
	}

	public function getUser()
	{
		$query = $this->db
			->from('user')
			->order_by('created_at DESC')
			->get();

		$row = $query->num_rows();

		if ( $row > 0 )
		{
			$datas = null;

			foreach($query->result() as $data)
			{
				if ( $data->id_actor != 0 )
				{
					$selectActor = $this->db
						->get_where('actor',array('id' => $data->id_actor))
						->result()[0];
				}

				$datas[] = array(
						'id' => $data->id,
						'uuid' => $data->unique_id,
						'actor' => $data->id_actor != 0 ? array(
								'id' => $selectActor->id,
								'uuid' => $selectActor->unique_id,
								'name' => $selectActor->name
							) : null,
						'full_name' => $data->full_name,
						'username' => $data->username,
						'email' => $data->email,
						'created_at' => $data->created_at,
						'user_status' => array(
								'code' => $data->user_status,
								'detail' => $data->user_status != 0 ?
								'Aktif' : 'Tidak Aktif'
							),
						'created_at' => $data->created_at, 
						'added' => array(
								'at' => $data->added_at,
								'by' => $data->added_by
							),
						'modified' => array(
								'at' => $data->modified_at,
								'by' => $data->modified_by
							),
						'last_login' => $data->last_login
					);
			}
		}

		return $row > 0 ? $datas : false;
	}

	public function getUserDetail($token)
	{
		$query = $this->db->get_where('user', array('unique_id' => $token));

		$row = $query->num_rows();

		return $row > 0 ? $query->result()[0] : false;
	}

	public function getActor()
	{
		$query = $this->db->get('actor');

		$row = $query->num_rows();

		return $row > 0 ? $query->result() : false;
	}

	public function getTranskrip($idUser)
	{
		$query = $this->db->get_where('transcript' , array('user_id' => $idUser));

		$row = $query->num_rows();

		return $row > 0 ? $query->result() : false;
	}

	public function getUrl($status = '')
	{
		$query = ( $status == '') ?
			$this->db->get('url') :
			$this->db->get_where('url', array('download_status' => $status));

		$row = $query->num_rows();

		return $row;
	}

	public function getUrlBySelf($id , $status = '')
	{
		$query = ( $status == '') ?
			$this->db->get_where('url', array('id' => $id)) :
			$this->db->get_where('url', array('id' => $id, 'download_status' => $status));

		$row = $query->num_rows();

		return $row;
	}

	public function getUrlByToday($id = '')
	{
		$query = ( $id == '') ?
			"SELECT * FROM url WHERE DATE(submitted_at) = CURDATE()" :
			"SELECT * FROM url WHERE DATE(submitted_at) = CURDATE() AND submitted_by = '".$id."'";

		$row = $this->db->query($query)->num_rows();

		return $row;
	}
}

/* End of file QueryInterface.php */
/* Location: ./application/models/QueryInterface.php */