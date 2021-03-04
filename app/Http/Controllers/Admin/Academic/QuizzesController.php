<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Classes;
use App\Models\Admin\Courses;
use App\Models\Admin\Quizzes;

class QuizzesController extends Controller
{
    /**
     * Create new quiz
     */
    public function new ()
    {
        $courses = Courses::getCourses();

        return view('admin.academic.quizzes.new', compact('courses'));
    }

    /**
         * Saving new quiz
     */
    public function store (Request $request)
    {
        $new = Quizzes::storeQuiz($request);

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

    /**
     * Display recent quizzes
     */
    public function recent ()
    {
        $quizzes = Quizzes::getQuizzes();
        $classes = Classes::getClasses();

        return view('admin.academic.quizzes.recent', compact('quizzes', 'classes'));
    }

    /**
     * Display quiz archives
     */
    public function archives ()
    {
        $quizzes = Quizzes::getArchives();
        $classes = Classes::getClasses();

        return view('admin.academic.quizzes.archives', compact('quizzes', 'classes'));
    }

    /**
     * Display quiz
     */
    public function view ($id)
    {
        $quiz = Quizzes::getById($id);

        // dd($quiz);

        return view('admin.academic.quizzes.view', compact('quiz'));
    }

    /**
     * Edit quiz
     */
    public function edit ($id)
    {
        $quiz = Quizzes::getById($id);
        $courses = Courses::getCourses();

        return view('admin.academic.quizzes.edit', compact(
            'quiz',
            'courses'
        ));
    }

    /**
     * Getting all quizzes filtered by class id
     */
    public function filter (Request $request)
    {
        $quizzes = Quizzes::filter($request)->get();

        echo json_encode($quizzes);
    }

    public function activate(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Quizzes::activate($request);

        echo json_encode($data);
    }

    public function close(Request $request)
    {
        $request->request->add(['userID' => Auth::id()]);
        $data = Quizzes::close($request);

        echo json_encode($data);
    }
}
