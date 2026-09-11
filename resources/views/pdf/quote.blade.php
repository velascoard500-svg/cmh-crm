<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>{{ $quote->folio }}</title>
<style>
@page { margin: 22px 24px 26px; }
body { font-family: DejaVu Sans, sans-serif; color:#171717; font-size:9.5px; margin:0; }
table { width:100%; border-collapse:collapse; }
.brand { font-size:28px; font-weight:800; letter-spacing:.6px; }
.brand-accent { color:#b87828; }
.kicker { font-size:9px; letter-spacing:2px; color:#555; }
.hero { border-bottom:3px solid #b87828; padding-bottom:12px; margin-bottom:14px; }
.hero-right { text-align:right; vertical-align:top; }
.doc-title { font-size:24px; font-weight:800; margin:6px 0 2px; }
.folio-card { background:#f6eadc; border-radius:10px; padding:10px 14px; display:inline-block; min-width:210px; }
.folio-label { font-size:9px; color:#555; }
.folio { font-size:20px; font-weight:800; color:#191919; }
.panel { border:1px solid #d9d9d9; border-radius:8px; margin-bottom:12px; overflow:hidden; }
.panel-title { background:#272727; color:white; padding:7px 10px; font-weight:700; font-size:11px; }
.panel-body { padding:10px; }
.meta td { padding:4px 6px; vertical-align:top; border-bottom:1px solid #eeeeee; }
.meta tr:last-child td { border-bottom:none; }
.label { font-weight:700; }
.items th { background:#272727; color:white; padding:7px 5px; font-size:9px; }
.items td { border:1px solid #dedede; padding:7px 5px; vertical-align:top; }
.num { text-align:right; white-space:nowrap; }
.total-wrap { margin-top:10px; }
.total-box { width:42%; margin-left:auto; border:1px solid #ddd; border-radius:8px; overflow:hidden; }
.total-box td { padding:6px 8px; border-bottom:1px solid #e8e8e8; }
.total-box tr:last-child td { border-bottom:none; }
.total-final td { background:#f6eadc; font-size:13px; font-weight:800; }
.note { white-space:pre-line; line-height:1.45; }
.signature { height:70px; text-align:center; vertical-align:bottom; color:#444; }
.signature-line { border-top:1px solid #777; width:220px; margin:0 auto 4px; }
.footer { position:fixed; left:0; right:0; bottom:-8px; text-align:center; color:#666; font-size:8px; }
.contact-bar { background:#272727; color:white; padding:8px 10px; margin-top:12px; }
.contact-bar td { color:white; }
.woodbar { background:#c69b6d; color:#1d1d1d; text-align:center; padding:7px; font-size:9px; letter-spacing:.5px; }
.small { font-size:8px; color:#666; }
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
        <div class="folio-label">COTIZACIÓN</div>
        <div class="folio">{{ $quote->folio }}</div>
        <div class="small">Fecha: {{ optional($quote->quote_date)->format('d/m/Y') }}</div>
    </div>
</td>
</tr>
</table>

<div class="doc-title">COTIZACIÓN</div>
<div class="small" style="margin-bottom:12px;">Propuesta comercial personalizada</div>

<table style="margin-bottom:12px;">
<tr>
<td style="width:49%; vertical-align:top;">
    <div class="panel">
        <div class="panel-title">DATOS DEL CLIENTE</div>
        <div class="panel-body">
            <table class="meta">
                <tr><td class="label">Cliente</td><td>{{ $quote->client?->name }}</td></tr>
                <tr><td class="label">Empresa</td><td>{{ $quote->client?->business_name ?: '-' }}</td></tr>
                <tr><td class="label">Teléfono</td><td>{{ $quote->client?->phone ?: '-' }}</td></tr>
                <tr><td class="label">Correo</td><td>{{ $quote->client?->email ?: '-' }}</td></tr>
            </table>
        </div>
    </div>
</td>
<td style="width:2%"></td>
<td style="width:49%; vertical-align:top;">
    <div class="panel">
        <div class="panel-title">DETALLES DE LA COTIZACIÓN</div>
        <div class="panel-body">
            <table class="meta">
                <tr><td class="label">Estado</td><td>{{ ucfirst($quote->status) }}</td></tr>
                <tr><td class="label">Vigencia</td><td>{{ $quote->valid_until ? $quote->valid_until->format('d/m/Y') : '-' }}</td></tr>
                <tr><td class="label">Tiempo de entrega</td><td>{{ $quote->delivery_time ?: 'Por confirmar' }}</td></tr>
                <tr><td class="label">Folio</td><td>{{ $quote->folio }}</td></tr>
            </table>
        </div>
    </div>
</td>
</tr>
</table>

<div class="panel">
    <div class="panel-title">PARTIDAS</div>
    <div class="panel-body" style="padding:0;">
        <table class="items">
            <thead>
                <tr>
                    <th style="width:45%">Descripción</th>
                    <th style="width:10%">Cantidad</th>
                    <th style="width:12%">Unidad</th>
                    <th style="width:16%">P. unitario</th>
                    <th style="width:17%">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quote->items as $item)
                    @php($importe=(float)$item->quantity*(float)$item->unit_price)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td class="num">{{ number_format((float)$item->quantity,2) }}</td>
                        <td>{{ $item->unit }}</td>
                        <td class="num">${{ number_format((float)$item->unit_price,2) }}</td>
                        <td class="num">${{ number_format($importe,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<table class="total-wrap">
<tr>
<td style="width:56%; vertical-align:top;">
    @if($quote->notes)
    <div class="panel">
        <div class="panel-title">NOTAS Y CONDICIONES</div>
        <div class="panel-body note">{{ $quote->notes }}</div>
    </div>
    @endif

    <div class="panel">
        <div class="panel-title">CONDICIONES COMERCIALES</div>
        <div class="panel-body">
            <div>• Fabricación sobre pedido.</div>
            <div>• El tiempo de producción depende del modelo solicitado.</div>
            <div>• Cambios posteriores a la autorización pueden modificar costo y entrega.</div>
        </div>
    </div>
</td>
<td style="width:2%"></td>
<td style="width:42%; vertical-align:top;">
    <table class="total-box">
        <tr><td>Subtotal</td><td class="num">${{ number_format((float)$quote->subtotal,2) }}</td></tr>
        <tr><td>Descuento</td><td class="num">${{ number_format((float)$quote->discount,2) }}</td></tr>
        <tr class="total-final"><td>TOTAL</td><td class="num">${{ number_format((float)$quote->total,2) }}</td></tr>
    </table>
</td>
</tr>
</table>

<div class="panel" style="margin-top:12px;">
    <div class="panel-title">DATOS PARA TRANSFERENCIA</div>
    <div class="panel-body">
        <table class="meta">
            <tr><td class="label">Banco</td><td>BBVA Bancomer</td><td class="label">Beneficiario</td><td>Diego Velasco Arango</td></tr>
            <tr><td class="label">CLABE</td><td colspan="3">012 680 004696840936</td></tr>
        </table>
    </div>
</div>

<table style="margin-top:18px;">
<tr>
<td class="signature">
    <div class="signature-line"></div>
    Autorización del cliente
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
<div class="woodbar">COMPRA DIRECTO DE FÁBRICA · FABRICAMOS DISEÑOS PERSONALIZADOS</div>

<div class="footer">Documento generado desde CMH CRM</div>
</body>
</html>