import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';

import add_data_to_database from '../../globals/js/add_data_to_database.js';





const login_btn = document.getElementById('login-btn')

// login_btn.onclick = ()=>{
	add_data_to_database(login_btn, reload_page)
// }


function reload_page(){
	window.location.reload()
}



