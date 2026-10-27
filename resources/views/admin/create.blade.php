@extends('layouts.template')

@section('content')


    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Administrateur</h1>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">Ajout</h3>
                        <div class="section-intro">Ajouter ici un nouvel administrateur</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <form class="settings-form" method="POST" action="{{ route('admin.store')}}">

                                    @csrf
                                    @method('POST')


                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Nom & Prénoms: <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
                                        <input type="text" class="form-control" id="setting-input-1" placeholder="Entrez le nom de l'administrateur" value="{{old('nom')}}" name="nom" required>

                                        @error('nom')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror

                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Email : </label>
                                        <input type="email" class="form-control" id="setting-input-3" name="email" placeholder="Entrez le Email" value="{{ old ('email')}}">

                                        @error('email')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn app-btn-primary" >Enregistrer</button>
                                    <a href="{{route('admin.index')}}" class="btn app-btn-secondary">Annuler</a>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->




            </div>
        </div>
    </div>





@endsection
