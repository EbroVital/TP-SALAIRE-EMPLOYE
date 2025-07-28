<?php

namespace App\Http\Controllers;

use App\Http\Requests\configurationRequest;
use App\Models\Configuration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{
    public function index(){
        $configs = Configuration::latest()->paginate(10);
        return view('config.index', compact('configs'));
    }

    public function create(){
        return view('config.create');
    }

    public function store(configurationRequest $request){

         try {
        // dd($request);

            $config = Configuration::create([
                'type' => $request->input('type'),
                'value' => $request->input('valeur')
            ]);
            $config->save();

            return redirect()->route('configuration.index')->with('info', 'Configuration ajoutée');
        } catch (Exception $e) {
            throw new Exception('Erreur lors de l\'enregistrement de la configuration');
        }
    }

    public function delete(Configuration $configuration){

        try {

            $configuration->delete();
            return redirect()->route('configuration.index')->with('info','Configuration supprimée');

        } catch (Exception $e) {
            throw new Exception('Erreur lors de la suppression de la configuration');
        }

    }
}
