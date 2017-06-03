<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	public function index()
	{
                $this->load->view('headers/main_header');
                $this->load->view('busqueda');
                $this->load->view('footers/main_footer');
	}
    public function cartas()
    {
        $this->load->model('Buscar_model');
        $carta = $_POST['Carta'];
        if($this->Buscar_model->buscarCartas($carta))
            echo json_encode($this->Buscar_model->buscarCartas($carta));
        else
            echo false;
    }
}