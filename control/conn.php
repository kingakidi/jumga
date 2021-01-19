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

      // TESTING KEYS 
         $tPublic = 'FLWPUBK_TEST-dcf6418b844bc45ae0a7fc1382d927ff-X';
         $tSecret =  'FLWSECK_TEST-742b86bc586fb380baea0253ade116b8-X';

      //LIVE 
         $lPublic = 'FLWPUBK-c5daa1ce8d14815004cfcfc6f1574385-X';
         $lSecret = 'FLWSECK-e5f055aa50071dc0c376a4703d7f7b97-X';

      // ROOT URL 
      $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );