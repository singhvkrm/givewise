<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'];
    $amount = $_POST['amount'];
    $cause = $_POST['cause'];
    $invoiceNumber = $_POST['invoice_number'];
    $email = $_POST['email'];

    // Prepare the thank you message
    $subject = "Thank You for Your Donation!";
    $message = "Dear $fullName,\n\nThank you for your generous donation of $$amount to support $cause.\n\n";
    $message .= "Your invoice number is: $invoiceNumber\n\n";
    $message .= "Warm regards,\nThe Donation Team";

    // Send the email
    if (mail($email, $subject, $message)) {
        echo "<p>Thank you! Your invoice has been sent to $email.</p>";
    } else {
        echo "<p>There was an error sending the invoice. Please try again.</p>";
    }
}
?>
