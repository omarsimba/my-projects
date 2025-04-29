import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';

import add_data_to_database from '../../globals/js/add_data_to_database.js';


functions.prevent_default();


// Show attachement upload area


const show_upload_area = document.getElementById('show-upload-area')
const upload_area = document.getElementById('attachement-upload-container')



show_upload_area.onclick = ()=>{
	upload_area.classList.add('active')
}



// --------------------



const main_forms_container = document.querySelector('#forms-container')
const forms_container = document.querySelector('#forms-container .forms-container--content')
const all_forms = document.querySelectorAll('#forms-container .forms-container--content form')





// Onclick on add new message
const add_new_message = document.getElementById('add-new-message')

add_data_to_database(add_new_message, get_email_on_add_new_message_btn)

function get_email_on_add_new_message_btn(){
	var mail_email = add_new_message.getAttribute('data-attr__email')
	var mail_spcial_id = add_new_message.getAttribute('data-attr__special_id')

	const verification_step__email__holder = document.getElementById('verification-step--email-holder')
	const mail__special_id__holder = document.getElementById('mail--special-id--holder')

	// Set email into its own holder
	verification_step__email__holder.innerHTML = `'${mail_email}'`

	// Set special id
	mail__special_id__holder.value = mail_spcial_id


	show_next_form()
}




// Onclick on check email verification
const verify_email_btn = document.getElementById('verify-email')

add_data_to_database(verify_email_btn, show_next_form)



// Resend verification code
const resend_verification_code_btn = document.getElementById('resend-verification-code')

add_data_to_database(resend_verification_code_btn)






function show_next_form(){
	const visible_form_in_forms_container = forms_container.querySelector('form.visible')
	const next_form_in_forms_container = visible_form_in_forms_container.nextElementSibling
	const next_form_margin = next_form_in_forms_container.getAttribute('data-margin')

	setTimeout(()=>{
		


		if (next_form_in_forms_container) {
			// Set margin left to forms container to show the new form
			forms_container.style.marginLeft = `-${next_form_margin}%`

			// Remove 'visible' class from the current form and set it to the next form
			visible_form_in_forms_container.classList.remove('visible')
			next_form_in_forms_container.classList.add('visible')



			// ------

			const active_step = document.querySelector('#step.active')
			const next_step = active_step.nextElementSibling.nextElementSibling

			// Set finished effect to the current step, and show to the user that they have to do the next step
			active_step.classList.add('finished')
			active_step.classList.remove('active')


			if (next_step) {
				next_step.classList.remove('unactive')
				next_step.classList.add('active')
			}


			// Change forms container height depending on the height of the next form
			// main_forms_container.style.height = `${next_form_in_forms_container.offsetHeight}px`
		}else{
			console.log('no more')
		}

	}, 1000)
}





// // If form's height changed then change the containers either
// all_forms.forEach(form => {
// 	form.onresize = ()=>{
// 		console.log('resizing...')
// 	}
// })

