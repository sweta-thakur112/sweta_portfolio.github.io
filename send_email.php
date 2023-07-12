<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $to = 'your_email@example.com'; // Replace with your email address
  $subject = 'New Contact Form Submission';
  $body = "Name: $name\nEmail: $email\n\n$message";

  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Display a success message
  $successMessage = '<p>Thank you for your message. We will get back to you soon!</p>';

  // Use mailtrap.io for testing email sending in a development environment
  $smtpHost = 'your_mailtrap_smtp_host';
  $smtpPort = 'your_mailtrap_smtp_port';
  $smtpUsername = 'your_mailtrap_smtp_username';
  $smtpPassword = 'your_mailtrap_smtp_password';

  $transport = (new Swift_SmtpTransport($smtpHost, $smtpPort))
    ->setUsername($smtpUsername)
    ->setPassword($smtpPassword);

  $mailer = new Swift_Mailer($transport);

  $message = (new Swift_Message($subject))
    ->setFrom([$email => $name])
    ->setTo($to)
    ->setBody($body);

  if ($mailer->send($message)) {
    echo $successMessage;
  } else {
    echo '<p>Sorry, an error occurred. Please try again later.</p>';
  }
}
?>
