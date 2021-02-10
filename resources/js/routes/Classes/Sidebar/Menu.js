import React, { Component } from "react";

import { setMenuStatus } from "../../../helpers/app";

class Menu extends Component {
    render() {
        const { classID } = this.props;

        return (
            <div className="col-md-2">
                <div className="card sticky-static">
                    <ul className="list-group">
                        <li className={'list-group-item '+setMenuStatus('/classes/:class_id/overview')}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/overview'}>Overview</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus(['/classes/:class_id/announcements', '/classes/:class_id/announcements/:announcement_id'])}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/announcements'}>Announcements</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus(['/classes/:class_id/lessons', '/classes/:class_id/lessons/:lessons_id'])}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/lessons'}>Lessons</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus('/classes/:class_id/attendance')}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/attendance'}>Attendance</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus(['/classes/:class_id/assignments', '/classes/:class_id/assignments/:lessons_id'])}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/assignments'}>Assignments</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus(['/classes/:class_id/projects', '/classes/:class_id/projects/:project_id'])}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/projects'}>Projects</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus('/classes/:class_id/quizzes')}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/quizzes'}>Quizzes</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus('/classes/:class_id/exams')}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/exams'}>Exams</a></p>
                        </li>
                        <li className="list-group-item" style={{ display: 'none' }}>
                            <p className="mb-0"><a href="#">Discussion</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus('/classes/:class_id/grades')}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/grades'}>Grades</a></p>
                        </li>
                        <li className={'list-group-item '+setMenuStatus('/classes/:class_id/participants')}>
                            <p className="mb-0"><a href={'/classes/'+classID+'/participants'}>Participants</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        )
    }
}

export default Menu;


