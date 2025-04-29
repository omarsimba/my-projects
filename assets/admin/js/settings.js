import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

functions.prevent_default();



const all_save_changes_btns = document.querySelectorAll('#save-changes')


all_save_changes_btns.forEach(save_changes_btn => {
	const this_form_id = save_changes_btn.getAttribute('data-form_id') // This form ID
	const save_change_for = save_changes_btn.getAttribute('data-save_change_for') // This form ID

	const backend_file = this_form_id 

	const the_form = document.getElementById(this_form_id)

	// Onclick on save changes button, then send data to backend
	save_changes_btn.onclick = ()=>{
		// Set loading animation
		save_changes_btn.classList.add('active')
		// Send data to backend

		let xhr = new XMLHttpRequest();
        xhr.open("POST", `${hostName}/assets/admin/php/website_settings/${backend_file}.php`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.response);

                    // Remove loading animation 
                    save_changes_btn.classList.remove('active')
                    // ======
                    if (data.success) {
                        // Empty all inputs 
                        backendResponseContainer('success', data.success)
                        
                    } else if (data.warning) {
                        backendResponseContainer('warning', data.warning)
                    } else if (data.error) {
                        backendResponseContainer('error', data.error)
                    }

                    console.log(data)
                }
            }
        }
        let formData = new FormData(the_form);
        formData.append('save_change_for', save_change_for)
        xhr.send(formData);

	}
}) 






// // Add new plateform 

const show_alert_btns = document.querySelectorAll('.show_special_alert_btn')
// const add_new_plateform_form = document.getElementById('add_new_platform--form')



show_alert_btns.forEach(show_alert_btn =>{
	const alert_id = show_alert_btn.getAttribute('data-alert_id')
	const this_alert = document.getElementById(alert_id)
	const hide_this_alert = this_alert.querySelector('#hide-package-alert-container')
	const btn_parent = show_alert_btn.parentNode



	show_alert_btn.onclick = ()=>{
		this_alert.classList.add('active')
	}

	hide_this_alert.onclick = ()=>{
		this_alert.classList.remove('active')
	}


	functions.check_if_element_inside_a_parent_if_not_hide_it(btn_parent, 'opened')

})









