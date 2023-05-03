<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
*/

require_once 'movie_connection.php';

if(isset($_POST['submit'])){
    $mv_name = $_POST['mv_name'];
    $mv_m_tag = $_POST['mv_m_tag'];
    $mv_link1 = $_POST['mv_link1'];
    $mv_link2 = $_POST['mv_link2'];
    $mv_lang = $_POST['mv_lang'];
    $mv_duration = $_POST['mv_duration'];
    $mv_director = $_POST['mv_director'];
    $mv_writter = $_POST['mv_writter'];
    $mv_starring = $_POST['mv_starring'];
    $mv_music = $_POST['mv_music'];
    $country = $_POST['country'];
    $cat_id = $_POST['cat_id'];
    $genre_id = $_POST['genre_id'];
    $mv_desc = $_POST['mv_desc'];
    $mv_date = date('Y-m-d', strtotime($_POST['mv_date']));
    $img = $_FILES['img']['name'];
    $target = "C:/xampp/htdocs/PHP_Assignment/thumb/". basename($img);
    
    $query = "INSERT INTO `movie`(`cat_id`, `genre_id`, `mv_name`, `mv_tag`, `link1`, `link2`, `img`, `release_date`, `duration`, `lang`, `director`, `writter`, `starring`, `music`, `country`,`meta_description`)
              VALUES ('$cat_id','$genre_id','$mv_name','$mv_m_tag','$mv_link1','$mv_link2','$img','$mv_date','$mv_duration','$mv_lang','$mv_director','$mv_writter','$mv_starring','$mv_music','$country','$mv_desc')";
    
    $run = mysqli_query($con, $query);
    if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
        echo "<script>alert('Movie Successfully Added...');window.location.href='movielist.php';</script>";
    }
    else{
        echo "<script>alert('Something Went Wrong!!');window.location.href='addmovie.php';</script>";
    }
}

