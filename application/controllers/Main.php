<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
                $this->load->view('headers/main_header');
		$this->load->view('main');
                $this->load->view('footers/main_footer');
	}
}
