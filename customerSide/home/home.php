<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','restaurantdb');

//Create Connection
$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($link->connect_error){ //if not Connection
die('Connection Failed'.$link->connect_error);//kills the Connection OR terminate execution
}

$sqlmainDishes = "SELECT * FROM menu WHERE item_category = 'Main Dishes' ORDER BY item_type; ";
$resultmainDishes = mysqli_query($link, $sqlmainDishes);
$mainDishes = mysqli_fetch_all($resultmainDishes, MYSQLI_ASSOC);

$sqldrinks = "SELECT * FROM menu WHERE item_category = 'Drinks' ORDER BY item_type; ";
$resultdrinks = mysqli_query($link, $sqldrinks);
$drinks = mysqli_fetch_all($resultdrinks, MYSQLI_ASSOC);

$sqlsides = "SELECT * FROM menu WHERE item_category = 'Side Snacks' ORDER BY item_type; ";
$resultsides = mysqli_query($link, $sqlsides);
$sides = mysqli_fetch_all($resultsides, MYSQLI_ASSOC);



// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo '<div class="user-profile">';
    echo 'Welcome, ' . $_SESSION["member_name"] . '!';
    echo '<a href="../customerProfile/profile.php">Profile</a>';
    echo '</div>';
    
}

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  

  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- importing javascript library for the function to work -->

   

  <title>RUSH CAFE</title>
</head>

<body>
 <!-- Header -->
 
<section id="header">
  <div class="header container">
    <div class="nav-bar">
      <div class="brand">
          <a class="nav-link" href="../home/home.php#hero">
            <h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> COFFEE RUSH</h1><span class="sr-only"></span>
          </a>
      </div>
      <div class="nav-list">
        <div class="hamburger">
          <div class="bar"></div>
        </div>
          <div class="navbar-container">
            
              <div class="navbar">
        <ul>
          <li><a href="#hero" data-after="Home">Home</a></li>
          
          <li><a href="#projects" data-after="Projects">Menu</a></li>
          <li><a href="#about" data-after="About">About</a></li>
          <li><a href="#contact" data-after="Contact">Contact</a></li>
          <li><a href="../CustomerReservation/reservePage.php" data-after="Service">Reservation</a></li>
          <li><a href="../../adminSide/StaffLogin/login.php" data-after="Staff">Staff</a></li>
          
          
   

        <div class="dropdown">
            <button class="dropbtn">ACCOUNT <i class="fa fa-caret-down" aria-hidden="true"></i> </button>
        <div class="dropdown-content">
        
  <?php

// Get the member_id from the query parameters
$account_id = $_SESSION['account_id'] ?? null; // Change this to the way you obtain the member ID

// Create a query to retrieve the member's information
//$query = "SELECT member_name, points FROM memberships WHERE account_id = $account_id";

// Execute the query
//$result = mysqli_query($link, $query);

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $account_id != null) {
    $query = "SELECT member_name, points FROM memberships WHERE account_id = $account_id";

// Execute the query
$result = mysqli_query($link, $query);
    // If logged in, show "Logout" link
    // Check if the query was successful
    if ($result) {
        // Fetch the member's information
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $member_name = $row['member_name'];
            $points = $row['points'];
            
            // Calculate VIP status
            $vip_status = ($points >= 1000) ? 'VIP' : 'Regular';
            
            // Define the VIP tooltip text
            $vip_tooltip = ($vip_status === 'Regular') ? ($points < 1000 ? (1000 - $points) . ' points to VIP ' : 'You are eligible for VIP') : '';
            
            // Output the member's information
            echo "<p class='logout-link' style='font-size:1.3em; margin-left:15px; padding:5px; color:white; '>$member_name</p>";
            echo "<p class='logout-link' style='font-size:1.3em; margin-left:15px;padding:5px;color:white; '>$points Points </p>";
            echo "<p class='logout-link' style='font-size:1.3em; margin-left:15px;padding:5px; color:white; '>$vip_status";
            
            // Add the tooltip only for Regular status
            if ($vip_status === 'Regular') {
                echo " <span class='tooltip'>$vip_tooltip</span>";
            }
            
            echo "</p>";
        } else {
            echo "Member not found.";
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }

    echo '<a class="logout-link" style="color: white; font-size:1.3em;" href="../customerLogin/logout.php">Logout</a>';
} else {
    // If not logged in, show "Login" link
    echo '<a class="signin-link" style="color: white; font-size:15px;" href="../customerLogin/register.php">Sign Up </a> ';
    echo '<a class="login-link" style="color: white; font-size:15px; " href="../customerLogin/login.php">Log In</a>';
}

