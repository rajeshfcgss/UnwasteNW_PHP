<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>
<head>
<style>
    .main-header-three{
        background:#04a9fb !important;
    }
    .form-copy{
            height: 63px;
            width: 100%;
            border: none;
            background-color: var(--wostin-extra);
            font-size: 14px;
            font-weight: 500;
            color: var(--wostin-gray);
            padding: 0 30px;
            outline: none;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
</head>
<?php include 'preloader.php';?>
<body>
    <div class="page-wrapper">
        <?php include 'header.php';?>

        <!--Page Header Start-->
        <!--Page Header End-->
        <!--Request A Pickup Top End-->

        <!--Request A Pickup Start-->
        <section class="project-details"  style="text-align: center;padding-top: 160px;padding-bottom:140px;">
            <div class="container">
                <div class="project-details__top">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="project-details__title-box">
                                <div class="project-details__title-left">
                                    <h2>Service Agreement</h2>
                                </div>
                            </div>
                            <div class="project-details__img-box" style="padding-bottom: 0px;">
                                <img src="assets/images/service.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="project-details__content" style="padding-top:40px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px; border: 1px solid #e6e6e6; margin-top: 0px; border-radius:3px;">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="project-details__content-left">
                                    <p class="project-details__content-text-1" style="text-align:left;">The following service agreement is entered in between:</p>
                                    <p class="project-details__content-text-1" style="text-align:left;"><b>1. UnWasteNetwork</b>, 19/33, Krishnaswamy Nagar, 50 Feet Road, Ramanthapuram, Coimbatore - 641045</p>
                                    <h3>and</h3>
                                    <p class="project-details__content-text-2" style="text-align:left;"><b>2. </b><?php echo $_GET["firstname"]; ?>&nbsp;<?php echo $_GET["lname"]; ?> <span style="font-weight:400;color:#878986;">from</span> <?php echo $_GET["address"]; ?>-<?php echo $_GET["pincode"]; ?> <span style="font-weight:400;color:#878986;">on</span> 20/01/2023</p>
                                    <p class="project-details__content-text-3" style="text-align:left;">UnWasteNetwork will provide waste pickup services. This services include</p>
                                    <p class="project-details__content-text-3" style="text-align:left;">
                                    <ul style="text-align:left;">
                                        <li>Supply of Bags for pickup of wastes</li>
                                        <li>Logistics services for pick up of waste from the premises : <span style="color:var(--wostin-base);"><?php echo $_GET["firstname"]; ?>&nbsp; <?php echo $_GET["lname"]; ?>, <?php echo $_GET["address"]; ?></span></li>
                                        <li>Only on weekdays as per the logistics calendar given or based on pick up request.</li>
                                    </ul></p>
                                    <p class="project-details__content-text-2" style="text-align:left;"><?php echo $_GET["firstname"]; ?>&nbsp; <?php echo $_GET["lname"]; ?> <span style="font-weight:400;color:#878986;">responsibilities will comprise of</span></p>
                                    <p class="project-details__content-text-3" style="text-align:left;">
                                        <ul style="text-align:left;">
                                        <li>Provide dry waste by collecting in the Blue bag provided.</li>
                                        <li>Provide loading support to the vehicle driver/staff to load the Blue Bags to the vehicle</li>
                                        <li>Prepay pickup cost with applicable taxes through Bank Transfer.</li>
                                        <li>Follow the Standard Operating Procedure on Dry waste segregation methods.</li>
                                        </ul>
                                    </p>
                                    <p class="project-details__content-text-3" style="text-align:left;"><b>></b> Quality check of the collected waste will be performed and informed in case of mixing of waste.</p>
                                    <p class="project-details__content-text-3" style="text-align:left;"><b>></b> This agreement can be terminated by either party on service of a month notice or on mutual agreement, once all dues from both sides have settled.</p>
                                    <p class="project-details__content-text-3" style="text-align:left;"><b>></b> This agreement is deemed to be extended unless any request for changes.</p>
                                    <br><br>
                                    <div class="request-a-pickup__tab-content-btn-box" style="text-align:center;">
                                                                <button id="rzp-button1" type="submit" class="thm-btn request-a-pickup__tab-content-btn">Pay Now</button>
                                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Request A Pickup End-->

<?php include 'footer.php';?>


    </div><!-- /.page-wrapper -->

   
</body>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function(){
        $("#rzp-button1").click(function(){
            debugger;
            var options = {
                "key":"rzp_test_ZTHPIZKigxqWkz", // Enter the Key ID generated from the Dashboard
                "amount": "2000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Unwaste Network", //your business name
                "description": "Unwaste Transaction",
                "image": "https://drive.google.com/file/d/107yO_HikGRraMUzOacLSIVZq87fOru0e/view?usp=share_link",
                //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
                "prefill": {
                    "name": "<?php echo $_GET["firstname"]; ?>" , //your customer's name
                    "email": "<?php echo $_GET["email"]; ?>",
                    "contact": "<?php echo $_GET["number"]; ?>"
                },
                "notes": {
                    "address": "<?php echo $_GET["address"]; ?>"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
	        var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();

            
            
            $.ajax({
                url:"http://localhost:7071/api/Transaction/Add",
                type:"POST",
                beforeSend: function(request) {
                    request.setRequestHeader("Authorization", "Bearer eyJhbGciOiJodHRwOi8vd3d3LnczLm9yZy8yMDAxLzA0L3htbGRzaWctbW9yZSNobWFjLXNoYTI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbGFkZHJlc3MiOiJhZG1pbkB1bndhc3RlLm9yZyIsInJvbGUiOiJBZG1pbiIsImV4cCI6MTY4MjQ4NDg1MCwiaXNzIjoiYXBpLm15YWRtaW4uY29tIiwiYXVkIjoiYXBpLm15YWRtaW4uY29tIn0.1kZEThGrOtS_e9ZpAYogbUeSTb2QjiY1WcmiPVFA2yo");
                },
                data:JSON.stringify(options),
                contentType:"application/json; charset=utf-8",
                dataType:"json",
                success: function(){
                    alert("Data: " + options + "\nStatus: " );
                }
            });
        });

    });

 
              
        
        
    
</script> 
</html>
    <?php include 'end.php';?>