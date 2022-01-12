<?php  

	class drag_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function get_data($table, $select, $where)
		{
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($where);
			$result = $this->db->get();
			return	$result->result_array();
		}
	}

?>