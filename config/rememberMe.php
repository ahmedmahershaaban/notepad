<?php
// connect to database
include ('config/connection.php');
// check if there sesstion and cookies

if(!isset($_SESSION['user_id']) && !empty($_COOKIE['rememberme'])){   
        list($authentication1, $authentication2) = explode(",", $_COOKIE['rememberme']);
        $authentication2 = hex2bin($authentication2);
        //Prepare $authentication2 to query
        $f2authentication2 = hash('sha256',$authentication2);
        //Check the Cookies with the remeberMe table
        $sql = "SELECT * FROM remember_me WHERE authentication1 = '$authentication1'";
        if(!($result = mysqli_query($link, $sql))){
             echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }
     
        $row = mysqli_fetch_assoc($result);
            
        $user_id = $row['user_id'];
       
        
    if(hash_equals($row['f2authentication2'],$f2authentication2) && $row['expire_time'] > time()-604800){
    
            // get info from users table to make the session
            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
            if(!($result = mysqli_query($link, $sql))){
                 echo '<div class="alert alert-danger">Error running the query!</div>';
                exit;
            }
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['last_action'] = time();
            $_SESSION['keepAlive'] = 'true';
            
     

            
 //Create two variables $authentificator1 and authentificator2
                $authentication1 = bin2hex(openssl_random_pseudo_bytes(6));
                $authentication2 = openssl_random_pseudo_bytes(20);
                //Define other query variables
                $expire_time = time()+604800;// 7days from he regester 

                //Prepare to save data in the COOKIE 
                 function f1($a,$b){
                     return $a . "," . bin2hex($b);
                }
                $cookiesValue = f1($authentication1,$authentication2);

                //Store authentcations in Cookies
             setcookie("rememberme",$cookiesValue,$expire_time, '/');

                //Prepare $authentication2 to query
                function f2($a){
                    return hash('sha256',$a);
                }
                $f2authentication2 = f2($authentication2);
                
                //Run query to update rememberme table
                $sql = "UPDATE remember_me SET authentication1 = '$authentication1', f2authentication2 = '$f2authentication2', expire_time = '$expire_time' WHERE user_id = '$user_id'";

                if(!($result = mysqli_query($link, $sql))){
                     echo '<div class="alert alert-danger">There was an error updating data to remember you next time.</div>';
                    exit;
                }
        

        

            
        }
    }

   ?>