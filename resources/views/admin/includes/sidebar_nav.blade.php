<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul id="main-menu" class="metismenu">
        <li class="header">Main</li>

        <li class="{{ set_nav_status(['admin/main/dashboard*']) }}">
            <a href="{{ route('dashboard') }}"><i class="icon-speedometer"></i><span>Dashboard</span></a>
        </li>

        <li>
            <a href="index.html"><i class="icon-home"></i><span>Home</span></a>
        </li>

        <li class="{{ set_nav_status(['admin/main/calendar*']) }}">
            <a href="{{ route('calendar') }}"><i class="icon-calendar"></i><span>Calendar</span></a>
        </li>

        <li>
            <a href="#"><i class="icon-bubbles"></i><span>Forums</span></a>
        </li>

        <li class="header">Academic</li>
        <li class="{{ set_nav_status(['admin/academic/class-activation*']) }}">
            <a href="{{ route('class-activation') }}"><i class="icon-user-following"></i><span>Class Activation</span></a>
        </li>

        <li class="{{ set_nav_status(['admin/academic/lessons*']) }}">
            <a href="#" class="has-arrow">
                <i class="icon-folder-alt"></i><span>Lessons</span>
            </a>
            <ul>
                <li class="{{ set_nav_status(['admin/academic/lessons/new']) }}">
                    <a href="{{ route('new-lesson') }}">New Lesson</a>
                </li>
                <li class="{{ set_nav_status(['admin/academic/lessons/lesson-plan']) }}">
                    <a href="{{ route('lesson-plan') }}">Lesson Plan</a>
                </li>
                <li class="{{ set_nav_status(['admin/academic/lessons/archives']) }}">
                    <a href="{{ route('archives') }}">Archives</a>
                </li>
            </ul>
        </li>

        <li style="display: none;">
            <a href="#"><i class="icon-volume-2"></i><span>Announcements</span></a>
        </li>

        <li style="display: none;">
            <a href="#"><i class="icon-doc"></i><span>Attendance</span></a>
        </li>

        <li class="{{ set_nav_status(['admin/academic/assignments*']) }}">
            <a href="#" class="has-arrow"><i class="icon-folder-alt"></i><span>Assignments</span></a>

            <ul>
                <li class="{{ set_nav_status(['admin/academic/assignments/new']) }}">
                    <a href="{{ route('new-assignment') }}">New Assignment</a>
                </li>
                <li class="{{ set_nav_status(['admin/academic/assignments/recent']) }}">
                    <a href="{{ route('recent-assignment') }}">Recent Assignment/s</a>
                </li>
                <li><a  href="classess.html">Assignment Submitted & Evaluation</a></li>
                <li class="{{ set_nav_status(['admin/academic/assignments/archives']) }}">
                    <a href="{{ route('archives-assignment') }}">Archives</a>
                </li>
            </ul>
        </li>

        <li class="{{ set_nav_status(['admin/academic/projects*']) }}">
            <a href="#" class="has-arrow"><i class="icon-folder-alt"></i><span>Projects</span></a>

            <ul>
                <li class="{{ set_nav_status(['admin/academic/projects/new']) }}">
                    <a href="{{ route('new-project') }}">New Project</a>
                </li>
                <li class="{{ set_nav_status(['admin/academic/projects/recent']) }}">
                    <a href="{{ route('recent-project') }}">Recent Project/s</a>
                </li>
                <li><a  href="classess.html">Project Submitted & Evaluation</a></li>
                <li class="{{ set_nav_status(['admin/academic/projects/archives']) }}">
                    <a href="{{ route('archives-project') }}">Archives</a>
                </li>
            </ul>
        </li>

        <li class="{{ set_nav_status(['admin/academic/quizzes*']) }}">
            <a href="#" class="has-arrow"><i class="icon-folder-alt"></i><span>Quizzes</span></a>

            <ul>
                <li class="{{ set_nav_status(['admin/academic/quizzes/new']) }}">
                    <a href="{{ route('new-quiz') }}">New Quiz</a>
                </li>
                <li class="{{ set_nav_status(['admin/academic/quizzes/recent']) }}">
                    <a href="{{ route('recent-quiz') }}">Recent Quizze/s</a>
                </li>
                <li><a  href="classess.html">Quiz Taken & Evaluation</a></li>
                <li class="{{ set_nav_status(['admin/academic/assignments/quizzes']) }}">
                    <a href="{{ route('archives-quiz') }}">Archives</a>
                </li>
            </ul>
        </li>

        <li class="{{ set_nav_status(['admin/academic/exams*']) }}">
            <a href="#" class="has-arrow"><i class="icon-folder-alt"></i><span>Exams</span></a>

            <ul>
                <li class="{{ set_nav_status(['admin/academic/exams/new']) }}">
                    <a href="{{ route('new-exam') }}">New Exam</a>
                </li>
                <li class="{{ set_nav_status(['admin/academic/exams/recent']) }}">
                    <a href="{{ route('recent-exam') }}">Recent Exam/s</a>
                </li>
                <li><a  href="classess.html">Exam Taken & Evaluation</a></li>
                <li class="{{ set_nav_status(['admin/academic/exams/archives']) }}">
                    <a href="{{ route('archives-exam') }}">Archives</a>
                </li>
            </ul>
        </li>

        <li><a href="#"><i class="icon-badge"></i><span>Grades</span></a></li>

        <li><a href="#"><i class="icon-speech"></i><span>Feedback</span></a></li>

        <li class="header">Services</li>
        <li class="{{ set_nav_status(['admin/services/enrollment*']) }}">
            <a href="#" class="has-arrow"><i class="icon-users  "></i><span>Enrollment</span></a>
            <ul>
                <li style="display: none;"><a href="">Online Registration</a></li>
                <li class="{{ set_nav_status(['admin/services/enrollment/enroll-student', 'admin/services/enrollment/enroll-student/new/*']) }}"><a href="{{ route('enroll_student') }}">Enroll Student</a></li>
                <li class="{{ set_nav_status(['admin/services/enrollment/class-summary']) }}"><a href="{{ route('class_summary') }}">Class Summary</a></li>
            </ul>
        </li>

        <li class="{{ set_nav_status(['admin/services/billing*']) }}">
            <a href="#" class="has-arrow"><i class="icon-calculator  "></i><span>Billing</span></a>
            <ul>
                <li class="{{ set_nav_status(['admin/services/billing/new', 'admin/services/billing/new/*']) }}"><a href="{{ route('invoices-new-1') }}">New Invoice</a></li>
                <li class="{{ set_nav_status(['admin/services/billing/invoices']) }}"><a href="{{ route('invoices') }}">Invoices</a></li>
                <li class="{{ set_nav_status(['admin/services/billing/payments']) }}"><a href="{{ route('payments') }}">Payments</a></li>
            </ul>
        </li>

        <li style="display: none;">
            <a href="#"><i class="icon-clock"></i><span>Scheduling</span></a>
        </li>

        <li class="{{ set_nav_status(['admin/services/assessment*']) }}">
            <a href="#" class="has-arrow"><i class="icon-magnifier  "></i><span>Assessment</span></a>

            <ul>
                <li class="{{ set_nav_status(['admin/services/assessment/new']) }}"><a href="{{ route('new-assessment') }}">New Assessment</a></li>
                <li class="{{ set_nav_status(['admin/services/assessment/recent']) }}"><a href="{{ route('recent-assessment') }}">Recent Assessment</a></li>
            </ul>
        </li>

        <li class="{{ set_nav_status(['admin/services/certification*']) }}">
            <a href="#" class="has-arrow"><i class="icon-printer"></i><span>Certification</span></a>

            <ul>
                <li class="{{ set_nav_status(['admin/services/certification/moderations']) }}">
                    <a href="{{ route('moderations') }}">Moderations</a>
                </li>
                <li class="{{ set_nav_status(['admin/services/certification/published']) }}">
                    <a href="{{ route('published') }}">Published</a>
                </li>
            </ul>
        </li>

        <li class="header">Manage Users</li>
        <li class="{{ set_nav_status(['admin/manage-users/students*']) }}"><a href="{{ route('students') }}"><i class="icon-users"></i><span>Students</span></a></li>
        <li class="{{ set_nav_status(['admin/manage-users/faculty*']) }}"><a href="{{ route('faculty') }}"><i class="icon-users"></i><span>Faculty</span></a></li>

        <li class="header">Setup</li>
        <li class="{{ set_nav_status(['admin/setup/classes*']) }}">
            <a href="{{ route('classes') }}"><i class="icon-docs"></i><span>Classes</span></a>
        </li>
        <li class="{{ set_nav_status(['admin/setup/courses*']) }}">
            <a href="{{ route('courses') }}"><i class="icon-docs"></i><span>Courses</span></a>
        </li>
        <li style="display: none;"><a href=""><i class="icon-docs"></i><span>Roles</span></a></li>
    </ul>
</nav>
