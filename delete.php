<?php
//Connection server
include_once "app/db.php";
include_once "app/functions.php";

  if( isset($_GET['id'])){
    $id = $_GET['id'];
  }

  $sql = "DELETE FROM students WHERE id='$id' ";
  $connection -> query($sql);

 header("location:index.php");
