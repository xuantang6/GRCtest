<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link href="cust_header.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <header>
            <a href="#" class="logo">
                <i class="bx bxs-movie"></i> GRC Cinema
            </a>
            <div class="bx bx-menu" id="menu-icon"></div>
            
            <!-- Menu -->
            <ul class="navbar">
                <li><a href="#home" class="home-active">Home</a></li>
                <li><a href="#movies">Movies</a></li>
                <li><a href="#coming">Coming</a></li>
                <li><a href="#popular">Popular</a></li>
            </ul>
            <a href="sign_in.php" class="button">Sign In</a>
        </header>
        
        <script>
            let header = document.querySelector('header');
            let menu = document.querySelector('#menu-icon');
            let navbar = document.querySelector('.navbar');
            
            window.addEventListener("scroll", function(){
               header.classList.toggle('shadow', window.scrollY > 0); 
            });
            
            menu.onclick = () => {
                menu.classList.toggle("bx-x");
                navbar.classList.toggle("active");
            };
        </script>
    </body>
</html>
