<?php
      $conn = mysqli_connect('localhost', 'root', '', 'jumga');
      if (!$conn) {
         die("ERROR ON CONNECTION");
      }
      if(!isset($_SESSION)) 
      { 
         session_start(); 
      } 
      ob_start();