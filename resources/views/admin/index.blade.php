@extends('layouts.template')

@section('content')

    <div class="app-content pt-3 p-md-3 p-lg-4">

        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Administrateurs</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            {{-- <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div> --}}
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('dashboard')}}">
                                    Retour au tableau de bord
                                </a>
                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('admin.create')}}">
                                    Ajouter un administrateur
                                </a>
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

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center">#</th> --}}
                                            <th class="text-center">Nom Complet</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @forelse ($admins as $admin)

                                            <tr>
                                                <td class="text-center"> {{ $admin->id }} </td>
                                                <td class="text-center"> {{ $admin->name }} </td>
                                                <td class="text-center"> {{ $admin->email }}</td>
                                                {{-- <td class="text-center"><a class="btn btn-primary" href="{{ route('admin.edit', $admin->id)}}">Editer</a></td> --}}

                                                <td class="text-center"><a class="btn btn-danger" href="{{route('admin.delete', $admin->id)}}">Supprimer</a></td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td class="text-center" colspan="6" style="text-align:center;">Aucun administrateur ajouté</td>
                                            </tr>

                                        @endforelse

                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $admins->links()}}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->

                
            </div>

        </div>

    </div>

@endsection
