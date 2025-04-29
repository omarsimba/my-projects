const show_other_description_btns = document.querySelectorAll('#show_more')


show_other_description_btns.forEach(show_other_description => {
    const other_description = show_other_description.previousElementSibling
    show_other_description.onclick = ()=>{
        if ( show_other_description.classList.contains('showed') ) {
            show_other_description.classList.remove('showed')
            other_description.classList.remove('active')
            show_other_description.innerHTML = 'Show More <i class="fa-solid fa-arrow-down"></i>';
        }else{
            show_other_description.classList.add('showed')
            other_description.classList.add('active')
            show_other_description.innerHTML = 'Show Less <i class="fa-solid fa-arrow-up"></i> ';
        }
    }
});

























