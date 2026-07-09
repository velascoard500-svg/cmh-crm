<?php require __DIR__.'/app/bootstrap.php'; require __DIR__.'/app/layout.php'; require_login();
$leads=$pdo->query('SELECT * FROM leads ORDER BY id DESC LIMIT 8')->fetchAll(PDO::FETCH_ASSOC);
$totalLeads=$pdo->query('SELECT COUNT(*) FROM leads')->fetchColumn();
$totalClients=$pdo->query('SELECT COUNT(*) FROM clients')->fetchColumn();
$pipeline=$pdo->query("SELECT COALESCE(SUM(amount),0) FROM leads WHERE stage NOT IN ('Entregado','Perdido')")->fetchColumn();
$quotes=$pdo->query("SELECT COUNT(*) FROM leads WHERE stage='Cotización'")->fetchColumn();
layout_header('Dashboard'); ?>
<div class="grid cards"><div class="card"><div class="label">Prospectos</div><div class="metric"><?=$totalLeads?></div></div><div class="card"><div class="label">Clientes</div><div class="metric"><?=$totalClients?></div></div><div class="card"><div class="label">Cotizaciones</div><div class="metric"><?=$quotes?></div></div><div class="card"><div class="label">Pipeline</div><div class="metric"><?=money($pipeline)?></div></div></div>
<div class="panel" style="margin-top:18px"><h3>Prospectos recientes</h3><table><tr><th>Cliente</th><th>Producto</th><th>Etapa</th><th>Monto</th><th>Acción</th></tr><?php foreach($leads as $l): ?><tr><td><?=e($l['client_name'])?><br><small><?=e($l['phone'])?></small></td><td><?=e($l['product'])?></td><td><span class="pill"><?=e($l['stage'])?></span></td><td><?=money($l['amount'])?></td><td><a class="wa" target="_blank" href="https://wa.me/52<?=preg_replace('/\D/','',$l['phone'])?>">WhatsApp</a></td></tr><?php endforeach; ?></table></div>
<?php layout_footer(); ?>
