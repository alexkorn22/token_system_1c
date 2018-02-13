<?php

    function debug($var,$die = false){
//        echo "<pre>" . date("Y.m.d h:i:s")  . "</pre>";
        echo "<pre>";
            var_dump($var);
        echo "</pre>";
        if($die){
            die();
        }
    }




?>