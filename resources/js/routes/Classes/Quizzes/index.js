import Main from './Main'
import View from './View'
import Result from './Result'

let parameter = window.location.pathname.split('/')[4];
let props = null;

if (parameter) {
	
	let res = window.location.pathname.split('/')[5];

	props = res && { path: '/classes/:class_id/quizzes/:quiz_id/result', component: Result } || { path: '/classes/:class_id/quizzes/:quiz_id', component: View };
} else {

	props = { path: '/classes/:class_id/quizzes', component: Main };
}

export default { ...props }