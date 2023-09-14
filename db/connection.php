<?php
  $conn = new MySQLi("localhost","root","local13@","maritacas",3306);
  if($conn->connect_errno){
    print "<script>alert('Erro ao conectar no banco de dados MySQL!')</script>";
  }
  else{
    print "<script>alert('Conectado no banco de dados MySQL!')</script>";
  }
