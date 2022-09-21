<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactThankYou;

class LeadController extends Controller
{
    public function store(Request $request){
        // Prendo i dati
        $data = $request->all();

        // Validare i dati
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|max:60000'
        ]);

        // Se la validazione fallisce
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
    
            ]);
        }

        //Salvo i dati nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // Invio la mail di ringraziamento al utente
        Mail::to($data['email'])->send(new ContactThankYou());

        return response()->json([
            'success' => true,

        ]);

    }
}
