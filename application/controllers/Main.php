<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
        $this->load->view('headers/main_header');
        $this->load->view('main');
        $this->load->view('footers/main_footer');
	}
    public function busqueda()
	{
        $this->load->view('headers/main_header');
        $this->load->view('busqueda');
        $this->load->view('footers/main_footer');
	}
    public function sign_up()
    {
        $this->load->view('headers/main_header');
        $this->load->view('sign_up');
        $this->load->view('footers/main_footer');
    }
    public function log_in()
    {
        $this->load->view('headers/main_header');
        $this->load->view('log_in');
        $this->load->view('footers/main_footer');
    }
    public function perfil()
    {
        $this->load->view('headers/main_header');
        $this->load->view('perfil');
        $this->load->view('footers/main_footer');
    }
    public function userInfo()
    {
        $this->load->view('headers/main_header');
        $this->load->view('userInfo');
        $this->load->view('footers/main_footer');
    }
    public function addMoney()
    {
        $this->load->view('headers/main_header');
        $this->load->view('addMoney');
        $this->load->view('footers/main_footer');
    }
    public function resultadosBusqueda()
    {
        $this->load->model('Buscar_model');
        //$this->load->database(); // Importante ¿?
        echo json_encode($this->Buscar_model->buscarCartas());
    }
}
