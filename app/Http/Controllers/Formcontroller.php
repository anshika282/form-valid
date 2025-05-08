<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Formcontroller extends Controller
{
    // public function index()
    // {
    //     return view('form');
    // }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:forms,email',
                'phone' => 'required|string',
                'linkedin' => 'nullable|url',
            ]);

            Form::create($validatedData);

            return response()->json(['message' => 'Form submitted successfully.'], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}
