<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\SubmitAccessRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Notifications\sendMailNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function index(){

        $admins = User::paginate(10);
        return view('admin.index', compact('admins'));
    }

    public function create(){
        return view('admin.create');
    }

    public function edit(User $user){
        return view('admin.edit', compact('user'));
    }

    // enregistrer un admin et envoyer un email
    public function store(AdminRequest $request){


        try{

            $user = new User();

            $user->name = $request->nom;
            $user->email = $request->email;
            $user->password = Hash::make('default');

            $user->save();

            // envoie d'email à l'utilisateur pour confirmer son compte

            try{

                if($user){

                    ResetCodePassword::where('email', $user->email)->delete();
                    $code = rand(1000, 4000);

                    $data = [
                        'code' => $code,
                        'email' => $user->email
                    ];

                    ResetCodePassword::create($data);

                    Notification::route('mail', $user->email)->notify(new sendMailNotification($code, $user->email));

                    // rediriger l'utilisateur vers une url

                    return redirect()->route('admin.index')->with('info','Administrateur ajouté');

                }

            } catch ( Exception $e){
                dd($e);
                throw new Exception('Une erreur est survenue lors de l\'envoi de l\'email');
            }

        } catch(Exception $e){
             dd($e);
            // throw new Exception('Une erreur est survenue lors de la création de cet administrateur');
        }
    }

    public function update(updateAdminRequest $request){

        try{

        } catch(Exception $e){
            // dd($e);
            throw new Exception('Une erreur est survenue lors de la mise à jour des informations de l\'administrateur');
        }
    }


    public function delete(User $user){

        try{

            $adminConnected = Auth::user()->id;

            if($adminConnected <> $user->id){
                $user->delete();
                return redirect()->back()->with('info', 'l\'administrateur a été rétiré');
            } else {
                return redirect()->back()->with('info', 'Vous ne pouvez pas supprimer votre compte');
            }

        } catch(Exception $e){
            // dd($e);
            throw new Exception('Une erreur est survenue lors de la suppression du compte de l\'administrateur');
        }
    }


    public function defineAccess($email){

        // dd($email);
        $checkUserExist = User::where('email',$email)->first();

        if($checkUserExist){

            return view('auth.validateAccount', compact('email'));

        } else {
            // return redirect()->route('login');
        }

    }

    public function SubmitdefineAccess(SubmitAccessRequest $request){

        try{

            $user = User::where('email', $request->email)->first();

            if($user){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();

                if($user){
                  $record = ResetCodePassword::where('email', $user->email)->count();

                  if($record > 1){
                    ResetCodePassword::where('email', $user->email)->delete();
                  }

                  return redirect()->route('login')->with('info', 'Vos accès ont été correctement défini');
                }

            } else {
                // 404
            }

        } catch (Exception $e){
            dd($e);
        }
    }


}
