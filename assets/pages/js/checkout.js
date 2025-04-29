import hostName from "../../globals/js/hostName.js";
import * as functions from "../../globals/js/functions.js";
// Preventing the forms submiting 
functions.prevent_default()
functions.copy_to_clipboard()



// When the user want to add more quantity or else 

const plus_btns = document.querySelectorAll("#plus_quantity");
const minus_btns = document.querySelectorAll("#minus_quantity");

plus_btns.forEach(btn => { // Add quantity .
    btn.onclick = () => {
        var quantity = btn.previousElementSibling;
        var i = quantity.textContent;
        quantity.textContent++;
    }
});

minus_btns.forEach(btn => { // Less quantity .
    btn.onclick = () => {
        var quantity = btn.nextElementSibling;
        var i = quantity.textContent;
        if (i > 1) {
            quantity.textContent--;
        }
    }
});

// ------------------------------------

// --------------------------------------



// Active the shipping form button 
const shipping_inputs = document.querySelectorAll(".container .checkout_content .left_side .other_infos .informations form .input input");
const checking_entred_data_btn = document.querySelector(".checking-entred-data");

// ------------------------
// All inputs
const first_name = document.querySelector(".container .checkout_content .left_side .other_infos .informations form .input #first_name");
const last_name = document.querySelector(".container .checkout_content .left_side .other_infos .informations form .input #last_name");
const email = document.querySelector(".container .checkout_content .left_side .other_infos .informations form .input #email");
const whatsapp_number = document.querySelector(".container .checkout_content .left_side .other_infos .informations form .input #whatsapp_number");

const pin_code = document.querySelector(".container .checkout_content .left_side .other_infos .informations form .input #pin_code");


const full_name__picker = document.querySelector(".container .checkout_content .left_side .entred_data_section .entred_data .data #full_name--picker");
const email__picker = document.querySelector(".container .checkout_content .left_side .entred_data_section .entred_data .data #email--picker");
const pin_code__picker = document.querySelector(".container .checkout_content .left_side .entred_data_section .entred_data .data #pin_code--picker");
const whatsapp_number__picker = document.querySelector(".container .checkout_content .left_side .entred_data_section .entred_data .data #whatsapp_number--picker");




// Choose available payment method





const checkboxes_for_available_payment_methods = document.querySelectorAll(".container .checkout_content .available_payment_methods .checkbox-payment_method");
const payment_methods_btn = document.querySelector(".container .checkout_content .available_payment_methods_section .show-payment-steps");

var payment_methods_arr = ''
var payment_method_btns = []



checkboxes_for_available_payment_methods.forEach(payment_method => {

    payment_method.onclick = () => {
        var parent = payment_method.parentNode

        // payment_method_btns = []
        payment_method_btns.push({'parent': parent, 'payment_method_btn': payment_method});
        
        var method_name = payment_method.getAttribute("data-method-name");
        var payment_method_origine = payment_method.getAttribute("data-payment_method_origine")
        var payment_method_name = payment_method.getAttribute("data-payment_method_name")


        var payment_method_account_details = payment_method.getAttribute("data-method-account_details");
        var data_to_arr = [method_name, payment_method_account_details, payment_method_origine, payment_method_name]
        if (payment_method.checked) {
            // console.log('checked')
            payment_methods_arr = []
                payment_methods_arr.push(data_to_arr)
                for (var i = 0; i < payment_method_btns.length; i++) {
                    payment_method_btns[i].parent.classList.remove('active')
                    payment_method_btns[i].payment_method_btn.checked = false
                }
                parent.classList.add('active')
                payment_method.checked = true
                
        } else {
            console.log(payment_methods_arr)
            payment_methods_arr = []
            console.log('not checked')
            for (var i = 0; i < payment_method_btns.length; i++) {
                payment_method_btns[i].parent.classList.remove('active')
            }

            parent.classList.remove('active')
        }
    }
});
// -------------------------










const all_paragraphes = document.querySelectorAll(".container .checkout_content .left_side .entred_data_section .entred_data .data p.value");

// ------------------------

setInterval(() => {
    if (first_name.value != "" && last_name.value != "" && email.value != "" && whatsapp_number.value != "" && pin_code.value != "") {
        checking_entred_data_btn.classList.add("active");
    } else {
        checking_entred_data_btn.classList.remove("active");
    }
    if (payment_methods_arr.length == 1) {
        payment_methods_btn.classList.add("active");
    } else {
        payment_methods_btn.classList.remove("active");
    }
}, 100);

// When the user enter thier shipping data , and wanna check them to be sure 



// ------------------------------------------

const next_btns = document.querySelectorAll("#next_btn");
const previous_btns = document.querySelectorAll("#previous_btn");
const entred_data_spinner = document.querySelector(".entred_data .spinner-container");

