<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        label {
            display: block;
            font: 1rem 'Fira Sans', sans-serif;
        }
        input,
        label {
            margin: 0.4rem 0;
        }
    </style>

</head>
<body>




<form action="funtions.php" method="post">

<label for="appt-time">Select Day </label>
<select name="day" id="">
    <option value="1">Monday</option>
    <option value="2">Tuesday</option>
    <option value="3">Wednesday</option>
    <option value="4">Thursday</option>
    <option value="5">Friday</option>
    <option value="6">Saturday</option>
    <option value="7">Sunday</option>
</select>




<label for="appt-time">Start Time </label>
<input id="appt-time" type="time" name="time_st" value="00:00" />



<label for="appt-time">End Time </label>
<input id="appt-time" type="time" name="time_et" value="00:00" />

<label for="appt-time">Subject </label>
<select name="sbj" id="">
    <option value="CC101">CC101</option>
    <option value="IM207">IM207</option>
    <option value="IPT209">IPT209</option>
</select>



<input type="submit" name="submit">

</form>







<hr>

<form action="" method="post">


<label for="appt-time">Select Day </label>
<select name="day" id="">
    <option value="1">Monday</option>
    <option value="2">Tuesday</option>
    <option value="3">Wednesday</option>
    <option value="4">Thursday</option>
    <option value="5">Friday</option>
    <option value="6">Saturday</option>
    <option value="7">Sunday</option>
</select>




<label for="appt-time">Start Time </label>
<input id="appt-time" type="time" name="time_st" value="00:00" />



<label for="appt-time">End Time </label>
<input id="appt-time" type="time" name="time_et" value="00:00" />

<label for="appt-time">Subject </label>
<select name="sbj" id="">
    <option value="CC101">CC101</option>
    <option value="IM207">IM207</option>
    <option value="IPT209">IPT209</option>
</select>



<input type="submit" name="load">



</form>






<?php


if(isset($_POST["load"])){

    $day = $_POST["day"];
    $st = $_POST["time_st"];
    $en = $_POST["time_et"];
    $sbj = $_POST["sbj"];


include_once ("connection.php");
        //include our connection
        
        $database = new Connection();
        $db = $database->open();
        try{	


            $sql = "SELECT * FROM tbl_sched WHERE day = '$day' AND  ('$st' BETWEEN start AND end
                                                OR '$en' BETWEEN start AND end
                                                OR '$st' >= start AND '$en' <= end)";


    
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            if(empty($result)){
                echo "No Results Found.";
            }


            foreach ($db->query($sql) as $row) {

              
                ?>

                
                <tr>
                    <!-- <td style="padding: 0 !important"><ul style="margin: 0 !important"><li>< ?php echo $row["eval_comments"]?></li></ul></td> -->
                        <td style="padding: 0 !important"><ul style="margin: 0 !important"><li><?php echo $row["day"]?> <?php echo $row["start"]?> <?php echo $row["end"]?><?php echo $row["subject"]?></li></ul></td>
                    <?php } ?>
                </tr>
                <?php 
            }
        
        catch(PDOException $e){
            echo "There is some problem in connection: " . $e->getMessage();
        }

        //close connection
        $database->close();


    }else{
        


    }


    ?>




    
</body>
</html>