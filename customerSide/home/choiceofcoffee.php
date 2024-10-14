<?php
session_start();

if (isset($_POST['item_id'])) {
    $itemID = $_POST['item_id'];

    // Add the item to the cart (customize this logic)
    // Example: $_SESSION['cart'][] = $itemID;

    // Return a success message (customize this response)
    echo json_encode(['success' => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COFFEE RUSH</title>
    <style>

            /* Mobile-first styles */
    body {
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        line-height: 1.5;
    }

    /* Navigation */
    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: #333;
        color: #fff;
    }

    /* Coffee customization section */
    .coffee-customization {
        padding: 3rem;
        background-color: #f9f9f9;
    }

    /* Input fields */
    input[type="text"],
    select {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Buttons */
    button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Responsive adjustments */
    @media screen and (min-width: 768px) {
        /* Larger screens */
        .coffee-customization {
            max-width: 600px;
            margin: 0 auto;
        }
    }

    

/* Styles for div A */
.div-a {
            display: none; /* Initially hidden */
        }
        /* Styles for div B */
        .div-b {
            display: none; /* Initially hidden */
        }
    

.mainBgn {
      background: rgb(111,120,148);
      background: linear-gradient(86deg, rgba(111,120,148,1) 0%, rgba(57,71,91,1) 100%);
      font-family: 'Sora', sans-serif;
      font-size:14px;
    }
    .boldfont {
      font-family:impact;
    }
    #cardFlare {
      color:#3a3a3a12;
      letter-spacing:2px;
      font-size:8em;
      line-height:0.8em
    }
    .lightColor {
      color:#eeeeee;
    }
    .lightColor2 {
      color:#aaaaaa;
    }
    label { text-transform : uppercase; color:#aaaaaa; font-size:12px }
    select,
    input[type="text"] {
      width:100%;
      border:none;
      border-bottom:1px solid #e5e5e5;
      height:50px;
      outline:none;
      color:#919191;
      font-size:18px;
      margin-top:6px;
      margin-bottom:24px;
    }
    .customRounded {
      border-radius:12px;
    }
    .priceShadow {
      text-shadow : 12px 14px 12px rgba(0,0,0,0.3)
    }


    @media screen and (max-width: 500px) {
    /* Adjust div A and div B styles for smaller screens */
    .div-a {
        display: block; /* Show div A */
    }
    .div-b {
        display: none; /* Hide div B */
    }
}
@media screen and (min-width: 501px) {
    /* Adjust div A and div B styles for larger screens */
    .div-a {
        display: none; /* Hide div A */
    }
    .div-b {
        display: block; /* Show div B */
    }
}

#payment-container {
    position: relative;
}

#payment-button {
    background-color: #007f00; /* Green color for the button */
    color: #ffffff; /* White text color */
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

#payment-message {
    position: absolute;
    top: 0;
    left: 100%; /* Position it just beside the button */
    padding-left: 10px; /* Add some spacing */
    color: #007f00; /* Green color for the message */
    font-weight: bold;
}

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<br>
<h1 class="text-center" style="font-family:Copperplate; color:black;"> COFFEE RUSH</h1><span class="sr-only"></span><hr><br><br>
    <section class="coffee-customization">
        <h2>Customize Your Coffee</h2>
        <div class="coffee-type">
            <label for="coffee-type">Select Coffee Type:</label>
            <select id="coffee-type">
                <option value="latte">Latte</option>
                <option value="cappuccino">Cappuccino</option>
                <option value="Americano">Americano</option>
                <option value="Espresso">Espresso</option>
                <option value="Hot Chocolate">Hot Chocolate</option>
                <!-- Add more coffee types -->
            </select>
        </div>

        <div class="size-options">
            <label>Choose Size:</label>
            <input type="radio" id="small" name="size" value="small">
            <label for="small">Small</label>
            <input type="radio" id="medium" name="size" value="medium">
            <label for="medium">Medium</label>
            <input type="radio" id="large" name="size" value="large">
            <label for="large">Large</label>
        </div>

        <!-- Add more customization options (number of cups, flavor, sweetness, milk) -->


    <div class="cup-quantity">
        <label for="cups">Number of Cups:</label>
        <input type="number" id="cups" min="1" value="1">
    </div>

    <div class="flavor-options">
        <label for="flavor">Choose Flavor:</label>
        <select id="flavor">
            <option value="vanilla">Vanilla</option>
            <option value="caramel">Caramel</option>
            <!-- Add more flavor options -->
        </select>
    </div>

    <div class="sweetness-level">
        <label for="sweetness">Sweetness Level:</label>
        <input type="radio" id="regular" name="sweetness" value="regular">
        <label for="regular">Regular</label>
        <input type="radio" id="less-sweet" name="sweetness" value="less-sweet">
        <label for="less-sweet">Less Sweet</label>
        <input type="radio" id="extra-sweet" name="sweetness" value="extra-sweet">
        <label for="extra-sweet">Extra Sweet</label>
    </div>

    <div class="milk-options">
        <label for="milk-type">Choose Milk Type:</label>
        <select id="milk-type">
            <option value="whole-milk">Whole Milk</option>
            <option value="skim-milk">Skim Milk</option>
            <!-- Add more milk options -->
        </select>
    </div>

    <div class="notes">
            <label for="customer-notes">Add Notes:</label><br>
            <textarea id="customer-notes" rows="4" placeholder="Any special requests or notes" style="height: 50px;"></textarea>
        </div>

        <button id="add-to-cart">Add to Cart</button>
    </section>

    <section class="cart">
        <h2>Your Cart</h2>
        <ul id="cart-items">
            <!-- Display selected items here -->
        </ul>
        <p>Total: <span id="cart-total">$0.00</span></p>
    </section>


    <section class="checkout">
        <h2>Checkout</h2>
        <!-- Other checkout details (items, total, etc.) go here -->

        <!-- Shipping Options -->
        <div class="shipping-method">
            <label for="shipping-method">Choose Shipping Method:</label>
            <select id="shipping-method">
                <option value="pickup">Pickup</option>
                <option value="delivery">Delivery</option>
            </select>
        </div>

        <!-- Delivery Time (Initially hidden) -->
        <div class="delivery-time" id="delivery-time-section" style="display: none;">
            <label for="delivery-time">Select Delivery Time:</label>
            <select id="delivery-time">
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="evening">Evening</option>
            </select>
        </div>

        <!-- Delivery Address Form (Initially hidden) -->
        <div class="delivery-address" id="delivery-address-section" style="display: none;">
            <label for="address">Delivery Address:</label>
            <input type="text" id="address" placeholder="Enter your delivery address">
            <!-- Add more address fields as needed (city, state, postal code, etc.) -->
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <!-- Display selected items, shipping method, time, location, and address -->
        </div>

        <!-- Place Order Button -->
        <button id="place-order">Place Order</button>
    </section>

    <section>

    <h1>Payment</h1>

    <div class="size-options">
            <label>Pay via</label>
            <input type="radio" id="cash" name="size" value="cash">
            <label for="cash">Cash</label>
            <input type="radio" id="card" name="size" value="card">
            <label for="card">Card</label>
</div>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@200;400&display=swap" rel="stylesheet">


    <div class="div-a">
        <h2>Your Order has been Placed as Reserved.</h2>
        <img src="../home/vos.png" alt="Visit Store for Cash Payment">
   <a href="../home/customerhome.php"> <button id="Cash">Return to Homepage</button> </a>
</div>

    <div class="div-b">

    <div class="bg-light vh-100 d-flex align-items-center">
      <div class="container">
        <div class="col-lg-8 col-md-9 mx-auto">
          <div class="px-5 pb-4 shadow mainBgn customRounded">
            <div class="mb-3">
              <h1 id="cardFlare" class="boldfont"><em>VISA</em></h1>
            </div>
            <div class="row align-items-center">
              <div class="col-md-3 col-sm-4 col-xs-12">
                <h6><small class="text-warning">Card payment</small></h6>
                <p class="fs-5 lightColor text-capitalize">Save Paper Save Trees</p>
                <div class="border-top pt-2 mt-5">
                  <h6 class="pt-3"><small class="lightColor2"><strong>ORDER TOTAL</strong></small></h6>
                  <section class="cart">
        <h2>Your Cart</h2>
        <p>Total Amount: <span id="payment-total">$0.00</span></p>

    </section>
                </div>
              </div>
              <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="bg-white customRounded shadow-lg px-4 pt-4" style="transform:translateX(90px)">
                  <div class="row mt-3">
                    <div class="col-sm-6 text-center">
                      <div class="lightColor2 text-uppercase"><small>COFFEE RUSH</small></div>
                      <div class="my-4">
                        <img src="paymentcoffee.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div>
                        <label for="">Name</label>
                        <input type="text" class="customInput">
                      </div>
                      <div>
                        <label for="">Card Number</label>
                        <input type="text" class="customInput">
                      </div>
                      <div class="row">
                        <div class="col">
                          <label for="">Expires</label>
                          <select name="" id="">
                            <option selected value='1'>Janaury</option>
                            <option value='2'>February</option>
                            <option value='3'>March</option>
                            <option value='4'>April</option>
                            <option value='5'>May</option>
                            <option value='6'>June</option>
                            <option value='7'>July</option>
                            <option value='8'>August</option>
                            <option value='9'>September</option>
                            <option value='10'>October</option>
                            <option value='11'>November</option>
                            <option value='12'>December</option>
                          </select>
                        </div>
                        <div class="col">
                          <label for="">Expires</label>
                          <select name="" id="">
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                          </select>
                        </div>
                        <div class="col">
                          <label for="">CVV</label>
                          <input type="text" class="customInput">
                        </div>
                      </div>
                      <div class="text-end" style="transform:translateY(20px)">
                   

                        <div id="payment-container">
    <button id="payment-button" class="btn py-3 btn-sm px-4 shadow rounded-0 btn-warning">Payment</button>
    <div id="payment-message"></div>
</div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="lightColor2 text-end mt-5">
                  <input type="checkbox" checked><label for="" class="ms-2 align-text-bottom">Save Card for Further Purchases</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<a href="../home/customerhome.php"> <button id="Cash">Return to Homepage</button> </a>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addToCartButton = document.getElementById('add-to-cart');
            const cartItemsList = document.getElementById('cart-items');
            let cartTotal = 0;
            const shippingMethodSelect = document.getElementById('shipping-method');
            const deliveryTimeSection = document.getElementById('delivery-time-section');
            const deliveryAddressSection = document.getElementById('delivery-address-section');
            // Get references to the radio buttons and divs
        const cashRadio = document.getElementById('cash');
        const cardRadio = document.getElementById('card');
        const divA = document.querySelector('.div-a');
        const divB = document.querySelector('.div-b');
        const paymentButton = document.getElementById("payment-button");
const paymentMessage = document.getElementById("payment-message");

paymentButton.addEventListener("click", () => {
    paymentMessage.textContent = "Payment done.";
});

        // Add event listeners to the radio buttons
        cashRadio.addEventListener('change', () => {
            divA.style.display = 'block'; // Show div A
            divB.style.display = 'none'; // Hide div B
        });

        cardRadio.addEventListener('change', () => {
            divA.style.display = 'none'; // Hide div A
            divB.style.display = 'block'; // Show div B
        });

            addToCartButton.addEventListener('click', function () {
                // Get selected coffee details
                const coffeeType = document.getElementById('coffee-type').value;
                const coffeeSize = document.querySelector('input[name="size"]:checked').value;
                const cups = parseInt(document.getElementById('cups').value);
                const flavor = document.getElementById('flavor').value;
                const sweetnessLevel = document.querySelector('input[name="sweetness"]:checked').value;
                const milkType = document.getElementById('milk-type').value;
                const customerNotes = document.getElementById('customer-notes').value; // Get customer notes

                // Calculate price based on selections (customize this logic)
                const pricePerCup = 4.50; // Example price
                const totalPrice = pricePerCup * cups;

                // Update cart total
                cartTotal += totalPrice;

                // Display selected item and notes in the cart
                const cartItemText = `${coffeeType} (${coffeeSize}), Flavor: ${flavor}, Sweetness: ${sweetnessLevel}, Milk: ${milkType}`;
                const cartItemWithNotes = `${cartItemText} - Notes: ${customerNotes}`;
                cartItemsList.innerHTML += `<li>${cartItemWithNotes} - $${totalPrice.toFixed(2)}</li>`;

                // Update cart total display
                document.getElementById('cart-total').textContent = `$${cartTotal.toFixed(2)}`;
                document.getElementById('payment-total').textContent = `$${cartTotal.toFixed(2)}`;
            });

            
            // Show/hide delivery time and address sections based on shipping method
            shippingMethodSelect.addEventListener('change', function () {
                const selectedMethod = shippingMethodSelect.value;
                if (selectedMethod === 'delivery') {
                    deliveryTimeSection.style.display = 'block';
                    deliveryAddressSection.style.display = 'block';
                } else {
                    deliveryTimeSection.style.display = 'none';
                    deliveryAddressSection.style.display = 'none';
                }
            });
        });

    </script>

</body>
</html>
