@extends('layouts.template')

@section('content')


    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Employés</h1>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">Ajout</h3>
                        <div class="section-intro">Ajouter ici un nouvel employé</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <form class="settings-form" method="POST" action="{{ route('employe.store')}}">

                                    @csrf
                                    @method('POST')


                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Département : </label>
                                        <select name="departement_id" id="departement_id" class="form-control">
                                            <option value="">Choisissez un département</option>

                                            @foreach ($departements as $departement)
                                                <option value="{{ $departement->id}}">
                                                    {{ $departement->name}}
                                                </option>
                                            @endforeach

                                        </select>

                                        @error('departement_id')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror

                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Nom :
                                            <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                                </label>
                                        <input type="text" class="form-control" id="setting-input-1" placeholder="Entrez le nom de l'employé" value="{{old('nom')}}" name="nom" required>



                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Prénoms :</label>
                                        <input type="text" class="form-control" id="setting-input-2" placeholder="Entrez le prenom" required value="{{ old('prenom')}}" name="prenom">


                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Email : </label>
                                        <input type="email" class="form-control" id="setting-input-3" name="email" placeholder="Entrez le Email" value="{{ old ('email')}}">

                                        @error('email')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror

                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Contact : </label>
                                        <input type="text" class="form-control" id="setting-input-3" name="contact" placeholder="Entrez le contact" value="{{old('contact')}}">

                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Montant Journalier : </label>
                                        <input type="number" class="form-control" id="setting-input-3" name="montant" placeholder="Entrez le montant journalier" value="{{old('montant')}}">

                                        @error('montant')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror

                                    </div>
                                    <button type="submit" class="btn app-btn-primary" >Enregistrer</button>
                                    <a href="{{route('employe.index')}}" class="btn app-btn-secondary">Annuler</a>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->




            </div>
        </div>
    </div>





@endsection
