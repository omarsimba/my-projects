import hostName from './hostName.js';
import * as functions from './functions.js';

functions.prevent_default();


// const add_data_to_database_btns = document.querySelectorAll('.add-data-to-database--')


// add_data_to_database_btns.forEach(add_data_to_database =>{
//     add_data_to_database(add_data_to_database_btns)
// })


export default function add_data_to_database(button, function_on_success = ''){

    button.addEventListener('click', () => {

        var form_name = button.getAttribute('data-form_name')
        var hide_data_from_inputs = button.getAttribute('data-hide_data_from_inputs')

        var backend_location = button.getAttribute('data-backend_location')
        const this_form = document.querySelector(`#${form_name}`)
        const general_error_holder = this_form.querySelector(`#general-error-holder`)


        // Empty all the error text holders
        const all_errors_text_holders = document.querySelectorAll('.error-text-holder')
        all_errors_text_holders.forEach(error_text_holder =>{
            error_text_holder.textContent = ''
        })

        functions.set_settings_and_effects_to_sending_data_to_backend_button(button, 'show-loader')


        let xhr = new XMLHttpRequest()
        xhr.open("POST", `${hostName}/assets/${backend_location}.php`, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.response);

                    // ======
                    if (data.success) {
                        functions.set_settings_and_effects_to_sending_data_to_backend_button(button, 'success')

                        // Empty all the inputs
                        if (hide_data_from_inputs == 'true') {
                            const all_inputs = this_form.querySelectorAll('.real-input')
                            all_inputs.forEach(input =>{
                                input.value = ''
                            })
                        }
                        

                        // If there is any value returned from backend, then set it into this button
                        if (data.success.attributes) {
                            for (var i = 0; i < data.success.attributes.length; i++) {
                                var attr_title = data.success.attributes[i].title
                                var attr_value = data.success.attributes[i].value
                                button.setAttribute(`data-attr__${attr_title}`, attr_value)

                            }
                        }

                        if (function_on_success) {
                            function_on_success()
                        }

                        

                        
                    }else if (data.error) {
                        console.log(data.error)
                        functions.set_settings_and_effects_to_sending_data_to_backend_button(button, 'get-back')
                        if(data.error.error_type == 'specific'){

                            var errors_list = data.error.errors_list
                            for (var i = 0; i < errors_list.length; i++) {
                                var error_holder = data.error.errors_list[i].input
                                var error_text = data.error.errors_list[i].text

                                var specific_error_holder = document.querySelector(`#${error_holder}-input-holder p#input-error-holder`)
                                specific_error_holder.textContent = error_text

                            }

                            // If there is any general error text, then put it in the general space
                            if (data.error.general_error != '') {
                                general_error_holder.textContent = data.error.general_error
                            }

                        }else{
                            general_error_holder.textContent = data.error
                        }


                    }
                }
            }
        }
        let formData = new FormData(this_form)
        xhr.send(formData)

    })

}







