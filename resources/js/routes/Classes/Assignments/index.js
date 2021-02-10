import Main from './Main'
import View from './View'

let parameter = window.location.pathname.split('/')[4];
let props = null;

if (parameter) {
	props = { path: '/classes/:class_id/assignments/:assignment_id', component: View };
} else {
	props = { path: '/classes/:class_id/assignments', component: Main };
}

export default { ...props }
