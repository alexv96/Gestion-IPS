function mostrarRegistro(element){
    if (element == document.getElementById('empresa')) {
        document.getElementById("empresaForm").style.display = "block";
		document.getElementById("cliente").style.display = "none";
    } else {
        document.getElementById("empresaForm").style.display = "none";
		document.getElementById("cliente").style.display = "block";
    }

    
}