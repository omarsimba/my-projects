import * as functions from './functions.js'

const open_selector_btns = document.querySelectorAll('#open-selector-input')


open_selector_btns.forEach(open_selector_btn => {
	open_selector_btn.onclick = ()=>{
		const this_selector_parent = open_selector_btn.parentNode
		const this_selector_text_holder = open_selector_btn.querySelector('.currenct-selector-text')
		const this_selector_input_holder = open_selector_btn.querySelector('#this_selector_input_value')


		const this_selector_btns = this_selector_parent.querySelectorAll('.other-selector-values .other-value')



		// Close all other opened selectors, to open this one 
		const all_opened_selectors = document.querySelectorAll('#selector-input')
		all_opened_selectors.forEach(opened_selector => {
			if (opened_selector != this_selector_parent) {
				if (opened_selector.classList.contains('opened')) {
					opened_selector.classList.remove('opened')
				}
			}
			
		})

		// Open this button selector 
		
		if (this_selector_parent.classList.contains('opened')) {
			this_selector_parent.classList.remove('opened')
		}else{
			this_selector_parent.classList.add('opened')
		}

		
		// Onclick on the selector buttons , show the data 
		this_selector_btns.forEach(this_selector_btn => {
			this_selector_btn.onclick = ()=>{
				const this_selector_btn_text = this_selector_btn.querySelector('.text-holder').textContent
				const this_selector_btn_value = this_selector_btn.querySelector('.text-holder').getAttribute('data-other-value-holder')


				// Set the value of this button, into the selector input 
				this_selector_input_holder.value = this_selector_btn_value

				this_selector_text_holder.textContent = this_selector_btn_text

				// When the user clicks on this button, close the current selector 
				this_selector_parent.classList.remove('opened')
			}
		})



		// When the user clicks somewhere else , close the profil and logout btns alert
		functions.check_if_element_inside_a_parent_if_not_hide_it(this_selector_parent, 'opened')

	}
})


