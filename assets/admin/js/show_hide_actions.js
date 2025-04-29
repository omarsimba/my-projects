import * as functions from '../../globals/js/functions.js';



const showActionsContainerBtns = document.querySelectorAll('#show-actions-container')

const allActionsContainers = document.querySelectorAll('#actions-container')

showActionsContainerBtns.forEach(showActionsContainerBtns => {
	const actionsContainer = showActionsContainerBtns.nextElementSibling

	showActionsContainerBtns.onclick = ()=>{


		for (var i = 0; i < allActionsContainers.length; i++) {
			if (allActionsContainers[i].classList.contains('active')) {
				allActionsContainers[i].classList.remove('active')
			}
		}

		
		if ( actionsContainer.classList.contains('active') ) {
			actionsContainer.classList.remove('active')
		}else{
			actionsContainer.classList.add('active')
		}


		// When the user clicks somewhere else , close the profil and logout btns alert
		functions.check_if_element_inside_a_parent_if_not_hide_it(actionsContainer)
		
	}


	

}) 