// Last step 

// const that_will_be_replaced = document.getElementById("that_will_be_replaced")

// const payment_method_account = document.getElementById("payment_method_account")

// --------------------


next_btns.forEach(btn => {
    btn.onclick = () => {

        if (btn.classList.contains("checking-entred-data")) {
            if (btn.classList.contains("active")) {
                this_function();
                setTimeout(() => {
                    entred_data_spinner.classList.remove("active");
                    set_data_();
                }, 3000);
            } else {
                getting_backend_errors('empty-input')
            }
        } else if (btn.classList.contains("show-payment-steps")) {
            if (payment_methods_arr.length == 1) {
                // Send the choosen payment method to the last step .
                var choosen_payment_method = payment_methods_arr[0];
                this_function(choosen_payment_method);

            } else if (payment_methods_arr.length == 0) {
                getting_backend_errors('no-payment-method')
            } else if (payment_methods_arr.length > 1) {
                getting_backend_errors('unexpected-payment')
            }
        } else {
            this_function();
        }

        function this_function(choosen_payment_method = null) {
            if (choosen_payment_method != null) {

                // if (choosen_payment_method[2] == 'bank_transfer') {
                    // Get this payment method details
                    get_payment_method_details_from_backend(choosen_payment_method[2], choosen_payment_method[3])

                    // console.log(__bank_account_details)

                // }

                // that_will_be_replaced.textContent = choosen_payment_method[0];
                // payment_method_account.textContent = choosen_payment_method[1]
                // payment_method_account.setAttribute("data-to_clipboard", choosen_payment_method[1]);

                // functions.copy_to_clipboard();

            }
            var this_element = btn.parentNode.parentNode;
            var next_element = btn.parentNode.parentNode.nextElementSibling;
            var followed_by = next_element.getAttribute("data-followed-by");
            var follower_link = document.querySelector(`.checkout_content .links ul .${followed_by}`);

            this_element.classList.replace("show", "hidden");
            next_element.classList.add("show");
            next_element.classList.remove("hidden");
            if (follower_link) {
                follower_link.classList.add("activated");
            }



            function get_payment_method_details_from_backend(payment_method_origin, payment_method_name){


                let xhr = new XMLHttpRequest();
                xhr.open("POST", `${hostName}/assets/pages/php/CHECKOUT/get_payment_method_details.php`, true);
                xhr.onload = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let data = JSON.parse(xhr.response);

                                const payment_method_box = document.querySelector(`.payment-method-box#for-${payment_method_origin}`)
                                const transformation_type_holder = payment_method_box.querySelector('.transformation-type')

                                var __bank_account_details = data.success

                                // Show this container
                                payment_method_box.classList.add('active')

                                // Set data to holders
                                transformation_type_holder.textContent = __bank_account_details.name

                                if (choosen_payment_method[2] == 'bank_transfer') {
                                    const full_name_holder = payment_method_box.querySelector('.full_name')
                                    const bank_transfer_rib_holder = payment_method_box.querySelector('.bank-transfer-rib')
                                    const by_application_rib = payment_method_box.querySelector('.by-application-rib')




                                    full_name_holder.textContent = __bank_account_details['full_name']
                                    bank_transfer_rib_holder.textContent = __bank_account_details['bank_transfer_rib']
                                    by_application_rib.textContent = __bank_account_details['by_application_rib']

                                } else if (choosen_payment_method[2] == 'agencies') {
                                    const full_name_holder = payment_method_box.querySelector('.full_name')


                                    full_name_holder.textContent = __bank_account_details['full_name']

                                } else if (choosen_payment_method[2] == 'online_payment') {
                                    const id_holder = payment_method_box.querySelector('.id')


                                    id_holder.textContent = __bank_account_details['id']

                                }
                        }
                    }
                }
                var formData = new FormData();
                formData.append('payment_method_origin', payment_method_origin)
                formData.append('payment_method_name', payment_method_name)


                xhr.send(formData);
            }



        }

        function set_data_() {
            full_name__picker.textContent = `${first_name.value} ${last_name.value}`
            email__picker.textContent = email.value
            pin_code__picker.textContent = pin_code.value
            whatsapp_number__picker.textContent = whatsapp_number.value


        }
    }
});
previous_btns.forEach(btn => {
    btn.onclick = () => {

        if (btn.classList.contains("entred_data_previous_btn")) {
            this_function();
            entred_data_spinner.classList.add("active");
        } else if(btn.classList.contains("choose_payment_method")){
            // Hide all the payment method details boxes
            const payment_method_boxs = document.querySelectorAll(`.payment-method-box.active`)
            payment_method_boxs.forEach(payment_method_box => {
                payment_method_box.classList.remove('active')
            })

            this_function();


        } else {
            this_function();
        }

        function this_function() {
            var this_element = btn.parentNode.parentNode;
            var previous_element = btn.parentNode.parentNode.previousElementSibling;
            var followed_by = this_element.getAttribute("data-followed-by");
            var follower_link = document.querySelector(`.checkout_content .links ul .${followed_by}`);

            this_element.classList.replace("show", "hidden");
            previous_element.classList.remove("hidden");
            previous_element.classList.add("show");
            if (follower_link) {
                follower_link.classList.remove("activated");
            }
        }
    }
});





