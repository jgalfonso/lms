<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Lessons;
use App\Models\Admin\Courses;
use App\Models\Admin\Classes;

class LessonsController extends Controller
{

    /**
     * Draft for now
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $summary = BikiniContestEntries::getSummary();
    //     $entries = BikiniContestEntries::getEntries('New');
    //
    //     return view('admin.moderations.bikini-contest.index', compact(
    //         'summary', 'entries'
    //     ));
    // }
    //
    // public function getEntries(Request $request)
    // {
    //
    //     $entries = BikiniContestEntries::getEntries($request->status);
    //
    //     echo json_encode($entries);
    // }

    /**
     * Create new lesson
     */
    public function new ()
    {
        $courses = Courses::getCourses();

        return view('admin.academic.lessons.new', compact('courses'));
    }

    /**
     * Saving new lesson
     */
    public function store (Request $request)
    {
        $new = Lessons::storeLesson($request);

        echo json_encode($new);
    }

    /**
     * Getting classes using specific course_id
     */
    public function getClasses (Request $request)
    {
        $classes = Classes::getByCourse($request);

        echo json_encode($classes);
    }

    // public function getEmailTemplate(Request $request)
    // {
    //     $template = EmailTemplate::getDetails($request->emailTemplateID);
    //
    //     echo json_encode($template);
    // }
    //
    // public function upload(Request $request)
    // {
    //     $data = BikiniContestImages::uploadImage($request);
    //
    //     if ($data['success'] = true) {
    //
    //         $request->request->add(['imageIDS' => $data['ids']]);
    //         $request->request->add(['status' => 'Draft']);
    //         $images = BikiniContestImages::getByRequest($request);
    //         $data['idx'] = $images->max('idx');
    //         $data['images'] = view('admin.moderations.bikini-contest.entry_images', compact('images'))->render();
    //     }
    //
    //     echo json_encode($data);
    // }
    //
    // public function moderate(Request $request)
    // {
    //     $request->request->add(['moderatorID' => Auth::user()->profile->profile_id]);
    //     $request->request->add(['userID' => Auth::id()]);
    //     $data = BikiniContestEntries::moderate($request);
    //
    //     echo json_encode($data);
    // }
    //
    // public static function delete(Request $request)
    // {
    //     $request->request->add(['userID' => Auth::id()]);
    //     $data = BikiniContestEntries::deleteEntry($request);
    //
    //     echo json_encode($data);
    // }
    //
    // public function publish(Request $request)
    // {
    //     $request->request->add(['publisherID' => Auth::user()->profile->profile_id]);
    //     $request->request->add(['userID' => Auth::id()]);
    //     $data = BikiniContestEntries::publish($request);
    //
    //     echo json_encode($data);
    // }
}
