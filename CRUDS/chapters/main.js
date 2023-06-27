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
        const response = await fetch('http://localhost/compouserCRUD/uploads/chapters');
        if (!response.ok) {
            throw new Error('Error en la petición');
        }
        let tablaIDS = document.getElementById('tablaIDS');
        let tabla = '';
        const data = await response.json();

        const searchInput = document.getElementById('searchInput');
        const searchTerm = searchInput.value.trim();

        const filteredData = data.filter(valor => valor.id.toString().includes(searchTerm));


        // Aquí puedes manipular los datos recibidos en la respuesta
        filteredData.forEach(valor => {
            // Aquí puedes manipular cada elemento individualmente
            tabla += `
            <tr">
                <th scope="row">${valor.id}</th>
                <td>${valor.id_team_schedule}</td>
                <td>${valor.id_route}</td>
                <td>${valor.id_trainer}</td>
                <td>${valor.id_psycologist}</td>
                <td>${valor.id_teacher}</td>
                <td>${valor.id_level}</td>
                <td>${valor.id_journey}</td>
                <td>${valor.id_staff}</td>
                <td><button type="button" class="btn btn-warning espacio white" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="${valor.id}">editar</button><button type="button" class="btn btn-danger white btnEliminar" data-id="${valor.id}">X</button></td>
            </tr>
            `;
        });

        tablaIDS.innerHTML = tabla; // Actualizar la tabla con los nuevos datos

        // Agregar evento de clic a los elementos con clase "btnEliminar"
        document.querySelectorAll('.btnEliminar').forEach(boton => {
            boton.addEventListener('click', async (e) => {
                const id = e.target.dataset.id; // Obtener el ID del atributo data-id del botón
                eliminarElemento(id);
            });
        });
        document.querySelectorAll('.btn-warning').forEach(boton => {
            boton.addEventListener('click', async (e) => {
                const id = e.target.dataset.id; // Obtener el ID del atributo data-id del botón
				console.log(id);
                ValorEditElemento(id);
            });
        });
        document.querySelector('.save').addEventListener('click', async (e) => {
            let formModal = document.querySelector('#formModal');
            let data = Object.fromEntries(new FormData(formModal))
            data.id = e.target.id;
            editarElemento(data)
        })


    } catch (error) {
        // Manejo de errores
        console.error('Error:', error);
    }
}

async function eliminarElemento(id) {
    try {
        const response = await fetch(`http://localhost/compouserCRUD/uploads/chapters/`, {
            method: 'DELETE',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ "id": id })	
        });
        if (!response.ok) {
            throw new Error('Error en la petición');
        }
        console.log(`Se eliminó el elemento con ID ${id}`);
        fetchData();
    } catch (error) {
        console.error('Error:', error);
    }
}

async function editarElemento(data) {
    data.id = parseInt(data.id);
    data.id_team_schedule = parseInt(data.id_team_schedule);
    data.id_route = parseInt(data.id_route);
    data.id_trainer = parseInt(data.id_trainer);
    data.id_psycologist = parseInt(data.id_psycologist);
    data.id_teacher = parseInt(data.id_teacher);
    data.id_level = parseInt(data.id_level);
    data.id_journey = parseInt(data.id_journey);
    data.id_staff = parseInt(data.id_staff);
    console.log(data);
    try {
        const response = await fetch('http://localhost/compouserCRUD/uploads/chapters', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Error en la petición');
        }

        console.log(`Se actualizó ${data.id}`);
        fetchData();
    } catch (error) {
        console.error('Error:', error);
    }
}

async function ValorEditElemento(id) {
    try {
        const response = await fetch(`http://localhost/compouserCRUD/uploads/chapters/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        if (!response.ok) {
            throw new Error('Error en la petición');
        }
        const data = await response.json();
        console.log(data);
        document.querySelector('.save').id = data[0].id;
        document.getElementById('id_team_schedule').value = data[0].id_team_schedule;
        document.getElementById('id_route').value = data[0].id_route;
        document.getElementById('id_trainer').value = data[0].id_trainer;
        document.getElementById('id_psycologist').value = data[0].id_psycologist;
        document.getElementById('id_teacher').value = data[0].id_teacher;
        document.getElementById('id_level').value = data[0].id_level;
        document.getElementById('id_journey').value = data[0].id_journey;
        document.getElementById('id_staff').value = data[0].id_staff;
        console.log(`Se tiene el elemento con ID ${id}`);
    } catch (error) {
        console.error('Error:', error);
    }
}

fetchData();

let form = document.getElementById('form');

form.addEventListener('submit', async (e) => {
	e.preventDefault();
    let data = Object.fromEntries(new FormData(e.target));
	console.log(data);
    data.id = parseInt(data.id);
    data.id_team_schedule = parseInt(data.id_team_schedule);
    data.id_route = parseInt(data.id_route);
    data.id_trainer = parseInt(data.id_trainer);
    data.id_psycologist = parseInt(data.id_psycologist);
    data.id_teacher = parseInt(data.id_teacher);
    data.id_level = parseInt(data.id_level);
    data.id_journey = parseInt(data.id_journey);
    data.id_staff = parseInt(data.id_staff);
    
    console.log(data);
    
    try {
        const response = await fetch('http://localhost/compouserCRUD/uploads/chapters', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Error en la petición');
        }

        console.log('Elemento creado exitosamente');
        fetchData(); // Actualizar la tabla después de crear el elemento
    } catch (error) {
        console.error('Error:', error);
    }
});

let searchButton = document.getElementById('searchButton');
searchButton.addEventListener('click', () => {
    fetchData();
});