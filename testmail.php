<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

// Cargar variables de entorno (para consola, pero en web puede que ya estén en getenv)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Función para obtener variable de entorno con valor por defecto
function env($key, $default = null) {
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    return $value;
}

// Configuración SMTP
$host = env('MAIL_HOST', 'sandbox.smtp.mailtrap.io');
$port = env('MAIL_PORT', 2525);
$encryption = env('MAIL_ENCRYPTION', 'tls');
$username = env('MAIL_USERNAME', '');
$password = env('MAIL_PASSWORD', '');
$fromAddress = env('MAIL_FROM_ADDRESS', 'test@example.com');
$fromName = env('MAIL_FROM_NAME', 'Adrian');

// Crear transporte
$transport = (new EsmtpTransport($host, $port, $encryption === 'tls' || $encryption === 'ssl'))
    ->setUsername($username)
    ->setPassword($password);

$mailer = new Mailer($transport);

// Crear email
$email = (new Email())
    ->from($fromAddress) // o usar new Address($fromAddress, $fromName) si quieres nombre
    ->to('test@test.com')
    ->subject('Prueba desde script')
    ->text('Contenido de prueba');

try {
    $mailer->send($email);
    echo "✅ Enviado correctamente";
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}