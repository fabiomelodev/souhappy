<?php

namespace App\Services;

use App\Models\Petition;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class PetitionPdfExporter
{
    public function export(Petition $petition): string
    {
        $petition->loadMissing('condominium');

        $signatures = $petition->signatures()->orderBy('signed_at')->get();

        $signaturesPdf = Pdf::loadView('pdf.petition-signatures', [
            'petition' => $petition,
            'signatures' => $signatures,
            'includeContent' => $petition->type === 'text',
        ])->output();

        if ($petition->type !== 'pdf' || blank($petition->pdf_path)) {
            return $signaturesPdf;
        }

        return $this->mergeWithOriginalPdf($petition, $signaturesPdf);
    }

    public function filename(Petition $petition): string
    {
        return 'abaixo-assinado-'.str($petition->title)->slug().'.pdf';
    }

    protected function mergeWithOriginalPdf(Petition $petition, string $signaturesPdf): string
    {
        $originalPath = Storage::disk('public')->path($petition->pdf_path);
        $signaturesTempPath = tempnam(sys_get_temp_dir(), 'petition_signatures_');

        file_put_contents($signaturesTempPath, $signaturesPdf);

        try {
            $pdf = new Fpdi();

            foreach ([$originalPath, $signaturesTempPath] as $sourcePath) {
                $pageCount = $pdf->setSourceFile($sourcePath);

                for ($page = 1; $page <= $pageCount; $page++) {
                    $templateId = $pdf->importPage($page);
                    $size = $pdf->getTemplateSize($templateId);

                    $pdf->AddPage(
                        $size['orientation'],
                        [$size['width'], $size['height']]
                    );

                    $pdf->useTemplate($templateId);
                }
            }

            return $pdf->Output('S');
        } finally {
            @unlink($signaturesTempPath);
        }
    }
}
