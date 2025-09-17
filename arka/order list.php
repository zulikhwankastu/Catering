<?php # Script to generate an invoice based on orders from the database

$page_title = 'Invoice';

require_once('mysqli.php'); // Connect to the database.

global $dbc;

// Retrieve orders from the database
$query = "SELECT * FROM `order`"; // Assuming your table name is `order`
$result = mysqli_query($dbc, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="container">';
    echo '<h1>Order list</h1>';
    echo '<div class="invoice-details">';
    
    // Iterate over each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="invoice-row">';
        echo '<p class="invoice-label">Order ID: ' . $row['order_id'] . '</p>';
        displayInvoiceRow('Occasion:', $row['occasion']);
        displayInvoiceRow('Event Date:', $row['event_date']);
        displayInvoiceRow('Event Time:', $row['event_time']);
        displayInvoiceRow('Budget/Pax (RM):', $row['budget']);
        displayInvoiceRow('Number of Pax:', $row['number_pax']);
        displayInvoiceRow('Event Address:', $row['event_address']);
        displayInvoiceRow('Location:', $row['location']);
        displayInvoiceRow('Contact Person:', $row['contact_person']);
        displayInvoiceRow('Company Name:', $row['company_name']);
        displayInvoiceRow('Contact:', $row['contact']);
        displayInvoiceRow('Email:', $row['email']);
        displayInvoiceRow('Special Request:', $row['special_request'] ?? 'None');
        displayInvoiceRow('Promo Code:', $row['promo_code'] ?? 'None');
        
        // Calculate total budget for each order
        $totalBudget = $row['budget'] * $row['number_pax'];
        echo '<p class="invoice-label">Total Budget: <b>RM ' . number_format($totalBudget, 2) . '</b></p>';
        
        echo '</div>'; // Close invoice-row
        echo '<hr>';
    }

    echo '</div>'; // Close invoice-details
    echo '</div>'; // Close container
} else {
    echo '<p class="error">No orders found.</p>';
}

mysqli_close($dbc); // Close the database connection.



// Function to display invoice rows
function displayInvoiceRow($label, $value) {
    echo '<p class="invoice-label">' . $label . ' <span>' . $value . '</span></p>';
}
?>

<!-- Include the CSS styles -->
<style>
<?php include('./list.css'); ?>
</style>

<div class="container">
    <a href="homepage.html" class="btn btn-primary">Log out</a>
</div>

<?php include('./includes/footer.html'); ?>