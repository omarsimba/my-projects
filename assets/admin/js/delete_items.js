import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

functions.prevent_default();

import showHideLoadingIcon from './functions/show-hide-loading-icon.js'




const deleteBtns = document.querySelectorAll('#__delete-item--')

deleteBtns.forEach(deleteBtn => {
	deleteBtn.onclick = ()=>{
		const itemId = deleteBtn.getAttribute('data-id')
		const itemType = deleteBtn.getAttribute('data-itemType')
		const btnparent = deleteBtn.parentNode
		
		deleteBtn.classList.add('loading')


		let xhr = new XMLHttpRequest();
        xhr.open("POST", `${hostName}/assets/admin/php/delete_items.php`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.response);

                    deleteBtn.classList.remove('loading')
                    if (data.success) {
						// btnparent.classList.remove('active')
                        backendResponseContainer('success', data.success)
                        // Remove the item from the table 
                        var itemParentToRemove
                        if ( itemType == 'COUPONS' || itemType == 'PRODUCT' || itemType == 'ADMIN' || itemType == 'ORDER' || itemType == 'MAIL' || itemType == 'REVIEW' || itemType == 'AFFILIATE' ) {
                        	itemParentToRemove = btnparent.parentNode.parentNode.parentNode
                        }
                        itemParentToRemove.style.display = 'none'

                    } else if (data.warning) {
                        backendResponseContainer('warning', data.warning)
                    } else if (data.error) {
                        backendResponseContainer('error', data.error)
                    }else if (data.load) {
                        window.location.href = hostName + data.load
                    }
                }
            }
        }
        let formData = new FormData();
        formData.append('itemId', itemId)
        formData.append('itemType', itemType)
        xhr.send(formData);

	}
})

