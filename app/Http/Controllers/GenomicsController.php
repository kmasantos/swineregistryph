<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\LaboratoryResult;
use App\Models\LaboratoryTest;
use App\Repositories\GenomicsRepository;
use Illuminate\Http\Request;

use Auth;
use PDF;

class GenomicsController extends Controller
{

    protected $user;
    protected $genomicsUser;
    protected $genomicsRepo;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GenomicsRepository $genomicsRepo)
    {
        $this->middleware('role:genomics');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            $this->genomicsUser = Auth::user()->userable()->first();

            return $next($request);
        });
        $this->genomicsRepo = $genomicsRepo;
    }

    /**
     * Show Genomics' homepage view
     *
     * @return  View
     */
    public function index()
    {
        return view('users.genomics.home');
    }

    /**
     * Show form for registering genetic information
     *
     * @return  View
     */
    public function showRegisterLaboratoryResults()
    {
        $farmOptions = [];
        $farms = Farm::all();

        foreach ($farms as $farm) {
            $farmOptions[] = [
                'text'  => $farm->name . ' , ' . $farm->province,
                'value' => $farm->id
            ];
        }

        $farmOptions = collect($farmOptions)->sortBy('text')->values();

        return view('users.genomics.registerLaboratoryResults', compact('farmOptions'));
    }

    /**
     * View Current Laboratory Results
     *
     * @param   Request $request
     * @return  View
     */
    public function viewLaboratoryResults(Request $request)
    {
        $currentSearchParameter = '';
        $labResults = LaboratoryResult::with(['laboratoryTests'])->get();
        $customLabResults = $this->genomicsRepo->customizeLabResults($labResults);

        // Filter laboratory results according to search filter
        if($request->q){
            $customLabResults = $customLabResults
                ->where('labResultNo', $request->q)
                ->values();

            // Retain current search parameter
            $currentSearchParameter = $request->q;
        }

        return view('users.genomics.viewLaboratoryResults', 
            compact(
                'customLabResults', 
                'currentSearchParameter'
            ));
    }

    /**
     * Add laboratory results
     *
     * @param   Request $request
     * @return  JSON
     */
    public function addLaboratoryResults(Request $request)
    {
        return $this->genomicsRepo->addLabResults($request, $this->genomicsUser);
    }

    /**
     * View PDF of Laboratory Results
     *
     * @param   integer     $labResultId
     * @return  PDF
     */
    public function viewPDFLaboratoryResults($labResultId)
    {
        $labResult = LaboratoryResult::where('id', $labResultId)->with('laboratoryTests')->first();

        if($labResult){
            $farm = Farm::find($labResult->farm_id);
            $customLabResult = $this->genomicsRepo->buildLabResultData($labResult, $farm);
            
            $view = \View::make('users.genomics._pdfLabResults', compact('customLabResult'));
            $html = $view->render();

            $tagvs = [
                'h1' => [
                    ['h' => 0, 'n' => 0]
                ],
                'h2' => [
                    ['h' => 0, 'n' => 0]
                ],
                'p' => [
                    ['h' => 0, 'n' => 0]
                ]
            ];

            // Set configuration and show pdf
            PDF::SetCellPadding(0);
            PDF::setHtmlVSpace($tagvs);
            PDF::setFont('dejavusanscondensed', '', 10);
            PDF::SetTitle("Lab Result No. {$customLabResult['labResultNo']}");
            PDF::AddPage();
            PDF::WriteHTML($html, true, false, true, false, '');
            PDF::Output("{$customLabResult['labResultNo']}.pdf");
        }
        else return abort(404);
    }
}
