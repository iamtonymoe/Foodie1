<?php
include("config/config.php");
include("templates/header.php")
?>

<form class="payment-details-form">
    <fieldset class="payment-fieldset">
        <legend class="payment-legend">Payment Information</legend>
        <div class="payment-group">
            <label class="payment-label" for="cardNum">Card Number</label>
            <input class="payment-input" type="text" id="cardNum" name="cardNum" placeholder="Enter your card number" required>
        </div>
        <div class="payment-group">
            <label class="payment-label" for="cardName">Cardholder Name</label>
            <input class="payment-input" type="text" id="cardName" name="cardName" placeholder="Enter cardholder's name" required>
        </div>
        <div class="payment-group">
            <label class="payment-label" for="expiry">Expiry Date (MM/YY)</label>
            <input class="payment-input" type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
        </div>
        <div class="payment-group">
            <label class="payment-label" for="cvvCode">CVV</label>
            <input class="payment-input" type="text" id="cvvCode" name="cvvCode" placeholder="Enter CVV" required>
        </div>
        <div class="payment-group">
            <button class="payment-button" type="submit">Pay Now</button>
        </div>
    </fieldset>

    <script>
        
    </script>
</form>

<?php
include("templates/footer.php")
?>