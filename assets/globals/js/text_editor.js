function formatDoc(cmd, value=null) {
	if(value) {
		document.execCommand(cmd, false, value);
	} else {
		document.execCommand(cmd);
	}
}


function addLink() {
	const url = prompt('Insert url');
	formatDoc('createLink', url);
}


const all_text_editor_button_roles = document.querySelectorAll('.text-editor--tool')
all_text_editor_button_roles.forEach(text_editor_role => {
	text_editor_role.onclick = ()=>{
		const this_role = text_editor_role.getAttribute('data-role')

		if (this_role == 'add-link') {
			addLink()
		}else{
			formatDoc(this_role)
		}

	}
})


const all_text_editor_selector_roles = document.querySelectorAll('.text-editor--selector-tool')
all_text_editor_selector_roles.forEach(text_editor_role => {
	text_editor_role.onchange = ()=>{
		const this_role = text_editor_role.getAttribute('data-role')
		const this_value = text_editor_role.value

		formatDoc(this_role, this_value)
		text_editor_role.selectedIndex=0;
	}
})

const all_text_editor_input_roles = document.querySelectorAll('.text-editor--input-tool')
all_text_editor_input_roles.forEach(text_editor_role => {
	text_editor_role.oninput = ()=>{
		const this_role = text_editor_role.getAttribute('data-role')
		const this_value = text_editor_role.value

		formatDoc(this_role, this_value)
		text_editor_role.selectedIndex=0
		text_editor_role.value="#000000"
	}
})




const all_text_editors = document.querySelectorAll('.text-editor-content');


all_text_editors.forEach(text_editor => {
	text_editor.addEventListener('mouseenter', function () {
		const a = text_editor.querySelectorAll('a');
		a.forEach(item=> {
			item.addEventListener('mouseenter', function () {
				text_editor.setAttribute('contenteditable', false);
				item.target = '_blank';
			})
			item.addEventListener('mouseleave', function () {
				text_editor.setAttribute('contenteditable', true);
			})
		})
	})
});



const filename = document.getElementById('filename');

function fileHandle(value) {
	if(value === 'new') {
		content.innerHTML = '';
		filename.value = 'untitled';
	} else if(value === 'txt') {
		const blob = new Blob([content.innerText])
		const url = URL.createObjectURL(blob)
		const link = document.createElement('a');
		link.href = url;
		link.download = `${filename.value}.txt`;
		link.click();
	} else if(value === 'pdf') {
		html2pdf(content).save(filename.value);
	}
}








