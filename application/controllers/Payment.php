	<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Payment extends CI_Controller
	{

		/**
		 * Index Page for this controller.
		 *
		 * Maps to the following URL
		 * 		http://example.com/index.php/welcome
		 *	- or -
		 * 		http://example.com/index.php/welcome/index
		 *	- or -
		 * Since this controller is set as the default controller in
		 * config/routes.php, it's displayed at http://example.com/
		 *
		 * So any other public methods not prefixed with an underscore will
		 * map to /index.php/welcome/<method_name>
		 * @see https://codeigniter.com/userguide3/general/urls.html
		 */
		public function index()
		{
			$this->load->model('user_model');
			$this->load->model('currency_model');
			$this->load->model('paymentcategory_model');
			$users = $this->user_model->getAll();
			$currencies =  $this->currency_model->getAll();
			$payment_categories =  $this->paymentcategory_model->getAll();
			$data = array(
				"users" => $users,
				"payment_categories" => $payment_categories,
				"currencies" => $currencies
			);
			return $this->output
				->set_content_type('application/json')
				// ->set_status_header(500)
				->set_output(json_encode($data));
		}

		public function add()
		{
			$this->load->model('payment_model');
			$this->load->library("dal/entities/payment_entity");
			// // $this->entity->ad = "filankes";	
			$this->payment_entity->amount = $this->input->input_stream('amount');
			$this->payment_entity->payment_type = $this->input->input_stream('payment_type');
			$this->payment_entity->user_id = $this->input->input_stream('user');
			$this->payment_entity->currency_id = $this->input->input_stream('currency');
			$this->payment_model->add($this->payment_entity);
			// exit();
			// print_r($this->payment_entity);	
			return $this->output
				->set_content_type('application/json')
				// ->set_status_header(500)
				->set_output(json_encode($this->payment_entity));
		}
		public function getAll()
		{
			$this->load->model('payment_model');
			$result = null;
			$data = json_decode(file_get_contents("php://input"), true);

			// // foreach($filter as $f) {
			// // 	echo $f;
			// // }
			$filter = array(
				"userId" => $data["user"],
				"currencyId" => $data["currency"],
				"dateFrom" => $data["datefrom"],
				"dateTo" => $data["dateto"],
			);

			if ((preg_match("/^[0-9]*$/", $filter["userId"]) ? true : false) && (preg_match("/^[0-9]*$/", $filter["currencyId"]) ? true : false) && !empty($filter["dateFrom"] && !empty($filter["dateTo"]) || "")) {
				$result =  $this->payment_model->getPaymentsDoToAllFilter($filter);

			}
			// // FILTER BY USERID AND CURRENCYID
			else if ((preg_match("/^[0-9]*$/", $filter["userId"]) ? true : false) && (preg_match("/^[0-9]*$/", $filter["currencyId"]) ? true : false)) {
				$result =$this->payment_model->getPaymentsByCurrencyAndUser($filter["userId"],$filter["currencyId"]);
			}

			// // FILTER BY USERID
			else if ((preg_match("/^[0-9]*$/", $filter["userId"]) ? true : false)) {
				// echo "AS";
				$result =$this->payment_model->getPaymentsByUser($filter["userId"]);
				// array_push($result,"else");
				// $result = array("dududu");

			
			}

	


			// // FILTER BY CURRENCY ID and date

			else if ((preg_match("/^[0-9]*$/", $filter["currencyId"]) ? true : false) && !empty($filter["dateFrom"] && !empty("dateTo"))) {
				$result = $this->payment_model->getPaymentsByCurrencyAndDate($filter);
			}
					// // FILTER BY CURRENCY ID
			else if ((preg_match("/^[0-9]*$/", $filter["currencyId"]) ? true : false)) {
				$result =$this->payment_model->getPaymentsByCurrency($filter["currencyId"]);

			} 
			else if (!empty($filter["dateFrom"] && !empty($filter["dateTo"]))) {

				$result = $this->payment_model->getPaymentsByDate($filter["dateFrom"], $filter["dateTo"]);

			} else {
				
				$result = $this->payment_model->getAll();
			}
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($result));
		}
		public function getPaymentStatics()
		{
			$this->load->model('payment_model');

			// exit();
			// print_r($this->payment_entity);	
			return $this->output
				->set_content_type('application/json')
				// ->set_status_header(500)
				->set_output(json_encode($this->payment_model->getPaymentStatics()));
		}
	}
