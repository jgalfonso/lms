<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Classes;
use App\Models\Enrollments;
use App\Models\Announcements;
use App\Models\Lessons;
use App\Models\LessonLinks;
use App\Models\LessonAttachments;
use App\Models\Attendance;
use App\Models\Assignments;
use App\Models\AssignmentLinks;
use App\Models\AssignmentAttachments;
use App\Models\SubmittedAssignment;
use App\Models\Projects;
use App\Models\ProjectLinks;
use App\Models\ProjectAttachments;
use App\Models\SubmittedProject;
use App\Models\Students;
use App\Models\Quizzes;
use App\Models\QuizParticipants;
use App\Models\QuizDetails;
use App\Models\QuizChoices;
use App\Models\QuizStudentAnswer;
use App\Models\Exams;

use App\Models\Comments;

class ClassesController extends Controller
{	

    public function getEnrolled()
    {   
        $studentID = Auth::user()->student->student_id;
        $data = Enrollments::getByRequest($studentID, 'Active');

        return response()->json($data);
    }

    public function getClass()
    {   
        $studentID = Auth::user()->student->student_id;
        $data['approved'] = Enrollments::getByRequest($studentID, 'Active');
        $data['pending'] = Enrollments::getByRequest($studentID, 'New');

        return response()->json($data);
    }

    public function getClassForApproval()
    {   
        $studentID = Auth::user()->student->student_id;
        $data = Enrollments::getByRequest($studentID, 'New');

        return response()->json($data);
    }

    public function getOverview(Request $request)
    {   
    	$request->request->add(['studentID' => Auth::user()->student->student_id]);
    	$data = Enrollments::getOverview($request);

        return response()->json($data);
    }

    public function getAnnouncements(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $request->request->add(['classID' =>  $request->referenceID]);
        $data['overview'] = Enrollments::getOverview($request);
        $data['announcements']  = Announcements::getByRequest($request);

        return response()->json($data);
    }

    public function getLessons(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $data['overview'] = Enrollments::getOverview($request);
        $data['lessons'] = Lessons::getByClassID($request);

        return response()->json($data);
    }

    public function getLessonByID(Request $request)
    {   
        $data['overview'] = Lessons::getByID($request);
        
        if ($data) {
            
            $data['links'] = LessonLinks::getByID($request);
            $data['attachments'] = LessonAttachments::getByID($request);
        }
        return response()->json($data);
    }

    public function getAttendance(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $data['overview'] = Enrollments::getOverview($request);
        $data['attendance'] = Attendance::getByRequestID($request);

        return response()->json($data);
    }






    public function getAssignments(Request $request)
    {   
        $data = Assignments::getByClassID($request);

        return response()->json($data);
    }

    public function getAssignmentByID(Request $request)
    {   
        $data['overview'] = Assignments::getByID($request);
        $data['links'] = AssignmentLinks::getByID($request);
        $data['attachments'] = AssignmentAttachments::getByID($request);

        return response()->json($data);
    }

    public function getSubmittedAssignment(Request $request)
    {   
        $data = SubmittedAssignment::getByAssignmentID($request);

        return response()->json($data);
    }

    public function getProjects(Request $request)
    {   
        $data = Projects::getByClassID($request);

        return response()->json($data);
    }

    public function getProjectByID(Request $request)
    {   
        $data['overview'] = Projects::getByID($request);
        $data['links'] = ProjectLinks::getByID($request);
        $data['attachments'] = ProjectAttachments::getByID($request);

        return response()->json($data);
    }

    public function getSubmittedProject(Request $request)
    {   
        $data = SubmittedProject::getByProjectID($request);

        return response()->json($data);
    }

    public function getQuizzes(Request $request)
    {   
        $data = Quizzes::getByClassID($request);

        return response()->json($data);
    }

    public function getQuizByID(Request $request)
    {   
        $data['overview'] = Quizzes::getByID($request);

        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $request->request->add(['quizParticipantID' => $data['overview']->quiz_participant_id]);
        $data['quizzes'] = QuizDetails::getByRequestID($request);

        return response()->json($data);
    }

    public function getQuizChoicesByID(Request $request)
    {   
        $data = QuizChoices::getByQuizDetailID($request);

        return response()->json($data);
    }

    public function getQuizResultByID(Request $request)
    {   
        $data['overview'] = QuizParticipants::getByID($request);
        
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $data['quizzes'] = QuizDetails::getByRequestID($request);

        return response()->json($data);
    }

    public function getExams(Request $request)
    {   
        $data = Exams::getByClassID($request);

        return response()->json($data);
    }

    public function getExamByID(Request $request)
    {   
         $data = Exams::getByID($request);

        return response()->json($data);
    }

    public function getParticipants(Request $request)
    {   
        $request->request->add(['courseID' => Auth::user()->student->course_id]);
        $data = Students::getByCourseID($request);

        return response()->json($data);
    }

    public function join(Request $request)
    {
      	$data = Classes::getByCode($request);

      	if ($data) {

      		$request->request->add(['classID' => $data->class_id]);
      		$request->request->add(['studentID' => Auth::user()->student->student_id]);
      		$request->request->add(['studentNO' => Auth::user()->student->student_no]);
      		$data = Enrollments::getByCode($request);

      		if ($data) {

      			$data = ['success' => false, 'message' => 'Class code already exist, to further review or pending for approval.'];
      		}
      		else {
      			
	      		$data = Enrollments::add($request);
      		}
      	} 
      	else {

      		$data = ['success' => false, 'message' => 'Class code does not exist. Please contact system administrator.'];
      	}

      	return response()->json($data); 	
    }

    public function attachAssignment(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $request->request->add(['studentCode' => Auth::user()->student->student_code]);
        $data = SubmittedAssignment::add($request);

        return response()->json($data); 
    }

    public function attachProject(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $request->request->add(['studentCode' => Auth::user()->student->student_code]);
        $data = SubmittedProject::add($request);

        return response()->json($data); 
    }

    public function takeQuiz(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $data = QuizParticipants::getByRequestID($request);

        if ($data) {

            if ($data->status == 'Active') $data = ['success' => true];
            else {
                $attempt = $data->attempt;
                
                if ($attempt == $request->allowedAttempts) $data = ['success' => false, 'message' => 'You’ve reached the maximum quiz attempts.'];
                else {

                    $request->request->add(['attempt' => $attempt+1]);
                    $data = QuizParticipants::add($request);
                }
            }
        } else {

            $request->request->add(['attempt' => 1]);
            $data = QuizParticipants::add($request);
        }

        return response()->json($data); 
    }

    public function answerQuiz(Request $request)
    {   
        $request->request->add(['studentID' => Auth::user()->student->student_id]);
        $data = QuizStudentAnswer::add($request);

        return response()->json($data); 
    }

    public function submitQuiz(Request $request)
    {   
        $data = QuizParticipants::edit($request);

        return response()->json($data); 
    }
}
