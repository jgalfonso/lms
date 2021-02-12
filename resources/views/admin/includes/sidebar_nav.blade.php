<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul id="main-menu" class="metismenu">
        <li class="header">Main</li>

        <li class="{{ set_nav_status(['admin/dashboard*']) }}">
            <a href="{{ route('dashboard') }}"><i class="icon-speedometer"></i><span>Dashboard</span></a>
        </li>

        <li>
            <a href="index.html"><i class="icon-home"></i><span>Home</span></a>
        </li>

        <li>
            <a href="calendar.html"><i class="icon-calendar"></i><span>Calendar</span></a>
        </li>

        <li>
            <a href="#"><i class="icon-bubbles"></i><span>Forums</span></a>
        </li>

        <li class="header">Academic</li>
        <li>
            <a href="academic-class_activation.html"><i class="icon-user-following"></i><span>Class Activation</span></a>
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
            </ul>
        </li>

        <li>
            <a href="#"><i class="icon-volume-2"></i><span>Announcements</span></a>
        </li>

        <li>
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

        <li>
            <a href="#" class="has-arrow"><i class="icon-folder-alt"></i><span>Quizzes</span></a>

            <ul>
                <li><a  href="classess-new.html">New</a></li>
                <li><a  href="classess.html">Recent Quizze/s</a></li>
                <li><a  href="classess.html">Quiz Taken & Evaluation</a></li>
                 <li><a  href="classess-new.html">Archives</a></li>
            </ul>
        </li>

        <li>
            <a href="#" class="has-arrow"><i class="icon-folder-alt"></i><span>Exams</span></a>

            <ul>
                <li><a  href="classess-new.html">New</a></li>
                <li><a  href="classess.html">Recent Exam/s</a></li>
                <li><a  href="classess.html">Exam Taken & Evaluation</a></li>
                <li><a  href="classess-new.html">Archives</a></li>
            </ul>
        </li>

        <li><a href="#"><i class="icon-badge"></i><span>Grades</span></a></li>

        <li><a href="#"><i class="icon-speech"></i><span>Feedback</span></a></li>

        <li class="header">Services</li>
        <li>
            <a href="#" class="has-arrow"><i class="icon-users  "></i><span>Enrollment</span></a>

            <ul>
                <li><a  href="">Online Registration</a></li>
                 <li><a  href="services-enrollment-enroll_student.html">Enroll Student</a></li>
                <li><a  href="services-enrollment-class_summary.html">Class Summary</a></li>
            </ul>
        </li>

       <li>
            <a href="#" class="has-arrow"><i class="icon-calculator  "></i><span>Billing</span></a>

            <ul>
                <li><a href="services-billing-invoices-new.html">New Invoice</a></li>
                <li><a href="services-billing-invoices.html">Invoices</a></li>
                <li><a href="services-billing-payments.html">Payments</a></li>
            </ul>
        </li>

        <li>
            <a href="#"><i class="icon-clock"></i><span>Scheduling</span></a>
        </li>

        <li>
            <a href="#" class="has-arrow"><i class="icon-magnifier  "></i><span>Assessment</span></a>

            <ul>
                <li><a href="services-assessment-new.html">New Assessment</a></li>
                <li><a href="services-assessment-recent.html">Recent Assessment</a></li>
            </ul>
        </li>

        <li>
            <a href="#" class="has-arrow"><i class="icon-printer"></i><span>Certification</span></a>

            <ul>
                <li><a href="services-certificates-moderations.html">Moderations</a></li>
                <li><a href="services-certificates-published.html">Published</a></li>
            </ul>
        </li>

        <li class="header">Manage Users</li>
        <li><a href="users-students.html"><i class="icon-users"></i><span>Students</span></a></li>
        <li><a href="users-admin.html"><i class="icon-users"></i><span>Admin</span></a></li>

        <li class="header">Setup</li>
        <li><a href="setup-class.html"><i class="icon-docs"></i><span>Class</span></a></li>
        <li><a href=""><i class="icon-docs"></i><span>Course</span></a></li>
        <li><a href=""><i class="icon-docs"></i><span>Roles</span></a></li>
    </ul>
</nav>
