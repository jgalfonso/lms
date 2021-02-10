import Join from './Join';
import Overview from './Overview';
import Announcements from './Announcements';
import Lessons from './Lessons';
import Attendance from './Attendance';
import Assignments from './Assignments';
import Projects from './Projects';
import Quizzes from './Quizzes';
import Grades from './Grades';
import Exams from './Exams';
import Participants from './Participants';

let parameter = window.location.pathname.split('/')[2];
let props;

switch(parameter) {
	case 'join': props = { path: '/classes/join', component: Join }; break;
	default: 

		let sub = window.location.pathname.split('/')[3];
		
		switch(sub) {
			case 'overview': props = { path: '/classes/:class_id/overview', component: Overview }; break;
			case 'announcements': props = { ...Announcements }; break;
			case 'lessons': props = { ...Lessons }; break;
			case 'attendance': props = { path: '/classes/:class_id/attendance', component: Attendance }; break;
			case 'assignments': props = { ...Assignments }; break;
			case 'projects': props = { ...Projects }; break;
			case 'quizzes': props = { ...Quizzes }; break;
			case 'exams': props = { ...Exams }; break;
			case 'grades': props = { path: '/classes/:class_id/grades', component: Grades }; break;
			case 'participants': props = { path: '/classes/:class_id/participants', component: Participants }; break;
			default: props = { path: '', component: '' };
		}
}

export default { ...props }