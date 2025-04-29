import hostName from '../../globals/js/hostName.js'
import * as functions from '../../globals/js/functions.js';

const acceptOrder = document.getElementById('accept-order')
const refuseOrder = document.getElementById('refuse-order')

const allOrders = document.querySelectorAll('#_an_order')
const side_order_more_details = document.querySelector('.side_order_more_details')
const side_order_more_details__details_container = document.querySelector('.side_order_more_details .details')
const hide_side_order_more_details = document.getElementById('hide--side_order_more_details')
var i = 0

var updatedData = {
    "updated-fullName": "",
    "updated-email": "",
    "updated-phone": "",
    "updated-address": "",
    "updated-city": "",
    "updated-freeTime": "",
}

allOrders.forEach(order => {
    order.onclick = () => { // The sidde order more details
        var order_id = order.getAttribute('data-order_id')
        i++
        if (i == 1) {
            order.classList.add('active')
            side_order_more_details.classList.add('active')

            fetch(`${hostName}/assets/admin/php/get_order_more_details.php`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    {
                        "order_id": order_id
                    }
                )
            })
            .then(response => response.json())
            .then(
                    (response) => {
                        var data = JSON.stringify(response)
                        var data = JSON.parse(data)

                        // Put order id into the action buttons 
                        acceptOrder.setAttribute('data-order-id', order_id)
                        refuseOrder.setAttribute('data-order-id', order_id)
                        console.log(data.success.product_info)


                        side_order_more_details__details_container.innerHTML = `
                            
                            
                            <div class="info-group">
                                <div class="info">
                                    <div class="icon"><i class="ri-user-line"></i></div>
                                    <div class="texts">
                                        <p class="key">Full name - <i class="ri-refresh-line"></i></p>
                                        <div class="to-be-input--container">
                                            <input type="submit" value="${data.success.full_name}" class="value to-be-input" name="update-customer-fullName" id="updated-fullName" />
                                            <button id="save-to-be-input-text" data-for="fullName"><i class="ri-save-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="fi fi-rr-at"></i></div>
                                    <div class="texts">
                                        <p class="key">Email - <i class="ri-refresh-line"></i></p>
                                        <div class="to-be-input--container">
                                            <input type="submit" value="${data.success.email}" class="value to-be-input" name="update-customer-email" id="updated-email" />
                                            <button id="save-to-be-input-text" data-for="email"><i class="ri-save-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="fi fi-rr-phone-flip"></i></div>
                                    <div class="texts">
                                        <p class="key">Phone - <i class="ri-refresh-line"></i></p>
                                        <div class="to-be-input--container">
                                            <input type="submit" value="${data.success.phone}" class="value to-be-input" name="update-customer-phone" id="updated-phone" />
                                            <button id="save-to-be-input-text" data-for="phone"><i class="ri-save-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="ri-map-2-line"></i></div>
                                    <div class="texts">
                                        <p class="key">City - <i class="ri-refresh-line"></i></p>
                                        <div class="to-be-input--container">
                                            <input type="submit" value="${data.success.city}" class="value to-be-input" name="update-customer-city" id="updated-city" />
                                            <button id="save-to-be-input-text" data-for="city"><i class="ri-save-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="ri-map-2-line"></i></div>
                                    <div class="texts">
                                        <p class="key">Address - <i class="ri-refresh-line"></i></p>
                                        <div class="to-be-input--container">
                                            <input type="submit" value="${data.success.address}" class="value to-be-input" name="update-customer-address" id="updated-address" />
                                            <button id="save-to-be-input-text" data-for="address"><i class="ri-save-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="fi fi-rr-coins"></i></div>
                                    <div class="texts">
                                        <p class="key">Cost</p>
                                        <p class="value">${data.success.cost}${data.success.currency}</p>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="fi fi-rr-language"></i></div>
                                    <div class="texts">
                                        <p class="key">Activated language</p>
                                        <p class="value">${data.success.activated_language_on_the_website}</p>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="fi fi-rr-at"></i></div>
                                    <div class="texts">
                                        <p class="key">Colors - <i class="ri-refresh-line"></i></p>
                                        <div class="colors-sizes--container">
                                            <div class="color-size">
                                                <div class="icon error" id="color-size-action" data-action="remove" data-value="white">x</div>
                                                <p>White</p>
                                            </div>
                                            <div class="color-size">
                                                <div class="icon success" id="color-size-action" data-action="add" data-value="black">+</div>
                                                <p>Black</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="icon"><i class="ri-time-line"></i></div>
                                    <div class="texts">
                                        <p class="key">Free time - <i class="ri-refresh-line"></i></p>
                                        <div class="to-be-input--container active">
                                            <input type="text" class="value to-be-input active" name="update-customer-free-time" id="updated-freeTime" />
                                            <button id="save-to-be-input-text" data-for="freeTime"><i class="ri-save-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            `
                        const editableInputs = document.querySelectorAll('.to-be-input--container')
                        editableInputs.forEach(editableInput =>{
                            editableInput.ondblclick = ()=>{
                                editableInput.classList.add('active') // add active class to the parent to show the save icon
                                const thisInput = editableInput.querySelector('input')
                                thisInput.classList.add('active')
                                thisInput.type = (thisInput.type === 'text') ? 'submit' : 'text'
                            }
                        })

                        const saveEditableTextBtns = document.querySelectorAll('#save-to-be-input-text')
                        saveEditableTextBtns.forEach(saveEditableTextBtn =>{
                            saveEditableTextBtn.onclick = ()=>{
                                const thisInput = saveEditableTextBtn.previousElementSibling
                                const editableInput = saveEditableTextBtn.parentNode
                                editableInput.classList.remove('active') // add active class to the parent to show the save icon
                                thisInput.classList.remove('active')
                                thisInput.type = (thisInput.type === 'text') ? 'submit' : 'text'

                                // Update the phone and address in the object to be able to send it to backend 
                                var btnFor = saveEditableTextBtn.getAttribute('data-for')
                                updatedData[`updated-${btnFor}`] = thisInput.value

                            }
                        })


                    })
        }
    }
});

hide_side_order_more_details.onclick = () => {
    side_order_more_details.classList.remove('active')
    allOrders.forEach(order => {
        if (order.classList.contains('active')) {
            order.classList.remove('active')
            i = 0
        }
    });
}




// Accept and refuse customers orders 

const actionBtns = document.querySelectorAll('.action-btn')

actionBtns.forEach(actionBtn => {
    actionBtn.onclick = ()=>{
        var orderId = actionBtn.getAttribute('data-order-id')
        var btnAction = actionBtn.getAttribute('data-action')

        if (orderId) {
            functions.insertingDataLoader('show')

            fetch(`${hostName}/assets/admin/php/accept_refuse_orders.php`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    {
                        "order-id": orderId,
                        "action": btnAction,
                        "updated-data": updatedData,
                    }
                )
            })
            .then(response => response.json())
            .then(
                    (response) => {
                        var data = JSON.stringify(response)
                        var data = JSON.parse(data)
                        functions.insertingDataLoader('hide')
                        if ( data.success ) {
                            alert(data.success)
                        }else if ( data.warning ) {
                            alert(data.warning)
                         }else if ( data.error ) {
                            alert(data.error)
                         }
                        
                    })

        }else{
            alert('Something went wrong! Try again.')
        }
    }
})



