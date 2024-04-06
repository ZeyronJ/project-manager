let deldir_btn = document.getElementById('deldir_btn')
let del_btns = document.getElementsByClassName('deleteFile')

deldir_btn.addEventListener('click',eliminar)

function eliminar(){
    Array.from(del_btns).forEach(e => {
        if(e.hidden == true){
            e.hidden = false
        }else{
            e.hidden = true
        }
    });
}