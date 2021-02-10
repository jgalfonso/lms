import { matchPath } from "react-router-dom";

export const getAppState = () => {
    
    let data = localStorage.getItem('lmsappState');
    return data;
}

export const setNavStatus = ($path) => {
	
	return matchPath(location.pathname, { path: $path, exact: true, strict: false }) && 'on' || null;
}

export const setSubNavStatus = ($path) => {
	
	return matchPath(location.pathname, { path: $path, exact: true, strict: false }) && 'collapse in' || 'collapse';
}

export const setMenuStatus = ($path) => {
	
	return matchPath(location.pathname, { path: $path, exact: true, strict: false }) && 'active' || null;
}