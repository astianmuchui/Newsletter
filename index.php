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

    if(isset($_POST['add'])){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        if(empty($name) || empty($email)){
            echo 'please fill in all fields';
        }else{
            //pass

        }
        $query = "INSERT INTO emails (client_name,email_adress) VALUES ('$name','$email')";
        $action = mysqli_query($conn,$query);
        if($action){
            // echo '<small>Added Succesfully</small>';
        }else{
            echo '<small>Email not added</small>';
        }
    }
    $query = "SELECT * FROM emails";
    $result = mysqli_query($conn,$query);
    $emails = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    //Dealing With the message
    $sender = '7iastian@gmail.com';
    $company = 'Seb Astian';
    if(isset($_POST['send'])){
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $headers = "from: ".$company."<".$sender.">"."\r\n";
        foreach ($emails as $email):
            mail($email['email_adress'],$subject,$message,$headers);
        endforeach;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Newsletter</title>
</head>
<body>
    <header>
        <h1>Newsletter System</h1>
        <nav>
            <ul>
                <li><a href="#emails">Your Emails</a></li>
            <li><a href="#add">Add Email</a></li>
            <li><a href="#send">Send Message</a></li>
        </ul>
    </nav>
    </header>
    <div class="main">
        
        <div class="table" id="emails">
            <h1>Your Emails Database</h1>
            <table>
                
                <tr>
                   <th>Name</th>
                   <th>Email adress</th>
                   <th>Date added</th> 
                </tr>
                <?php foreach($emails as $email):?>
                <tr>
                
                    <td><?php echo $email['client_name']?></td>
                    <td><?php echo $email['email_adress']?></td>
                    <td><?php echo $email['time']?></td>
                    <?php endforeach ?>
                </tr>
            </table>
            
        </div>
        <div class="form" id="add">
            <h1>Add New Email</h1>
            <form action="#" method="post">
                <div class="form-group">
                    <label>Name </label> <br> <br>
                <input type="text" name="name" id="" required> <br> <br>
                </div>
                <div class="form-group">
                    <label>Email Adress</label> <br> <br>
                <input type="email" name="email" id="" required> <br> <br>
                </div>
                
                <input type="submit" name="add" value="+ Add Email" class="btn-dark">
            </form>
        </div>
        <div class="send" id="send"> <br> <br>
            <label>Write Message</label> <br> <br>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Subject</label> <br> <br>
                    <input type="text" name="subject"> <br> <br>
                <textarea name="message" id="" cols="30" rows="10" placeholder="Write here" required></textarea> <br> <br>
                </div>
                <input type="submit" name="send" value="Send Message" class="btn-primary"> <br> <br>
            </form>
        </div>
    </div>
             <div class="bar">
                 <h4>Powered by <span>Seb Astian</span></h4>
             </div>       
</body>
</html>