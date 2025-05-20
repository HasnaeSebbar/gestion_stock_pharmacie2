<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de Commande - Hôpital Hassan II</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
            margin: 20px;
        }

        .entete {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .entete .gauche,
        .entete .droite {
            font-size: 14px;
            line-height: 1.6;
            width: 30%;
        }

        .entete .droite {
            text-align: right;
            direction: rtl;
        }

        .entete .logo {
            text-align: center;
            width: 30%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            margin-top: 40px;
        }

        .signature p {
            margin-top: 60px;
            border-top: 1px solid #000;
            display: inline-block;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <!-- En-tête bilingue avec logo centré -->
    <div class="entete">
        <div class="gauche">
            <strong>ROYAUME DU MAROC</strong><br>
            Ministère de la Santé<br>
            Délégation Provinciale de Settat<br>
            Hôpital Hassan II de Settat
        </div>
        <div class="logo">
            
            @php $isPdf = $isPdf ?? false; @endphp

             <img src="{{ $isPdf ? public_path('images/logo_ministere_sante.jpg') : asset('images/logo_ministere_sante.jpg') }}" alt="Logo Maroc" style="height: 80px;">
        </div>
        <div class="droite">
            <strong>المملكة المغربية</strong><br>
            وزارة الصحة<br>
            المندوبية الإقليمية بسطات<br>
            مستشفى الحسن الثاني بسطات
        </div>
    </div>

    <div class="header">
        <h1>Hôpital Hassan II - Settat</h1>
        <p><strong>Bon de Commande Fournisseur</strong></p>
    </div>

    <div class="info">
        <p><strong>Date de commande :</strong> {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</p>
        <p><strong>Fournisseur :</strong> {{ $commande->fournisseur->nom }}</p>
        <p><strong>Adresse :</strong> {{ $commande->fournisseur->adresse ?? 'N/A' }}</p>
        <p><strong>Commande N° :</strong> {{ $commande->id }}</p>
        <p><strong>Émise par :</strong> Hôpital Hassan II</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Unité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->produit->nom }}</td>
                    <td>{{ $detail->quantite }}</td>
                    <td>{{ $detail->produit->unite ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Chef de Pharmacie</p>
        </div>
        <div class="signature">
            <p>Représentant du Fournisseur</p>
        </div>
    </div>

</body>
</html>

