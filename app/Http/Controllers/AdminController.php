<?php

namespace App\Http\Controllers;

use App\Mail\ShortlistedApplicantEmail;
use App\Models\Applicant;
use App\Models\Employement;
use App\Models\EmploymentType;
use App\Models\HistoricalVacancy;
use App\Models\Qualification;
use App\Models\Remark;
use App\Models\Shortlisted;
use App\Models\Training;
use App\Models\User;
use App\Models\Vacancy;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Mail;

class AdminController extends Controller
{
    //

    /**
     * Show create vaccancy page.
     */
    public function createVacancy()
    {
        $minQuali = Qualification::all();
        $empType = EmploymentType::all();
        return view('admin.createVacancy', compact('minQuali', 'empType'));
    }

    public function saveVacancy(Request $request)
{
    $request->validate([
        'position' => ['required', 'string', 'max:255'],
        'minQuali' => ['required', 'numeric'],
        'course' => ['required', 'string', 'max:255'],
        'empType' => ['required', 'numeric'],
        'slot' => ['required', 'numeric'],
        'remuneration' => ['required', 'string', 'max:255'],
        'grade' => ['required', 'string', 'max:255'],
        'dateline' => ['required', 'string'],
        'tor' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust max file size as needed
    ], [
        'tor.required' => 'The TOR is required.',
        'tor.mimes' => 'The TOR must be a PDF file.',
    ]);

    // Store the uploaded file and get the path
    if ($request->hasFile('tor')) {
        $file = $request->file('tor');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('tor', $filename, 'public');
    }

    // Concatenate marks into a single string
    $shortlistingCriteria = '';
    if ($request->has('class10marks')) {
        $shortlistingCriteria .= 'Class 10 Marks: ' . $request->input('class10marks') . ', ';
    }
    if ($request->has('class12marks')) {
        $shortlistingCriteria .= 'Class XII Marks: ' . $request->input('class12marks') . ', ';
    }
    if ($request->has('degreemarks')) {
        $shortlistingCriteria .= 'Degree/Diploma Marks: ' . $request->input('degreemarks');
    }

      // Retrieve criteria from the request
  

    // Save the vacancy with the concatenated shortlisting criteria
    $vacancy = new Vacancy();
    $vacancy->position = $request->position;
    $vacancy->minQualification = $request->minQuali;
    $vacancy->course = $request->course;
    $vacancy->criteria = $shortlistingCriteria;
    $vacancy->class10marks = $request->class10marks;
    $vacancy->class12marks = $request->class12marks;
    $vacancy->degreemarks = $request->degreemarks;
    $vacancy->remuneration = $request->remuneration;
    $vacancy->grade = $request->grade;
    $vacancy->slot = $request->slot;
    $vacancy->empType = $request->empType;
    $vacancy->dateline = $request->dateline;
    $vacancy->tor = $filePath; // Save the file path in the database
    $vacancy->save();

    $title = 'Created';
    Session::flash('success', 'Vacancy created successfully.');
    return redirect()->back()->with(['title'=>$title]);
}


    /**
     * show vacancy list.
     */
    public function showVacancy()
    {
        $vacancies = DB::table('vacancies as v')
            ->join('qualifications as q', 'v.minQualification', 'q.id')
            ->select('v.*', 'q.qualification')
            ->get();
        return view('admin.listVacancy', compact('vacancies'));
    }


    //REPORTS MADE CHANGES HERE

    public function showReport()
    {
        return view('admin.report');
    }

