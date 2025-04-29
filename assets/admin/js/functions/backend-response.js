export default function backendResponseContainer(status, msg){
	const backendResponseContainer = document.getElementById('backend-response-container')
	const backendResponseText = backendResponseContainer.querySelector('p')
	const backendResponseIcon = backendResponseContainer.querySelector('i')

	backendResponseText.textContent = msg
	if ( status == 'success' ) {
		backendResponseIcon.className = 'ri-check-double-line color--success'
	}else if ( status == 'error' ) {
		backendResponseIcon.className = 'ri-close-line color--error'
	}else if ( status == 'warning' ) {
		backendResponseIcon.className = 'ri-error-warning-line color--warning'
	}

	backendResponseContainer.classList.add('active')

	setTimeout(()=>{
		backendResponseContainer.classList.remove('active')
	}, 2000)


}
