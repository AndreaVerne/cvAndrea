<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/src/Exception.php';
require __DIR__ . '/src/PHPMailer.php';
require __DIR__ . '/src/SMTP.php';

// Establecer la codificación a UTF-8
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');

function mail2($from, $subject, $message, $headers = [], $params = "")
{

    $mail = new PHPMailer(true);
    //Mail al que quiero que lleguen las consultas
    $to = 'admin@andreaverne.com.ar';
    // $to = 'anddi.verne.1996@gmail.com';

    try {
        // $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
        $mail->isSMTP();
        $mail->Host = 'andreaverne.com.ar';  // Host de conexión SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'admin@andreaverne.com.ar';                 // Usuario SMTP
        $mail->Password = 'Lasheras1150';  // Password SMTP                      
        $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
        $mail->Port = 587;                                    // Puerto SMTP

        $mail->SMTPOptions = ['ssl' => ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
        $mail->SMTPSecure = false;             // Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
        $mail->SMTPAutoTLS = false;            // Descomentar si se requiere desactivar completamente TLS (sin cifrado)

        $mail->setFrom($from);      // Mail del remitente

        if (strpos($to, ',') !== false) {
            $dires = explode(',', $to);
            foreach ($dires as $direc) {
                $mail->addAddress(trim($direc));
            }
        } else {
            $mail->addAddress($to);     // Mail del destinatario
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;  // Asunto del mensaje
        $mail->Body    = $message;    // Contenido del mensaje (acepta HTML)
        //$mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

        $mail->send();

        // -------- mensaje de ok --------
        echo '<div class="message-container">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ed719e" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>';
        // echo '<p>Gracias por contactarse con nosotros, el mensaje se ha enviado con éxito</p>';
        echo '<p>Serás redirigido a nuestro sitio en 5 segundos. Si no, haz clic <a href="index.php">aquí</a>.</p>';
        echo '</div>';
?>
        <script>
            setTimeout(function() {
                window.location.href = 'index.php'; // Redirige a index.php después de 5 segundos
            }, 5000);
        </script>
<?php

        return true;
    } catch (Exception $e) {
        echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
        die();
        return false;
    }
}

//genero el mensaje del mail
$mensaje = "Hola, mi nombre es ";
$mensaje .= mb_convert_encoding($_POST["nombre"], 'UTF-8', 'auto');
$mensaje .= ", y tengo la siguiente consulta: <br>";
$mensaje .= mb_convert_encoding($_POST["mensaje"], 'UTF-8', 'auto');
$mensaje .= "<br> Mi telefono de contacto es: ";
$mensaje .= $_POST["telefono"];

//llamo a la función 
mail2($_POST['email'], "Mensaje de su sitio", $mensaje);
// mail2('anddi.verne@hotmail.com', "Mensaje de su sitio", 'prueba');

?>

<style>
    body {
        background-color: #ff60b11f;
    }

    .message-container {
        text-align: center;
        padding: 20px;
        border-radius: 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
    }
</style>