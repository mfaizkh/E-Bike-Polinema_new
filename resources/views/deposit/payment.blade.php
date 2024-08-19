<?php

// require 'vendor/autoload.php';
// require_once dirname(__FILE__) . '/vendor/midtrans/Midtrans.php';

// my code goes here
namespace Midtrans;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Notification;
// Config::$serverKey = 'Mid-server-KRjCt11miIxtc38Qemf6lh-t';
// Config::$clientKey = 'Mid-client-sQTL1rw1EgusyIYY';
Config::$serverKey = 'SB-Mid-server-9N7RAtr6K6cTlIFnQeDjOKr1';
Config::$clientKey = 'SB-Mid-client-d75dBkUJXxyzXBGv';
// Config::$serverKey = 'Mid-server-N4XMPAMrHIyErErk0_IWTDTz';
// Config::$clientKey = 'Mid-client-S0PVgAcfqf2M_GJn';

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
}
printExampleWarningMessage();
Config::$isProduction = false;
Config::$isSanitized = true;
Config::$is3ds = true;
//Ambil data
$order_id = rand(1000,10000);
$gross_amount = $jumlah;
$nama = $pengguna->email;
// Required
$transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => $gross_amount, // no decimal allowed for creditcard
);
// Optional
$item1_details = array(
    'id' => '1',
    'price' => $gross_amount,
    'quantity' => 1,
    'name' => "Deposit Saldo"
);
// Optional
$item_details = array ($item1_details);
// Optional
$customer_details = array(
    'email'    => $pengguna->nama
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);
$snap_token = '';

try {
    $snap_token = Snap::getSnapToken($transaction);
 
}
catch (\Exception $e) {
  echo $e;
}



?>

<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/50/Avast_App_Locker_logo.png" type="image/png" />-->
  <!--plugins-->
  <link href="https://satria.fajarcode.com/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <link href="https://satria.fajarcode.com/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://satria.fajarcode.com/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/css/style.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  

  <!-- loader-->
	<link href="https://satria.fajarcode.com/assets/css/pace.min.css" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="https://satria.fajarcode.com/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/css/light-theme.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="https://satria.fajarcode.com/assets/css/header-colors.css" rel="stylesheet" />

  <title>E-BIKE POLINEMA</title>
</head>

<body class="bg-login">
<div class="wrapper">
       <!--start content-->
       <main class="authentication-content mt-5">
        <div class="container-fluid">
         <div class="row">
          <div class="col-12 col-lg-4 mx-auto">
            <div class="card shadow rounded-5 overflow-hidden">
                  <div class="row g-0">
                    <div class="col col-xl-12">
                      <div class="card-body p-4"><center><b>E-BIKE POLINEMA</b><hr>
                        <h3><span class="text-danger">P</span><span class="text-primary">e</span><span class="text-success">m</span><span class="text-danger">b</span><span class="text-primary">a</span><span class="text-success">y</span><span class="text-danger">a</span><span class="text-primary">r</span><span class="text-success">a</span><span class="text-danger">n</span></h3>
                        <p>Silahkan lanjutkan pembayaran anda dengan melakukan klik tombol <b>PAY</b> dibawah ini. Jika sudah melakukan pembayaran klik <b>KEMBALI KE MERCHANT</b>
                        <div class="mt-3"> <button id="pay-button" class="btn btn-primary radius-15">Pay!</button>
                          <a href="{{ route('deposit.index') }}" class="btn btn-outline-dark ms-3 radius-15">Batalkan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            </div>
        </div>
  <!-- Bootstrap bundle JS -->
  <script src="https://satria.fajarcode.com/assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="https://satria.fajarcode.com/assets/js/jquery.min.js"></script>
  <script src="https://satria.fajarcode.com/assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="https://satria.fajarcode.com/assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="https://satria.fajarcode.com/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="https://satria.fajarcode.com/assets/js/pace.min.js"></script>
  <!--app-->
  <script src="https://satria.fajarcode.com/assets/js/app.js"></script>
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
  <script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){

         // SnapToken acquired from previous step
         snap.pay('<?php echo $snap_token?>', {
             // Optional
             onSuccess: function(result){
                window.location.href = "{{ route('payment.success', ['email' => $nama, 'nominal' => $gross_amount]) }}";
               
             },
             // Optional
            onPending: function(result){
                window.location.href = "{{ route('deposit.index') }}?alert=nopay";
            },
            // Optional
            onError: function(result){
                window.location.href = "{{ route('deposit.index') }}?alert=error";
            }
         });
    };
</script>

  
</body>

</html>
