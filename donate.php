<?php
// Start by checking if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'];
    $amount = $_POST['amount'];
    $cause = $_POST['cause'];
    $customCause = isset($_POST['custom_cause']) ? $_POST['custom_cause'] : '';

    // Choose the actual cause based on selection
    $actualCause = ($cause === "Custom") ? $customCause : $cause;

    // Generate a unique invoice number (e.g., timestamp)
    $invoiceNumber = time();

    // Generate a barcode (Using Code128 format)
    require 'barcode.php';  // assuming barcode.php contains your barcode generation code
    $barcodeImage = generateBarcode($invoiceNumber);

    // Display the thank you note and contact form
    echo "<h2>Thank You for Your Donation!</h2>";
    echo "<p>Name: $fullName</p>";
    echo "<p>Amount: $$amount</p>";
    echo "<p>Cause: $actualCause</p>";
    echo "<img src='data:image/png;base64," . base64_encode($barcodeImage) . "' alt='Barcode'><br><br>";
    echo "<form action='send_invoice.php' method='POST'>";
    echo "<input type='hidden' name='full_name' value='$fullName'>";
    echo "<input type='hidden' name='amount' value='$amount'>";
    echo "<input type='hidden' name='cause' value='$actualCause'>";
    echo "<input type='hidden' name='invoice_number' value='$invoiceNumber'>";
    echo "<label for='email'>Your Email:</label>";
    echo "<input type='email' id='email' name='email' required><br><br>";
    echo "<button type='submit'>Send Invoice</button>";
    echo "</form>";
}
?>
