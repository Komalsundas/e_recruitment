<?php

namespace App\Http\Controllers;

use App\Mail\Notify;
use App\Models\Applicant;
use App\Models\Education;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mail;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request);
        // Validate the form data
        $validatedUserData = $request->validate([
            'name' => 'required|string|max:255',
            'cid' => 'required|string|max:11|unique:applicants,cid',
            'dob' => 'required|date|max:255',
            'gender' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'acontact' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dzongkhag' => 'required|string|max:255',
            'gewog' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'passport_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'coverletter' => 'required|file|mimes:pdf|max:2048',
            'cidcopy' => 'required|file|mimes:pdf|max:2048',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'mc' => 'required|file|mimes:pdf|max:2048',
            'noc' => 'required|file|mimes:pdf|max:2048',
        ]);
        $existingApplicant = Applicant::where('cid', $validatedUserData['cid'])
            ->where('vacancy_id', $request->vacancy_id)
            ->first();

            $criteriaMet = $this->compareMarksWithCriteria($request);
        

            if (is_string($criteriaMet)) {
                // Construct a more informative error message
                $errorMessage = 'Your application does not meet the minimum qualification criteria for ' . ucfirst($criteriaMet) . '.';
                return redirect()->back()->with('error', $errorMessage)->withInput();
            }
            



        if ($request->hasFile('passport_photo')) {
            $file = $request->file('passport_photo');
            $filename = 'passport' . '.' . $file->getClientOriginalExtension();
            $passport_path = $file->storeAs($request->cid, $filename, 'public');

        }
        if ($request->hasFile('coverletter')) {
            //for coverletter
            $file = $request->file('coverletter');
            $coverletter_name = 'coverletter' . '.' . $file->getClientOriginalExtension();
            $coverletter_path = $file->storeAs($request->cid, $coverletter_name, 'public');

        }
        if ($request->hasFile('cidcopy')) {
            //for cid_copy
            $file = $request->file('cidcopy');
            $cid_name = $request->cid . '.' . $file->getClientOriginalExtension();
            $cid_path = $file->storeAs($request->cid, $cid_name, 'public');
        }
        if ($request->hasFile('cv')) {
            //for cv
            $file = $request->file('cv');
            $cv_name = 'cv' . '.' . $file->getClientOriginalExtension();
            $cv_path = $file->storeAs($request->cid, $cv_name, 'public');
        }
        if ($request->hasFile('mc')) {
            //for mc
            $file = $request->file('mc');
            $mc_name = 'mc' . '.' . $file->getClientOriginalExtension();
            $mc_path = $file->storeAs($request->cid, $mc_name, 'public');
        }
        if ($request->hasFile('noc')) {
            //for noc
            $file = $request->file('noc');
            $noc_name = 'noc' . '.' . $file->getClientOriginalExtension();
            $noc_path = $file->storeAs($request->cid, $noc_name, 'public');
        }

        // $criteriaMet = $this->compareMarksWithCriteria($request);

        // if (!$criteriaMet) {
        //     // Flash error message if criteria are not met
        //     return redirect()->back()->with('error', 'Your application does not meet the minimum qualification criteria.')->withInput();
        // }

        $applicant = new Applicant([
            'name' => $validatedUserData['name'],
            'cid' => $validatedUserData['cid'],
            'dob' => $validatedUserData['dob'],
            'gender' => $validatedUserData['gender'],
            'contact' => $validatedUserData['contact'],
            'acontact' => $validatedUserData['acontact'],
            'email' => $validatedUserData['email'],
            'dzongkhag' => $validatedUserData['dzongkhag'],
            'gewog' => $validatedUserData['gewog'],
            'village' => $validatedUserData['village'],
            'present_address' => $validatedUserData['present_address'],
            'passport_photo' => $passport_path,
            'coverletter' => $coverletter_path,
            'cidcopy' => $cid_path,
            'cv' => $cv_path,
            'mc' => $mc_path,
            'noc' => $noc_path,
            'vacancy_id' => $request->vacancy_id,
            'x_percentage' => $request->x_percentage,
            'xii_percent' => $request->xii_percent,
            'degree_percentage' => $request->x_percentage,
            'final_score' => $request->final_score,

        ]);

        $applicant->save();

        //education

        if ($request->hasFile('x_marksheet')) {
            //for mc
            $file = $request->file('x_marksheet');
            $x_name = 'x_marksheet' . '.' . $file->getClientOriginalExtension();
            $x_path = $file->storeAs($request->cid, $x_name, 'public');
        }

        $x_education = new Education([
            'institute' => $request->x_institute,
            'year' => $request->x_year,
            'course_name' => "General",
            'grade' => 10,
            'stream' => 'N',
            'eng' => $request->x_eng,
            'dzo' => $request->x_dzo,
            'math' => $request->x_mat,
            'phy' => $request->x_phy,
            'che' => $request->x_che,
            'bio' => $request->x_bio,
            'his' => $request->x_his,
            'geo' => $request->x_geo,
            'eco' => $request->x_eco,
            'it' => $request->x_it,
            'ent' => $request->x_ent,
            'agfs' => $request->x_agfs,
            'com' => 0,
            'acc' => 0,
            'media' => 0,
            'rigzhung' => 0,

            'aggregate' => $request->x_percentage,
            'marksheet' => $x_path,
            'applicant_id' => $applicant->id,
        ]);
        $x_education->save();

        //Class 12
        $xii_path = null;
        if ($request->hasFile('xii_marksheet')) {
            //for mc
            $file = $request->file('xii_marksheet');
            $xii_name = 'xii_marksheet' . '.' . $file->getClientOriginalExtension();
            $xii_path = $file->storeAs($request->cid, $xii_name, 'public');
        }
        if ($request->stream == 'S') {
            $course = "Science";
        } elseif ($request->stream == 'C') {
            $course = "Commerce";
        } else {
            $course = "Arts";
        }
        $xii_education = new Education([
            'institute' => $request->xii_institute,
            'year' => $request->xii_year,
            'course_name' => $course,
            'grade' => 12,
            'stream' => $request->stream,
            'eng' => $request->xii_eng,
            'dzo' => $request->xii_dzo,
            'math' => $request->xii_mat,
            'phy' => $request->xii_phy,
            'che' => $request->xii_che,
            'bio' => $request->xii_bio,
            'his' => $request->xii_his,
            'geo' => $request->xii_geo,
            'eco' => $request->xii_eco,
            'it' => $request->xii_it,
            'com' => $request->xii_com,
            'acc' => $request->xii_acc,
            'ent' => 0,
            'agfs' => 0,
            'media' => $request->xii_media,
            'rigzhung' => $request->xii_rigzhung,

            'aggregate' => $request->xii_percent,
            'marksheet' => $xii_path,
            'applicant_id' => $applicant->id,
        ]);
        $xii_education->save();

        if ($request->hasFile('degree_marksheet')) {
            //for mc
            $file = $request->file('degree_marksheet');
            $xv_name = 'degree_marksheet' . '.' . $file->getClientOriginalExtension();
            $xv_path = $file->storeAs($request->cid, $xv_name, 'public');
        } else {
            // Default path if no file is provided
            $xv_path = null;
        }
        $degree_education = new Education([
            'institute' => $request->degree_institute,
            'year' => $request->degree_year,
            'course_name' => $request->degree_course,
            'grade' => 15,
            'stream' => 'N',
            'eng' => 0,
            'dzo' => 0,
            'math' => 0,
            'phy' => 0,
            'che' => 0,
            'bio' => 0,
            'his' => 0,
            'geo' => 0,
            'eco' => 0,
            'it' => 0,
            'com' => 0,
            'acc' => 0,
            'ent' => 0,
            'agfs' => 0,
            'rigzhung' => 0,
            'media' => 0,

            'aggregate' => $request->degree_percentage,
            'marksheet' => $xv_path,
            'applicant_id' => $applicant->id,
        ]);
        $degree_education->save();

        // to save experience data
        if ($request->has('company') && is_array($request->company)) {
            $i = 0;
            foreach ($request->company as $company) {
                $file = $request->file('document')[$i] ?? null; // Check if file exists
                $ex_path = null;
                if ($file) {
                    $ex_name = 'experience' . $i . '.' . $file->getClientOriginalExtension();
                    $ex_path = $file->storeAs($request->cid, $ex_name, 'public');
                }
                $experience = [
                    'company' => $company,
                    'post' => $request->position[$i] ?? null, // Check if position exists
                    'from' => $request->from[$i] ?? null, // Check if from date exists
                    'to' => $request->to[$i] ?? null, // Check if to date exists
                    'place' => $request->place[$i] ?? null, // Check if place exists
                    'document' => $ex_path,
                    'applicant_id' => $applicant->id,
                ];

                DB::table('employements')->insert($experience);
                $i++;
            }
        }

