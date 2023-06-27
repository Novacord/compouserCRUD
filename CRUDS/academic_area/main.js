// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');
allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();

		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}

		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})
// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');
if(sidebar.classList.contains('hide')) {
	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}
toggleSidebar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');

	if(sidebar.classList.contains('hide')) {
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})

		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
	} else {
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})
sidebar.addEventListener('mouseleave', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
	}
})
sidebar.addEventListener('mouseenter', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})
// PROFILE DROPDOWN
const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');
imgProfile.addEventListener('click', function () {
	dropdownProfile.classList.toggle('show');
})
// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');
allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');

	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})
window.addEventListener('click', function (e) {
	if(e.target !== imgProfile) {
		if(e.target !== dropdownProfile) {
			if(dropdownProfile.classList.contains('show')) {
				dropdownProfile.classList.remove('show');
			}
		}
	}

	allMenu.forEach(item=> {
		const icon = item.querySelector('.icon');
		const menuLink = item.querySelector('.menu-link');

		if(e.target !== icon) {
			if(e.target !== menuLink) {
				if (menuLink.classList.contains('show')) {
					menuLink.classList.remove('show')
				}
			}
		}
	})
})
// PROGRESSBAR
const allProgress = document.querySelectorAll('main .card .progress');
allProgress.forEach(item=> {
	item.style.setProperty('--value', item.dataset.value)
})


//GET table



async function fetchData() {
	try {
	  const response = await fetch('http://localhost/compouserCRUD/uploads/academic_area');
	  if (!response.ok) {
		throw new Error('Error en la petición');
	  }
	  let tablaIDS = document.getElementById('tablaIDS')
	  let tabla = ''
	  const data = await response.json();
	  // Aquí puedes manipular los datos recibidos en la respuesta
	  data.forEach(valor => {
		// Aquí puedes manipular cada elemento individualmente
		tabla += `
		<tr>
			<th scope="row">${valor.id}</th>
			<td>${valor.id_area}</td>
			<td>${valor.id_staff}</td>
			<td>${valor.id_position}</td>
			<td>${valor.id_journey}</td>
			<td><button type="button" class="btn btn-warning espacio white"><i class='bx bxs-pencil' ></i></button><button type="button" class="btn btn-danger white"><i class='bx bxs-tag-x' ></i></button></td>
		</tr>
		`
	  });
	  tablaIDS.insertAdjacentHTML("afterend", tabla)
	} catch (error) {
	  // Manejo de errores
	  console.error('Error:', error);
	}
	
  }
  
  fetchData();

  let form = document.getElementById('form');

  form.addEventListener('submit',async(e)=>{
	  let data = Object.fromEntries(new FormData(e.target))
	  data.id = parseInt(data.id)
	  data.id_area = parseInt(data.id_area)
	  data.id_staff = parseInt(data.id_staff)
	  data.id_position = parseInt(data.id_position)
	  data.id_journey = parseInt(data.id_journey)
	  console.log(data)
	  const response = await fetch('http://localhost/compouserCRUD/uploads/academic_area', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
	  
    });
  })
