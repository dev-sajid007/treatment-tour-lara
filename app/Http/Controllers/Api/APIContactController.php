<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIContactController extends Controller
{
    /**
     * Store a newly created contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email',
                'phone_number' => 'nullable|string|max:15',
                'present_address' => 'nullable|string|max:255',
                'message'    => 'nullable|string',
                'services'   => 'nullable|string|max:255',
            ]);
    
            // Create a new contact using the validated data
            $contact = Contact::create($request->all());
    
            // Return a success response
            return response()->json([
                'message' => 'Contact created successfully',
                'contact' => $contact
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            \Log::error('Error creating contact: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while creating the contact'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
