<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){

        $departements = Departement::all()->count();
        $employes = Employe::all()->count();
        $admin = User::all()->count();


        $defaultPaymentDate = null;
        $paymentNotification = "";
        //  $appName = Configuration::where('type','APP_NAME')->first();

        $currentDate = Carbon::now()->day;

        $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();

        if ($defaultPaymentDateQuery) {
            $defaultPaymentDate = $defaultPaymentDateQuery->value;
            $convertedPaymentDate = intval($defaultPaymentDate);

            if ($currentDate < $convertedPaymentDate) {
                $paymentNotification = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " de ce mois";
            } else {
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->format('F');
                $paymentNotification = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " du mois de " . $nextMonthName;
            }
        }

        return view('dashboard', compact('departements', 'employes', 'admin', 'paymentNotification'));
    }
}
