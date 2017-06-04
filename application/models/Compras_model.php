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
    public function comprarFasciculo ($idFasciculo, $idComprador, $idVendedor, $cantidad, $gastos, $fecha) {
        
        
        $cantidadBD = 0;
        $precioDB = 0;
        $consultaCantidad = $this->db->query("SELECT Cantidad, Precio FROM `fasciculos` WHERE idFasciculo = '".$idFasciculo."';");
        $consultaSaldo = $this->db->query("SELECT Saldo FROM `usuarios` WHERE idUsuario = '".$idComprador."';");

        
        // Cantidad suficiente
        
        if($consultaCantidad->num_rows() == 1 ){
            foreach ($consultaCantidad->result_array() as $row)
                {
                 $cantidadBD = $row['Cantidad'];
                 $precioDB = $row['Precio'];
                }
            //return "Cantidad ".$cantidadBD." ".$precioDB;
        }
        else
            return false;
        
        $TOTAL = ($precioDB*intval($cantidad))+  floatval($gastos);
        // Dinero suficiente
        
        if($consultaSaldo->num_rows() == 1 ){
            foreach ($consultaSaldo->result_array() as $row)
                {
                 $saldoDB = $row['Saldo'];
                }
            //return "Saldo ".$saldoDB;
        }
        else
            return false;
        
        // efectuar compra
        if($TOTAL < $saldoDB){
            if( intval($cantidad) <= $cantidadBD ){
                $saldoFinal = floatval($saldoDB)-floatval($TOTAL);
                $query = $this->db->query("INSERT INTO transacciones
                                          (idVenta, idFasciculo, idVendedor, idComprador, gastoEnvio, Cantidad, FecVenta, Precio, PrecioTOTAL)
                                          VALUES ('".uniqid()."', '".$idFasciculo."', '".$idVendedor."', '".$idComprador."', '".$gastos."','".$cantidad."','".$fecha."','".$precioDB."','".$TOTAL."');");
                
                $updateSaldo = $this->db->query("UPDATE usuarios 
                                                SET Saldo = ".floatval($saldoFinal)."
                                                WHERE idUsuario = '".$idComprador."' ");
                $updateSaldoAdmin = $this->db->query("UPDATE usuarios 
                                                SET Saldo = Saldo + ".floatval($TOTAL)."
                                                WHERE idUsuario = '593418dc89481' ");
                if(intval($cantidad) == $cantidadBD){
                    $updateCantidad = $this->db->query("UPDATE fasciculos 
                                                SET Cantidad = Cantidad - ".intval($cantidad).", Vendido = 1
                                                WHERE idFasciculo = '".$idFasciculo."' ");
                }else{
                   $updateCantidad = $this->db->query("UPDATE fasciculos 
                                                SET Cantidad = Cantidad - ".intval($cantidad)."
                                                WHERE idFasciculo = '".$idFasciculo."' "); 
                }
                return 'Compra correcta';   
            }else{
                return 'No hay tantas cartas a la venta como pides';
            }
        }
        else
            return 'Saldo insuficiente';
        //return 'Hola, modelo '.$cantidadDB;
            
    }
    public function getComprasActivas ($idUsuario){
        $query = $this->db->query("SELECT t.idVenta, t.idVendedor, u.Nick, t.gastoEnvio, t.Cantidad, t.FecVenta, t.Enviado, t.Precio, t.PrecioTOTAL
                                   FROM `transacciones` AS t, usuarios AS u
                                   WHERE idComprador = '".$idUsuario."' AND t.idVendedor = u.idUsuario;");
        if($query->num_rows() > 0 ){
            foreach ($consultaCantidad->result_array() as $row)
                {
                 $cantidadBD = $row['Cantidad'];
                 $precioDB = $row['Precio'];
                }
        }
    }
}
