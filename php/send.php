<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validar los datos
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Configurar los detalles del correo
        $to = "facundonic.gonzalez@gmail.com"; // Reemplaza con tu dirección de correo
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Componer el correo
        $email_subject = "Nuevo mensaje de: $name - $subject";
        $email_body = "<h2>Nuevo mensaje de contacto</h2>
                        <p><strong>Nombre:</strong> $name</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Asunto:</strong> $subject</p>
                        <p><strong>Mensaje:</strong><br>$message</p>";

        // Enviar el correo
        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "Gracias, tu mensaje ha sido enviado.";
        } else {
            echo "Lo sentimos, no se pudo enviar tu mensaje. Intenta nuevamente más tarde.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
