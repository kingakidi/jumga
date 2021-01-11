<?php include "../control/conn.php"; 
     if (!isset($_SESSION['juId'])) {
        header("Location: ../login.php");
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUMGA</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jumga</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

 
    <link href="css/sydee.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="./vendor/textEditor/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->
</head>