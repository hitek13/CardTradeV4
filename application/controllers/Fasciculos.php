<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fasciculos
 *
 * @author miguel
 */
class Fasciculos extends CI_Controller {

    public function index()
    {
            $this->load->view('headers/main_header');
            $this->load->view('busqueda');
            $this->load->view('footers/main_footer');
    }
    public function addFasciculo()
    {
        $this->load->model('Buscar_model');
        
        $idCarta = $_POST['idCarta'];
        $idUsuario = $_POST['idUsuario'];
        $Precio = $_POST['Precio'];
        $Cantidad = $_POST['Cantidad'];
        $Estilo = $_POST['Estilo'];
        $Calidad = $_POST['Calidad'];
        
        echo json_encode( $this->Buscar_model->registrarFasciculo($idCarta, $idUsuario, $Precio, $Cantidad, $Estilo, $Calidad) );
    }
    public function showFasciculos(){
        $this->load->model('Buscar_model');
        $idCarta = $_POST['idCarta'];
        echo json_encode( $this->Buscar_model->getFasciculuos($idCarta) );
    }
    public function showFasciculosByUser(){
        $this->load->model('Buscar_model');
        $idUsuario = $_POST['idUsuario'];
        echo json_encode( $this->Buscar_model->getFasciculuosByUser($idUsuario) );
    }
}