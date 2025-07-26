<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = htmlspecialchars($_POST['nom']);
  $commune = htmlspecialchars($_POST['commune']);
  $date = htmlspecialchars($_POST['date']);
  $temoignage = htmlspecialchars($_POST['temoignage']);
  $consentement = isset($_POST['consentement']) ? 'Oui' : 'Non';

  $to = "temoignage@guyavenir.com";
  $subject = "📩 Nouveau témoignage citoyen";
  $message = "Nom (optionnel) : $nom\nCommune : $commune\nDate : $date\nConsentement : $consentement\n\nTémoignage :\n$temoignage";
  $headers = "From: formulaire@guyavenir.com";

  if (mail($to, $subject, $message, $headers)) {
    echo "<p style='font-family:sans-serif;'>✔️ Merci pour votre témoignage. Il a bien été envoyé.</p>";
  } else {
    echo "<p style='font-family:sans-serif;'>❌ Une erreur est survenue. Essayez plus tard.</p>";
  }

  $file_name = $_FILES['preuve']['name'];
$file_tmp = $_FILES['preuve']['tmp_name'];

if (!empty($file_name)) {
  $destination = "uploads/" . basename($file_name); // dossier à créer sur ton serveur
  move_uploaded_file($file_tmp, $destination);
  $message .= "\n\nPreuve jointe : $file_name";

}
?>
