<!--  The entire list of Checkout fields is available at
 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->

<style>
.razorpay-payment-button{
  display:none;
}
</style>
</php print_r($_POST); ?>
<form action="razor/verify.php" method="POST">
  <script

    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data["prefill"]["name"]?>"
    data-prefill.email="<?php echo $data["prefill"]["email"]?>"
    data-prefill.contact="<?php echo $data["prefill"]["contact"]?>"
    data-notes.shopping_order_id= <?php echo $data["shopping_id"] ?>
    data-order_id="<?php echo $data["order_id"]?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="<?= $shopping_id ?>">
  <input type="hidden" name="campid" value="<?= $_POST["campid"] ?>">
  <input type="hidden" name="amount" value="<?= $_POST["donateAmount"] ?>">
  <input type="hidden" name="name" value = "<?= $_POST["name"] ?>">
  <input type="hidden" name="phoneNumber" value="<?= $_POST["phoneNumber"] ?>">
  <input type="hidden" name="email" value="<?= $_POST["emailId"] ?>">
  <input type="hidden" name="pancardNum" value="<?= $_POST["pancardNum"] ?>">
  <input type="hidden" name="address" value="<?= $_POST["address"] ?>">
</form>
<script>
  document.getElementsByClassName("razorpay-payment-button")[0].click();
</script>