import {getAppState} from '../../helpers/app';

let user = getAppState();
const initialState = user ? { authenticated: true, user: user } : {};

export default function(state = initialState) {
	return state;
}
