import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import add_data_to_database from '../../globals/js/add_data_to_database.js';





const img = document.getElementById('img')
const imgInput = document.getElementById('img-input')


imgInput.oninput = ()=>{
	if (imgInput.files.length) {
        const reader = new FileReader()
        reader.onload = (e) => {
            img.src = reader.result ;
        }
        reader.readAsDataURL(imgInput.files[0])
    }
}




// Update admin profil

const update_admin_profil = document.getElementById('update-admin-profil')

add_data_to_database(update_admin_profil)

