export default function showHideLoadingIcon(btn, action){
	if ( action == 'add' ) {
		btn.classList.add('loading-data')
	}else if ( action == 'remove' ) {
		btn.classList.remove('loading-data')
	}
}