// Close the database connection
mysqli_close($link);
?>

     
    </div>
  </div> 
        </ul>
          </div>
          </div>
      </div>
    </div>
  </div>
</section>
<!-- End Header -->





<!-- Hero Section with Video Background and Text Overlay -->
<section id="hero" style="position: relative;">
    <video autoplay loop muted playsinline poster="your-poster-image.jpg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        <source src="../image/SteakOnGrillCloseup.mp4" type="video/mp4">
        <!-- Add additional source elements for 
        1.  SteakOnGrillCloseup

        other video formats if needed -->
    </video>
    <div class="hero container" style="position: relative; z-index: 1;">
        <div>
            <h1><strong><h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> COFFEE RUSH</h1><span></span></strong></h1>
            <h1><strong style="color:white;">CAFE<span></span></strong></h1>
            <a type="button" class="cta" onclick="myFunction()">Order Now</a>
            <script>
function myFunction() {
  var r = confirm("Please login first!");
  if (r == true) {
    // Forward to login page
    window.location.href = "../customerLogin/login.php";
  } else {
    // Stay on the current page
    // No action needed
  }
}
</script>
        </div>
    </div>
</section>
<!-- End Hero Section -->
  
  
  
  <!-- menu Section -->
  <section id="projects">
    <div class="projects container">
      <div class="projects-header">
        <h1 class="section-title"   >Me<span>n</span>u</h1>
      </div>
     
        
       <select style="text-align:center;" id="menu-category" class="menu-category">
        <option  value="blue">ALL ITEMS</option>
        <option value="yellow">MAIN DISHES</option>
        <option value="red">SIDE DISHES</option>
        <option value="green">DRINKS</option>
      </select>
        
    <div class="yellow msg"> 
     
        <div></div>
      <div class="mainDish">
           <h1 style="text-align:center;">MAIN DISHES</h1>
          <?php foreach ($mainDishes as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">$<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
        
      </p>
    <?php endforeach; ?>
      </div>
    </div>
      
      
    <div class="red msg">
        <div></div>
      <div class="sideDish">
           <h1 style="text-align:center">SIDE DISHES</h1>
          <?php foreach ($sides as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">$<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
    </div>
        
      
      
    <div class="green msg">
        <div></div>
      <div class="drinks">
           <h1 style="text-align:center">DRINKS</h1>
          <?php foreach ($drinks as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">$<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
    </div>
      
      
       <div class="blue msg">
          
      <div class="mainDish">
           <h1 style="text-align:center">MAIN DISHES</h1>
          <?php foreach ($mainDishes as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">$<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
             
           
     
      <div class="sideDish">
           <h1 style="text-align:center">SIDE DISHES</h1>
          <?php foreach ($sides as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">$<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
            
      
      <div class="drinks">
           <h1 style="text-align:center">DRINKS</h1>
          <?php foreach ($drinks as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">$<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
          
      </div>
    </div>
  </section>
  <!-- End menu Section -->


  
  <!-- About Section -->
<section id="about" ">
  <div class="about container">
    <div class="col-right">
        <h1 class="section-title" >About <span>Us</span></h1>
        <h2>COFFE RUSH Company History:</h2>
 <p>Coffee Rush was founded in 2009 by Fleur Studd and Jason Scheltus. It's hard to fathom now, but at that time, finding fresh, in-season, traceable, high quality coffee in Melbourne (or Australia) was practically impossible. We wanted to help address that and, in doing so, ignite positive change in the industry by redefining what coffee was and could be, and to build a market for, and appreciation of, high quality specialty coffee.</p>
 <p>We built our first shop and roastery in the wonderful, bustling Prahran Market. We fell in love with this location for many reasons, the most important being that it allows us to engage with a community of shoppers who are seeking out quality produce, and who care about seasonality and provenance. Over the last decade and a half we have slowly grown to six shops, each located in very special neighbourhoods in Melbourne - from Carlton to the Queen Victoria Market, South Melbourne to the 'Paris end' of Collins Street. In each of these locations, we have built meaningful, ongoing relationships with the area's unique community, and we've made hundreds of beautiful coffees for thousands of wonderful customers.</p>
 <p>We realised early on that we wanted to deliver Melbourne's best coffee experience and to do this, we needed to put all our energy into sourcing, roasting and sharing the very best coffee we could find. Our goal was to make these coffees accessible and exciting, easy to understand and appreciate, and simple to brew and enjoy.</p>
 <p>Today, Coffee Rush is still independently owned by Fleur and Jason, along with Jenni Bryant, who joined the business in 2010 and became a co-owner in 2019. The trio actively work in the business alongside an incredible group of friendly, caring, talented and passionate back-of-house and front-of-house team members.</p>
 <p>All our coffees are produced by dedicated farmers, many of who we have been lucky to work with, year after year. These producers' talent, hard work and unwavering commitment to quality - and to supporting their local communities - blows us away every time we visit them and reinforces all the reasons we do what we do. It makes us even more determined to celebrate and showcase their coffees, and to tell their stories. We know our job is done when a customer gets excited to see a specific coffee on our shelves, or asks us when it will be back on offer.</p>
 
 
    
      </div>
    </div>
  </section>
  <!-- End About Section -->

  
  
  
  
 <!-- Contact Section -->
<section id="contact">
  <div class="contact container">
    <div>
      <h1 class="section-title">Contact <span>info</span></h1>
    </div>
    <div class="contact-items">
      <div class="contact-item contact-item-bg">
        <div class="contact-info">
          <div class='icon'><img src="../image/icons8-phone-100.png" alt=""/></div>
          <h1>Phone</h1>
          <h2>+61 235 4789</h2>
        </div>
      </div>
      
      <div class="contact-item contact-item-bg"> 
        <div class="contact-info">
          <div class='icon'><img src="../image/icons8-email-100.png" alt=""/></div>
          <h1>Email</h1>
          <h2>RushCafe@gmail.com</h2> 
        </div>
      </div>
      
      <div class="contact-item contact-item-bg">
        <div class="contact-info">
          <div class='icon'> <img src="../image/icons8-home-address-100.png" alt=""/></div>
          <h1>Address</h1>
          <h2>Coffee Rush, Street Level, 201 Spencer St, Docklands VIC 3008</h2>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact Section -->


  

  
  
  
  
  <!-- Footer -->
  <section id="footer">
    <div class="footer container">
        <div class="brand">
          <h1>Brekki on the House</h1>
      </div>
        <h2>Follow our Socials</h2>
      <div class="social-icon">
        <div class="social-item">
          <a href="https://www.facebook.com"><img src="https://img.icons8.com/color/48/facebook.png" alt="facebook"/></a>
        </div>
        <div class="social-item">
          <a href="https://www.instagram.com"><img src="https://img.icons8.com/color/48/instagram-new.png" alt="instagram-new"/></a>
        </div>
          <div class="social-item">
          <a href="https://www.pinterest.com"><img src="https://img.icons8.com/color/48/pinterest.png" alt="pinterest-new"/></a>
        </div>
          <div class="social-item">
          <a href="https://www.tiktok.com"><img src="https://img.icons8.com/color/48/tiktok.png" alt="tiktok-new"/></a>
        </div>
          <div class="social-item">
          <a href="https://www.youtube.com"><img src="https://img.icons8.com/color/48/youtube-play.png" alt="youtube-new"/></a>
        </div>
          
        
      </div>
      <p>© 2023 Coffee Rush</p>
      
      
    </div>
  </section>
  <!-- End Footer -->
  <script src="../js/app.js"></script>
   <style type="text/css">
       
       .navbar-container {
  width: 100%;
  padding: 0;
  margin: 0;
}
      .msg {
        font-family: 'Montserrat', sans-serif;
        margin-top: 25px;
        padding: 25px;
        display: none;
        color: black;
      }
      .yellow {
        background: #fff;
      }
      .green {
        background: #fff;
      }
      .red {
        background: #fff;
      }

      /* Styling the select button */
   .menu-category {
  font-size: 24px;
  padding: 10px;
  border: 2px solid black; /* Red border */
  outline: none;
  cursor: pointer;
  transition: border-color 0.3s ease, background-color 0.3s ease, color 0.3s ease;
  color: #000; /* Black text */
  background-color: #fff; /* White background */
  border-radius: 0; /* No border radius (sharp corners) */
}

/* Style the option text in the select dropdown */
.menu-category option {
  font-size: 20px;
}

/* Hover effect */
.menu-category:hover {
  background-color: black; /* Red background on hover */
  color: white; /* Black text on hover */
}

      /* Use CSS Grid to create three columns */
      .msg {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Three columns with equal width */
        grid-gap: 24px; /* Adjust the gap between items */
      }

      /* Style the menu item content */
      .msg p {
        margin: 5px 0;
      }
      
    .item-name {
  display: inline-block; /* Ensure items are displayed on separate lines */
  width: 100%; /* Adjust the width as needed */
  float: left;
}

.item-price {
  display: inline-block; /* Ensure prices are displayed on separate lines */
  width: 30%; /* Adjust the width as needed */
  float: right;
}

.user-profile {
    display: flex;
    align-items: center;
    color: white;
    margin-right: 20px;
}

.user-profile a {
    margin-left: 10px;
    color: white;
    text-decoration: none;
}

/* Style for the profile link */
.profile-link {
  border: 1px solid #fff; /* Smaller border style and color */
  padding: 3px 8px; /* Smaller padding inside the border */
  border-radius: 3px; /* Rounded corners for the border */
  text-decoration: none; /* Remove the default underline */
  color: #fff; /* Text color */
  margin-left: auto; /* Automatically push the link to the right */
  margin-right: 10px; /* Add a small right margin for spacing */
}


#contact .col-right h2 {
  font-size: 24px; /* Adjust the font size */
  color: white; /* Text color for the right column */
}

#contact .col-right p {
  font-size: 18px; /* Adjust the font size */
  color: white; /* Text color for the right column */
}

/* Style for the contact-item containers */
.contact-item-bg {
  background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black background */
  padding: 20px;
  border-radius: 5px;
  margin-bottom: 20px; /* Add margin between contact items */
}

.contact-item-bg h1,
.contact-item-bg h2 {
  color: white; /* Text color for the contact items */
}

.contact-item-bg i {
  color: #fff; /* Icon color */
}

.contact-item-bg .icon img {
  width: 80px; /* Adjust the width of the icon images */
  height: 80px; /* Adjust the height of the icon images */
}



.navbar {
  overflow: hidden;
  
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: right;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;  
  border: none;
  outline: none;
  color: white;
  padding: 13.9px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
  margin-top: 6px;
}

 .dropdown:hover .dropbtn {
  color: crimson;
  
}

.dropdown-content {
  display: none;
  position: absolute;
    background-color: rgba(0, 0, 0, 0.5);
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  color: black;
}

.dropdown-content a {
  float: none;
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}
/* Style for the dropdown content text */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Hover effect for dropdown content text */
.dropdown-content a:hover {
  background-color: #ddd;
  color: black; /* Set the text color to black on hover if needed */
}

.dropdown:hover .dropdown-content {
  display: block;
}

 .tooltip {
    display: none;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 5px;
    border-radius: 3px;
    font-size: 0.9em;
    margin-top: 50px; /* Add margin to move the tooltip below the element */
    left: 0; /* Set left to 0 to align with the element */
    width: 100%; /* Make the tooltip span the width of the element */
    text-align: center; /* Center the text within the tooltip */
  }

    </style>
    <!-- Java-Ol-->
    <script type="text/javascript">
    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var val = $(this).attr("value");
                if(val){
                    $(".msg").not("." + val).hide();
                    $("." + val).show();
                } else{
                    $(".msg").hide();
                }
            });
        }).change();
    });
    
    
    
    
    
    

  $(document).ready(function(){
    // Function to filter menu items based on search input
    function filterMenuItems(searchTerm) {
      $(".item-name").each(function() {
        var itemName = $(this).text().toLowerCase();
        if (itemName.includes(searchTerm)) {
          $(this).closest(".msg").show();
        } else {
          $(this).closest(".msg").hide();
        }
      });
    }
    
    // Search button click event
    $("#search-button").click(function() {
      var searchTerm = $("#search-input").val().toLowerCase();
      filterMenuItems(searchTerm);
    });
    
    // Search input keyup event
    $("#search-input").keyup(function() {
      var searchTerm = $(this).val().toLowerCase();
      filterMenuItems(searchTerm);
    });
  });

$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});

    </script>
<!-- jQuery Ol -->


<!-- CSS Ol Popper js -->

<script>
  $(document).ready(function () {
    $('.logout-link').hover(function () {
      var $tooltip = $(this).find('.tooltip');
      var elementHeight = $(this).height();
      $tooltip.css('top', elementHeight + 10 + 'px'); // Position the tooltip below the element
      $tooltip.css('display', 'block');
    }, function () {
      $(this).find('.tooltip').css('display', 'none');
    });
  });
</script>


</body>

</html>

