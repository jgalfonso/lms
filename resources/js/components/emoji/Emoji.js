import React, {Component} from 'react';

import EmojiMartPicker from "emoji-mart-picker";
import insertTextAtCursor from 'insert-text-at-cursor';

class Emoji extends Component {
  	
  	onChange = emoji => {
        console.log(emoji);
  	
    	if (emoji) {
    		//const e = document.getElementById(this.props.for);
    		let e =  this.props.for.current;			    
            insertTextAtCursor(e, emoji.native);    	 
        }
  	}

    render() {
  	    return ( 	
    		<EmojiMartPicker 
                set="emojione"
                style={this.props.style} 
                onChange={this.onChange} >

                    <button class="btn btn-warning" style={{ marginTop: "15px", marginRight: "3px", width: "auto" }}><i class="fa fa-smile-o emoji"></i></button>
          	</EmojiMartPicker>           
        );
    }
}

export default Emoji;