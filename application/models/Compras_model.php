<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Compras_model
 *
 * @author miguel
 */
class Compras_model   extends CI_Model {
    //put your code here
    public function __construct()
        {
            parent::__construct();
            //$this->load->database(); // ¿? necesario
        }
    public function comprarFasciculo ($idFasciculo, $idComprador, $idVendedor, $precio, $cantidad, $gastos, $fecha) {
        
        $cantidadBD = 0;
        $consulta = $this->db->query("SELECT Cantidad FROM `fasciculos` WHERE idFasciculo = '".$idFasciculo."';");
        
        if($consulta->num_rows() == 1 ){
            foreach ($consulta->result_array() as $row)
                {
                 $cantidadBD = $row['Cantidad'];
                }
            //return "Cantidad ".$cantidadBD;
        }
        else
            return "Fasciculo ".$idFasciculo;
        
        //return "Muchachada ".$cantidadBD;
        
        if( intval($cantidad) <= $cantidadBD ){
            $query = $this->db->query("INSERT INTO transacciones
                                      (idVenta, idFasciculo, idVendedor, idComprador, gastoEnvio, FecVenta, Precio)
                                      VALUES ('".uniqid()."', '".$idFasciculo."', '".$idVendedor."', '".$idComprador."', '".$gastos."','".$fecha."', '".$precio."');");
           
            return 'Compra correcta';   
        }else{
            return 'No hay tantas cartas a la venta como pides';
        }
        //return 'Hola, modelo '.$cantidadDB;
            
    }
}
