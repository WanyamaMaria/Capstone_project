<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Program;
use App\Models\Facility;
use App\Models\Service;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Participant;
use App\Models\Outcome;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'stats' => [
                'programs' => Program::count(),
                'facilities' => Facility::count(),
                'services' => Service::count(),
                'equipment' => Equipment::count(),
                'projects' => Project::count(),
                'participants' => Participant::count(),
                'outcomes' => Outcome::count(),
            ]
        ]);
    }
}
