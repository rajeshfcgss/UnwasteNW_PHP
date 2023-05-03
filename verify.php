<script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<?php

require('config.php');

session_start();

require('razorpay-php/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";
$pid="";
if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $pid=$_POST['razorpay_payment_id'];
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
  
   // if ($result === FALSE) { /* Handle error */
    //}

    //var_dump($result);

    $html = '<div  class="tm_container" style="margin-top: 0;line-height: 1.5em;max-width: 880px;padding: 30px 15px;
  margin-left: auto;margin-right:
                  auto;position: relative;">
        <div class="tm_invoice_wrap" style="margin-top: 0;line-height: 1.5em;">
            <div class="tm_invoice tm_style1" id="tm_download_section" style="margin-top: 0;line-height: 1.5em;background: #fff;border-radius:
                  10px;padding: 50px;">
                <div class="tm_invoice_in" style="margin-top: 0;
        line-height: 1.5em;
        position: relative;
        z-index: 100;">
                    <div class="tm_invoice_head tm_align_center tm_mb20" style="margin-top: 0;line-height: 1.5em;margin-bottom: 20px;align-items: center;display: flex;;
                   justify-content: space-between;">
                        <div class="tm_invoice_left" style="margin-top: 0;line-height: 1.5em;">
                            <div class="tm_logo tm_size1" style="margin-top: 0;line-height: 1.5em;">
                                <img src="../icon/logo.png" alt="Logo" style="border-style:
                   none;border: 0;max-width: 100%;height: auto;vertical-align: middle;max-height: 60px;" />
                            </div>
                        </div>
                        <div class="tm_invoice_right tm_text_right" style="margin-top: 0;line-height: 1.5em;text-align: right;
            flex: none;width: 60%;">
                            <div class="tm_primary_color tm_f50 tm_text_uppercase" style="margin-top: 0;line-height: 1em;
              font-size: 50px;color:#111;text-transform: uppercase;">Invoice</div>
                        </div>
                    </div>
                    <div class="tm_invoice_info_2 tm_mb20" style="margin-top: 0;line-height: 1.5em;margin-bottom: 20px;display: flex; justify-content: space-between;border-top: 1px solid #dbdfea;border-bottom: 1px solid
                     #dbdfea;padding: 11px 0;">
                        <p class="tm_invoice_number tm_m0" style="margin-top: 0;
            line-height: 1.5em;
            margin-bottom: 15px;margin: 0px;">Invoice No: <b class="tm_primary_color" style="font-weight: bold;color: #111;">#<span id="orderid"></span></b></p>
                        <p class="tm_invoice_date tm_m0" style="margin-top: 0;line-height: 1.5em;margin-bottom: 15px;margin: 0px;">Date: <b class="tm_primary_color" style="font-weight: bold;color: #111;"><span id="date"></span></b></p>
                    </div>
                    <div class="tm_invoice_head tm_mb10" style="margin-top: 0;line-height: 1.5em;margin-bottom: 10px;display: flex;
          justify-content: space-between;">
                        <div class="tm_invoice_left" style="margin-top: 0;line-height: 1.5em;">
                            <p class="tm_mb2" style="margin-top: 0;line-height: 1.5em;margin-bottom: 2px;">
                                <b class="tm_primary_color" style="font-weight:
                    bold;color: #111;">Invoice To:</b>
                            </p>
                            <p style="margin-top: 0;line-height: 1.5em;margin-bottom: 15px;">

                                <span id="address"></span><br />
                              <span id="emailAddress"></span><br />
                            </p>
                        </div>
                        <div class="tm_invoice_right tm_text_right" style="margin-top: 0;line-height: 1.5em;text-align: right; width: 60%;">
                            <p class="tm_mb2" style="margin-top: 0;line-height: 1.5em;margin-bottom: 2px;">
                                <b class="tm_primary_color" style="font-weight:
                   bold;color: #111;">Pay To:</b>
                            </p>
                            <p style="margin-top: 0;line-height: 1.5em;margin-bottom: 15px;">
                                ND Logistics PVT Ltd, <br />
                                19/33, 50 feet Road, Krishnaswamy Nagar,<br />
                                Ramanthapuram, Coimbatore 641045.<br />
                                marketing@ndlogistics.co
                            </p>
                        </div>
                    </div>
                    <div class="tm_table tm_style1 tm_mb40" style="margin-top: 0;line-height: 1.5em;margin-bottom: 40px;">
                        <div class="tm_round_border" style="margin-top: 0;line-height: 1.5em;border: 1px solid #dbdfea;
            overflow: hidden;border-radius: 6px;">
                            <div class="tm_table_responsive" style="margin-top: 0;line-height: 1.5em;overflow-x: auto;">
                                <table style="width: 100%;caption-side: bottom;
               border-collapse: collapse;min-width: 600px;">
                                    <thead>
                                        <tr>
                                            <th class="tm_width_7 tm_semi_bold tm_primary_color tm_gray_bg" style="text-align: left;padding: 10px 15px;line-height:
                                1.55em;font-weight: 600;width: 58.33333333%;color: #111;background: #f5f6fa;">Item Details</th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg" style="text-align: left;padding: 10px 15px;line-height:
                 1.55em;font-weight: 600;width: 16.66666667%;
                 color: #111;background: #f5f6fa;">Price</th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg " style="text-align: right;padding: 10px
                           15px;line-height: 1.55em;font-weight: 600;
                           width: 16.66666667%;color: #111;
                           background: #f5f6fa;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tm_width_7" style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                  line-height: 1.55em;width: 58.33333333%;">
                                                <span id="servicetype"></span>
                                            </td>
                                            <td class="tm_width_2" style="border-top: 1px solid #dbdfea;padding: 10px 10px;
                line-height: 1.55em;width: 16.66666667%;">
                                                <span id="amount"></span>
                                            </td>
                                            <td class="tm_width_2 " style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                  line-height: 1.55em;width: 16.66666667%; text-align: right;">
                                                 <span id="total"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_7" style="border-top: 1px solid #dbdfea;  padding: 10px 15px;
                        line-height: 1.55em;width: 58.33333333%;">
                                            </td>
                                            <td class="tm_width_2" style="border-top: 1px solid #dbdfea;
                  padding: 10px 15px;line-height: 1.55em;width: 16.66666667%;">
                                            </td>
                                            <td class="tm_width_2 tm_text_right" style="border-top: 1px solid #dbdfea;
                  padding: 10px 15px;line-height: 1.55em;width:
                        16.66666667%;text-align: right;"> </td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_7" style="border-top: 1px solid #dbdfea; padding: 10px 15px;
                  line-height: 1.55em;width: 58.33333333%;">
                                            </td>
                                            <td class="tm_width_2" style="border-top: 1px solid #dbdfea;padding: 10px 15px;line-height: 1.55em;width: 16.66666667%;">
                                            </td>
                                            <td class="tm_width_2 tm_text_right" style="border-top: 1px solid #dbdfea; padding: 10px 15px; line-height: 1.55em;width:
                      16.66666667%;text-align: right;"> </td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_7" style="border-top: 1px solid #dbdfea;padding: 10px 15px;line-height: 1.55em;width: 58.33333333%;">
                                            </td>
                                            <td class="tm_width_2" style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                         line-height: 1.55em;width: 16.66666667%;">
                                            </td>
                                            <td class="tm_width_2 tm_text_right" style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                  line-height: 1.55em;width:
                       16.66666667%;text-align: right;"> </td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_7" style="border-top: 1px solid #dbdfea;padding: 10px 15px;line-height: 1.55em;width: 58.33333333%;">
                                            </td>
                                            <td class="tm_width_2" style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                                           line-height: 1.55em;width: 16.66666667%;">
                                            </td>
                                            <td class="tm_width_2 tm_text_right" style="border-top: 1px solid #dbdfea;padding: 10px 15px;line-height: 1.55em;width:
                       16.66666667%;text-align: right;"> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer" style="margin-top: 0;line-height: 1.5em;display: flex;">
                            <div class="tm_left_footer" style="margin-top: 0;line-height: 1.5em;width: 58%;padding: 10px 15px;">
                                <p class="tm_mb2" style="margin-top: 0;line-height: 1.5em;margin-bottom: 2px;">
                                    <b class="tm_primary_color" style="font-weight:
                 bold;color: #111;">Payment info:</b>
                                </p>
                                <p class="tm_m0" style="margin-top: 0;line-height: 1.5em;margin-bottom: 15px;margin: 0px;">
                                   Transaction ID -
                                     <span>   '. $pid .'</span> <br />Amount:  <span id="price"></span>
                                </p>
                            </div>
                            <div class="tm_right_footer" style="margin-top: 0;line-height: 1.5em;width: 42%;">
                                <table style="width: 100%;caption-side: bottom;border-collapse: collapse;margin-top: -1px;">
                                    <tbody>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_bold" style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                      line-height: 1.55em ;  font-weight: 700;width: 25%;color: #111;border: none !important; ">
                                                Subtotal
                                            </td>
                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold" style="border-top: 1px solid #dbdfea;padding:
                       10px 15px;line-height: 1.55em;font-weight: 700;width: 25%;color: #111;text-align: right;border: none !important;">
                                                 <span id="subtotal"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0" style="border-top: 1px solid
                             #dbdfea;padding: 10px 15px;line-height : 1.55em ;padding-top : 0;
                             width : 25%;color: #111;border: none !important;">
                           
                                                <span class="tm_ternary_color" style="color: #b5b5b5;"> </span>
                                            </td>
                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0" style="border-top: 1px solid #dbdfea;padding:
              10px 15px;line-height: 1.55em;padding-top: 0;width: 25%;color: #111;
              text-align: right;border: none !important;"></td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0" style="border-top: 1px solid #dbdfea;padding: 10px 15px;
                      line-height: 1.55em ;padding-top : 0 ;width: 25%;color: #111;border: none !important;">
                                                Tax <span class="tm_ternary_color"
                                                          style="color: #b5b5b5;">(5%)</span>
                                            </td>
                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0" style="border-top: 1px solid #dbdfea;padding:
                    10px 15px;line-height: 1.55em;padding-top: 0;width: 25%;color: #111;text-align: right;border: none !important;">
                                             <span id = "tax"></span>
                                            </td>
                                        </tr>
                                        <tr class="tm_border_top tm_border_bottom" style="border-bottom: 1px solid #dbdfea;border-top: 1px solid #dbdfea;">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color" style="border-top: 0;padding: 10px 15px;
                      line-height: 1.55em;font-size: 16px;font-weight: 700;width: 25%;
                      color: #111;">
                                                Grand Total
                                            </td>
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right" style="border-top: 0;padding: 10px
                       15px;line-height: 1.55em;font-size: 16px;font-weight: 700;width: 25%;
                       color: #111;text-align: right;">
                                                 <span id = "grandtotal"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 0;line-height: 1.5em;">
                        <p class="tm_mb5" style="margin-top: 0;line-height: 1.5em;margin-bottom: 5px;">
                            <b class="tm_primary_color" style="font-weight:
             bold;color: #111;">Terms &amp; Conditions:</b>
                        </p>
                        <ul class="tm_m0 tm_note_list" style="margin: 0px;padding-left: 15px;list-style: disc;">
                            <li>
                                All claims relating to quantity or shipping errors shall be waived by Buyer unless made in writing to Seller within thirty (30)
                                days after delivery of goods to the address stated.
                            </li>
                            <li>
                                Delivery dates are not guaranteed and Seller has no liability for damages that may be incurred due to any delay in shipment of
                                goods hereunder. Taxes are excluded unless otherwise stated.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>';

} else {
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html
?>
<script>  
    debugger;
    var loc= localStorage.getItem('userdata');
    var cache=JSON.parse(atob(loc));
    var today = new Date();
   document.getElementById('date').innerHTML = today.toDateString();;
     $(document).ready(function () {
        $("#firstname").text(cache.firstname);
        $("#lastname").text(cache.lastname);
        $("#mobileNumber").text(cache.mobileNumber);
        $("#emailAddress").text(cache.emailAddress);
        $("#servicetype").text(cache.servicetype);
        $("#orderid").text(cache.orderid);
        $("#amount").text(parseInt(cache.amount)/100);
        $("#total").text(parseInt(cache.amount)/100);
        $("#subtotal").text(parseInt(cache.amount)/100);
        $("#tax").text(parseInt(cache.amount)/100*5/100);
        $("#grandtotal").text((parseInt(cache.amount)/100*5/100)+parseInt(cache.amount)/100 );
        $("#price").text((parseInt(cache.amount)/100*5/100)+parseInt(cache.amount)/100 );
        $("#address").text(cache.address);
        $("#pincode").text(cache.postCode);
      
     


       
    });  
    </script>




    
