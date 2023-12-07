<?php
    include "connect.php";
    
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
 
   if(!isset($_SESSION)) {
        session_start();
    }

    $uname = mysqli_real_escape_string($conn, $_POST["cust_uname"]);
 
   $pwd = mysqli_real_escape_string($conn, $_POST["cust_psw"]);

   $azureFunctionUrl = "https://bankingwithphp.azurewebsites.net/api/aurl_fun?";
   $postData = array(
    'action' => "login",
    'username' => $uname,
    'password' => $pwd
);
$ch = curl_init($azureFunctionUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Execute cURL session and retrieve the response
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Do something with the response from the Azure Cloud Function
// For example, you can decode the JSON response if the Azure function returns JSON data.
$responseData = json_decode($response, true);
echo $responseData;
    $sql0 =  "SELECT * FROM customer WHERE uname='".$uname."' AND pwd='".$pwd."'";
  
  $result = $conn->query($sql0);
    $row = $result->fetch_assoc();

    if (($result->num_rows) > 0) {
        $_SESSION['loggedIn_cust_id'] = $row["cust_id"];
 
       $_SESSION['isCustValid'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
        header("location:customer_home.php");
 
   }
    else {
        session_destroy();
        die(header("location:home.php?loginFailed=true"));
    }
?>
