<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="invoice.css">
</head>
<body>
    <div class="container">

<?php
$page_title = 'Invoice';
include('./includes/header.html');

echo '<h1 id="mainhead">Invoice</h1>';

if (isset($_POST['submitted'])) {
    require_once('mysqli.php'); // Include your database connection script.

    // Retrieve submitted data from the form
    $o = $_POST['occasion'];
    $ed = $_POST['event_date'];
    $et = $_POST['event_time'];
    $bg = $_POST['budget'];
    $np = $_POST['number_pax'];
    $ea = $_POST['event_address'];
    $cp = $_POST['contact_person'];
    $cn = $_POST['company_name'];
    $ct = $_POST['contact'];
    $e = $_POST['email'];
    $location = $_POST['location'];
    $special_request = isset($_POST['special_request']) ? $_POST['special_request'] : "";
    $promo_code = isset($_POST['promo_code']) ? $_POST['promo_code'] : "";

    // Calculate total budget
    $totalBudget = $bg * $np;

    
    // Display the invoice
    echo '<div class="invoice">';
    echo '<h2>Order Details</h2>';

    echo '<table class="invoice-table" cellspacing="0" cellpadding="5">
            <tr>
                <th>Item</th>
                <th>Details</th>
            </tr>';

    displayInvoiceRow('Occasion:', $o);
    displayInvoiceRow('Event Date:', $ed);
    displayInvoiceRow('Event Time:', $et);
    displayInvoiceRow('Budget/Pax (RM):', $bg);
    displayInvoiceRow('Number of Pax:', $np);
    displayInvoiceRow('Event Address:', $ea);
    displayInvoiceRow('Location:', $location);
    displayInvoiceRow('Contact Person:', $cp);
    displayInvoiceRow('Company Name:', $cn);
    displayInvoiceRow('Contact:', $ct);
    displayInvoiceRow('Email:', $e);
    displayInvoiceRow('Special Request:', $special_request);
    displayInvoiceRow('Promo Code:', $promo_code);
    echo '<tr class="total-row">
            <td><b>Total Budget:</b></td>
            <td><b>RM ' . number_format($totalBudget, 2) . '</b></td>
          </tr>';

    echo '</table>';
    echo '</div>';

    mysqli_close($dbc); // Close the database connection.
} else {
    echo '<p class="error">No order details submitted.</p>';
}

include('./includes/footer.html');

// Function to display invoice rows
function displayInvoiceRow($label, $value) {
    echo '<tr>
            <td>' . $label . '</td>
            <td>' . $value . '</td>
          </tr>';
}
?>
 <div class="btn-container">
    <a href="homepage.html" class="btn">Go back to homepage</a>
</div>

    </div>
</body>
</html>