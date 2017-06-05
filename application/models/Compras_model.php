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
        $cadena = '';              ///          0       1               2       3           4               5       6           7               8               
        $query = $this->db->query("SELECT t.idVenta, t.idVendedor, u.Nick, t.gastoEnvio, t.Cantidad, t.FecVenta, t.Enviado, t.Precio, t.PrecioTOTAL
                                   FROM `transacciones` AS t, usuarios AS u
                                   WHERE idComprador = '".$idUsuario."' AND t.idVendedor = u.idUsuario AND t.Recibido = 0;");
        if($query->num_rows() > 0 ){
            foreach ($query->result_array() as $row)
                {
                 $cadena .= $row['idVenta'].';'.$row['idVendedor'].';'.$row['Nick'].';'.$row['gastoEnvio'].';'.$row['Cantidad'].';'.$row['FecVenta'].';'.$row['Enviado'].';'.$row['Precio'].';'.$row['PrecioTOTAL'].'|';
                }
            return $cadena;
        }else{
            return 'No hay compras activas';
        }
    }
    public function getComprasFin ($idUsuario){
        $cadena = '';              ///          0       1               2       3           4               5       6           7               8               
        $query = $this->db->query("SELECT t.idVenta, t.idVendedor, u.Nick, t.gastoEnvio, t.Cantidad, t.FecVenta, t.Enviado, t.Precio, t.PrecioTOTAL, t.Recibido
                                   FROM `transacciones` AS t, usuarios AS u
                                   WHERE idComprador = '".$idUsuario."' AND t.idVendedor = u.idUsuario AND t.Recibido = 1;");
        if($query->num_rows() > 0 ){
            foreach ($query->result_array() as $row)
                {
                 $cadena .= $row['idVenta'].';'.$row['idVendedor'].';'.$row['Nick'].';'.$row['gastoEnvio'].';'.$row['Cantidad'].';'.$row['FecVenta'].';'.$row['Enviado'].';'.$row['Precio'].';'.$row['PrecioTOTAL'].';'.$row['Recibido'].'|';
                }
            return $cadena;
        }else{
            return 'No hay compras activas';
        }
    }
    public function getVentasActivas ($idUsuario){
        $cadena = '';              ///          0       1               2       3           4               5       6           7               8               
        $query = $this->db->query("SELECT t.idVenta, t.idComprador, u.Nick, t.gastoEnvio, t.Cantidad, t.FecVenta, t.Enviado, t.Precio, t.PrecioTOTAL, u.Nombre AS nomUser, u.Apellidos, u.Direccion, u.Ciudad, u.Pais, c.Nombre AS nomCarta, f.Estilo
                                   FROM `transacciones` AS t, usuarios AS u, cartas AS c, fasciculos AS f
                                   WHERE idVendedor = '".$idUsuario."' AND t.idComprador = u.idUsuario AND f.idFasciculo = t.idFasciculo AND c.idCarta = f.idCarta AND t.Recibido = 0;");
        if($query->num_rows() > 0 ){
            foreach ($query->result_array() as $row)
            {
                $direccion = $row['nomUser'].' '.$row['Apellidos'].'<br>'.$row['Direccion'].'<br>'.$row['Ciudad'].'<br>'.$row['Pais'];
                $pedido = $row['nomCarta'].'<br>'.$row['Estilo'].' x'.$row['Cantidad'].'<br>'.$row['gastoEnvio'];
                $cadena .= $row['idVenta'].';'.$row['idComprador'].';'.$row['Nick'].';'.' '.';'.$direccion.';'.$row['FecVenta'].';'.$row['Enviado'].';'.$pedido.';'.$row['PrecioTOTAL'].'|';
            }
            return $cadena;
        }else{
            return 'No hay compras activas';
        }
    }
    public function getVentasFin ($idUsuario){
        $cadena = '';              ///          0       1               2       3           4               5       6           7               8               
        $query = $this->db->query("SELECT t.idVenta, t.idComprador, u.Nick, t.gastoEnvio, t.Cantidad, t.FecVenta, t.Enviado, t.Precio, t.PrecioTOTAL, u.Nombre AS nomUser, u.Apellidos, u.Direccion, u.Ciudad, u.Pais, c.Nombre AS nomCarta, f.Estilo
                                   FROM `transacciones` AS t, usuarios AS u, cartas AS c, fasciculos AS f
                                   WHERE idVendedor = '".$idUsuario."' AND t.idComprador = u.idUsuario AND f.idFasciculo = t.idFasciculo AND c.idCarta = f.idCarta AND t.Recibido = 1;");
        if($query->num_rows() > 0 ){
            foreach ($query->result_array() as $row)
            {
                $direccion = $row['nomUser'].' '.$row['Apellidos'].'<br>'.$row['Direccion'].'<br>'.$row['Ciudad'].'<br>'.$row['Pais'];
                $pedido = $row['nomCarta'].'<br>'.$row['Estilo'].' x'.$row['Cantidad'].'<br>'.$row['gastoEnvio'];
                $cadena .= $row['idVenta'].';'.$row['idComprador'].';'.$row['Nick'].';'.' '.';'.$direccion.';'.$row['FecVenta'].';'.$row['Enviado'].';'.$pedido.';'.$row['PrecioTOTAL'].'|';
            }
            return $cadena;
        }else{
            return 'No hay compras finalizadas';
        }
    }
    public function setRecibido ($idVenta){
        $total = 0;
        
        $queryTOTAL = $this->db->query("SELECT PrecioTOTAL, idVendedor
                                    FROM transacciones   
                                    WHERE idVenta = '".$idVenta."'; ");
        if($queryTOTAL->num_rows() > 0 ){
            foreach ($queryTOTAL->result_array() as $row)
                {
                $total = $row['PrecioTOTAL'];
                $idVendedor = $row['idVendedor'];
                }
            $updateSaldoAdmin = $this->db->query("UPDATE usuarios 
                                                SET Saldo = Saldo - ".(floatval($total)*0.95)."
                                                WHERE idUsuario = '593418dc89481' ");
            $updateSaldo = $this->db->query("UPDATE usuarios 
                                                SET Saldo = Saldo + ".(floatval($total)*0.95)."
                                                WHERE idUsuario = '".$idVendedor."' ");
            $query = $this->db->query("UPDATE transacciones 
                                    SET Recibido = 1
                                    WHERE idVenta = '".$idVenta."'; ");
            return 'Se ha marcado la compra como recibida.';
        }else{
            return 'No se ha encontrado el usuario';
            }
        
    }
    public function setEnviado ($idVenta){
        $query = $this->db->query("UPDATE transacciones 
                                    SET Enviado = 1
                                    WHERE idVenta = '".$idVenta."'; "); 
        return 'Se ha marcado la compra como enviada, cuando el comprador marque como recibido, se te ingresara el dinero.';
    }
}
