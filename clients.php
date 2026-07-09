<?php require __DIR__.'/app/bootstrap.php'; require __DIR__.'/app/layout.php'; require_login();
if($_SERVER['REQUEST_METHOD']==='POST'){
  $pdo->prepare('INSERT INTO clients(name,phone,email,city,source,notes) VALUES(?,?,?,?,?,?)')->execute([$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['source'],$_POST['notes']]);
  flash('Cliente guardado'); header('Location: clients.php'); exit;
}
$clients=$pdo->query('SELECT * FROM clients ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
layout_header('Clientes'); ?>
<div class="panel"><h3>Nuevo cliente</h3><form method="post" class="form"><div><label>Nombre</label><input name="name" required></div><div><label>Teléfono</label><input name="phone" required></div><div><label>Correo</label><input name="email"></div><div><label>Ciudad</label><input name="city"></div><div><label>Fuente</label><input name="source" value="Facebook Ads"></div><div class="full"><label>Notas</label><textarea name="notes"></textarea></div><div><button>Guardar cliente</button></div></form></div>
<div class="panel" style="margin-top:18px"><table><tr><th>Nombre</th><th>Teléfono</th><th>Ciudad</th><th>Fuente</th><th>Acción</th></tr><?php foreach($clients as $c): ?><tr><td><?=e($c['name'])?></td><td><?=e($c['phone'])?></td><td><?=e($c['city'])?></td><td><?=e($c['source'])?></td><td><a class="wa" target="_blank" href="https://wa.me/52<?=preg_replace('/\D/','',$c['phone'])?>">WhatsApp</a></td></tr><?php endforeach; ?></table></div>
<?php layout_footer(); ?>
