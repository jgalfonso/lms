import React from 'react';
import ReactDOM from 'react-dom';
import { Route, Switch, Redirect } from 'react-router-dom';

import TopNavBar from '../components/includes/TopNavBar';
import SearchBar from '../components/includes/SearchBar';
import RightBar from '../components/includes/RightBar';
import LeftSideBar from '../components/includes/LeftSideBar';

import { getAppState } from '../helpers/app';

import SignIn from './Auth/SignIn';
import Dashboard from './Dashboard';
import Home from './Home';
import Classes from './Classes';
import Forums from './Forums';
import Calendar from './Calendar';
import Wiki from './Wiki';
import PageNotFound from './PageNotFound';

export default function createRoutes() {
    return (
        <Switch>
        	<Route path={['/sign-in']}>
			  	<Route {...SignIn} />
			</Route>

			<Route exact path={['/']}>
				<>
					<TopNavBar />

					<SearchBar />

					<RightBar />

					<LeftSideBar />

				  	<Route exact path='/' {...Home} />
			  	</>
			</Route>

			<Route path={[
				'/dashboard', 
				'/classes/join', 
				'/classes/:class_id/overview', 
				'/classes/:class_id/announcements', 
				'/classes/:class_id/lessons', 
				'/classes/:class_id/attendance', 
				'/classes/:class_id/assignments', 
				'/classes/:class_id/projects',
				'/classes/:class_id/quizzes',
				'/classes/:class_id/exams',
				'/classes/:class_id/grades',
				'/classes/:class_id/participants',
				'/forums',
				'/calendar',
				'/wiki']} >
				<>
					<TopNavBar />

					<SearchBar />

					<RightBar />

					<LeftSideBar />

					<Route {...Dashboard} />
				  	<Route {...Classes} />
				  	<Route {...Forums} />
				  	<Route {...Calendar} />
				  	<Route {...Wiki} />
			  	</>
			</Route>

			<Route {...PageNotFound} />
        </Switch>
    )
}


