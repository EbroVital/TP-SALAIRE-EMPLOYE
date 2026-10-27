@extends('layouts.template')

@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">

        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Paiments</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('dashboard')}}">
                                    Retour au tableau de bord
                                </a>
                            </div>

                            <div class="col-auto">

                                @if ($isPaymentDay)

                                    <a class="btn app-btn-secondary" href="{{ route('payment.initPayment')}}">
                                        Lancer les paiements
                                    </a>

                                @endif

                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div>

            <div class="row mt-2 mb-2 p-2">
                @if (Session::get('info'))
                    <div class="alert alert-success text-center" role="alert">
                        <b> {{ Session::get('info') }} </b>
                    </div>
                @endif
            </div>


            @if (!$isPaymentDay)

                <div class="alert alert-danger text-center" role="alert">
                    <b>  Vous ne pourrez effectuer de paiement qu'a la date du paiement  </b>
                </div>

            @endif


            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="text text-center">Référence</th>
                                            <th class="text text-center">Employé</th>
                                            <th class="text text-center">Montant payé</th>
                                            <th class="text text-center">Date de transaction</th>
                                            <th class="text text-center">Mois</th>
                                            <th class="text text-center">Année</th>
                                            <th class="text text-center">Statut</th>
                                            <th class="text text-center"> </th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @forelse ($payments as $payment)

                                            <tr>
                                                <td class="text text-center"> {{ $payment->reference }} </td>
                                                <td class="text text-center"> {{ $payment->employe->nom }}
                                                    {{ $payment->employe->prenom }}  </td>
                                                <td class="text text-center"> {{ $payment->amount }}  FCFA</td>

                                                <td class="text text-center"> {{ date('d-m-Y', strtotime($payment->done_time)) }}  </td>

                                                <td class="text text-center"> {{ $payment->month }}  </td>
                                                <td class="text text-center"> {{ $payment->year }}  </td>
                                                <td class="text text-center">
                                                    <div class="btn btn-success">
                                                        {{ $payment->status}}
                                                    </div>
                                                </td>

                                                <th class="text text-center">
                                                    <a href="{{route('payment.download', $payment->id)}}">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </th>


                                            </tr>

                                        @empty

                                            <tr>
                                                <td class="text text-center" colspan="8" style="text-align:center;">Aucune transaction effectuée</td>
                                            </tr>

                                        @endforelse

                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $payments->links()}}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->


            </div>

        </div>

    </div>

@endsection
