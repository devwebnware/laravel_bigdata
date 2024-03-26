<?php

namespace App\Services;

use App\Models\Invoices\Invoice;

class InvoiceNumberGenerationService
{
    /**
     * Generate a new Draft number.
     */
    public function generateDraftNumber($currDraftNumber): string
    {
        if (! $currDraftNumber) {
            $newDraftNo = 'DRF001';
        } else {
            while (true) {
                $draftNo = intval(trim(substr($currDraftNumber, strripos($currDraftNumber, 'F') + 1))) + 1;
                if ($draftNo < 10) {
                    $newDraftNo = 'DRF00'.$draftNo;
                } elseif ($draftNo < 100) {
                    $newDraftNo = 'DRF0'.$draftNo;
                } else {
                    $newDraftNo = 'DRF'.$draftNo;
                }
                $existingDraft = Invoice::where('proforma_number', $newDraftNo)->first();
                if (! $existingDraft) {
                    break;
                }

                $currDraftNumber = $newDraftNo;
            }
        }

        return $newDraftNo;
    }

    /**
     * Generate a new Proforma number.
     */
    public function generateProformaNumber($currProformaNumber, $prefix): string
    {
        if (! $currProformaNumber) {
            $newProformaNo = $prefix.'0001';
        } else {
            while (true) {
                $intProformaNo = intval(trim(substr($currProformaNumber, strripos($currProformaNumber, 'F') + 3))) + 1;

                if ($intProformaNo < 10) {
                    $newProformaNo = $prefix.'000'.$intProformaNo;
                } elseif ($intProformaNo < 100) {
                    $newProformaNo = $prefix.'00'.$intProformaNo;
                } elseif ($intProformaNo < 1000) {
                    $newProformaNo = $prefix.'0'.$intProformaNo;
                } else {
                    $newProformaNo = $prefix.$intProformaNo;
                }

                $existingProforma = Invoice::where('proforma_number', $newProformaNo)->first();
                if (! $existingProforma) {
                    break;
                }

                $currProformaNumber = $newProformaNo;
            }
        }

        return $newProformaNo;
    }

    /**
     * Generate a new Invoice number.
     */
    public function generateInvoiceNumber($currInvoiceNumber, $prefix): string
    {
        if (! $currInvoiceNumber) {
            $newInvoiceNo = $prefix.'0001';
        } else {
            while (true) {
                $intInvoiceNo = intval(trim(substr($currInvoiceNumber, strripos($currInvoiceNumber, 'N') + 3))) + 1;

                if ($intInvoiceNo < 10) {
                    $newInvoiceNo = $prefix.'000'.$intInvoiceNo;
                } elseif ($intInvoiceNo < 100) {
                    $newInvoiceNo = $prefix.'00'.$intInvoiceNo;
                } elseif ($intInvoiceNo < 1000) {
                    $newInvoiceNo = $prefix.'0'.$intInvoiceNo;
                } else {
                    $newInvoiceNo = $prefix.$intInvoiceNo;
                }

                $existingInvoice = Invoice::where('invoice_number', $newInvoiceNo)->first();
                if (! $existingInvoice) {
                    break;
                }

                $currInvoiceNumber = $newInvoiceNo;
            }
        }

        return $newInvoiceNo;
    }
}
