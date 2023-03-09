<?php 

var_dump($_POST);

if(isset($_POST['submit'])){ 
    echo 'Selected Country ID: '.$_POST['country']; 
    echo 'Selected State ID: '.$_POST['state']; 
    echo 'Selected City ID: '.$_POST['city']; 
} 
?>