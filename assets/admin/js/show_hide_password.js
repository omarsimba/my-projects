
const showHidePasswordBtns = document.querySelectorAll('#show-hide-password-btn')


showHidePasswordBtns.forEach(showHidePasswordBtn => {
	showHidePasswordBtn.onclick = ()=>{
		const this_btn_icon = showHidePasswordBtn.querySelector('i')
		const this_password_input = showHidePasswordBtn.parentNode.nextElementSibling


		if (this_password_input.type == 'password') {
			this_password_input.type = 'text'
			this_btn_icon.className = 'ri-eye-off-line'
		}else{
			this_password_input.type = 'password'
			this_btn_icon.className = 'ri-eye-line'
		}

	}
})



