import hostName from '../../globals/js/hostName.js'
import * as functions from '../../globals/js/functions.js';

const all__change_selector_by__ = document.querySelectorAll('#selector_by__')


all__change_selector_by__.forEach(change_selector_by__ => {
	const btn_parent = change_selector_by__.parentNode.parentNode

	change_selector_by__.addEventListener('click', ()=>{
		const btn_value = change_selector_by__.querySelector('p').getAttribute('data-other-value-holder')
		if (btn_value != '') {
			var current_url = window.location.href.split('?')[0]
			window.location.href = current_url + btn_value
		}

		console.log(btn_value)

	})

	// When the user clicks somewhere else , close the profil and logout btns alert
	functions.check_if_element_inside_a_parent_if_not_hide_it(btn_parent, 'opened')

})



