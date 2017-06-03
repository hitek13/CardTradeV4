<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transacciones
 *
 * @author miguel
 */
class Transacciones  extends CI_Controller {

    public function index()
    {
            $this->load->view('headers/main_header');
            //$this->load->view('busqueda');
            $this->load->view('footers/main_footer');
    }
    public function comprar(){
       
        $this->load->model('Compras_model');

        $idFasciculo = $_POST['idFasciculo'];
        $idComprador = $_POST['idComprador'];
        $idVendedor = $_POST['idVendedor'];
        $precio = $_POST['Precio'];
        $cantidad = $_POST['Cantidad'];
        $gastos= $_POST['GE'];
        $fecha = $_POST['fecha'];
        
        echo json_encode( $this->Compras_model->comprarFasciculo($idFasciculo, $idComprador, $idVendedor, $precio, $cantidad, $gastos, $fecha) );
    }
}
