<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Az űrlapról érkező adatok
    $name = htmlspecialchars(trim($_POST["name"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));
    $captcha = htmlspecialchars(trim($_POST["captcha"]));
    
    // CAPTCHA ellenőrzés
    if ($captcha !== "21") { // 10 + 11 = 21
        echo "<script>alert('Hibás CAPTCHA válasz. Próbáld újra!'); window.history.back();</script>";
        exit;
    }
    
    // Ellenőrzés: minden mező kitöltött?
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        echo "<script>alert('Minden mezőt ki kell tölteni!'); window.history.back();</script>";
        exit;
    }
    
    // Email küldési adatok
    $to = "frksgerii@gmail.com";
    $subject = "Új kapcsolatfelvételi űrlap beküldés";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Kapcsolatfelvételi űrlap adatai:\n\n";
    $body .= "Név: $name\n";
    $body .= "Telefonszám: $phone\n";
    $body .= "Email: $email\n";
    $body .= "Üzenet:\n$message\n";

    // Email küldése
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Üzenet sikeresen elküldve!'); window.location.href = '/';</script>";
    } else {
        echo "<script>alert('Hiba történt az üzenet küldése közben. Próbáld újra később!'); window.history.back();</script>";
    }
} else {
    // Ha a fájlt közvetlenül nyitják meg, visszairányítás az űrlaphoz
    header("Location: /");
    exit;
}
?>
