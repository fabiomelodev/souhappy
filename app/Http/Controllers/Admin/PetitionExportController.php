<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petition;
use App\Services\PetitionPdfExporter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetitionExportController extends Controller
{
    public function __invoke(Request $request, Petition $petition, PetitionPdfExporter $exporter): Response
    {
        $user = $request->user();

        abort_unless($user?->isCouncilMember() && $user->condominium_id === $petition->condominium_id, 403);

        $pdf = $exporter->export($petition);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$exporter->filename($petition).'"',
        ]);
    }
}
