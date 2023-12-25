<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserAdmin_model extends CI_Model
{
	public function login($username, $password)
	{
		$this->db->select('*')
			->from('user_admin')
			->where(array(
				'username_user' => $username,
				'password_user' => $password
			));
		return $this->db->get()->row();
	}

	public function select()
	{
		$this->db->select('*')->from('user_admin');
		return $this->db->get()->result();
	}
	public function insert($data)
	{
		$this->db->insert('user_admin', $data);
	}
	public function update($id, $data)
	{
		$this->db->where('id_user', $id)->update('user_admin', $data);
	}
	public function delete($id)
	{
		$this->db->where('id_user', $id)->delete('user_admin');
	}

}

/* End of file UserAdmin_model.php */
