<?php
// Az email cím, ahová az üzenetet küldeni szeretnéd
$to = 'frksgerii@gmail.com';  // Ezt a változót később módosíthatod
$subject = 'Kapcsolatfelvételi üzenet';

// Az űrlap adatok ellenőrzése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Biztonsági lépés: Adatok tisztítása
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Üzenet összeállítása
    $body = "Név: $name\n";
    $body .= "Email: $email\n";
    $body .= "Üzenet:\n$message\n";

    // Email fejlécek
    $headers = "From: no-reply@yourdomain.com\r\n"; // Ne felejtsd el módosítani a domain nevet
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email küldés
    if (mail($to, $subject, $body, $headers)) {
        echo "Az üzenet sikeresen elküldve!";
    } else {
        echo "Hiba történt az üzenet küldésekor.";
    }
}
?>
