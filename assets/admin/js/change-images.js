
const image_file_inputs = document.querySelectorAll('.select-img-input')


image_file_inputs.forEach(image_file_input => {
	image_file_input.oninput = (e) => {
		const this_images_holder = image_file_input.nextElementSibling
		var files = e.target.files

		this_images_holder.innerHTML = ''

		for (var i = 0; i < files.length; i++) {
			var file = files[i]
			// console.log(file)
	        var reader = new FileReader();
	        reader.onload = function (event) {
	            var dataURL = event.target.result //get file content

	            console.log(dataURL)
	            this_images_holder.innerHTML += `
			        <div class="choosen-img">
						<img src="${dataURL}">
					</div>
		        `

	        }



	        reader.readAsDataURL(file);

		}


	}
})

