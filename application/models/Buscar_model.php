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
        }
        
    public function buscarCartas(){

        $this -> db -> select('Card');
        $this -> db -> from('Cards');
        $query = $this -> db ->get(); 

        return $query -> result_array();
    }
    public function introducirCarta(){
        $query = $this->db->query('INSERT INTO Cards (Card, Edition) VALUES ("Chapolina Colorada", "5678")');
        return $query->result_array();
    }
}
