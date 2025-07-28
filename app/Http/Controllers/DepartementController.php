<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartementRequest;
use App\Models\Departement;
use Exception;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index(){

        $departements = Departement::paginate(10);
        return view('departement.index', compact('departements'));
    }

    public function create(){

        return view('departement.create');
    }

    public function edit(Departement $departement){

        return view('departement.edit', compact('departement'));
    }


    public function store(Departement $departement, DepartementRequest $request){

        try {

            $departement->name = $request->nom;
            $departement->save();

            return redirect()->route('departement.index')->with('info', 'Département enregistré !');

        } catch (Exception $e) {
            dd($e);
        }

    }


    public function update(Departement $departement, DepartementRequest $request){

        try {

            $departement->name = $request->nom;
            $departement->update();

            return redirect()->route('departement.index')->with('info', 'Département mis à jour !');

        } catch (Exception $e) {
            dd($e);
        }
    }

    public function delete(Departement $departement){

        try {

            $departement->delete();

            return redirect()->route('departement.index')->with('info', 'Département supprimé !');

        } catch (Exception $e) {
            dd($e);
        }

    }

}
