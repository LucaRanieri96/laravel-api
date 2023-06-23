<?php

namespace App\Http\Controllers\API;

use App\Models\Lead;
use App\Mail\NewLead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->all();
        //Validate data
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        //if validation failure
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        //save data
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();
        //send email
        Mail::to('info@boolpress.com')->send(new NewLead($newLead));
        //return success response
        return response()->json([
          'success' => true,
      ]);
    }
}
