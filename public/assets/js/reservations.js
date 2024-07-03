var domain = window.location.hostname;
var port = window.location.port;
function remove_row(id){
    var option = document.getElementById('option_'+id);
    var tr = document.getElementById('room_'+id);
    tr.remove();
    option.disabled = false;
}
function fill_select_rooms(response){
    var select_rooms = document.getElementById('rooms');
    $('#rooms').empty();
    response.data.free_rooms.forEach(room => {
        var option = document.createElement('option');
        option.id = 'option_'+room.id;
        option.value = room.id;
        option.text = 'Habitación # '+room.number+' Camas: '+room.type+' Precio:  S/.'+room.price;
        select_rooms.appendChild(option);
    });
}
function get_user(){
    var dni = document.getElementById('dni').value;
    if(dni.length == 8){
        var url = 'http://'+domain+':'+port+'/api/clients/'+dni;
        fetch(url,{
            'method':'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if(!response.ok){
                throw new Error('Error al buscar el cliente');
            }
            return response.json();
        }).then(data => {
            user_fill(data);
        }).catch(error => {
            console.log(error);
        });
    }else{
        alert('DNI debe tener 8 digitos');
    }
}
function get_free_rooms(){
    var fecha = document.getElementById('date').value;
    var dias = document.getElementById('days').value;
    var url = 'http://'+domain+':'+port+'/api/rooms/free/';
    fetch(url,{
        'method':'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            'date': fecha,
            'days': dias,
        })
    }).then(response => {
        if(!response.ok){
            throw new Error('Error al ejecutar la consulta');
        }
        return response.json();
    }).then(response => {
        fill_select_rooms(response);
    }).catch(error => {
        console.log(error);
    });
}
function user_fill(response){
    var id = document.getElementById('id');
    var name = document.getElementById('name');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    if (response.message == 'Cliente encontrado'){
        id.value = response.data.id
        name.value = response.data.name;
        email.value = response.data.email;
        phone.value = response.data.phone;
    }else{
        id.value = 0;
        name.value = '';
        email.value = '';
        phone.value = '';
        name.readOnly = false;
        email.readOnly = false;
        phone.readOnly = false;
    }
}
document.getElementById('dni').addEventListener('keyup',function(event){
    if(event.key === 'Enter'){
        get_user();
    }
});
document.getElementById('btn_search_dni').addEventListener('click',function(){
    get_user();
});
document.getElementById('btn_check_rooms').addEventListener('click',function(){
    get_free_rooms();
});
document.getElementById('btn_add_room').addEventListener('click',function(){
    var tabla = document.getElementById('tbody_rooms');
    var selectElement = document.getElementById('rooms');
    var selectedValue = selectElement.value;
    var selectedIndex = selectElement.selectedIndex;
    if(selectElement.options[selectedIndex].disabled == false){
    // Obtener el texto de la opción seleccionada
    var selectedText = selectElement.options[selectedIndex].text;
    var tr = document.createElement('tr');
    tr.id = 'room_'+selectedValue;
    var td_text = document.createElement('td');
    var td_btn = document.createElement('td');
    var btn = document.createElement('button');
    var txt = document.createElement('input');
    var spa = document.createElement('span');
    spa.innerHTML = selectedText;
    txt.type = 'hidden';
    txt.name = 'rooms[]';
    txt.value = selectedValue;
    td_text.appendChild(txt);
    td_text.appendChild(spa);
    btn.innerHTML = 'Eliminar';
    btn.classList.add('btn','btn-danger');
    btn.setAttribute('onclick',"remove_row("+selectedValue+")");
    td_btn.appendChild(btn);
    tr.appendChild(td_text);
    tr.appendChild(td_btn);
    tabla.appendChild(tr);
    selectElement.options[selectedIndex].disabled = true;
    }else{
        alert('Habitación ya seleccionada');
    }
});