import hostName from '../../globals/js/hostName.js'
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

const showProductDetailsBtns = document.querySelectorAll('#show-product-details')


// Show the update alert 
showProductDetailsBtns.forEach(showProductDetailsBtn => {
	showProductDetailsBtn.onclick = ()=>{

		const itemId = showProductDetailsBtn.getAttribute('data-id')
		const itemType = showProductDetailsBtn.getAttribute('data-itemType')
		const thisUpdateAlert = document.getElementById('update-package-alert-container---1')

		const thisMailerNameHodler = thisUpdateAlert.querySelector('#mailer-name-holder')
		const thisMailTextHodler = thisUpdateAlert.querySelector('#mail-text-holder')
		const mailSpecialIdHolder = thisUpdateAlert.querySelector('#mail_special_id_holder')



		const hideThisUpdateAlert = thisUpdateAlert.querySelector('#hide-update-package-alert-container')

		const btnparent = showProductDetailsBtn.parentNode
		const thisTableRow = btnparent.parentNode.parentNode.parentNode


		thisUpdateAlert.classList.add('active')
		thisUpdateAlert.classList.remove('loading')


		// Getting the mail details from backend

		fetch(`${hostName}/assets/admin/php/get_package_details_to_update.php`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    {
                        "item-type": itemType,
                        "item-id": itemId,
                    }
                )
            })
            .then(response => response.json())
            .then((response) => {
            	var data = JSON.stringify(response)
                var data = JSON.parse(data)

                if (data.success) {
                	var mail_details = data.success

                	thisMailerNameHodler.textContent = mail_details.mailer_name
                	// Change the text container direction
                	thisMailTextHodler.dir = mail_details.direction
                	thisMailTextHodler.textContent = mail_details.mail_text
                	mailSpecialIdHolder.value = mail_details.special_id





                	// ##############################

                	// When the user want to update the data send the input data to the server and create an array contains the updated images and thier index
                        	const updateTheFormBtns = thisUpdateAlert.querySelectorAll('#update-package')
                        	
                        	


                        	updateTheFormBtns.forEach(updateTheForm => {
                        		const thisFormName = updateTheForm.getAttribute('data-this_form_name')
                        		const btnRole = updateTheForm.getAttribute('data-role')

	                        	updateTheForm.onclick = () => {
	                        		updateTheForm.classList.add('loading-data')

	                        		const thisForm = thisUpdateAlert.querySelector('form')
	                        		// ======

	                        		let xhr = new XMLHttpRequest();
							        xhr.open("POST", `${hostName}/assets/admin/php/updateData/${thisFormName}.php`, true);
							        xhr.onload = () => {
							            if (xhr.readyState === XMLHttpRequest.DONE) {
							                if (xhr.status === 200) {
							                    let data = JSON.parse(xhr.response);

							                    updateTheForm.classList.remove('loading-data')
							                    if (data.success) {
							                        backendResponseContainer('success', data.success)
							                        // Hide the update alert 
							                        thisUpdateAlert.classList.remove('active')
							                        thisUpdateAlert.classList.add('loading')
							                        

							                        // Hide this table row 
							                        thisTableRow.style.display = 'none'

							                    } else if (data.warning) {
							                        backendResponseContainer('warning', data.warning)
							                        console.log(data.warning)
							                    } else if (data.error) {
							                        backendResponseContainer('error', data.error)
							                        console.log(data.error)
							                    }
							                }
							            }
							        }

							        let formData = new FormData(thisForm);
							        xhr.send(formData);
	                        	}
							})


                }else if ( data.error ) {
                	thisUpdateAlert.classList.add('loading')
					thisUpdateAlert.classList.remove('active')
                	backendResponseContainer('error', data.error)
                }else if ( data.warning ) {
                	thisUpdateAlert.classList.add('loading')
					thisUpdateAlert.classList.remove('active')
                	backendResponseContainer('warning', data.warning)
                }
                
            	
            })


		// Hide the update alert and show the loading effect again
		hideThisUpdateAlert.onclick = ()=>{
			thisUpdateAlert.classList.add('loading')
			thisUpdateAlert.classList.remove('active')
		}


		// When the user clicks somewhere else , close the profil and logout btns alert
		functions.hide_an_element_by_its_own_parent(thisUpdateAlert, thisUpdateAlert.querySelector('form'))


	}
})