<?php

// Function to generate bcrypt hash
function generateBcryptHash($password) {
    // Generate bcrypt hash with default options
    return password_hash($password, PASSWORD_BCRYPT);
}

// Example usage
$password = 'Test101';
$hashedPassword = generateBcryptHash($password);

echo 'Original Password: ' . $password . PHP_EOL;
echo 'Bcrypt Hash: ' . $hashedPassword . PHP_EOL;

?>