    public function generateReport(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Retrieve active vacancies within the specified date range
        $activeVacanciesQuery = Vacancy::query();
        $historicalVacanciesQuery = HistoricalVacancy::query();

        // If both start and end dates are provided, apply the date range filter
        if ($startDate && $endDate) {
            // Convert the date format to match the database format (if needed)
            $startDate = date('Y-m-d', strtotime($startDate));
            $endDate = date('Y-m-d', strtotime($endDate));

            // Apply the date range filter to active vacancies
            $activeVacanciesQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $historicalVacanciesQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        // Retrieve active vacancies from the primary table
        $activeVacancies = $activeVacanciesQuery->get();

        // Retrieve historical vacancies
        $historicalVacancies = $historicalVacanciesQuery->get();

        // Merge active and historical vacancies into a single collection
        $allVacancies = $activeVacancies->merge($historicalVacancies);

        // Calculate the number of applicants for each vacancy
        foreach ($allVacancies as $vacancy) {
            $vacancy->applicants_count = Applicant::where('vacancy_id', $vacancy->id)->count();
        }

        // Pass the merged vacancies to the report view
        return view('admin.report', compact('allVacancies'));
    }

    

    public function showVacancyUser()
{
    // Get the current date and time
    $currentDateTime = Carbon::now();

    // Fetch only the vacancies where the deadline is not reached
    $vacancies = DB::table('vacancies as v')
        ->join('qualifications as q', 'v.minQualification', 'q.id')
        ->join('employment_types as et', 'et.id', 'v.empType')
        ->select('v.*', 'q.qualification', 'et.employType')
        ->where('v.dateline', '>', $currentDateTime) // Filter out vacancies with deadlines in the past
        ->get();

    return view('vacancy', compact('vacancies'));
}

    


    /**
     * Display the specified vacancy.
     */
    public function viewVacancy(int $id)
    {
        $minQuali = Qualification::all();
        $empType = EmploymentType::all();
        $vacancy = Vacancy::find($id);
        return view('admin.editVacancy', compact('vacancy', 'minQuali', 'empType'));
    }
    public function shortlisted(int $id = null)
    {
        $vacancies = DB::table('vacancies')
            ->select('vacancies.*')
            ->get();

        return view('admin.shortlisted', compact('vacancies'));
    }
//     public function shortlisted(int $id = null)
// {
//     // Fetching vacancies with panels relationship
//     $vacancies = Vacancy::with('panels')->get();

//     return view('admin.shortlisted', compact('vacancies'));
// }

    public function result(int $id = null)
    {
        $vacancies = DB::table('vacancies')
            ->select('vacancies.*')
            ->get();

        return view('result', compact('vacancies'));
    }
    public function dashboard()
    {
        $vacancies = DB::table('vacancies')
            ->select('vacancies.*')
            ->get();

        return view('dashboard', compact('vacancies'));
    }

// public function deleteVacancy($id)
// {
//     // Find the vacancy by ID
//     $vacancy = Vacancy::find($id);

//     if (!$vacancy) {
//         return redirect()->back()->with('error', 'Vacancy not found.');
//     }

//     // Perform deletion logic
//     $vacancy->delete();

//     return redirect()->route('vacancy-list')->with('success', 'Vacancy deleted successfully.');
// }
    public function deleteVacancy($id)
    {
        // Find the vacancy by ID
        $vacancy = Vacancy::find($id);

        if (!$vacancy) {
            return redirect()->back()->with('error', 'Vacancy not found.');
        }

        // Move the vacancy to the historical table before deletion
        HistoricalVacancy::create($vacancy->toArray());

        // Perform deletion logic only for the primary table
        $vacancy->delete();

        return redirect()->route('vacancy-list')->with('success', 'Vacancy deleted successfully.');
    }

    /**
     * Display the specified vacancy.
     */
//     public function viewCandidate(int $id)
//     {
//         $applicant = DB::table('applicants as a')
//         ->join('vacancies as v', 'v.id', 'a.vacancy_id')
//         ->select('a.*', 'v.position')
//         ->where('a.id', $id)
//     ->first();

//     $education = DB::table('education')
//                     ->where('applicant_id', $applicant->id)
//                     ->get();
//     return view('userprofile', compact('applicant', 'education'));
// }
    public function viewCandidate(int $id)
    {
        $applicant = DB::table('applicants as a')
            ->join('vacancies as v', 'v.id', 'a.vacancy_id')
            ->select('a.*', 'v.position')
            ->where('a.id', $id)
            ->first();

        $education = DB::table('education')
            ->where('applicant_id', $applicant->id)
            ->get();

        $trainings = Training::where('applicant_id', $applicant->id)->get();
        $employments = Employement::where('applicant_id', $applicant->id)->get();

        // Fetch remarks for the applicant
        $remarks = Remark::where('applicant_id', $applicant->id)->get();

        return view('userprofile', compact('applicant', 'education', 'trainings', 'employments', 'remarks'));
    }

    public function saveRemarks(Request $request, int $id)
    {
        // Validate the request data (remark)
        $validatedData = $request->validate([
            'remark' => 'required|string|max:255',
        ]);

        // Find the applicant
        $applicant = Applicant::findOrFail($id);

        // Create or update the remark for the applicant
        $remark = Remark::updateOrCreate(
            ['applicant_id' => $applicant->id],
            ['remark' => $validatedData['remark']]
        );

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Remark saved successfully');
    }

// public function viewCandidate(int $id)
// {
//     $applicant = Applicant::with('training')->find($id);
//     // Retrieve the applicant along with their training record
//     $applicant = DB::table('applicants as a')
//         ->join('vacancies as v', 'v.id', 'a.vacancy_id')
//         ->leftJoin('trainings as t', 'a.id', 't.applicant_id') // Assuming 'trainings' is the name of your training table
//         ->select('a.*', 'v.position', 't.*') // Select the training fields
//         ->where('a.id', $id)
//         ->first();

//     // Check if applicant exists
//     if (!$applicant) {
//         // Handle case where applicant does not exist, e.g., show error message or redirect
//     }

//     // Retrieve education records for the applicant
//     $education = DB::table('education')
//                     ->where('applicant_id', $applicant->id)
//                     ->get();

//     // Pass the applicant data to the view
//     return view('userprofile', compact('applicant', 'education'));
// }

// public function showcanidate(int $id)
//     {
//         // Use the new method to get applicants in descending order of the final score
//         $applicant = $this->showCandidatesOrdered($id);

//         return view('admin.showcanidate', compact('applicant','id'));
//     }
    public function showcanidate(int $id)
    {
        // Use the new method to get applicants in descending order of the final score
        $applicant = $this->showCandidatesOrdered($id);

        // Fetch education details for all applicants
        $education = DB::table('education')
            ->whereIn('applicant_id', $applicant->pluck('id'))
            ->where('grade', 15) // Assuming you want to fetch only Bachelors Degree details
            ->get();

        return view('admin.showcanidate', compact('applicant', 'education', 'id'));
    }

    // New method to retrieve applicants and order them by the final score
    public function showCandidatesOrdered(int $id)
    {
        $applicant = DB::table('applicants as a')
            ->join('vacancies as v', 'v.id', 'a.vacancy_id')
            ->select('a.*', 'v.position') // Include the 'status' column
            ->where('v.id', $id)
            ->orderByDesc('a.final_score') // Order by final score in descending order
            ->get();

        return $applicant;
    }

    public function shortlist(int $id)
    {
        // Retrieve the applicant
        $applicant = Applicant::find($id);

        // dd($applicant);

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        // Check if the applicant is already shortlisted
        if ($applicant->shortlisted) {
            return redirect()->back()->with('error', 'Applicant is already shortlisted.');
        }

        // Get the vacancy ID associated with the applicant
        $vacancyId = $applicant->vacancy_id;

        // Create a shortlisted entry
        Shortlisted::create([
            'applicant_id' => $applicant->id,
            'name' => $applicant->name,
            'cid' => $applicant->cid,
            'dob' => $applicant->dob,
            'contact' => $applicant->contact,
            'vacancy_id' => $vacancyId,
        ]);

        // Update the applicant to mark them as shortlisted
        $applicant->update(['shortlisted' => true]);

//email
        $mail_data = [
            'title' => 'Dear Sir/Madam,',
            'body' => 'You have been shortlisted and we will notify you of the interview date soon. Please ensure that you are reachable',
        ];
        Mail::to($applicant->email)
            ->send(new ShortlistedApplicantEmail($mail_data));


        $sms = 'You have been shortlisted and we will notify you of the interview date soon. Please ensure that you are reachable';
        $kannelApiUrl = "http://202.144.128.243:14001/cgi-bin/sendsms";
        $kannelUser = "tester"; // Use a different variable name
        $from = "BTL HR";
        $pass = "foobar";
        $text = $sms;
        $to = "975" . $applicant->contact;

        Http::get($kannelApiUrl, [
            'user' => $kannelUser, // Use the new variable name
            'pass' => $pass,
            'text' => $text,
            'to' => $to,
            'from' => $from,
        ]);

// return redirect()->route('admin.showCanidate', ['id' => $id])->with('success', 'Applicant shortlisted successfully.');
        return redirect()->back()->with('success', 'Applicant shortlisted successfully.');
        // return back()->with('success', 'Applicant shortlisted successfully.');
    }

//     public function select(int $id)
// {
//     // Retrieve the applicant
//     $applicant = Applicant::find($id);

//     if (!$applicant) {
//         return redirect()->back()->with('error', 'Applicant not found.');
//     }

//     // Check if the applicant is already selected
//     if ($applicant->selected) {
//         return redirect()->back()->with('error', 'Applicant is already selected.');
//     }

//     // Mark the applicant as selected
//     $applicant->update(['selected' => true]);

 
   
//     $sms = 'You have been selected and we will notify you of the interview date soon. Please ensure that you are reachable';
//     $kannelApiUrl = "http://202.144.128.243:14001/cgi-bin/sendsms";
//     $kannelUser = "tester"; // Use a different variable name
//     $from = "BTL HR";
//     $pass = "foobar";
//     $text = $sms;
//     $to = "975" . $applicant->contact;

//     return redirect()->back()->with('success', 'Applicant selected successfully.');
// }

// public function standby(int $id)
// {
//     // Retrieve the applicant
//     $applicant = Applicant::find($id);

//     if (!$applicant) {
//         return redirect()->back()->with('error', 'Applicant not found.');
//     }

//     // Update the applicant status to standby (selected = 2)
//     $applicant->update(['selected' => 2]);

//     return redirect()->back()->with('success', 'Applicant set to standby.');
// }


// public function select(int $id)
// {
//     // Retrieve the applicant
//     $applicant = Applicant::find($id);

//     // Check if the applicant exists
//     if (!$applicant) {
//         return redirect()->back()->with('error', 'Applicant not found.');
//     }

//     // Check if the applicant is already selected
//     if ($applicant->selected) {

//             // Send SMS notification
//     $sms = 'You have been selected';
//     $kannelApiUrl = "http://202.144.128.243:14001/cgi-bin/sendsms";
//     $kannelUser = "tester"; // Use a different variable name
//     $from = "BTL HR";
//     $pass = "foobar";
//     $text = $sms;
//     $to = "975" . $applicant->contact;

//         return redirect()->back()->with('error', 'Applicant is already selected.');
//     }

//     // Mark the applicant as selected
//     $applicant->update(['selected' => Applicant::STATUS_SELECTED]);


    
//     // Consider adding error handling for SMS sending

//     return redirect()->back()->with('success', 'Applicant selected successfully.');
// }

public function select(int $id)
{
    // Retrieve the applicant
    $applicant = Applicant::find($id);

    // Check if the applicant exists
    if (!$applicant) {
        return redirect()->back()->with('error', 'Applicant not found.');
    }

    // Check if the applicant is already selected
    if ($applicant->selected) {
        return redirect()->back()->with('error', 'Applicant is already selected.');
    }

    // Mark the applicant as selected
    $applicant->update(['selected' => Applicant::STATUS_SELECTED]);

    // Send SMS notification
    $sms = 'You have been selected';
    $kannelApiUrl = "http://202.144.128.243:14001/cgi-bin/sendsms";
    $kannelUser = "tester"; // Use a different variable name
    $from = "BTL HR";
    $pass = "foobar";
    $text = $sms;
    $to = "975" . $applicant->contact;

    // Send the SMS using cURL or HTTP client
    Http::get($kannelApiUrl, [
        'user' => $kannelUser,
        'pass' => $pass,
        'text' => $text,
        'to' => $to,
        'from' => $from,
    ]);

    // Consider adding error handling for SMS sending

    return redirect()->back()->with('success', 'Applicant selected successfully.');
}


// public function standby(int $id)
// {
//     // Retrieve the applicant
//     $applicant = Applicant::find($id);

//     // Check if the applicant exists
//     if (!$applicant) {
//         return redirect()->back()->with('error', 'Applicant not found.');
//     }

//     // Update the applicant status to standby
//     $applicant->update(['selected' => Applicant::STATUS_STANDBY]);

//     return redirect()->back()->with('success', 'Applicant set to standby.');
// }

public function standby(int $id)
{
    // Retrieve the applicant
    $applicant = Applicant::find($id);

    // Check if the applicant exists
    if (!$applicant) {
        return redirect()->back()->with('error', 'Applicant not found.');
    }

    // Update the applicant status to standby
    $applicant->update(['standby' => Applicant::STATUS_STANDBY]);

    return redirect()->back()->with('success', 'Applicant set to standby.');
}

public function updateresult($id)
{
    // Update the status of selected applicants to 'Selected'
    Applicant::where('selected', Applicant::STATUS_SELECTED)->update(['status' => 'Selected']);

    // Update the status of applicants on standby to 'Standby'
    Applicant::where('standby', Applicant::STATUS_STANDBY)->update(['status' => 'Standby']);
    return redirect()->back()->with('successful');
}




    public function addRemark(Request $request, $id)
    {
        // Retrieve the applicant
        $applicant = Applicant::find($id);

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        // Validate the request
        $request->validate([
            'remark' => 'required|string|max:255',
        ]);

        // Add the remark to the applicant
        $applicant->remarks()->create([
            'remark' => $request->input('remark'),
        ]);

        // Send email to the applicant
        $mail_data = [
            'title' => 'Dear Sir/Madam,',
            'body' => 'A remark has been added to your application.',
        ];

        Mail::to($applicant->email)->send(new RemarkAddedEmail($mail_data));

        // // Send SMS notification to the applicant
        // $sms = 'A remark has been added to your application.';
        // $kannelApiUrl = "http://dev.btcloud.bt:14001/cgi-bin/sendsms";
        // $kannelUser = "tester"; // Use a different variable name
        // $from = "BTL HR";
        // $pass = "foobar";
        // $text = $sms;
        // $to = "975" . $applicant->contact;

        Http::get($kannelApiUrl, [
            'user' => $kannelUser, // Use the new variable name
            'pass' => $pass,
            'text' => $text,
            'to' => $to,
            'from' => $from,
        ]);

        return redirect()->back()->with('success', 'Remark added successfully.');
    }

    

    public function viewshortlisted(int $vacancyId)
    {
        $user = auth()->user();

        $query = DB::table('shortlisteds as s')
            ->join('applicants as a', 's.applicant_id', '=', 'a.id')
            ->join('vacancies as v', 's.vacancy_id', '=', 'v.id')
            ->where('v.id', $vacancyId);

        if ($user && $user->email === 'hr@bt.bt') {
            $shortlistedCandidates = $query->select('a.*', 'v.position')->orderByDesc('a.final_score')->get();
        } else {
            $shortlistedCandidates = $query->select('a.cid', 'v.position', 'a.contact')->get();
        }

        return view('admin.viewshortlisted', compact('shortlistedCandidates'));
    }

    public function viewresult(int $vacancyId)
    {
        // Fetch applicants data from your database or wherever you're storing it
        // $applicants = Applicant::all(); // Adjust this according to your data retrieval logic
        // Query to fetch applicants data based on the vacancyId

        $query = DB::table('applicants as a')
            ->join('vacancies as v', 'a.vacancy_id', '=', 'v.id')
            ->where('v.id', $vacancyId);

        // // Fetch the applicants data
        // $applicants = $query->select('a.*')->get();
        // Fetch the applicants data
        $applicants = $query->select('a.*', 'v.position')->get();

        // Check if assessment is complete
        $assessmentComplete = false; // Initially set to false

        // Pass the applicants data and assessment completion status to the view
        return view('viewresult', compact('applicants', 'assessmentComplete'));
    }

// public function viewresult(int $vacancyId)
// {
//     // Query to fetch applicants data based on the vacancyId
//     $query = DB::table('applicants as a')
//         ->join('vacancies as v', 'a.vacancy_id', '=', 'v.id')
//         ->where('v.id', $vacancyId);

//     // Fetch the applicants data
//     $applicants = $query->select('a.*')->get();

//     // Pass the applicants data to the view
//     return view('viewresult', compact('applicants'));
// }

// public function viewresult()
// {
//     // Fetch applicants data from your database or wherever you're storing it
//     $applicants = Applicant::all(); // Adjust this according to your data retrieval logic

//     // Pass the applicants data to the view
//     return view('viewresult', compact('applicants'));
// }
// public function viewresult(int $vacancyId)
// {
//     // Fetch applicants data based on the selected vacancy ID
//     $applicants = Applicant::where('vacancy_id', $vacancyId)->get();

//     // Pass the applicants data to the view
//     return view('viewresult.blade', compact('applicants'));
// }

// public function completeAssessment(Request $request)
// {

//     $vacancies = Vacancy::all();

//     // Pass the vacancies data to the view
//     return view('
//     result', compact('vacancies'));

// }

// public function completeAssessment(Request $request)
// {
//     // Update the assessment completion status to true
//     $assessmentComplete = true;

//     // Update the status of each applicant based on shortlisted column
//     // For example, if shortlisted is 1, status becomes "Shortlisted", else "Not Shortlisted"
//     Applicant::where('shortlisted', 1)->update(['status' => 'Shortlisted']);
//     Applicant::where('shortlisted', 0)->update(['status' => 'Not Shortlisted']);

//     // Redirect back to the view result page with a success message
//     return redirect()->route('result')
//                      ->with('success', 'Assessment completed successfully.')
//                      ->with('assessmentComplete', $assessmentComplete);
// }

    public function completeAssessment(Request $request)
    {
        // Retrieve the vacancy ID from the request
        $vacancyId = $request->input('vacancy_id');
        // dd($request);

        // Update the assessment completion status to true
        $assessmentComplete = true;

        // Update the status of applicants belonging to the specified vacancy
        Applicant::where('vacancy_id', $vacancyId)
            ->where('shortlisted', 1)
            ->update(['status' => 'Shortlisted']);

        Applicant::where('vacancy_id', $vacancyId)
            ->where('shortlisted', 0)
            ->update(['status' => 'Not Shortlisted']);

        // Redirect back to the view result page with a success message
        return redirect()->route('result')
            ->with('success', 'Assessment completed successfully.')
            ->with('assessmentComplete', $assessmentComplete);
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());
        // Validate the request data
        $request->validate([
            'position' => 'required|string',
            'minQuali' => 'required|integer',
            'course' => 'required|string',
            'criteria' => 'required|string',
            'empType' => 'required|integer',
            'slot' => 'required|integer',
            'remuneration' => 'required|string',
            'grade' => 'required|string',
            'dateline' => 'required|date',
            'tor' => 'nullable|file|mimes:pdf|max:10240', // Example: PDF file, max size 10MB
        ]);

        // Find the Vacancy model by ID
        $vacancy = Vacancy::findOrFail($id);

        // Update the model with the new data
        $vacancy->update([
            'position' => $request->input('position'),
            'minQualification' => $request->input('minQuali'),
            'course' => $request->input('course'),
            'criteria' => $request->input('criteria'),
            'empType' => $request->input('empType'),
            'slot' => $request->input('slot'),
            'remuneration' => $request->input('remuneration'),
            'grade' => $request->input('grade'),
            'dateline' => $request->input('dateline'),
            // Update other fields as needed
        ]);

        // Handle file upload if a new TOR is provided
        if ($request->hasFile('tor')) {
            $torPath = $request->file('tor')->storeAs('tor', 'tor_' . $vacancy->id . '.pdf', 'public');
            $vacancy->tor_path = $torPath;
            $vacancy->save();
        }

        // Redirect back or to the updated vacancy page
        return redirect()->route('vacancy-list', $vacancy->id)->with('success', 'Vacancy updated successfully');

    }
    //load focal change password page
    public function change_pwd()
    {
        return view('change_pwd');
    }

