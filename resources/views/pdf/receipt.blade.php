<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>{{ $receipt->folio }}</title>
<style>
@page { margin:22px 24px 26px; }
body { font-family:DejaVu Sans,sans-serif; color:#171717; font-size:9.5px; margin:0; }
table { width:100%; border-collapse:collapse; }
.brand { font-size:28px; font-weight:800; letter-spacing:.6px; }
.brand-accent { color:#b87828; }
.kicker { font-size:9px; letter-spacing:2px; color:#555; }
.hero { border-bottom:3px solid #b87828; padding-bottom:12px; margin-bottom:14px; }
.hero-right { text-align:right; vertical-align:top; }
.doc-title { font-size:24px; font-weight:800; margin:6px 0 2px; }
.folio-card { background:#f6eadc; border-radius:10px; padding:10px 14px; display:inline-block; min-width:210px; }
.folio-label { font-size:9px; color:#555; }
.folio { font-size:20px; font-weight:800; }
.panel { border:1px solid #d9d9d9; border-radius:8px; margin-bottom:12px; overflow:hidden; }
.panel-title { background:#272727; color:white; padding:7px 10px; font-weight:700; font-size:11px; }
.panel-body { padding:10px; }
.meta td { padding:4px 6px; vertical-align:top; border-bottom:1px solid #eeeeee; }
.meta tr:last-child td { border-bottom:none; }
.label { font-weight:700; }
.amount-card { background:#f6eadc; border-radius:8px; padding:14px; }
.amount-title { font-size:11px; font-weight:700; }
.amount { font-size:25px; font-weight:800; margin-top:6px; }
.balance td { padding:7px 8px; border-bottom:1px solid #eee; }
.balance tr:last-child td { border-bottom:none; background:#f6eadc; font-size:12px; font-weight:800; }
.signature { height:80px; text-align:center; vertical-align:bottom; }
.signature-line { border-top:1px solid #777; width:220px; margin:0 auto 4px; }
.contact-bar { background:#272727; color:white; padding:8px 10px; margin-top:12px; }
.contact-bar td { color:white; }
.woodbar { background:#c69b6d; color:#1d1d1d; text-align:center; padding:7px; font-size:9px; letter-spacing:.5px; }
.small { font-size:8px; color:#666; }
.footer { position:fixed; left:0; right:0; bottom:-8px; text-align:center; color:#666; font-size:8px; }
</style>
</head>
<body>

<table class="hero">
<tr>
<td style="width:58%; vertical-align:top;">
    <div class="brand">CMH <span class="brand-accent">PROYECTOS</span></div>
    <div class="kicker">DIVISIÓN CARPINTERÍA</div>
    <div class="small">DISEÑAMOS · FABRICAMOS · TU ESPACIO</div>
</td>
<td class="hero-right" style="width:42%;">
    <div class="folio-card">
        <div class="folio-label">RECIBO DE PAGO</div>
        <div class="folio">{{ $receipt->folio }}</div>
        <div class="small">Fecha: {{ optional($receipt->payment_date)->format('d/m/Y') }}</div>
    </div>
</td>
</tr>
</table>

<div class="doc-title">RECIBO DE PAGO</div>
<div class="small" style="margin-bottom:12px;">Gracias por tu confianza</div>

<table style="margin-bottom:12px;">
<tr>
<td style="width:49%; vertical-align:top;">
    <div class="panel">
        <div class="panel-title">DATOS DEL CLIENTE</div>
        <div class="panel-body">
            <table class="meta">
                <tr><td class="label">Cliente</td><td>{{ $receipt->quote?->client?->name }}</td></tr>
                <tr><td class="label">Empresa</td><td>{{ $receipt->quote?->client?->business_name ?: '-' }}</td></tr>
                <tr><td class="label">Teléfono</td><td>{{ $receipt->quote?->client?->phone ?: '-' }}</td></tr>
                <tr><td class="label">Correo</td><td>{{ $receipt->quote?->client?->email ?: '-' }}</td></tr>
            </table>
        </div>
    </div>
</td>
<td style="width:2%"></td>
<td style="width:49%; vertical-align:top;">
    <div class="panel">
        <div class="panel-title">DETALLES DEL PAGO</div>
        <div class="panel-body">
            <table class="meta">
                <tr><td class="label">Cotización</td><td>{{ $receipt->quote?->folio }}</td></tr>
                <tr><td class="label">Fecha</td><td>{{ optional($receipt->payment_date)->format('d/m/Y') }}</td></tr>
                <tr><td class="label">Forma de pago</td><td>{{ ucfirst($receipt->payment_method) }}</td></tr>
                <tr><td class="label">Referencia</td><td>{{ $receipt->reference ?: '-' }}</td></tr>
            </table>
        </div>
    </div>
</td>
</tr>
</table>

<table style="margin-bottom:12px;">
<tr>
<td style="width:49%; vertical-align:top;">
    <div class="amount-card">
        <div class="amount-title">MONTO RECIBIDO</div>
        <div class="amount">${{ number_format((float)$receipt->amount,2) }} MXN</div>
    </div>
</td>
<td style="width:2%"></td>
<td style="width:49%; vertical-align:top;">
    <div class="panel">
        <div class="panel-title">ESTADO DE LA COTIZACIÓN</div>
        <div class="panel-body" style="padding:0;">
            <table class="balance">
                <tr><td>Total de cotización</td><td style="text-align:right;">${{ number_format((float)$receipt->quote?->total,2) }}</td></tr>
                <tr><td>Total pagado</td><td style="text-align:right;">${{ number_format((float)$receipt->quote?->paid,2) }}</td></tr>
                <tr><td>Saldo pendiente</td><td style="text-align:right;">${{ number_format((float)$receipt->quote?->balance,2) }}</td></tr>
            </table>
        </div>
    </div>
</td>
</tr>
</table>

<div class="panel">
    <div class="panel-title">CONCEPTO</div>
    <div class="panel-body">
        Pago correspondiente a la cotización {{ $receipt->quote?->folio }}.
        @if($receipt->notes)
        <br><br>{{ $receipt->notes }}
        @endif
    </div>
</div>

<table style="margin-top:26px;">
<tr>
<td class="signature">
    <div class="signature-line"></div>
    Nombre y firma
</td>
<td class="signature">
    <div class="signature-line"></div>
    CMH Proyectos
</td>
</tr>
</table>

<table class="contact-bar">
<tr>
<td style="text-align:left;">Tel. 442 526 7129</td>
<td style="text-align:right;">CMH Proyectos · Querétaro</td>
</tr>
</table>
<div class="woodbar">CALIDAD · DISEÑO · CONFIANZA</div>

<div class="footer">Documento generado desde CMH CRM</div>
</body>
</html>