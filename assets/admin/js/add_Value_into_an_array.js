const add_Value_into_an_array__containers = document.querySelectorAll('.add_value_into_an_array_input')


// Get all the containers 
add_Value_into_an_array__containers.forEach(add_Value_into_an_array__container => {
	// Get the input of this specific container
	const add_Value_into_an_array__input = add_Value_into_an_array__container.querySelector('input.visible-input')
	const add_Value_into_an_array__hidden_input = add_Value_into_an_array__container.querySelector('input.hidden-input')

	const add_Value_into_an_array__values_holder = add_Value_into_an_array__container.querySelector('.add_value_into_an_array_container')

	var values = []

	add_Value_into_an_array__input.addEventListener('keyup', (e)=>{
		var keyCode = e.keyCode
		
		// If the written letter is "=", then separate the written letters
		if (keyCode == 187) {
			var this_value = add_Value_into_an_array__input.value.slice(0, -1)

			// Check if this value already exist in the array
			if (values.indexOf(this_value) == '-1') {
				values.push(this_value)

				var value_HTML = `<div class="value" title="Double click to remove">${this_value}</div>`
				add_Value_into_an_array__values_holder.insertAdjacentHTML("afterbegin", value_HTML)
			}

			add_Value_into_an_array__input.value = ''


			// Join '-' between the values, and put the final value in the hidden input 
			set_values_as_strint(values, add_Value_into_an_array__hidden_input)


			// -----------------------------
			// Delete the value when the user double clicks on it
			const all_values_HTML = add_Value_into_an_array__values_holder.querySelectorAll('.value')
			all_values_HTML.forEach(value_HTML => {
				value_HTML.ondblclick = ()=>{
					var this_value = value_HTML.textContent

					if (values.indexOf(this_value) != '-1') {
						// Remove this value from the array
						values.splice(values.indexOf(this_value), 1)
						// Remove this value from the UI
						value_HTML.style.display = 'none'

						// Join '-' between the values, and put the final value in the hidden input 
						set_values_as_strint(values, add_Value_into_an_array__hidden_input)
						console.log(values)
					}

				}
			})



			function set_values_as_strint(arr, input){
				var value_to_string = arr.join('-')
				input.value = value_to_string
			}



		}
	})



})










