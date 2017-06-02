<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buscarModel
 *
 * @author miguel
 */

// SUPER IMPORTNATE, PRIMERO MAYUSCULA, EL RESTO EN MINÚSCULA
class Buscar_model  extends CI_Model {
    //put your code here
    public function __construct()
        {
            parent::__construct();
            //$this->load->database(); // ¿? necesario
        }
        
    public function buscarCartas($carta){

        $resultados = '';
        $query = $this->db->query("SELECT * FROM cartas WHERE Nombre LIKE '%".$carta."%'");

        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resultados .= $row['Nombre'].'|';
            }
            return $resultados;
        }else
            return false;

    }
}
