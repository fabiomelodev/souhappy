<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1f2937;
        }

        h1 {
            font-size: 18px;
            margin: 0 0 4px;
        }

        h2 {
            font-size: 14px;
            margin: 24px 0 8px;
        }

        .meta {
            color: #6b7280;
            font-size: 11px;
            margin: 0 0 16px;
        }

        .content {
            line-height: 1.6;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            font-size: 11px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f3f4f6;
        }

        .signature-cell {
            width: 110px;
        }

        .signature-cell img {
            height: 36px;
        }

        .date-cell {
            width: 90px;
            white-space: nowrap;
        }

        .empty {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <h1>{{ $petition->title }}</h1>
    <p class="meta">
        {{ $petition->condominium->name }}
        &middot; {{ $signatures->count() }} {{ $signatures->count() === 1 ? 'assinatura' : 'assinaturas' }}
        @if ($petition->published_at)
            &middot; Publicado em {{ $petition->published_at->timezone(config('app.display_timezone'))->format('d/m/Y H:i') }}
        @endif
        @if ($petition->deadline_at)
            &middot; Prazo final: {{ $petition->deadline_at->timezone(config('app.display_timezone'))->format('d/m/Y H:i') }}
        @endif
        &middot; Exportado em {{ now()->timezone(config('app.display_timezone'))->format('d/m/Y H:i') }}
    </p>

    @if ($includeContent)
        <div class="content">{!! $petition->content !!}</div>
    @endif

    <h2>Assinaturas</h2>

    @if ($signatures->isEmpty())
        <p class="empty">Nenhuma assinatura registrada até o momento.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nome completo</th>
                    <th>Torre</th>
                    <th>Apartamento</th>
                    <th class="signature-cell">Assinatura</th>
                    <th class="date-cell">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($signatures as $signature)
                    <tr>
                        <td>{{ $signature->full_name }}</td>
                        <td>{{ $signature->tower }}</td>
                        <td>{{ $signature->apartment_number }}</td>
                        <td class="signature-cell">
                            <img src="{{ $signature->signatureAbsolutePath() }}" alt="Assinatura de {{ $signature->full_name }}">
                        </td>
                        <td class="date-cell">{{ $signature->signed_at->timezone(config('app.display_timezone'))->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
