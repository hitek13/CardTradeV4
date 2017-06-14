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
        $cantidad = $_POST['Cantidad'];
        $gastos= $_POST['GE'];
        $fecha = $_POST['fecha'];
        
        echo json_encode( $this->Compras_model->comprarFasciculo($idFasciculo, $idComprador, $idVendedor, $cantidad, $gastos, $fecha) );
    }
    public function comprasActivas(){
        $this->load->model('Compras_model');
        
        $idUsuario = $_POST['idUsuario'];
        
        echo json_encode($this->Compras_model->getComprasActivas($idUsuario));
        //echo json_encode('hola, controller');
    }
    public function comprasFin (){
        $this->load->model('Compras_model');
        
        $idUsuario = $_POST['idUsuario'];
        
        echo json_encode($this->Compras_model->getComprasFin($idUsuario));
    }
    public function ventasActivas (){
        $this->load->model('Compras_model');      
        $idUsuario = $_POST['idUsuario'];
        echo json_encode($this->Compras_model->getVentasActivas($idUsuario));
    }
    public function ventasFin (){
        $this->load->model('Compras_model');      
        $idUsuario = $_POST['idUsuario'];
        echo json_encode($this->Compras_model->getVentasFin($idUsuario));
    }
    public function recibido (){
        $this->load->model('Compras_model');
        
        $idVenta = $_POST['idVenta'];
        $idUsuario = $_POST['idUser'];
        $valoracion = $_POST['nota'];
        
        echo json_encode($this->Compras_model->setRecibido($idVenta, $idUsuario, $valoracion));
    }
    public function enviado (){
        $this->load->model('Compras_model');
        
        $idVenta = $_POST['idVenta'];
        
        echo json_encode($this->Compras_model->setEnviado($idVenta));
    }
}
