import React, {Component} from 'react';
import Dropzone from 'react-dropzone';

class MyUploader extends Component {
    state = {
        files : []
    }

    componentDidMount() {
       this.setState({
            files : this.props.files && this.props.files || []
        })
    }
    componentDidUpdate(prevProps,prevState){
        if(prevState.files != this.state.files) {

            this.props.getFileFunction(this.state.files);
        }

        if(prevProps.clearFiles != this.props.clearFiles) {
            
            if(this.props.clearFiles) {

                this.setState({
                    files : []
                })
            }
        }

    }

    onDrop = (acceptedFiles) => {
        
        acceptedFiles.map((file) => {
            Object.assign(file, {
                preview: URL.createObjectURL(file)
            })

            this.setState({
                files : [...this.state.files,file]
            })
        })
    }

    remove = (index) => (e) => {

        let filteredArray = this.state.files.filter((file,i) => i !== index)
        this.setState({files: filteredArray});
    }

    
    render(){
        const thumb = {
            display: 'inline-flex',
            borderRadius: 2,
            border: '1px solid #eaeaea',
            marginBottom: 8,
            marginRight: 8,
            width: 100,
            height: 100,
            padding: 4,
            boxSizing: 'border-box'
        }

        const thumbInner = {
            display: 'flex',
            minWidth: 0,
            overflow: 'hidden'
        };
        const img = {
            display: 'block',
            width: 'auto',
            height: '100%'
        }

        const thumbs = this.state.files.map((file,index) => {
            return(
                <div style={thumb} key={file.name}>
                    <div style={thumbInner}>
                        <p>{file.name}</p>

                        /*
                        <img
                            src={file.preview}
                            style={img}
                        />
                        */
                        
                    </div>

                    <button type="button" onClick={this.remove(index)} key={index} >x</button>
                </div>
            )
        });


        return (
            <div className="text-center uploadWrapper">
                <Dropzone onDrop={this.onDrop} multiple >
                    {({getRootProps, getInputProps}) => (
                        <div className="forUpload"
                             
                            {...getRootProps()}>
                            <input {...getInputProps()} />
                            <i className="fa fa-cloud-upload"></i>
                            <p className="forUploadStyle">Click me to upload a file!</p>
                        </div>
                    )}
                </Dropzone>
                
                {
                    this.state.files.length > 0 && (
                        <div>
                            <h2>Uploading {this.state.files.length} files...</h2>
                            <div>{thumbs}</div>
                        </div> 
                    ) || null
                }

            </div>
        )
                
    }
}
  

export default MyUploader;
