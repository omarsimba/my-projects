import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

functions.prevent_default();

const add_data_to_db_btns = document.querySelectorAll("#add_data_to_db");
const insertingDataLoader = document.getElementById("insertingDataLoader");

add_data_to_db_btns.forEach(add_data_to_db => {
    add_data_to_db.onclick = (e) => {

        if (!add_data_to_db.classList.contains('loading')) {

            // Add loading effect 
            add_data_to_db.classList.add('loading')
            // ======
            var form_name = add_data_to_db.getAttribute("data-this_form_name");
            const the_form = document.getElementById(form_name)
            const all_text_editors = the_form.querySelectorAll('.text-editor-content')

            // Send to backend
            functions.insertingDataLoader('show')

            let xhr = new XMLHttpRequest();
            if (the_form.getAttribute('data-special_folder')) {
                form_name = the_form.getAttribute('data-special_folder') + '/' + form_name
            }
            xhr.open("POST", `${hostName}/assets/admin/php/${form_name}.php`, true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = JSON.parse(xhr.response);

                        // Remove loading effect 
                        add_data_to_db.classList.remove('loading')
                        // ======
                        functions.insertingDataLoader('hide')
                        if (data.success) {
                            // Empty all inputs 
                            functions.empty_form_inputs(the_form)
                            backendResponseContainer('success', data.success)
                            
                        } else if (data.warning) {
                            backendResponseContainer('warning', data.warning)
                        } else if (data.error) {
                            backendResponseContainer('error', data.error)
                        }else if (data.load) {
                            window.location.href = hostName + data.load
                        }else if (data.profile_success) {
                            backendResponseContainer('success', data.profile_success)
                        }

                        console.log(data)
                    }
                }
            }
            let formData = new FormData(the_form)
            if (all_text_editors.length > 0) {
                all_text_editors.forEach(text_editor => {
                    const text_editor_name = text_editor.getAttribute('data-name')
                    const text_editor_value = text_editor.innerHTML
                    formData.append(text_editor_name, text_editor_value)
                })
            }
            xhr.send(formData)

        }

    }
});














