<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


            <script>
            $(document).ready(function(){
                $('#country').on('change', function(){
                    var countryID = $(this).val();
                    if(countryID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'country_id='+countryID,
                            success:function(html){
                                $('#state').html(html);
                                $('#city').html('<option value="">Select state first</option>'); 
                            }
                        }); 
                    }else{
                        $('#state').html('<option value="">Select country first</option>');
                        $('#city').html('<option value="">Select state first</option>'); 
                    }
                });
                
                $('#state').on('change', function(){
                    var stateID = $(this).val();
                    if(stateID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'state_id='+stateID,
                            success:function(html){
                                $('#city').html(html);
                            }
                        }); 
                    }else{
                        $('#city').html('<option value="">Select state first</option>'); 
                    }
                });

                $('#city').on('change', function(){
                    var cityID = $(this).val();
                    if(cityID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'city_id='+cityID,
                            success:function(html){
                                $('#district').html(html);
                            }
                        }); 
                    }else{
                        $('#district').html('<option value="">Select state first</option>'); 
                    }
                });
            });
            </script>

</head>
<body>

<?php 
    // Include the database config file 
    include_once 'dbConfig.php'; 
     
    // Fetch all the country data 
    $query = "SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC"; 
    $result = $db->query($query); 
?>

<form action="posts.php" method="post">
<!-- Country dropdown -->
<select id="country" name="country">
    <option value="">Select Country</option>
    <?php 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Country not available</option>'; 
    } 
    ?>
</select>

<!-- State dropdown -->
<select id="state" name="state">
    <option value="">Select country first</option>
</select>

<!-- City dropdown -->
<select id="city" name="city">
    <option value="">Select state first</option>
</select>

<select id="district" name="district">
    <option value="">Select state first</option>
</select>

<button type="submit" name ="submit">Import </button>


</form>
    
</body>
</html>