// to save training data
        if ($request->has('training') && is_array($request->training)) {
            $i = 0;
            foreach ($request->training as $training) {
                $file = $request->file('certificates')[$i] ?? null; // Check if file exists
                $training_path = null;
                if ($file) {
                    $training_name = 'training' . $i . '.' . $file->getClientOriginalExtension();
                    $training_path = $file->storeAs($request->cid, $training_name, 'public');
                }
                $trainingData = [
                    'training' => $training,
                    'country' => $request->country[$i] ?? null, // Check if country exists
                    'sdate' => $request->sdate[$i] ?? null, // Check if start date exists
                    'edate' => $request->edate[$i] ?? null, // Check if end date exists
                    'certificates' => $training_path,
                    'applicant_id' => $applicant->id,
                ];

                DB::table('trainings')->insert($trainingData);
                $i++;
            }
        }

        $vacancy = Vacancy::find($request->vacancy_id);

        // Construct the email body
        $mail_data = [
            'title' => 'Dear Sir/Madam,',
            'body' => 'An applicant has applied for the post of ' . $vacancy->position . '. To review and assess the application, kindly log in to the portal using your credentials.',
        ];

        Mail::to('erecruitment@bt.bt')
            ->cc(['tshering.yangki@bt.bt', 'komal.sundas@bt.bt', 'numo@bt.bt'])
            ->send(new Notify($mail_data));

        //SMS
        $sms = 'Your application form has been successfully submitted. We appreciate your interest in joining us.';
        $kannelApiUrl = "http://202.144.128.243:14001/cgi-bin/sendsms";
        $from = "BTL HR";
        $applicant = "tester";
        $pass = "foobar";
        $text = $sms;
        $to = "975" . $request->contact;
        // $to = "97517171572";
        Http::get($kannelApiUrl, [
            'user' => $applicant,
            'pass' => $pass,
            'text' => $text,
            'to' => $to,
            'from' => $from,
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');

    }

    private function compareMarksWithCriteria(Request $request)
{
    // Retrieve the vacancy's criteria
    $vacancy = Vacancy::findOrFail($request->vacancy_id);
    
    // Retrieve applicant's marks from the request
    $applicantMarks = [
        'class10' => $request->x_percentage,
        'class12' => $request->xii_percent,
        'degree' => $request->degree_percentage,
    ];
    

    // Check if each mark meets the criteria
    foreach ($applicantMarks as $key => $value) {
        // Retrieve the marks criteria from the vacancy
        $criteria = $vacancy->{$key . 'marks'};
        
        // Check if the applicant's marks are less than the criteria
        if ($value < $criteria) {
            // Criteria not met, return the name of the criteria
            return $key;
        }
    }

    // All criteria met, return true
    return true;
}

    

    public function checkcid(Request $request)
    {
        $cid = $request->input('cid');
        $existingApplicant = Applicant::where('cid', $cid)->first();

        if ($existingApplicant) {
            // If CID exists, return a response indicating it's a duplicate
            return response()->json(['status' => 'duplicate']);
        } else {
            // If CID doesn't exist, return a response indicating it's not a duplicate
            return response()->json(['status' => 'unique']);
        }
    }

    /**
     * Display the specified vacancy.
     */
    public function viewForm(int $id)
    {
        $vacancy = Vacancy::find($id);

        // Check if $vacancy is not null before accessing its properties
        if ($vacancy) {
            $vacancy_id = $id;
            $minQualification = $vacancy->minQualification;

            //  dd($minQualification); // Add this line to dump the value
            return view('form', compact('vacancy_id', 'minQualification'));
        } else {
            // Handle the case where no vacancy is found with the given $id
            abort(404);
        }
    }
}
