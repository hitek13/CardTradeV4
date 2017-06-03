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
        $query = $this->db->query("SELECT Nombre, idCarta FROM cartas WHERE Nombre LIKE '%".$carta."%'");

        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resultados .= $row['Nombre'].';'.$row['idCarta'].'|';
            }
            return $resultados;
        }else
            return false;

    }
    public function registrarFasciculo ($idCarta, $idUsuario, $Precio, $Cantidad, $Estilo, $Calidad){
        $consulta = $this->db->query("SELECT idFasciculo "
                                    . "FROM `fasciculos` "
                                    . "WHERE idCarta = '".$idCarta."' AND idUsuario = '".$idUsuario."' AND Vendido = '0'");
        if($consulta->num_rows() == 0){
            $query = $this->db->query("INSERT INTO fasciculos
                                      (idFasciculo, idCarta, idUsuario, Precio, Estilo, Calidad, Cantidad)
                                      VALUES ('".uniqid()."', '".$idCarta."', '".$idUsuario."', '".$Precio."', '".$Estilo."',
                                       '".$Calidad."', '".$Cantidad."');");
            return 'Inserción correcta';   
        }else{
            return false;
        }
    }
    public function getFasciculuos ($idCarta){
        $resultados = '';
        $query = $this->db->query("SELECT f.idFasciculo, u.Nick, f.Precio, f.Estilo, f.Calidad, f.Cantidad, u.idUsuario
                                        FROM `fasciculos` AS f, usuarios as u
                                        WHERE f.idCarta = '".$idCarta."' AND f.Vendido = '0' AND f.idUsuario = u.idUsuario");
        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resultados .= $row['Nick'].';'.$row['Estilo'].';'.$row['Calidad'].';'.$row['Cantidad'].';'.$row['Precio'].';'.$row['idFasciculo'].';'.$row['idUsuario'].'|';
            }
            return $resultados;
        }else
            return false;
    }
}
