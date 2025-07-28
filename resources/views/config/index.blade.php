@extends('layouts.template')

@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">

        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Configurations</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div><!--//col-->
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('configuration.create')}}">
                                    Ajouter une nouvelle configuration
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div>

            <div class="row mt-2 mb-2 p-2">
                @if (Session::get('info'))
                    <div class="alert alert-success" role="alert">
                        <b> {{ Session::get('info') }} </b>
                    </div>
                @endif
            </div>


            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">#</th>
                                            <th class="cell">TYPE</th>
                                            <th class="cell">VALEUR</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($configs as $config)
                                            <tr>
                                                <td class="cell">{{ $config->id }}</td>
                                                <td class="cell"><span class="truncate">
                                                @if ($config->type === 'PAYMENT_DATE')
                                                    Date mensuel de paiement
                                                @endif

                                                @if ($config->type === 'APP_NAME')
                                                    Nom de l'application
                                                @endif

                                                @if ($config->type === 'DEVELOPPER_NAME')
                                                    Equipe de développement
                                                @endif

                                                </td>
                                                <td class="cell"><span class="truncate">{{ $config->value }}

                                                @if ($config->type === 'PAYMENT_DATE')
                                                    de chaque mois
                                                @endif</td>
                                                <td class="cell">
                                                    <a class="btn btn-danger"
                                                        href="{{ route('configuration.delete', $config->id) }}">Supprimer
                                                    </a>
                                                </td>

                                            </tr>
                                         @empty
                                            <tr>
                                                <td class="cell" colspan="4" style="text-align: center;">Aucune configuration enregistrée</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $configs->links() }}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->

            </div>

        </div>

    </div>

@endsection
