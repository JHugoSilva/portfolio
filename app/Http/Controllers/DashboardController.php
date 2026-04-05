<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $skillCount = Skill::count();
        $educationCount = Education::count();
        $experienceCount = Experience::count();
        $serviceCount = Service::count();
        $projectCount = Project::count();
        $testimonialCount = Testimonial::count();
        $messageCount = Message::count();
        $userCount = User::count();

        $skills = Skill::latest()->get();
        $projects = Project::latest()->get();
        $testimonials = Testimonial::latest()->take(5)->get();
        $services = Service::with('skills')->latest()->get();

        return response()->json([
            'skillCount' => $skillCount,
            'educationCount' => $educationCount,
            'experienceCount' => $experienceCount,
            'serviceCount' => $serviceCount,
            'projectCount' => $projectCount,
            'testimonialCount' => $testimonialCount,
            'messageCount' => $messageCount,
            'userCount' => $userCount,
            'projects' => $projects,
            'testimonials' => $testimonials,
            'skills' => $skills,
            'services' => $services
        ]);
    }
}
