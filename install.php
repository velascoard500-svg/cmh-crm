<?php
if (!file_exists(__DIR__.'/config.php')) {
  if (file_exists(__DIR__.'/config.example.php')) copy(__DIR__.'/config.example.php', __DIR__.'/config.php');
}
require __DIR__.'/app/bootstrap.php';
$sql = file_get_contents(__DIR__.'/database/schema.sql');
$pdo->exec($sql);
$email='admin@cmhproyectos.com';
$exists=$pdo->prepare('SELECT id FROM users WHERE email=?');$exists->execute([$email]);
if(!$exists->fetch()){
  $pdo->prepare('INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)')->execute(['Administrador CMH',$email,password_hash('admin123', PASSWORD_DEFAULT),'admin']);
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Instalación CMH CRM</title><link rel="stylesheet" href="public/assets/style.css"></head><body><div class="login panel"><h1>CMH CRM instalado</h1><p>Usuario inicial:</p><p><b>admin@cmhproyectos.com</b></p><p>Contraseña:</p><p><b>admin123</b></p><p>Por seguridad, elimina o renombra <b>install.php</b> después de iniciar sesión.</p><a class="btn" href="login.php">Entrar al CRM</a></div></body></html>
