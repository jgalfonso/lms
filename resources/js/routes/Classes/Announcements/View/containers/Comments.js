import React, { Component } from "react";
import parse from 'html-react-parser';
import moment from 'moment';
import { withSnackbar } from 'notistack';

import Emoji from "../../../../../components/emoji/Emoji";
import Loader from "../../../../../components/loader/Bar";

import snackBar from '../../../../../helpers/snackbar';
import { add, del } from "../../../../../helpers/comments";

class Comments extends Component {
    constructor(props) {
        super(props)      
        this.form = React.createRef();
        this.body = React.createRef();

        this.state = {
            body: '',
            dt: [],
            loading: false
        }
    }

    componentDidMount() {
        
        this.setState({ 
            dt: this.props.dt
        });
    }

    componentDidUpdate(prevProps, prevState) {
        if (prevProps.dt != this.props.dt) {
            
            this.setState({ 
                dt: this.props.dt
            });
        }
    }

    handleChange = e => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }  

    handlePost = async (e) => {
        e.preventDefault();

        if (this.form.current.reportValidity()) {
            
            this.setState({ loading: true });

            const dt = new FormData();
            dt.append('commentableTypeID', 1);
            dt.append('referenceID', this.props.announcementID);
            dt.append('message', this.state.body);

            await add(dt, this.props.user.access_token).then(response => {
                
                this.setState({ loading: false });

                if (response.success) {

                    snackBar.show(this.props, 'Comment sucessfully posted.', 'success');
                    this.props.onSuccess();
                    
                   this.setState({ body: '' });
                }
                else snackBar.show(this.props, response.message, 'error');
            });  
        }
    }

    handleRemove = async (commentID) => {
        this.setState({ loading: true });

        const dt = new FormData();
        dt.append('referenceID', this.props.announcementID);
        dt.append('commentID', commentID);

        await del(dt, this.props.user.access_token).then(response => {
                
            this.setState({ loading: false });

            if (response.success) {

                snackBar.show(this.props, 'Comment sucessfully removed.', 'success');
                this.props.onSuccess();
                
               this.setState({ body: '' });
            }
            else snackBar.show(this.props, response.message, 'error');
        });  
    }

    render() {
        const { body, dt, loading } = this.state;

        return (
            <div className="col-12">
                <div className="card">
                    <div className="body">
                <h5 className="card-title"><a href="">Comments :</a></h5>

                <div className="clearfix"></div>

                <form ref={this.form}>
                    <div className="chatapp_body" style={{ margin: 0, border: 0 }}>
                        <div className="chat-history" style={{ padding: "15px 0 0 0", borderTop: "1px dashed #e1e8ed" }}>
                            <ul className="message_data">
                                {
                                    dt && dt.map((data, index) => {

                                        let css = data.parent_id && 'right clearfix' || 'left clearfix';

                                        let avatar = data.parent_id && (

                                                data.teacher_path && data.teacher_filename && (<img className="user_pix" src={data.teacher_path+data.teacher_filename} alt="avatar" />) || <div className="user_pix avtar-pic w35 bg-orange"><span>{data.teacher_initial}</span></div>
                                            ) || (
                                                
                                                data.student_path && data.student_filename && (<img className="user_pix" src={data.student_path+data.student_filename} alt="avatar" />) || <div className="user_pix avtar-pic w35 bg-green"><span>{data.student_initial}</span></div>
                                            );
                                       
                                        return (
                                            <li key={index} className={css}>
                                                {avatar}
                                               
                                                <div className="message">
                                                    <span>{data.message}</span>
                                                </div>
                                                
                                                <span className="data_time">{moment(data.dt_created).startOf('second').fromNow()} {!data.parent_id && data.created_by == this.props.user.user_id && <>| <a onClick={() => this.handleRemove(data.comment_id)} style={{ color: "#007bff" }} >Remove</a></>}  </span>
                                            </li>
                                        )
                                   })
                                }
                            </ul>
                        </div>

                        <div className="chat-message clearfix" style={{ padding: "10px 0 10px 50px" }}>
                            <div className="input-group mb-0">
                                <textarea 
                                    ref={this.body} 
                                    onChange={this.handleChange} 
                                    value={body}
                                    type="text" name="body" className="form-control" placeholder="Enter comment here..." rows="5" required style={{ background: "#fff" }}></textarea>
                            </div>

                            <div className="align-right">
                                <Emoji for={this.body} style={{ position: 'absolute', bottom: '-50px', right: '5px' }} />

                                <button onClick={(e) => this.handlePost(e)} className="btn btn-primary" style={{ marginTop: "15px", width: "100px" }}>Post</button>
                            </div>
                        </div>
                    </div>
                </form>
                 </div>
                  </div>

                <Loader loading={loading} />
            </div>
        )
    }
}

export default withSnackbar(Comments);


