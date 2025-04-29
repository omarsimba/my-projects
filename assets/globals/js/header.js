import hostName from './hostName.js'
import * as functions from './functions.js'


const header = document.querySelector("header");


window.onscroll = () => {
    if (window.scrollY >= 20) {
        header.classList.add("active");
    } else {
        header.classList.remove("active");
    }
}


                



// Show and hide language switcher 
const show_available_languages = document.querySelector('#show_available_languages')
const available_languages = document.querySelector('.available_languages')

show_available_languages.onmouseenter = () => {
    available_languages.classList.add('active')
}
available_languages.onmouseenter = () => {
    available_languages.classList.add('active')
}

show_available_languages.onmouseleave = () => {
    available_languages.classList.remove('active')
}
available_languages.onmouseleave = () => {
    available_languages.classList.remove('active')
}




// Switch the language 
const language_switcher_btns = document.querySelectorAll('.language_switcher_btn')
const switching_language_alert = document.querySelector('#switching_language_alert')

language_switcher_btns.forEach(language_switcher => {
    language_switcher.onclick = () => {
        // Start switching language effect 
        switching_language_alert.classList.add('active')

        available_languages.classList.remove('active')

        let switch_to = language_switcher.getAttribute('data-switch_to')

        let xhr = new XMLHttpRequest();
        xhr.open("POST", `${hostName}/assets/globals/php/switch_language.php?switch_to=${switch_to}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.response);

                    if (data.success) {
                        window.location.reload()
                        // Stop switching language effect 
                        switching_language_alert.classList.remove('active')
                    } else if (data.warning) {
                        alert(data.warning)
                    } else if (data.error) {
                        alert(data.error)
                    }
                }
            }
        }
        xhr.send();
    }

});







// Switch currency 
const show_currency_switcher_btns = document.querySelectorAll('#show-currencies-holder')


show_currency_switcher_btns.forEach(show_currency_switcher_btn => {
    show_currency_switcher_btn.onclick = ()=>{
        const currency_switcher_btns_container = show_currency_switcher_btn.parentNode

        const currency_switcher_btns = currency_switcher_btns_container.querySelectorAll('#change-currency')


        if (currency_switcher_btns_container.classList.contains('active')) {
            currency_switcher_btns_container.classList.remove('active')
        }else{
            currency_switcher_btns_container.classList.add('active')
        }

        // When the user clicks somewhere else , close the profil and logout btns alert
        functions.check_if_element_inside_a_parent_if_not_hide_it(currency_switcher_btns_container)



        // Change the currency 
        currency_switcher_btns.forEach(currency_switcher_btn => {
            currency_switcher_btn.onclick = ()=>{
                // Get the choosen currency 
                var thisCurrency = currency_switcher_btn.getAttribute('data-currency')

                let xhr = new XMLHttpRequest();
                xhr.open("POST", `${hostName}/assets/globals/php/switch_currency.php?switch_currency=${thisCurrency}`, true);
                xhr.onload = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let data = JSON.parse(xhr.response);

                            if (data.success) {
                                window.location.reload()
                                // Stop switching currency effect 
                            } else if (data.warning) {
                                alert(data.warning)
                            } else if (data.error) {
                                console.log(data.error)
                            }
                        }
                    }
                }
                xhr.send();
            }
        })

    } 
})










// Show hide side menu

const show_side_menu = document.getElementById('show-side-menu')
const hide_side_menu = document.getElementById('hide-menu-side')
const side_menu = document.getElementById('menu-side')

show_side_menu.onclick = ()=>{
    side_menu.classList.add('active')
    
}

hide_side_menu.onclick = ()=>{
    side_menu.classList.remove('active')
}


