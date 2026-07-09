<?php
require_once __DIR__.'/app/db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
$pdo=db();
$sql=file_get_contents(__DIR__.'/schema.sql');
$pdo->exec($sql);
$hash=password_hash($_POST['password'] ?: 'admin123', PASSWORD_DEFAULT);
$st=$pdo->prepare("INSERT IGNORE INTO users (name,email,password_hash,role,active) VALUES (?,?,?,?,1)");
$st->execute([$_POST['name'] ?: 'Administrador', $_POST['email'] ?: 'admin@cmhproyectos.com', $hash, 'admin']);
$pdo->prepare("INSERT INTO settings (`key`,`value`) VALUES ('company',?),('phone',?),('bank_name',?),('bank_account_name',?),('bank_clabe',?) ON DUPLICATE KEY UPDATE value=VALUES(value)")->execute([cfg()['company'],cfg()['phone'],cfg()['bank_name'],cfg()['bank_account_name'],cfg()['bank_clabe']]);
header('Location: login.php?installed=1'); exit;
}
?><!doctype html><html><head><meta charset="utf-8"><title>Instalar CRM</title><link rel="stylesheet" href="assets/style.css"></head><body><div class="login card"><h1>Instalar CMH CRM</h1><p>Antes de continuar, copia <b>config.example.php</b> como <b>config.php</b> y coloca los datos de MySQL.</p><form method="post"><label>Nombre administrador</label><input name="name" value="Administrador"><label>Email</label><input name="email" value="admin@cmhproyectos.com"><label>Contraseña</label><input name="password" value="admin123"><br><br><button class="btn red">Crear tablas e instalar</button></form></div></body></html>
