<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Photo;
use App\Models\Property;
use App\Models\Swine;
use App\Models\SwineProperty;
use App\Repositories\CustomHelpers;
use App\Repositories\SwineRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use Storage;

class SwineController extends Controller
{
    use CustomHelpers;

    protected $user;
    protected $breederUser;
    protected $swineRepo;

    // Constant variable paths
    const SWINE_IMG_PATH = '/images/swine/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SwineRepository $swineRepository)
    {
        $this->middleware('role:breeder');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            $this->breederUser = Auth::user()->userable()->first();

            return $next($request);
        });
        $this->swineRepo = $swineRepository;
    }

    /**
     * Show Registration form for adding swine
     *
     * @return  View
     */
    public function showRegistrationForm()
    {
        $farmOptions = [];
        $breedOptions = [];

        // Get farm options for farm from input select
        foreach ($this->breederUser->farms as $farm) {
            array_push($farmOptions,
                [
                    'text' => $farm->name . ' , ' . $farm->province,
                    'value' => $farm->id
                ]
            );
        }

        // Get breed options for breed input select
        foreach(Breed::all() as $breed){
            array_push($breedOptions,
                [
                    'text' => $breed->title,
                    'value' => $breed->id
                ]
            );
        }

        $farmOptions = collect($farmOptions);
        $breedOptions = collect($breedOptions);

        return view('users.breeder.form', compact('farmOptions', 'breedOptions'));
    }

    /**
     * View already registered swine
     *
     * @return  View
     */
    public function viewRegisteredSwine()
    {
        $swines = $this->breederUser->swines()->with(['swineProperties.property', 'breed', 'photos', 'farm', 'certificate.photos'])->get();

        return view('users.breeder.viewRegisteredSwine', compact('swines'));
    }

    /**
     * View Registry Certicate
     *
     * @param   integer     $swineId
     * @return  View
     */
    public function viewRegistryCertificate($swineId)
    {
        $swine = Swine::where('id', $swineId)->with('swineProperties')->first();

        return view('users.breeder.registryCertificate', compact('swine'));
    }

    /**
     * Get Swine according to registration number
     *
     * @param   Request     $request
     * @param   integer     $regNo
     * @return  JSON
     */
    public function getSwine(Request $request, $sex, $regNo)
    {
        if($request->ajax()){
            $swine = Swine::where('registration_no', $regNo)->first();

            if($swine){
                $swineSex = $this->swineRepo->getSwinePropValue($swine,1);

                if($swineSex === $sex){
                    return $data = [
                        'existingRegNo' =>         $swine->registration_no,
                        'imported' => [
                            'regNo' =>             ($swine->farm_id == 0) ? $swine->registration_no : '',
                            'farmOfOrigin' =>      ($swine->farm_id == 0) ? $this->swineRepo->getSwinePropValue($swine, 26) : '',
                            'countryOfOrigin' =>   ($swine->farm_id == 0) ? $this->swineRepo->getSwinePropValue($swine, 27) : ''
                        ],
                        'farmFromId' =>            $swine->farm_id,
                        'sex' =>                   $this->swineRepo->getSwinePropValue($swine, 1),
                        'birthDate' =>             $this->changeDateFormat($this->swineRepo->getSwinePropValue($swine, 2)),
                        'birthWeight' =>           $this->swineRepo->getSwinePropValue($swine, 3),
                        'adgBirthEndDate' =>       $this->changeDateFormat($this->swineRepo->getSwinePropValue($swine, 5)),
                        'adgBirthEndWeight' =>     $this->swineRepo->getSwinePropValue($swine, 6),
                        'adgTestStartDate' =>      $this->changeDateFormat($this->swineRepo->getSwinePropValue($swine, 8)),
                        'adgTestStartWeight' =>    $this->swineRepo->getSwinePropValue($swine, 9),
                        'adgTestEndDate' =>        $this->changeDateFormat($this->swineRepo->getSwinePropValue($swine, 10)),
                        'adgTestEndWeight' =>      $this->swineRepo->getSwinePropValue($swine, 11),
                        'houseType' =>             $this->swineRepo->getSwinePropValue($swine, 12),
                        'bft' =>                   $this->swineRepo->getSwinePropValue($swine, 13),
                        'bftCollected' =>          $this->changeDateFormat($this->swineRepo->getSwinePropValue($swine, 14)),
                        'feedIntake' =>            $this->swineRepo->getSwinePropValue($swine, 15),
                        'teatNo' =>                $this->swineRepo->getSwinePropValue($swine, 17),
                        'parity' =>                $this->swineRepo->getSwinePropValue($swine, 18),
                        'littersizeAliveMale' =>   $this->swineRepo->getSwinePropValue($swine, 19),
                        'littersizeAliveFemale' => $this->swineRepo->getSwinePropValue($swine, 20),
                        'littersizeWeaning' =>     $this->swineRepo->getSwinePropValue($swine, 21),
                        'litterweightWeaning' =>   $this->swineRepo->getSwinePropValue($swine, 22),
                        'dateWeaning' =>           $this->changeDateFormat($this->swineRepo->getSwinePropValue($swine, 23)),
                        'farmSwineId' =>           $this->swineRepo->getSwinePropValue($swine, 24),
                        'geneticInfoId' =>         $this->swineRepo->getSwinePropValue($swine, 25)
                    ];
                }
                else return 'Swine with registration no. ' . $regNo . ' is not '. $sex . '.';
            }
            else return 'Swine with registration no. ' . $regNo . ' cannot be found.';
        }
    }

    /**
     * Add Swine to database
     *
     * @param   Request     $request
     * @return  integer
     */
    public function addSwineInfo(Request $request)
    {
        if($request->ajax()){
            $gpSireInstance = $this->swineRepo->addParent($request->gpSire);
            $gpDamInstance = $this->swineRepo->addParent($request->gpDam);
            $gpOneInstance = $this->swineRepo->addSwine($request->gpOne, $gpSireInstance->id, $gpDamInstance->id);

            return $gpOneInstance;
        }
    }

}
