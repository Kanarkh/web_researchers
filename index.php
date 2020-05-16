<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
        <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
        <script src="semantic/semantic.js"></script>
        <title>RESEARCHERS</title>
        <style>
            
        </style>
    </head>
    <body>
    
    <!-- 홈페이지 Title -->
    <div style="padding-top:10px; padding-left:60px;" align = center><h3 class="ui icon header"><i class="handshake outline icon"></i>
    <div class="content">연구자들<div class="sub header">Researchers Melting Pot</div>
    </div></h3></div>


    <!-- MyCode -->
    <!-- Navbar -->
    <?php 
    require("./view/Navbar.php"); 
    ?>
    
    <!-- 첫화면 Home 열기 -->
    <?php
        if($_SERVER['REQUEST_URI']=='/'){
            require("./view/menuview/Home.php");
        }
    ?>
    <!-- menu page 열기 -->
    <?php
    if(isset($_GET['menu'])){
        $pagewhere = basename($_GET['menu']);
        require("./view/menuview/$pagewhere.php");

    }else{
        
    }
    ?>
    <!-- where page 열기 -->
    <?php
    if(isset($_GET['where'])){
        $pagewhere = basename($_GET['where']);
        require("./view/where/$pagewhere.php");

    }else{

    }
    ?>
    <!-- mypage page 열기 -->
    <?php
    if(isset($_GET['mypage'])){
        $pagewhere = basename($_GET['mypage']);
        require("./view/menuview/mypage/$pagewhere.php");
    }else{

    }
    ?>

    <!-- 하단 -->
    <?php
        require("./view/footmenu.php");
    ?>
    <!-- end MyCode -->
    </body>
</html>