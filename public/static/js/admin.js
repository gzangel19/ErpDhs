var base = location.protocol + '//' + location.host;

var route = document.getElementsByName('routeName')[0].getAttribute('content');

// document.getElementsByClassName('lk-'+route)[0].classList.add('active');

const http = new XMLHttpRequest();

const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');


document.addEventListener("DOMContentLoaded", function (event) {

    console.log(route);

    if(route = "clientes.show"){

        var btn_pedidos = document.getElementsByClassName('btn_pedidos');

        for(i = 0; i < btn_pedidos.length; i++){
        
            btn_pedidos[i].addEventListener('click', historialPagos);
                
        }

    }


});


function historialPagos(e){

    e.preventDefault();

    var pedido_id = this.getAttribute('data_object');

    var url = base + '/api/clientes/pedidos/' + pedido_id;

    http.open('GET',url,true);

    http.setRequestHeader('X-CSRF-Token',csrfToken);

    http.send();

    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status == 200){

            var data = this.responseText;
                
            data = JSON.parse(data);

           

            var cuerpoTabla = document.getElementById('cuerpoTabla');

            var input_pedido_id = document.getElementById('pedido_id');
        
            var modalTitle = document.getElementById('modalTitle');
        
            cuerpoTabla.innerHTML = '';
        
            modalTitle.innerHTML = '';

            input_pedido_id.value = '';

            modalTitle.innerHTML = "Historial de Pagos Registrados Pedido N° " + pedido_id;

            for(let item of data){

                console.log(item);

                var date = new Date(item.created_at);

                cuerpoTabla.innerHTML += "<tr> <td> " + date.toLocaleDateString() + "</td> <td>"+ item.tipo + "</td> <td> AR$ " + item.entrada + "</td> <td> " + item.forma + "</td></tr>";

               
            }

            input_pedido_id.value = pedido_id;
        }
    }
        
}

function doSearch()
{
    const tableReg = document.getElementById('datos');
    const searchText = document.getElementById('searchTerm').value.toLowerCase();
    let total = 0;

    // Recorremos todas las filas con contenido de la tabla
    for (let i = 1; i < tableReg.rows.length; i++) {
        // Si el td tiene la clase "noSearch" no se busca en su cntenido
        if (tableReg.rows[i].classList.contains("noSearch")) {
            continue;
        }

        let found = false;
        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        // Recorremos todas las celdas
        for (let j = 0; j < cellsOfRow.length && !found; j++) {
            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                found = true;
                total++;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            // fila de la tabla
            tableReg.rows[i].style.display = 'none';
        }
    }

    // mostramos las coincidencias
    const lastTR=tableReg.rows[tableReg.rows.length-1];
    const td=lastTR.querySelector("td");
    lastTR.classList.remove("hide", "red");
    if (searchText == "") {
        lastTR.classList.add("hide");
    } else if (total) {
        td.innerHTML="Se ha encontrado "+total+" coincidencia"+((total>1)?"s":"");
    } else {
        lastTR.classList.add("red");
        td.innerHTML="No se han encontrado coincidencias";
    }
}



