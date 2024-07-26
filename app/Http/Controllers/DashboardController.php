<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->type == 'hr_coordinator') {
            // HR Coordinator sees all forms
            $forms = Form::with('actions')->get();
        } elseif ($user->type == 'hr_manager') {
            // HR Manager sees forms approved by HR Coordinator
            $forms = Form::whereHas('actions', function($query) {
                $query->where('hr_accepted', 'accepted');
            })->with('actions')->get();
        } else {
            // Other users do not see any forms
            $forms = collect();
        }

        return view('dashboard', compact('forms'));
    }

    public function accept($formId)
    {
        $user = Auth::user();
        $action = FormAction::where('form_id', $formId)->first();

        if ($user->type == 'hr_coordinator') {
            $action->update(['hr_accepted' => 'accepted', 'coordinator_id' => $user->id]);
        } elseif ($user->type == 'hr_manager' && $action->hr_accepted == 'accepted') {
            $action->update(['manager_accepted' => 'accepted', 'manager_id' => $user->id]);
        }


        return redirect()->back()->with('success', 'Form accepted successfully!');
    }

    public function reject($formId)
    {
        $user = Auth::user();
        $action = FormAction::where('form_id', $formId)->first();

        if ($user->type == 'hr_coordinator') {
            $action->update(['hr_accepted' => 'rejected', 'coordinator_id' => $user->id]);
        } elseif ($user->type == 'hr_manager' && $action->hr_accepted == 'accepted') {
            $action->update(['manager_accepted' => 'rejected', 'manager_id' => $user->id]);
        }

        return redirect()->back()->with('fail', 'Form rejected.');
    }
}
