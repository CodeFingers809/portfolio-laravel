<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use App\Models\Education;
use App\Models\SocialLink;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Award;
use App\Models\Certification;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        $data = [
            'personalInfo' => PersonalInfo::first(),
            'education' => Education::orderBy('order')->get(),
            'socialLinks' => SocialLink::orderBy('order')->get(),
            'experiences' => Experience::orderBy('order')->get(),
            'projects' => Project::orderBy('order')->get(),
            'awards' => Award::orderBy('order')->get(),
            'certifications' => Certification::orderBy('order')->get(),
            'skills' => Skill::orderBy('order')->get(),
            'skillsByCategory' => Skill::orderBy('order')->get()->groupBy('category'),
        ];

        return view('portfolio', $data);
    }
}
