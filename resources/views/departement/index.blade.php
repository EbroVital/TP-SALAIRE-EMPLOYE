@extends('layouts.template')

@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">

        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">DEPARTEMENTS</h1>
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
                                <a class="btn app-btn-secondary" href="{{ route('departement.create')}}">
                                    Ajouter un département
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
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
                                            <th class="cell">NOM</th>
                                            <th class="cell"></th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @forelse ($departements as $departement)

                                            <tr>
                                                <td class="cell"> {{ $departement->id }} </td>
                                                <td class="cell"> {{ strtoupper($departement->name)  }} </td>
                                                <td class="cell">
                                                    <a class="btn btn-primary" href="{{ route('departement.edit', $departement->id)}}">Editer</a>
                                                </td>
                                                <td class="cell">
                                                    <a class="btn btn-danger" href="{{ route('departement.delete', $departement->id)}}">Supprimer</a>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td class="cell" colspan="2" style="text-align:center;">Aucun département ajouté</td>
                                            </tr>

                                        @endforelse

                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $departements->links() }}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->

            </div>

        </div>

    </div>

@endsection