    //save changed password for dc focal user
    public function save_pwd(Request $request)
    {
        $validData = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
            [
                'password.required' => 'The password field is required.',
                'password.confirmed' => 'The password confirmation does not match.',
            ]);

        $res = User::where('id', Auth::user()->id)->first();
        $res->password = Hash::make($validData['password']);
        $res->save();
        // $request->user()->update([
        //     'password' => Hash::make($validData['password']),
        // ])->where('id', Auth::user()->id);

        $msg = 'Password updated successfully.';
        Session::flash('success', $msg);
        return redirect()->back();
    }

//     public function addPanel(Request $request)
//     {
//         // Validate the form data
//         $request->validate([
//             // Define your validation rules here
//         ]);
    
//         // Process the form data and save the panel details to the database
//         $panel = new Panel();
//         $panel->username = $request->input('username');
//         $panel->password = bcrypt($request->input('password')); // Assuming you're hashing passwords for security
//         $panel->vacancy_id = $request->input('vacancy_id'); // Set the vacancy_id from the form data
//         $panel->save();
    
//         // Redirect back with a success message
//         return redirect()->back()->with('success', 'Panel added successfully.');
// }


// public function addPanel(Request $request)
// {
//     // Validate the form data
//     $validatedData = $request->validate([
//         'username' => 'required|string',
//         'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^.+@.+\..+$/'],
//         'panel_contact' => 'required|string',
//         'vacancy_id' => 'required|integer', // Adjust the validation rules as needed
//     ]);

//     // Create a user
//     $user = User::create([
//         'name' => $validatedData['username'],
//         'email' => $validatedData['email'],
//         'password' => Hash::make('123456789'), // Assign a default password
//         // You may need to adjust other attributes based on your user model
//     ]);
//     $user->assignRole('panel');

//     // Create a panel associated with the user
//     $panel = new Panel([
//         'username' => $validatedData['username'],
//         'panel_contact' => $validatedData['panel_contact'],
//         'vacancy_id' => $validatedData['vacancy_id'],
//         'user_id' => $user->id,
//     ]);
//     $panel->save();

//     // Redirect back with a success message
//     return redirect()->back()->with('success', 'Panel added successfully.');
// }


}