// Increase and decrease quantity 
const quantity_right_side = document.getElementById("quantity_right_side");
const quantity_left_side = document.getElementById("quantity_value");

const main_price = document.querySelector("#product_total_price span");
const socend_price = document.querySelector("#socend_price span");
const steps_payment_amount = document.querySelector(".steps_payment_amount");

const increase_quantity = document.getElementById("increase_quantity");
const decrease_quantity = document.getElementById("decrease_quantity");
var i = 1;

increase_quantity.onclick = () => { // When you increase the quantity , you change total prices , and quantities  .

    var product_price = increase_quantity.getAttribute("data-product_price");
    i++;
    var product_price = (product_price * i).toFixed(2);
    var product_quantity = i;

    // Sitting quantities to html .
    quantity_right_side.textContent = product_quantity;
    quantity_left_side.textContent = product_quantity;

    // Sitting prices to html .
    main_price.textContent = product_price;
    socend_price.textContent = product_price;
    steps_payment_amount.textContent = product_price;



}

decrease_quantity.onclick = () => { // When you decrease the quantity , you change total prices , and quantities  .

    var product_price = decrease_quantity.getAttribute("data-product_price");
    if (i > 1) {
        i--;
        var product_price = (product_price * i).toFixed(2);
        var product_quantity = i;

        // Sitting quantities to html .
        quantity_right_side.textContent = product_quantity;
        quantity_left_side.textContent = product_quantity;

        // Sitting prices to html .
        main_price.textContent = product_price;
        socend_price.textContent = product_price;
        steps_payment_amount.textContent = product_price;
    }

}





// Send user data to backend , to save it intoo database 
const finish_payment_steps = document.getElementById("finish_payment_steps");


finish_payment_steps.onclick = () => {

    const first_name_value = first_name.value;
    const last_name_value = last_name.value;
    const email_value = email.value;
    const whatsapp_number_value = whatsapp_number.value;


    const pin_code_value = pin_code.value;
    var quantity_value = document.querySelector(".container .checkout_content .right_side .assets .asset #quantity_right_side").textContent;
    var product_id_value = finish_payment_steps.getAttribute("data-product_id");

    var chosen_payment_method_origin = payment_methods_arr[0][0]

    send_user_data_to_backend(first_name_value, last_name_value, email_value, whatsapp_number_value, pin_code_value, quantity_value, product_id_value, chosen_payment_method_origin);
}

function send_user_data_to_backend(first_name_value, last_name_value, email_value, whatsapp_number_value, pin_code_value, quantity_value, product_id_value, chosen_payment_method_origin) {
    finish_payment_steps.classList.add("spinning");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `${hostName}/assets/pages/php/CHECKOUT/insert_new_order.php`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.response);


                finish_payment_steps.classList.remove("spinning");

                if (data.success) {
                    functions.small_message(data.success.title, data.success.text)
                } else if (data.warning) {
                    functions.small_message(data.warning.title, data.warning.text)

                } else if (data.error) {
                    functions.small_message(data.error.title, data.error.text)
                }

            }
        }
    }
    var formData = new FormData();
    // |||||||||||||||||||||||||||||||||||||||||
    formData.append("first_name_value", first_name_value);
    formData.append("last_name_value", last_name_value);
    formData.append("email_value", email_value);
    formData.append("quantity", quantity_value);
    formData.append("product_id", product_id_value);
    formData.append("payment_method_origin", payment_methods_arr[0][2])
    formData.append("payment_method_name", payment_methods_arr[0][3])
    formData.append("pin_code_value", pin_code_value);

    formData.append("whatsapp_number_value", whatsapp_number_value);



    xhr.send(formData);

    console.log(payment_methods_arr[0][2], quantity_value, product_id_value, payment_methods_arr[0][3])
}



function getting_backend_errors(error_type){


    let xhr = new XMLHttpRequest();
        xhr.open("POST", `${hostName}/assets/pages/php/getting_backend_error_texts.php`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.response);
                    if (data.success) {
                        functions.modern_alert(data.success.title, data.success.text);
                    }
                }
            }
        }
        var formData = new FormData();
        formData.append('error_type', error_type)

        xhr.send(formData);
}




