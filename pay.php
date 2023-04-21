<?php require('razorpay-php/razorpay-php/Razorpay.php'); require_once("test.php");   
if(!isset($_SESSION['emailAddress']))
{
    header("location:index.php"); 
    exit(); 
}
else
{
    $pid=$_SESSION['pid'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content = "width=device-width, initial-scale=1">
    <title>paymenet product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12 form-container">
    <h1>payment</h1>
    <hr>
    <?php
include("gateway-config.php");
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);
$firstname=$_SESSION['fname'];
$lastname=$_SESSION['lname'];
$email=$_SESSION['email'];
$mobile=$_SESSION['mobile'];
$address=$_SESSION['address'];
$note=$_SESSION['note'];
$sql="SELECT * from products WHERE pid=:pid";
$stmt=$db->prepare($sql);
$stmt->bindparam(':pid', $pid, PDO::PARAM_INT);
$stmt->execute();
$row=$stmt->fetch();
$price=$row['price'];
$_SESSION['price']=$price;
$title=$row['title'];
$webtitle='kloudping';
$displayCurrency='INR';
$imageurl='https://www.kloudping.com/favicon3.png';
$orderData = [
    'receipt'         => 3456,
    'amount'          => $price * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $webtitle,
    "description"       => $title,
    "image"             => $imageurl,
    "prefill"           => [
    "name"              => $firstname.' '.$lastname,
    "email"             => $email,
    "contact"           => $mobile,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];
if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

    ?>
    <div class="row">
   <div class="col-8">
    <h4>(Payer Detail)</h4>

<div class="mb-3">
    <label class="label">First Name</label>
    <?php echo $firstname; ?>
    </div>
    <div class="mb-3">
    <label class="label">Last Name</label>
    <?php echo $lastname; ?>
    </div>
    <div class="mb-3">
    <label class="label">Email</label>
    <?php echo $email; ?>
    </div>
    <div class="mb-3">
    <label class="label">Mobile</label>
    <?php echo $mobile; ?>
    </div>
    <div class="mb-3">
    <label class="label">Address</label>
    <?php echo $address; ?>
    </div>
    <div class="mb-3">
    <label class="label">Note</label>
    <?php echo $note; ?>
    </div>
</div>

<div class="col-sm-4 text-center">
<?php
$sql="SELECT * FROM products WHERE pid=:pid";
$stmt=$db->prepare($sql);
$stmt->bindparam(':pid', $pid, PDO::PARAM_INT);
$stmt->execute();
$row=$stmt->fetch();

    echo '<div class="col-4 text-center>"
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="uploads/'.$row['image'].'"  alt="card image cap">
  <div class="card-body">
    <h5 class="card-title">'.$row['title'].'</h5>
    <p class="card-text">'.$row['price'].'INR</p>
    
  </div>
</div>';

?>
<br>
<center>
<form action="verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="<?php echo $pid;?>">
</form>
</center>
 
</div>
</div>
</div>
  </div>
  </div>
</body>
</html> 