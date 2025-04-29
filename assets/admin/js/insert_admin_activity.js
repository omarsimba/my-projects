import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'



const admin_id = document.body.getAttribute('data-admin_id')








// Insert new activity to database
insert_new_activity()
// Each 1 minute, insert new activity to database
setInterval(()=>{
	insert_new_activity()
}, 100000)



function insert_new_activity(){
	let xhr = new XMLHttpRequest();
	xhr.open("POST", `${hostName}/assets/admin/php/insert_admin_activity.php?admin_id=${admin_id}`, true);
	xhr.send();

	console.log('New activity inserted')
}












