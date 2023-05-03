<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'movie_connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM `movie` WHERE id = $id";
    $run = mysqli_query($con, $query);
    if($run){
        header('Location:movielist.php');
    }
    else{
        echo "<script>alert('Something Went Wrong!!');window.location.href='movielist.php';</script>";
    }
}
else{
    header('Location:movielist.php');
}
