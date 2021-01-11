<?php
require('./control/conn.php');

  if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status === 'successful') {
      $ti = $_GET['transaction_id'];
     
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$ti/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "Authorization: Bearer FLWSECK_TEST-d5ea60870bfa28fdcad784a993290999-X"
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $res = json_decode($response, true);
      

      if ($res['status'] ==='success') {
          // CHECK THE TRASACTION STATUS 
          $t_status = $res['data']['status'];
          $t_id = $res['data']['id'];
          $t_email = $res['data']['customer']['email'];

          // echo $t_status. " ". $t_id. " ". $t_email;
          if ( $t_status === 'successful') {
              // SEND THE TRANSACTION ID TO DATABASE 
              $t_query = mysqli_query($conn, "UPDATE users SET transaction_code='$t_id' WHERE email='$t_email'");
              if (!$t_query) {
                die("ACCOUNT VERIFICATION FAILED KINDLY LOGIN TO VERIFY");
              }else{
                echo "ACCOUNT ACTIVATE SUCCESSFULLY, PROCEED TO LOGIN";
              }
          }
      }else{
        echo "UNABLE TO VERIFY TRANSACTION";
      }
    }
  }

