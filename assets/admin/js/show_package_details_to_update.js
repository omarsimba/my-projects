import hostName from '../../globals/js/hostName.js'
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

const showProductDetailsBtns = document.querySelectorAll('#show-product-details')

// Show the update alert 
showProductDetailsBtns.forEach(showProductDetailsBtn => {
	showProductDetailsBtn.onclick = ()=>{


		const itemId = showProductDetailsBtn.getAttribute('data-id')
		const itemType = showProductDetailsBtn.getAttribute('data-itemType')
		const updateAlertID = 'update-package-alert-container---' + showProductDetailsBtn.getAttribute('data-updateAlertId')

		const thisUpdateAlert = document.getElementById(updateAlertID)
		const thisUpdateAlertContent = thisUpdateAlert.querySelector('.update-package-alert-content')

		const thisUpdateAlertInputIdFormat = thisUpdateAlert.getAttribute('data-inputsIdFormat')
		const hideThisUpdateAlert = thisUpdateAlert.querySelector('#hide-update-package-alert-container')
		const btnparent = showProductDetailsBtn.parentNode

		const thisTableRow = btnparent.parentNode.parentNode.parentNode
		// ====

		// Show the update alert and show the loading effect 
		thisUpdateAlert.classList.add('active')
		
		// Go to backend to get this product's details to be able to update them 

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
            .then(
                    (response) => {
                        var data = JSON.stringify(response)
                        var data = JSON.parse(data)
                         
                        if ( data.success ) {
                        	// Remove loading effect 
                        	thisUpdateAlert.classList.remove('loading')
                        	// Remove actions container
                        	btnparent.classList.remove('active')

                        	var theData = data.success.data
							var theDataType = data.success.type

							const chooseIndex = []

							// Showing these data on their inputs only if it is normal , as update inputs 
                        	if ( theDataType == 'normal' ) {
                        		
	                        	// Put data into their input
	                        	for (var i = 0; i < theData.length; i++) {
	                        		var data = theData[i]

	                        		var id = data.id
		                        	var value = data.inputValue
		                        	var type = data.inputType
		                        	// ---
		                        	var inputId = thisUpdateAlertInputIdFormat + id
		                        	const thisInput = thisUpdateAlert.querySelector(`#${inputId}`)


                        			
		                        	// console.log(thisInput, value)

		                        	// Set the input value into the input by using its own html id
		                        	if (thisInput) {
		                        		var inputType = thisInput.getAttribute('data-inputType')

		                        		if (inputType == 'STATIC') {
		                        			thisInput.innerHTML = value
	                        			}else{
		                        			thisInput.value = value
		                        		}
		                        	} 

		                        	if ( type == 'select' ) { // If the input is a select element , then put option inside of it
		                        		var otherValues = data.otherValues

		                        		var visualValue = data.inputVisualValue
		                        		var currentStatus = data.currentStatus
		                        		const selectorValueHolder = thisInput.parentNode.querySelector('#current-value-holder')

		                        		selectorValueHolder.textContent = `(${visualValue})`
		                        		selectorValueHolder.className = 'color--' + currentStatus
		                        		thisInput.value = ''

		                        		thisInput.innerHTML = '<option value="">Select other option</option>'
		                        		for (var a = 0; a < otherValues.length; a++) {
		                        			var id = otherValues[a].id
		                        			var value = otherValues[a].value
		                        			thisInput.innerHTML += `
		                        				<option value="${id}">${value}</option>
		                        			`
		                        		}
		                        	}

		                        	if ( type == 'text-editor' ) {
		                        		thisInput.innerHTML = value
		                        	}



		                        	// const imgsContainer = thisUpdateAlert.querySelector('form #imgs-content-container')
		                        	// // imgsContainer.innerHTML = ''
		                        	// if ( type == 'main-img' ) { // If the type is the additional images 
		                        		
		                        	// 	// const inputsContainer = thisUpdateAlert.querySelector('form .inputs_group')
		                        	// 	imgsContainer.innerHTML = `
		                        	// 		<div class="input">
									// 			<p><i class="ri-landscape-line"></i> Main image</p>
									// 			<div class="imgs-container">
									// 				<div class="imgs-single-container" id="${inputId}">
									// 					<img src="${hostName}/assets/admin/imgs/${data.path}/${value}" id="main-img-holder">
									// 					<input type="file" name="update-main-img" id="main-img-input">
									// 				</div>
									// 			</div>
									// 		</div>
		                        	// 	`
		                        	// }

		                        	// if ( type == 'additional-imgs' ) { // If the type is the additional images 
		                        	// 	var additionalImgs = value
		                        		
		                        	// 	if ( additionalImgs.length > 0 ) {
		                        	// 		var htmlHolder = ''
			                        // 		for (var b = 0; b < additionalImgs.length; b++) {
			                        // 			htmlHolder += `
			                        // 				<div class="imgs-single-container" id="${b}">
									// 					<img src="${hostName}/assets/admin/imgs/products/${additionalImgs[b]['url']}" id="additional-img-holder">
									// 					<input type="file" name="update-img-for-${b}" id="additional-img-input" data-imgIndex="${b}">
									// 				</div>
			                        // 			`
			                        // 		}
			                        // 		imgsContainer.innerHTML += `
			                        // 			<div class="input">
									// 				<p><i class="ri-landscape-line"></i> Additional images</p>
									// 				<div class="imgs-container">
									// 					${htmlHolder}
									// 					<div class="imgs-single-container" id="add-additional-img">
									// 						<p>+</p>
									// 						<input type="file" name="added-imgs[]" id="add-new-additional-img-input" multiple>
									// 					</div>
									// 				</div>
									// 			</div>
		                        	// 		`
		                        	// 	}else{
		                        	// 		imgsContainer.innerHTML += `
			                        // 			<div class="input">
									// 				<p><i class="ri-landscape-line"></i> Add Additional images</p>
									// 				<div class="imgs-container">
									// 					<input type="file" name="added-imgs[]" id="add-new-additional-img-input" multiple>
									// 				</div>
									// 			</div>
		                        	// 		`
		                        	// 	}
		                        	// }
	                        	}

	                        	// // Update additional image and main image 
	                        	// const additionalImgsInputs = thisUpdateAlert.querySelectorAll('#additional-img-input')
	                        	// // When the user choose the additional images 
	                        	// if ( additionalImgsInputs ) {
		                        // 	additionalImgsInputs.forEach(additionalImgsInput => {
		                        // 		additionalImgsInput.oninput = (e)=>{
		                        // 			const imgIndex = additionalImgsInput.getAttribute('data-imgIndex')
		                    	// 			const imgContent = e.target.files

		                        // 			if ( additionalImgsInput.value != "" ) {

		                        // 				chooseIndex.push(imgContent)

		                        // 			}
		                        // 		}
		                        // 	})
	                        	// }


	                        	// // Add new additional image 
	                        	// const addNewAdditionalImgInput = document.querySelector('#add-new-additional-img-input')
	                        	// // When the user choose a new additional image
	                        	// if ( addNewAdditionalImgInput ) {
	                        	// 	addNewAdditionalImgInput.oninput = (e)=>{
		                		// 		const imgContent = e.target.files
		                		// 		if ( addNewAdditionalImgInput.value != "" ) {
			                	// 			for (var i = 0; i < imgContent.length; i++) {
			                					
			                    // 				chooseIndex.push(imgContent[i])

			                    // 			}
		                		// 		}                    			
		                    	// 	}
	                        	// }
                        	}

                        	// If the type is for orders 
                        	if ( theDataType == 'ORDER' ) {

                        		// var customerInfo = theData.customer_area
                        		// var totalPrice = theData.total_price
                        		// var orderId =  '#' + theData.customer_area[7]



                        		const totalPriceHolder = thisUpdateAlert.querySelector('#total-price-holder')
                        		const orderIdHolder = thisUpdateAlert.querySelector('#order-id-holder')


                        		// Check if the order is for delivery 
                        		const update_and_confirm_btn = thisUpdateAlert.querySelector('.UPDATE-AND-CONFIRM-BTN')
                        		const update_and_confirm_btn_text = update_and_confirm_btn.querySelector('p')

                        		// If this order already confirmed , set to delivery text , and change the button role to DELIVERY 
                        		if (data.success.btn == 'To delivery') {
                        			update_and_confirm_btn_text.textContent = data.success.btn
                        			update_and_confirm_btn.setAttribute('data-role', 'DELIVERY_ORDER')
                        		}


                        		// Setting the total price into it's own holder
                        		totalPriceHolder.textContent = totalPrice
                        		orderIdHolder.textContent = orderId

                        		// const customersInfoContainers = thisUpdateAlert.querySelectorAll('.inputs .order_section #customer-info .input')
                        		// customersInfoContainers.forEach((customersInfoContainer, i) => {

                        			// const thisInputsContainerInput = customersInfoContainer.querySelector('.input-of-content')
                        			// const changeInputTypeBtn = customersInfoContainer.querySelector('#change-input-type')

                        			// var inputId = '--order_' + thisInputsContainerInput.id// Get the input ID
                        			


                        			// When the user click on the editable inputs , then hide the grey background
                        			// thisInputsContainerInput.onclick = ()=>{
                        			// 	if ( inputType == 'EDITABLE' ) {
                        			// 		customersInfoContainer.classList.add('show-save-icon')
                        			// 		thisInputsContainerInput.classList.remove('unvisible')
                        			// 	}
                        			// }

                        			// changeInputTypeBtn.onclick = ()=>{
                        			// 	if ( inputType == 'EDITABLE' ) {
                        			// 		customersInfoContainer.classList.remove('show-save-icon')
                        			// 		thisInputsContainerInput.classList.add('unvisible')
                        			// 	}
                        			// }
                        		// })
                        		
                        		// ########################
                        		// ########################


                        		var orderProducts = theData.order_products

                        		const productsContainer = thisUpdateAlert.querySelector('.inputs .order_section #choosen-product-container')


                        		// Inserting the products into their holders 
                        		productsContainer.innerHTML = ''




                        		var updatedProducts = []

                        		for (var ll = 0; ll < orderProducts.length; ll++) {
                        			var product = orderProducts[ll]
                        			var productCount = product.title
                        			var basicInfo = product.data.basic_info

                        			var thisProductId = product.product_id

                        			// ##### For loop the basic info and put them into the html container 
                        			var basicInfoHTMLContainer = ''

                        			for (var a = 0; a < basicInfo.length; a++) {
                        				var thisBasic = basicInfo[a]
                        				basicInfoHTMLContainer += `
                        					<div class="input">
												<p><i class="${thisBasic['icon']}"></i> ${thisBasic['section_title']}</p>
												<div class="static-input editable">${thisBasic['section_value']}</div>
											</div>

                        				`
                        			}
                        			// ##### End for loop 

                        			var allColors = product.data.colors_and_sizes['colors']
                        			var allSizes = product.data.colors_and_sizes['sizes']

                        			// Setting all colors and current colors into HTML containers 
                        			
                        			var allColorsHTML = ''
                        			var currentColorsHTML = ''
                        			function allColorsHTMLFun(thisColorBtn){
                        				return `
                        					<div id="all-colors-container" class="container">
												${thisColorBtn}
											</div>
                        				`
                        			}
                        			var currentColorsOfProduct = allColors['current']
                        			for (var i = 0; i < currentColorsOfProduct.length; i++) {
                        				var thisColor = currentColorsOfProduct[i]['color']
                        				var thisQuantity = currentColorsOfProduct[i]['quantity']
                        				currentColorsHTML += `<button id="color-item">${thisColor} - ${thisQuantity}</button>`

                        			}
                        			allColorsHTML = allColorsHTMLFun(currentColorsHTML)

                        			// ======

                        			var allSizesHTML = ''
                        			var currentSizesHTML = ''
                        			function allSizesHTMLFun(thisSizeBtn){
                        				return `
                        					<div id="all-colors-container" class="container">
												${thisSizeBtn}
											</div>
                        				`
                        			}
                        			var currentSizesOfProduct = allSizes['current']
                        			for (var i = 0; i < currentSizesOfProduct.length; i++) {
                        				var thisSize = currentSizesOfProduct[i]
                        				for (var b = 0; b < thisSize.length; b++) {
                        					var thisSpecialSize = thisSize[b]
                        					currentSizesHTML += `<button id="color-item">${thisSpecialSize}</button>`
                        				}
                        			}
                        			allSizesHTML = allColorsHTMLFun(currentSizesHTML)


                        			// ===
                        			


                        			productsContainer.innerHTML += `
                        				<p>${productCount}</p>
										<div class="inputs_group" id="product-basic-info">
											${basicInfoHTMLContainer}
										</div>
										<div class="inputs_group" id="product-color-and-size">

											<div class="input">
												<p><i class="ri-palette-line"></i> Choosen colors</p>
												<div class="colors-sizes--holder">
													${allColorsHTML}
												</div>
											</div>

											<div class="input">
												<p><i class="ri-font-size"></i> Choosen sizes</p>
												<div class="colors-sizes--holder">
													${allSizesHTML}
												</div>
											</div>

											<div class="input">
												<p><i class="ri-palette-line"></i> Update colors</p>
												<div class="colors-sizes--holder">
													<input name="updated-colors" placeholder="Update colors" id="updated-colors-input" data-product_id="${thisProductId}">
												</div>
											</div>

											<div class="input">
												<p><i class="ri-font-size"></i> Update sizes</p>
												<div class="colors-sizes--holder">
													<input name="updated-sizes" placeholder="Update sizes" id="updated-sizes-input" data-product_id="${thisProductId}">
												</div>
											</div>
										</div>
                        			`

                        			// Create a new array in updatedProducts array , to push the new data about updated colors and sizes

                        			updatedProducts.push({
                        				"product_id": thisProductId,
                        				"updated_colors": '',
                        				"updated_sizes": '',
                        			})

                        			const updatedColorsInputs = productsContainer.querySelectorAll('#updated-colors-input')

                        			updatedColorsInputs.forEach(updatedColorsInput => {
                        				// When the user write something in colors input , then insert that data into it's own place in the updateProduct array 

	                        			updatedColorsInput.onkeyup = (e)=>{

	                        				if ( updatedColorsInput.value != '' ) {
	                        					var thisSpecialProductId = updatedColorsInput.getAttribute('data-product_id')
		                        				for (var nl = 0; nl < updatedProducts.length; nl++) {
		                        					var thisPlace = updatedProducts[nl]['product_id']
		                        					if ( thisPlace == thisSpecialProductId ) {
		                        						updatedProducts[nl]['updated_colors'] = updatedColorsInput.value
		                        					}
		                        				}
	                        				}
	                        				
	                        			}
                        			})
                        			
                        			// ========

                        			const updatedSizesInputs = productsContainer.querySelectorAll('#updated-sizes-input')

                        			updatedSizesInputs.forEach(updatedSizesInput => {
                        				// When the user write something in sizes input , then insert that data into it's own place in the updateProduct array 
	                        			updatedSizesInput.onkeyup = (e)=>{
	                        				var thisSpecialProductId = updatedSizesInput.getAttribute('data-product_id')
	                        				for (var nl = 0; nl < updatedProducts.length; nl++) {
	                        					var thisPlace = updatedProducts[nl]['product_id']
	                        					if ( thisPlace == thisSpecialProductId ) {
	                        						updatedProducts[nl]['updated_sizes'] = updatedSizesInput.value
	                        					}
	                        				}
	                        			}
                        			})
                        		}
                        		
                        	}

                        	// ##########################################
                        	// ##########################################
                        	// ##########################################

                        	// When the user want to update the data send the input data to the server and create an array contains the updated images and thier index
                        	const updateTheFormBtns = thisUpdateAlert.querySelectorAll('#update-package')
                        	
                        	


                        	updateTheFormBtns.forEach(updateTheForm => {
                        		const thisFormName = updateTheForm.getAttribute('data-this_form_name')
                        		const btnRole = updateTheForm.getAttribute('data-role')

	                        	updateTheForm.onclick = () => {
	                        		updateTheForm.classList.add('loading-data')

	                        		const thisForm = thisUpdateAlert.querySelector('form')
        							const all_text_editors = thisForm.querySelectorAll('.text-editor-content')

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
							                        if ( btnRole != 'UPDATE_ADMIN' && btnRole != 'UPDATE_PRODUCT' ) {
							                        	thisTableRow.style.display = 'none'
							                        }
							                        console.log(data.success)

							                    } else if (data.warning) {
							                        backendResponseContainer('warning', data.warning)
							                    } else if (data.error) {
							                        backendResponseContainer('error', data.error)
							                    }
							                }
							            }
							        }

							        let formData = new FormData(thisForm);
							        formData.append('btn-role', btnRole)

	                        		if ( btnRole == 'UPDATE_PRODUCT' ) {
								        formData.append('role', btnRole)
								        for (var i = 0; i < chooseIndex.length; i++) {
								        	formData.append('additional-imgs[]', chooseIndex[i])
								        }
							        }

							        if ( btnRole == 'UPDATE_AND_CONFIRM_ORDER' ) {
							        	if ( updatedProducts[0].updated_colors != '' && updatedProducts[0].updated_sizes != '' ) {
							        		formData.append('updated-data', JSON.stringify(updatedProducts))
							        	}
								        
							        }

							        if (all_text_editors.length > 0) {
							            all_text_editors.forEach(text_editor => {
							                const text_editor_name = text_editor.getAttribute('data-name')
							                const text_editor_value = text_editor.innerHTML
							                formData.append(text_editor_name, text_editor_value)
							            })
							        }

							        xhr.send(formData);
	                        	}
							})


                        	// ########################""
                        	// When the user want to refuse the data 
							const refuseBnts = document.querySelectorAll('#refuse-package')

							refuseBnts.forEach(refuseBtn => {
								const thisFormName = refuseBtn.getAttribute('data-this_form_name')
								const btnRole = refuseBtn.getAttribute('data-role')

								refuseBtn.onclick = () => {
									refuseBtn.classList.add('loading-data')

									const thisForm = thisUpdateAlert.querySelector('form')
									// ======

									let xhr = new XMLHttpRequest();
							        xhr.open("POST", `${hostName}/assets/admin/php/refuseData/${thisFormName}.php`, true);
							        xhr.onload = () => {
							            if (xhr.readyState === XMLHttpRequest.DONE) {
							                if (xhr.status === 200) {
							                    let data = JSON.parse(xhr.response);

							                    refuseBtn.classList.remove('loading-data')
							                    if (data.success) {
							                        backendResponseContainer('success', data.success)
							                        // Hide the update alert 
							                        thisUpdateAlert.classList.remove('active')
							                        thisUpdateAlert.classList.add('loading')

							                        // Hide this table row 
							                        thisTableRow.style.display = 'none'
							                        
							                    } else if (data.warning) {
							                        backendResponseContainer('warning', data.warning)
							                    } else if (data.error) {
							                        backendResponseContainer('error', data.error)
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



