let costo = document.getElementById('costo')
let plazo = document.getElementById('plazo')

let costo_input = document.getElementById('costo_input')
let plazo_input = document.getElementById('plazo_input')

costo.addEventListener('change',costo_inp)
plazo.addEventListener('change',plazo_inp)

let costo_toggle = false
let plazo_toggle = false

function costo_inp(){
    console.log('test');
    if (!costo_toggle){
        console.log('test');
        costo_toggle = true
        costo_input.innerHTML = `
        <label class="mr-10">Monto</label>
        <input class="w-80" type="number"  name="cost" ">                        
    `
    }else{
        costo_toggle = false
        costo_input.innerHTML = ''
    }
}

function plazo_inp(){
    console.log('test');
    if (!plazo_toggle){
        console.log('test');
        plazo_toggle = true
        plazo_input.innerHTML = `
        <div class="flex p-2 justify-between">
            <label>Dias</label>
            <input type="number" name="days" value="{{ $project->dias }}">                        
        </div>                            
    `
    }else{
        plazo_toggle = false
        plazo_input.innerHTML = ''
    }
}