<?php
include("config/config.php");
include("templates/header.php")
?>

<form class="formClass" id="orderForm">
<div class="form-header">Order Confirmation</div>
    
    <div class="food-details">
        <div class="foodimage">
            <img src="path/to/food-image.jpg" alt="Food Image" />
        </div>
        <div class="food-info">
            <div class="food-title">Food Title</div>
            <div class="food-description">Delicious description of the food goes here.</div>
        </div>
        <div class="food-price-quantity">
            <div class="food-price">$10.00</div>
            <div class="food-quantity">
                <label for="quantity">Quantity:</label>
                <div class="quantity-controls">
                    <button type="button" class="quantity-button" onclick="changeQuantity(-1)">-</button>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" required />
                    <button type="button" class="quantity-button" onclick="changeQuantity(1)">+</button>
                </div>
            </div>
        </div>
    </div>

    <div class="formGrid">
        <div class="form-group">
            <label>Delivery Address:</label>
            <div class="address-selection">
                <input type="radio" id="currentLocation" name="addressType" value="currentLocation" onclick="toggleAddressFields()" required>
                <label for="currentLocation">Current Location</label>
                
                <input type="radio" id="homeAddress" name="addressType" value="homeAddress" onclick="toggleAddressFields()">
                <label for="homeAddress">Home Address</label>
                
                <input type="radio" id="otherAddress" name="addressType" value="otherAddress" onclick="toggleAddressFields()">
                <label for="otherAddress">Another Delivery Address</label>
            </div>

            <!-- Static field for Current Location -->
            <div id="currentLocationField" class="address-field" style="display:none;">
                <label for="currentLocationAddress">Your Current Location:</label>
                <input type="text" id="currentLocationAddress" name="currentLocationAddress" placeholder="Fetching location..." readonly />
            </div>

            <!-- Static field for Home Address -->
            <div id="homeAddressField" class="address-field" style="display:none;">
                <label for="homeAddressInput">Your Home Address:</label>
                <input type="text" id="homeAddressInput" name="homeAddressInput" placeholder="123 Main St, City, Country" required />
            </div>

            <!-- Input field for Another Delivery Address -->
            <div id="otherAddressField" class="address-field" style="display:none;">
                <label for="otherAddressInput">Another Delivery Address:</label>
                <input type="text" id="otherAddressInput" name="otherAddressInput" placeholder="Enter delivery address" />
            </div>
        </div>

        <div class="form-group">
            <label for="storeAddress">Store Address:</label>
            <input type="text" id="storeAddress" name="storeAddress" value="456 Store St, City, Country" readonly />
        </div>

        <div class="form-group">
            <label for="deliveryTime">Delivery Time:</label>
            <input type="text" id="deliveryTime" name="deliveryTime" value="Estimated delivery time: 30 minutes" readonly />
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required />
            <span class="validation-message" id="phoneError"></span>
        </div>
        
        <div class="form-group">
            <label for="additionalNotes">Additional Notes:</label>
            <input type="text" id="additionalNotes" name="additionalNotes" />
        </div>
    </div>

    <div class="button-group">
        <button type="submit" class="submit-btn">Place Order</button>
    </div>

    <script>
        function toggleAddressFields() {
    const currentLocationField = document.getElementById('currentLocationField');
    const homeAddressField = document.getElementById('homeAddressField');
    const otherAddressField = document.getElementById('otherAddressField');
    
    // Hide all fields initially
    currentLocationField.style.display = 'none';
    homeAddressField.style.display = 'none';
    otherAddressField.style.display = 'none';
    
    // Show the relevant field based on the selected radio button
    if (document.getElementById('currentLocation').checked) {
        currentLocationField.style.display = 'block';
    } else if (document.getElementById('homeAddress').checked) {
        homeAddressField.style.display = 'block';
    } else if (document.getElementById('otherAddress').checked) {
        otherAddressField.style.display = 'block';
    }
}

    </script>
</form>



<script>
    function changeQuantity(delta) {
        const quantityInput = document.getElementById('quantity');
        let currentValue = parseInt(quantityInput.value) || 1; // Default to 1 if the input is empty

        // Update the quantity based on the delta value
        if (currentValue + delta >= 1) { // Ensure it doesn't go below 1
            quantityInput.value = currentValue + delta;
        }
    }
    
    document.querySelector('.formClass').addEventListener('submit', function(event) {
        const address = document.getElementById('address');
        const addressError = document.getElementById('addressError');
        
        if (!address.value) {
            addressError.textContent = 'Delivery address is required.';
            addressError.style.color = 'red';
            event.preventDefault(); // Prevent form submission
        } else {
            addressError.textContent = ''; // Clear error message
        }
    });
</script>




<?php
include("templates/footer.php")
?>