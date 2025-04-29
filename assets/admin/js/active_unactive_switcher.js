const all_active_unactive_switchers = document.querySelectorAll('.active_unactive_switcher')


all_active_unactive_switchers.forEach(all_active_unactive_switcher => {
	const this_checkbox = all_active_unactive_switcher.querySelector('input')
	all_active_unactive_switcher.onclick = ()=>{
		all_active_unactive_switcher.classList.toggle('active')
		
		if (this_checkbox.checked) {
			this_checkbox.checked = false
		}else{
			this_checkbox.checked = true
		}

		// console.log(this_checkbox.checked)
	}
})




















