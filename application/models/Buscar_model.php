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
        $query = $this->db->query("SELECT Nombre, idCarta, Imagen FROM cartas WHERE Nombre LIKE '%".$carta."%'");

        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resultados .= $row['Nombre'].';'.$row['idCarta'].';'.$row['Imagen'].'|';
            }
            return $resultados;
        }else
            return false;

    }
    public function buscarAvanzada($edicion, $costeMc,$relCMC, $atk, $relAtk, $def, $relDef){
        $sqledicion = ''; $sqlcmc = ''; $sqlatk = ''; $sqldef = '';
       /*
        if($edicion){$sqledicion = 'AND Edicion = "'.$edicion.'"';}
        if($costeMc){$sqlcmc = 'AND CMC '.$relCMC.' '.$costeMc;}
        if($atk){$sqlatk = 'AND CMC '.$relAtk.' '.$atk;}
        if($def){$sqldef = 'AND CMC '.$relDef.' '.$def;}
        */
        //return 'Hola';
        $resultados = '';
        $query = $this->db->query("SELECT Nombre, idCarta, Imagen FROM cartas WHERE 1  ".$sqledicion." ".$sqlcmc." ".$sqlatk." ".$sqldef." ;");

        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resultados .= $row['Nombre'].';'.$row['idCarta'].';'.$row['Imagen'].'|';
            }
            return $resultados;
        }else
            return false;

    }
    public function getImage($carta){

        $resultados = '';
        $query = $this->db->query("SELECT Imagen FROM cartas WHERE idCarta = '".$carta."';");

        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resultados .= $row['Imagen'];
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
    public function getFasciculuosByUser ($idUsuario){
        $resultados = '';
        $query = $this->db->query("SELECT f.idFasciculo, c.Nombre, f.Precio, f.Estilo, f.Calidad, f.Cantidad, u.idUsuario
                                        FROM `fasciculos` AS f, usuarios as u, cartas AS c
                                        WHERE f.idUsuario = '".$idUsuario."' AND f.Vendido = '0' AND f.idUsuario = u.idUsuario AND c.idCarta = f.idCarta");
        if( $query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {                   //      0                   1                   2               3                       4               5                           6                      
                $resultados .= $row['Nombre'].';'.$row['Estilo'].';'.$row['Calidad'].';'.$row['Cantidad'].';'.$row['Precio'].';'.$row['idFasciculo'].';'.$row['idUsuario'].'|';
            }
            return $resultados;
        }else
            return false;
    }
    public function deleteFasciculo ($idFasciculo, $idUsuario){
        $query = $this->db->query("DELETE
                                    FROM `fasciculos` 
                                    WHERE idFasciculo = '".$idFasciculo."' AND idUsuario = '".$idUsuario."'
                                    ");
        return $query;
    }
}
