<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeRequest;
use App\Http\Requests\updateEmployeRequest;
use App\Models\Departement;
use App\Models\Employe;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class EmployeController extends Controller
{

    public function index(){

        $employes = Employe::with('departement')->paginate(10);
        return view('employe.index', compact('employes'));
    }

    public function create(){

        $departements = Departement::all();
        return view('employe.create', compact('departements'));
    }

    public function edit(Employe $employe){

        $departements = Departement::all();
        return view('employe.edit', compact('employe', 'departements'));
    }

    public function store(EmployeRequest $request){

        try{

            $query = Employe::create($request->all());

            if($query){
                return redirect()->route('employe.index')->with('info', 'Employé ajouté !');
            };

        } catch (Exception $e){
            dd($e);
        }

    }

    public function update(updateEmployeRequest $request, Employe $employe){

        try{

            $employe->nom = $request->nom;
            $employe->prenom = $request->prenom;
            $employe->email = $request->email;
            $employe->departement_id = $request->departement_id;
            $employe->contact = $request->contact;
            $employe->montant_journalier = $request->montant_journalier;

            $employe->update();

          return redirect()->route('employe.index')->with('info',"les informations de l'employe ont été mise à jour");

        } catch (Exception $e){
            dd($e);
        }

    }

    public function delete(Employe $employe){

        try{

            $employe->delete();
            return redirect()->route('employe.index')->with('info',"l'employe à été supprimé !");

        } catch (Exception $e){
            dd($e);
        }

    }


}
