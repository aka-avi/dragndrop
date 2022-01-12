<?php  

class Drag extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('drag_model');
	}

	public function index()
	{
		$where = "status = 1";
		$data['trucks'] = $this->drag_model->get_data('trucks', '*', $where);
		$data['approve_orders'] = $this->drag_model->get_data('orders', '*', $where);

		$this->load->view('drag/index.php', $data);

	}	

	public function save_change()
	{
		print_r($_POST);
		$sale_order_id = $_POST['sale_order_id'];
		if($_POST['container_id'] == '0'){
			//order is moved to approved
		}
		else{
			//order is moved to a truck
		}
		die;
	}
}

?>