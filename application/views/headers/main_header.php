<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        
        
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" 
            integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
         
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesHeader.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/css/stylesFoot.css">
	<title>FoW</title>
        
        <style>
            
        </style>

	
</head>
<body>
        <!-- ||||||||||||||||||||||||| Menu Bar BIG |||||||||||||||||||||||| -->
    <nav class="navbar navbar-inverse navbar-static-top hidden-xs" role="navigation">
        <div class="container-fluidc">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">FoW Card-Trade</a>
          </div>
          <ul class="nav navbar-nav">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lenguage
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/Espana.png" 
                               height="16px" />
                          Spanish</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/italy_flag_128.png"
                               height="16px"/>
                          Italian</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/united_kingdom_flags_flag_17079.png"
                               height="16px"/>
                          English</a></li>
                </ul>
              </li>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
    </nav>
    
    <!-- ||||||||||||||||||||||||| Menu Bar small |||||||||||||||||||||||| -->
    
    <nav class="navbar navbar-inverse navbar-static-top visible-xs" role="navigation">
        <div class="container-fluidc">
            <ul class="nav navbar-nav">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <h3 align="center">FoW Card-Trade<span class="caret"></span></h3></a>
                <ul class="dropdown-menu">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Page 1</a></li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
              </li>
            
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lenguage
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/Espana.png" 
                               height="16px" />
                          Spanish</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/italy_flag_128.png"
                               height="16px"/>
                          Italian</a></li>
                  <li><a href="#">
                          <img src="<?php echo base_url(); ?>application/resources/flag/united_kingdom_flags_flag_17079.png"
                               height="16px"/>
                          English</a></li>
                </ul>
              </li>
            
          </ul>
          
        </div>
    </nav>