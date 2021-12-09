<?php

namespace App\Http\Controllers;

use App\Actions\GenerateUniqueID;
use App\Models\Drug;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function doctorsIndex(): \Inertia\Response
    {
        return Inertia::render('Doctors/Patients/Index');
    }


    public function doctorsShow($code): \Inertia\Response
    {
        $patient =  Patient::where('rn', $code)->firstOrFail();

        return Inertia::render('Doctors/Patients/Show', [
            'patient' => $patient,
            'visit' => PatientVisit::where('patient_id', $patient->id)
                ->where('user_id', auth()->id())
                ->where('status', 'waiting')
                ->select(['id', 'status'])
                ->first(),
            'drugs' => Drug::select('id', 'name')->get()->toArray()
        ]);
    }

    public function doctorsFinishConsultation($code, Request $request)
    {
        $data = $request->validate([
            "visit_id" => "required",
            "diagnosis" => "required|min:5",
            "patient_id" => "required",
            "prescriptions" => "sometimes|array",
            //"prescriptions.*.dosage" => "string"
        ]);

        dd($data);


    }

    public function seePatient(Request $request)
    {

        $visit = PatientVisit::findOrFail($request->visit_id);

        $visit->status= "active";

        $visit->save();

        return redirect()->back(303);

    }

    public function receptionIndex(): \Inertia\Response
    {
        return Inertia::render('Reception/Patients/Index', [
            'patients' => Patient::orderBy('last_visited_at', 'desc')->get()->map(function($patient) {
               return array_merge($patient->toArray(), ['last_visited_at' => $patient->last_visited_at->isoFormat('MMMM Do YYYY, h:mm:ss a')]);
            })
        ]);
    }

    public function receptionShow($code): \Inertia\Response
    {
        return Inertia::render('Reception/Patients/Show', [
            'patient' => Patient::where('rn', $code)->firstOrFail(),
            'doctors' => User::where('role', 'doctor')->get()
        ]);
    }

    public function receptionAssignDoctor(Request $request)
    {
        $data = $request->all();
        $referrer = $request->user();

        $visit = PatientVisit::create([
            'referrer_id' => $referrer->id,
            'patient_id' => $data['patient_id'],
            'notes' => $data['notes'],
            'user_id' => $data['doctor'],
        ]);

        return  redirect()->route('reception.dashboard', 303);
    }

    public function receptionSearch(Request $request): \Inertia\Response
    {
        $searchKey = $request->get('search');

        $patients = Patient::where('rn', $searchKey)
            ->orWhere('ic', $searchKey)
            ->orWhere('name', 'like', '%' . $searchKey . '%')
            ->orderBy('last_visited_at', 'desc')
            ->get();

        return Inertia::render('Reception/Patients/Index', [
            'patients' => $patients->map(function($patient) {
                return array_merge($patient->toArray(), ['last_visited_at' => $patient->last_visited_at->isoFormat('MMMM Do YYYY, h:mm:ss a')]);
            })
        ]);
    }

    public function register(Request $request): \Inertia\Response
    {
        return Inertia::render('Reception/Patients/Create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $data = $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'sex' => 'required',
            'dob' => 'required|date',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone' => 'required',
        ]);

        Patient::create(array_merge($data, [
            'rn' => GenerateUniqueID::rnNumber(),
            'last_visited_at' => now()
        ]));

        return  redirect()->route('reception.dashboard', 303);
    }
}
