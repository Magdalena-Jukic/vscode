<?php
  include "connection.php";


      if(isset($_POST['updateData'])){
        if(isset($_POST["id_zupanije"]) && isset($_POST["naziv_zupanije"])){
          $id = $_POST["id_zupanije"];
          $name = $_POST["naziv_zupanije"];

          $sql = "UPDATE zupanije SET naziv ='$name' WHERE id=$id;";
          $query_run = mysqli_query($mysqli_conn, $sql);

          if($query_run){
            echo "<script> alert('DATA')</script>";
            header('Location:index.php' );
            exit;
          }else{
            echo "<script> alert('ERROR')</script>";
          } 
        }
        else{
          echo "nono";
        }
     }

     if(isset($_POST['updateData_brStan'])){
      if(isset($_POST["id_naselja"]) && isset($_POST["brStan"])){
        $id = $_POST["id_naselja"];
        $brStan = $_POST["brStan"];

        $sql = "UPDATE naselja SET brojStanovnika ='$brStan' WHERE id=$id;";
        $query_run = mysqli_query($mysqli_conn, $sql);

        if($query_run){
          echo "<script> alert('DATA')</script>";
          header('Location:index.php' );
          exit;
        }else{
          echo "<script> alert('ERROR')</script>";
        } 
      }
      else{
        echo "nono";
      }
   }


