import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

functions.prevent_default();



const profileDetails = document.getElementById('profile-details')
const profileDetailsIcon = profileDetails.querySelector('#profile-details-icon')

const profileAndLogout = document.getElementById('profile-and-logout')

const logoutBtn = document.getElementById('logout-btn')


profileDetails.onclick = ()=>{
    if ( !profileAndLogout.classList.contains('active') ) {
        profileAndLogout.classList.add('active')
        profileDetailsIcon.style.transform = 'rotate(180deg)'
    }else{
        profileAndLogout.classList.remove('active')
        profileDetails.classList.remove('active')
        profileDetailsIcon.style.transform = 'rotate(0)'
    }
}

// When the user clicks somewhere else , close the profil and logout btns alert
functions.check_if_element_inside_a_parent_if_not_hide_it(profileAndLogout)



// When the user want to logout 
logoutBtn.ondblclick = ()=>{
    functions.insertingDataLoader('show')
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `${hostName}/assets/admin/php/logingout.php?logout=true`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.response);

                if (data.success) {
                    functions.insertingDataLoader('hide')
                    window.location.reload()
                } else if (data.warning) {
                    backendResponseContainer('warning', data.warning)
                } else if (data.error) {
                    backendResponseContainer('error', data.error)
                }
            }
        }
    }
    xhr.send();
}



// --------------------

// Toogle side header
const side_header = document.getElementById('side_header')
const toggle_side_header = document.getElementById('toggle-side-header')



if (toggle_side_header) {

    toggle_side_header.onclick = ()=>{
        var toggle_value = toggle_side_header.getAttribute('data-toggle')

        if (side_header.classList.contains('small')) {
            side_header.classList.remove('small')
            toggle_value = 'full'
        }else{
            side_header.classList.add('small')
            toggle_value = 'small'
        }

        
        console.log(toggle_value)

        let xhr = new XMLHttpRequest();
        xhr.open("POST", `${hostName}/assets/admin/php/set_side_header_width.php?toogle=${toggle_value}`, true);
        xhr.send();
    }
}



























