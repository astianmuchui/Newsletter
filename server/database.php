<?php
        $servername = "newsletter";
        $serverhost = "localhost";
        $serverUser = "root";
        $serverPassword = "";
        $conn = mysqli_connect($serverhost,$serverUser,$serverPassword,$servername);
        if($conn){
            //WE passed
        }else{
            echo "There was a problem connecting to the server";
        }
        $query = "SELECT * FROM emails";
        $result = mysqli_query($conn,$query);
        $emails = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
?>