import hostName from '../../globals/js/hostName.js';
import * as functions from '../../globals/js/functions.js';
import backendResponseContainer from './functions/backend-response.js'

functions.prevent_default();


const ordering_orders = document.getElementById('ordering_orders')
const action_btns = document.querySelectorAll('#action-btn')
const allOrders = document.querySelectorAll('#order')

var orderingPackages = []
var i = 0

ordering_orders.onclick = ()=>{
    if ( ordering_orders.classList.contains('start_choosing') ) { // If the user completed choosing orders
        // You choose

        ordering_orders.innerHTML = 'Choose <i class="ri-play-line"></i>'

        ordering_orders.classList.remove('start_choosing')

        const allClickedOrders = document.querySelectorAll('#order.clicked')
        allClickedOrders.forEach(clickedOrders => {
            clickedOrders.classList.remove('clicked')
        });

    }else{ // If the user just started choosing orders
        // start choosing

        orderingPackages.length = 0 // Empty the array
        i = 0
        allOrders.forEach(order => {
            var ordering_number = order.querySelector('.ordering_number')
            ordering_number.textContent = 0
        });
        ordering_orders.innerHTML = 'Complet <i class="ri-stop-line"></i>'

        ordering_orders.classList.add('start_choosing')

        allOrders.forEach(orders => {
            orders.classList.add('ordering')
        });
    }
}

allOrders.forEach(order => {
    order.onclick= ()=>{
        if ( ordering_orders.classList.contains('start_choosing') ) {
            var id = order.getAttribute('data-special_id')
            var ordering_number = order.querySelector('.ordering_number')

            if ( order.classList.contains('clicked') ) { // This order already chosen .
                alert('This order already chosen!')
            }else{ // Choose the order and add the order id in the array .
                order.classList.add('clicked') // Add clicked class to the order .
                orderingPackages.push(id) // Add the order id into the array .
                i++
                ordering_number.textContent = i
            }
        }
    }
});



action_btns.forEach(action_btn => {
    action_btn.onclick = ()=>{
        var action = action_btn.getAttribute('data-action')
        var id = action_btn.getAttribute('data-special_id')
        var order_id = action_btn.getAttribute('data-order_id')
        
        var thisPackage = action_btn.parentNode.parentNode

        // Show loading effect
        functions.insertingDataLoader('show')

        let xhr = new XMLHttpRequest();
        xhr.open("POST", `${hostName}/assets/admin/php/to_be_delivered.php`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.response);

                    // Hide loading effect
                    functions.insertingDataLoader('hide')

                    if (data.success) {
                        backendResponseContainer('success', data.success)
                        thisPackage.classList.add('removed')
                    } else if (data.warning) {
                        backendResponseContainer('warning', data.warning)
                    } else if (data.error) {
                        backendResponseContainer('error', data.error)
                        console.log(data.error)
                    }
                }
            }
        }
        let formData = new FormData();
        formData.append('id', id)
        formData.append('action', action)
        formData.append('order_id', order_id)

        xhr.send(formData);
    }
});
