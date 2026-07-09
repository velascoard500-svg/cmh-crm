<?php require __DIR__.'/app/bootstrap.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $st=$pdo->prepare('SELECT * FROM users WHERE email=? LIMIT 1');$st->execute([$_POST['email']??'']);$u=$st->fetch(PDO::FETCH_ASSOC);
  if($u && password_verify($_POST['password']??'', $u['password'])){ $_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']]; header('Location: index.php'); exit; }
  $error='Correo o contraseña incorrectos';
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login CMH CRM</title><link rel="stylesheet" href="public/assets/style.css"></head><body><div class="login panel"><h1>CMH CRM</h1><p>Inicia sesión</p><?php if($error): ?><div class="flash danger"><?=e($error)?></div><?php endif; ?><form method="post"><label>Correo</label><input name="email" type="email" required value="admin@cmhproyectos.com"><br><br><label>Contraseña</label><input name="password" type="password" required value="admin123"><br><br><button>Entrar</button></form></div></body></html>
