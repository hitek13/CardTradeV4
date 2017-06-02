<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author miguel
 */
class Users extends CI_Controller {
    public function insertInto()
    {
        $this->load->model('Signup_model');
        //$this->load->database(); // Importante ¿?
        $Nick = $_POST['Nick'];
        $email = $_POST['Email'];
        $Nombre = $_POST['Nombre'];
        $Pass = $_POST['Pass'];
        $Apell = $_POST['Apellido'];
        $Direc = $_POST['Direccion'];
        $Pais = $_POST['Pais'];
        $Ciudad = $_POST['Ciudad'];
        $DNI = $_POST['DNI'];
        $fecha = $_POST['fecha'];

        echo json_encode($this->Signup_model->InsertInto( $Nick, $email, $Nombre, $Pass, $Apell, $Direc, $Pais, $Ciudad, $DNI, $fecha));
    }
    public function logIn(){
        $this->load->model('Signup_model');
        $Nick = $_POST['Nick'];
        $Pass = $_POST['Pass'];
        echo json_encode($this->Signup_model->LogIn($Nick, $Pass));
    }
    public function getUserInfo(){
        $this->load->model('Signup_model');
        $Nick = $_POST['Nick'];
        $idUser = $_POST['idUser'];
        echo json_encode($this->Signup_model->userInfo($Nick, $idUser));
    }
    public function getMsg(){
        $this->load->model('Signup_model');
        $idUser = $_POST['idUser'];
        echo json_encode($this->Signup_model->userMsg($idUser));
    }
}
