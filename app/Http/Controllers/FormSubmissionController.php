<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormSubmissionController extends Controller
{


    public function form()
    {
        return view('formSubmission');
    }

    public function submitForm(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'nationality' => 'required|string|max:255',
            'cv_attachment' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            } else {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        // Process the file upload
        if ($request->hasFile('cv_attachment')) {
            $file = $request->file('cv_attachment');
            $filePath = $file->store('cv_attachments', 'public');

            // Save the form data to the database
            $form = Form::create([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'cv_attachment' => $filePath,
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Form submitted successfully!',
                    'data' => $form,
                ], 200);
            } else {
                return redirect()->back()->with('success', 'Form submitted successfully!');
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'CV attachment is required.',
            ], 400);
        } else {
            return redirect()->back()->with('fail', 'CV attachment is required.');
        }
    }






}
