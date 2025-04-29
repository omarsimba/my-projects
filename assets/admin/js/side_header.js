const lists = document.querySelectorAll('li.has_list')
lists.forEach(list => {
    list.onclick = () => {

        // Check if there is any other open list group except this special one
        const active_lists = document.querySelectorAll('li.has_list.active')
        active_lists.forEach(active_list => {
            if (active_list.classList.contains('active') && active_list != list) {
                active_list.classList.remove('active')
            }
        })

        // Check if this list has 'ACTIVE' class or not
        if (list.classList.contains('active')) {
            list.classList.remove('active')
        }else {
            list.classList.add('active')
        }
    }
});