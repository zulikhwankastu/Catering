<?php # Script 7.7 - register.php (3rd version after Scripts 7.3 & 7.5)

$page_title = 'Order';
include ('./includes/header.html');

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

	require_once ('mysqli.php'); // Connect to the db.
		
	global $dbc;
	

	$errors = array(); // Initialize error array.

	$o = trim($_POST['occasion']);
    $ed = trim($_POST['event_date']);
    $et = trim($_POST['event_time']);
    $bg = trim($_POST['budget']);
    $np = trim($_POST['number_pax']);
    $ea = trim($_POST['event_address']);
    $cp = trim($_POST['contact_person']);
    $cn = trim($_POST['company_name']);
    $ct = trim($_POST['contact']);
    $e = trim($_POST['email']);
    $location = $_POST['location'];
    $special_request = isset($_POST['special_request']) ? trim($_POST['special_request']) : "";
    $promo_code = isset($_POST['promo_code']) ? trim($_POST['promo_code']) : "";

    
	// Check for a first name.
	if (empty($_POST['occasion'])) {
		$errors[] = 'You forgot to enter your ocassion.';
	} else {
		$o = $_POST['occasion'];
	}
	
	// Check for a last name.
	if (empty($_POST['event_date'])) {
		$errors[] = 'You forgot to enter the event date.';
	} else {
		$ed = $_POST['event_date'];
	}
	
	// Check for an email address.
	if (empty($_POST['event_time'])) {
		$errors[] = 'You forgot to enter the event time';
	} else {
		$et = $_POST['event_time'];
	}

    if (empty($_POST['budget'])) {
        $errors[] = 'You forgot to enter your budget.';
    } elseif (!is_numeric($_POST['budget'])) {
        $errors[] = 'Your budget must be a numeric value.';
    } else {
        $bg = $_POST['budget'];
    }

    if (empty($_POST['number_pax'])) {
        $errors[] = 'You forgot to enter the number of pax.';
    } elseif (!is_numeric($_POST['number_pax'])) {
        $errors[] = 'Number of pax must be a numeric value.';
    } else {
        $np = $_POST['number_pax'];
    }
    

    
    if (empty($_POST['event_address'])) {
		$errors[] = 'You forgot to enter the event address';
	} else {
		$ea = $_POST['event_address'];
	}

    if (empty($_POST['contact_person'])) {
		$errors[] = 'You forgot to enter the contact person';
	} else {
		$cp = $_POST['contact_person'];
	}

    if (empty($_POST['company_name'])) {
		$errors[] = 'You forgot to enter the company name';
	} else {
		$cn = $_POST['company_name'];
	}

    if (empty($_POST['contact'])) {
		$errors[] = 'You forgot to enter the contact';
	} else {
		$ct = $_POST['contact'];
	}
    
    if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter the email';
	} else {
		$e = $_POST['email'];
	}
	
    $location = $_POST['location'];

    $special_request = isset($_POST['special_request']) ? $_POST['special_request'] : "";
    $promo_code = isset($_POST['promo_code']) ? $_POST['promo_code'] : "";

	
	
	
	if (empty($errors)) {
		// Insert into the database.
		$query = "INSERT INTO `order` (occasion, event_date, event_time, budget, number_pax, event_address, contact_person, company_name, contact, email, location, special_request, promo_code) VALUES ('$o', '$ed', '$et', '$bg', '$np', '$ea', '$cp', '$cn', '$ct', '$e', '$location', '$special_request', '$promo_code')";

		$result = mysqli_query($dbc, $query);
		
		if ($result) {
			// Display the invoice here
            include ('invoice.php');
            exit();
		} else {
			// Print an error message if insertion fails.
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc)  . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
			include ('./includes/footer.html'); 
			exit();
		}
	} else { // Report the errors.
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	}
	
	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<head>
<link rel="stylesheet" type="text/css" href="order.css">

</head>
<body>
<div class="container">
<h2>Place your cater</h2>
<form action="orderForm.php" method="post">
	<p>Occasion: <input type="text" name="occasion" size="30" maxlength="250" value="<?php if (isset($_POST['occasion'])) echo $_POST['occasion']; ?>" /></p>
	<p>Event Date: <input type="date" name="event_date" size="15" maxlength="30" value="<?php if (isset($_POST['event_date'])) echo $_POST['event_date']; ?>" /></p>
	<p>Event Time: <input type="time" name="event_time" size="20" maxlength="40" value="<?php if (isset($_POST['event_time'])) echo $_POST['event_time']; ?>"  /> </p>
    <p>Budget/Pax (RM): <input type="text" name="budget" size="20" maxlength="40" value="<?php if (isset($_POST['budget'])) echo $_POST['budget']; ?>"  /> </p>
    <p>Number of Pax : <input type="text" name="number_pax" size="20" maxlength="40" value="<?php if (isset($_POST['number_pax'])) echo $_POST['number_pax']; ?>"  /> </p>
    <p>Event Address: <input type="text" name="event_address" size="30" maxlength="250" value="<?php if (isset($_POST['event_address'])) echo $_POST['event_address']; ?>"  /> </p>

	
    <p>Select Locaction</p>
     <p>Select Location</p>
    <select name="location"> <!-- Added name attribute -->
        <option value="empty">Location</option>
        <option value="kuala lumpur">Kuala Lumpur</option>
        <option value="selangor">Selangor</option>
    </select>
     <br><br>
    <p>Contact Details </p> 
    <p>Contact Person: <input type="text" name="contact_person" size="30" maxlength="250" value="<?php if (isset($_POST['contact_person'])) echo $_POST['contact_person']; ?>"  /> </p>
    <p>Company Name: <input type="text" name="company_name" size="30" maxlength="250" value="<?php if (isset($_POST['company_name'])) echo $_POST['company_name']; ?>"  /> </p>
    <p>Contact: <input type="text" name="contact" size="20" maxlength="40" value="<?php if (isset($_POST['contact'])) echo $_POST['contact']; ?>"  /> </p>
    <p>Email: <input type="text" name="email" size="50" maxlength="30" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
     <br><br>
    <p>Other Details</p>
    <p>Special Request: <input type="text" name="special_request" size="30" maxlength="250" /></p>
    <p>Promo Code: <input type="text" name="promo_code" size="10" maxlength="20" /></p>
   
   
	<p><input type="submit" name="submit" value="Place Order" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
    <a href="homepage.html" class="button">Go to Homepage</a>
	</div>
</body>
<?php
include ('./includes/footer.html');
?>