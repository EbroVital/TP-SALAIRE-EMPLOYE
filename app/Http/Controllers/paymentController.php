<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Employe;
use App\Models\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;

class paymentController extends Controller
{
    public function index(){

        $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();
        $defaultPaymentDate = $defaultPaymentDateQuery->value;
        $convertedPaymentDate = intval($defaultPaymentDate);

        $today = date('d');

        $isPaymentDay = false ;

        if($today ==  $convertedPaymentDate){
            $isPaymentDay = true ;
        }

        $payments = Payment::latest()->orderBy('id','desc')->paginate(10);
        return view('paiement.index', compact('payments', 'isPaymentDay'));
    }


    public function initPayment(){

        $monthMapping = [
            'JANUARY' => 'JANVIER',
            'FEBRUARY'=>'FEVRIER' ,
            'MARCH'=>'MARS' ,
            'APRIL'=>'AVRIL' ,
            'MAY'=>'MAI' ,
            'JUNE'=>'JUIN',
            'JULY'=>'JUILLET',
            'AUGUST'=>'AOUT' ,
            'SEPTEMBER'=>'SEPTEMBRE',
            'OCTOBER'=>'OCTOBRE' ,
            'NOVEMBER'=>'NOVEMBRE' ,
            'DECEMBER'=>'DECEMBRE'
        ];

        $currentMonth = strtoupper(Carbon::now()->formatLocalized('%B'));

        // mois en cour en français
        $currentMonthInFrench = $monthMapping[$currentMonth] ?? '';

        // année en cour
        $currentYear = Carbon::now()->format('Y');


        // simuler les paiements pour les employés dans le mois en cour, les paiements concernent les employés qui n'ont pas encore été payé dans le mois actuel.

        //  la liste des employés qui n'ont pas été payé pour le mois en cour
        $employes = Employe::whereDoesntHave('payments', function($query) use ($currentMonthInFrench, $currentYear){

            $query->where('month', '=' , $currentMonthInFrench)->where('year','=', $currentYear);

        })->get();

        if($employes->count() == 0){
            return redirect()->back()->with('info', 'Tous les employés ont été payés pour ce mois de ' . $currentMonthInFrench);
        }

        // faire les paiements pour ces employés

        foreach($employes as $employe){

            $hasBeenPaid = $employe->payments()->where('month', '=' , $currentMonthInFrench)->where('year','=', $currentYear)->exists();

            if(!$hasBeenPaid){
                $salaire = $employe->montant_journalier * 31;

                DB::table('payments')->insert([
                    'reference' => strtoupper(Str::random(10)),
                    'employe_id' => $employe->id,
                    'amount'=> $salaire,
                    'lauch_date'=> now(),
                    'done_time' => now(),
                    'status' => 'SUCCESS',
                    'month' => $currentMonthInFrench,
                    'year' => $currentYear,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // $payment->save();

            }
        }

        // rediriger

        return back()->with('info','Paiement des employés effectués pour le mois de ' . $currentMonthInFrench);

    }


    public function downloadInvoice(Payment $payment){

        try {

            $fullPaymentInfo = Payment::with('employe')->find($payment->id);

            // générer le PDF
            // return view('paiement.facture', compact('fullPaymentInfo'));

            $pdf = PDF::loadView('paiement.facture', compact('fullPaymentInfo'));
            $filename = 'facture_' . $fullPaymentInfo->employe->nom . '.pdf';
            return $pdf->download($filename);


        } catch (\Exception $e) {
             throw new Exception('une erreur est survenue lors du téléchargement de la facture');
            // dd($e);
        }

    }


}
