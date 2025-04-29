import hostName from "./hostName.js";


// export function get_translation_from_backend(text){
//     let xhr = new XMLHttpRequest()
//         xhr.open("POST", `${hostName}/assets/php/translate_text.php`, true)
//         xhr.onload = () => {
//             if (xhr.readyState === XMLHttpRequest.DONE) {
//                 if (xhr.status === 200) {
//                     let data = JSON.parse(xhr.response);

//                     return data
//                 }
//             }
//         }

//         let formData = new FormData()
//         formData.append('text', text)
//         xhr.send(formData)
// }

export function small_message(title,text){
    const small_message = document.querySelector('#alert_container')
    const small_message_title = document.querySelector('#alert_container h3')
    const small_message_text = document.querySelector('#alert_container p')

    // Setting the message in it's own container 
    small_message_title.textContent = title
    small_message_text.innerHTML = text

    // Deleting every class in the icon and the message container
    // small_message.className = ''
    // small_message_icon.className = ''
    // if ( status == 'success' ) {
    //     small_message_icon.classList.add('ri-checkbox-circle-fill')
    //     small_message.classList.add('success')
    // }else if ( status == 'warning' ) {
    //     small_message_icon.classList.add('ri-error-warning-fill')
    //     small_message.classList.add('warning')
    // }else if ( status == 'error' ) {
    //     small_message_icon.classList.add('ri-error-warning-fill')
    //     small_message.classList.add('error')
    // }

    small_message.classList.add('active')
    setTimeout(() => {
        small_message.classList.remove('active')
    }, 3000);
}

export function prevent_default() {
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        form.onsubmit = (e) => {
            e.preventDefault();
        }
    });
}
export function insertingDataLoader(addRemove = 'hide') {
    const insertingDataLoader = document.getElementById("insertingDataLoader");
    if (addRemove == 'show') {
        insertingDataLoader.classList.add('active')
    }else{
        insertingDataLoader.classList.remove('active')
    }
}


export function empty_form_inputs(form){
    var elements = form.elements
    var elemsArr1 = Array.from(elements);
    
    for (var i = 0; i < elemsArr1.length - 1; i++) {
        const element = elemsArr1[i]
        const elementAttributes = elemsArr1[i].attributes
        const elementValue = elemsArr1[i].value
        const elementDefaultValue = elemsArr1[i].getAttribute('data-defaultValue')
        // Empty the input element 
        element.value = elementDefaultValue
    }
}




export function check_if_element_inside_a_parent_if_not_hide_it(parent_element, hide_class = 'active'){
    document.addEventListener('mousedown', (e) => {
        var clickedItem = e.target
        var is_exist = false


        if (parent_element.contains(clickedItem)) {
            is_exist = true
        }

        if (!is_exist) {
            // hide_class => the class that when it is removed , hide the element and most of time it is "active"
            parent_element.classList.remove(hide_class)
        }


        
    })

}


export function copy_to_clipboard() {
    const all_to_be_copied = document.querySelectorAll(".to_be_copied") ;
    all_to_be_copied.forEach(to_be_copied => {
        to_be_copied.onclick = ()=>{
            var data = to_be_copied.getAttribute("data-to_clipboard") ;
            
            navigator.clipboard.writeText( data ).then(() => {
                // modern_alert('Copied', `<span>${data}</span>, just copied!`)
                small_message('Just copied', `<span>${data}</span>`)
            });
        }
    });
}



export function hide_an_element_by_its_own_parent(parent_element, child_element, hide_class = 'active'){
    document.addEventListener('mousedown', (e) => {
        var clickedItem = e.target
        var is_exist = false


        if (child_element.contains(clickedItem)) {
            is_exist = true
        }

        if (!is_exist) {
            // hide_class => the class that when it is removed , hide the element and most of time it is "active"
            parent_element.classList.remove(hide_class)
        }

        // console.log(parent_element, child_element)
    })

}




export function get_translated_text_from_backend(text){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `${hostName}/assets/globals/php/translate_text.php`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.response);

                return data.success
            }
        }
    }
    let formData = new FormData();
    formData.append('text', text)
    xhr.send(formData);
}



export function set_settings_and_effects_to_sending_data_to_backend_button(button, event = 'show-loader'){
    
    // These are the icon and text holders
    const main_text_holder = button.querySelector('#btn-text-holder')
    const main_icon_holder = button.querySelector('#btn-icon-holder')

    // These are the main details that has been sat at first
    var main_text = button.getAttribute('data-main-text')
    var main_icon = button.getAttribute('data-main-icon')


    // These are the icon and text that will replace the main text and icon
    var text_to_change_with = button.getAttribute('data-loading-text')
    var icon_to_change_with = button.getAttribute('data-loading-icon')

    // These are the icon and text that will replace the main text and icon
    var success_event_text = button.getAttribute('data-success-text')
    var success_event_icon = button.getAttribute('data-success-icon')


    if (!event || event == 'show-loader') {
        if (button.classList.contains('loading')) {

            button.classList.remove('loading')
            main_text_holder.textContent = main_text
            main_icon_holder.className = main_icon 

        }else{

            button.classList.add('loading')
            main_text_holder.textContent = text_to_change_with
            main_icon_holder.className = icon_to_change_with

        }
    }else if (event == 'get-back'){ // Reshow the button as default
        button.classList.remove('success-event')
        button.classList.remove('loading')

        main_text_holder.textContent = main_text
        main_icon_holder.className = main_icon 
        
    }else if (event == 'success'){
        button.classList.add('success-event')
        main_text_holder.textContent = success_event_text
        main_icon_holder.className = success_event_icon
        button.classList.remove('loading')

        setTimeout(()=>{
            button.classList.remove('success-event')

            main_text_holder.textContent = main_text
            main_icon_holder.className = main_icon 
        }, 2000)
    }


    
    



}



