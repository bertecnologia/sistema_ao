function clique(e) {
	
	if(e) {
		if (e.charCode != null) {
			botao = e.charCode;
		} else if (e.keyCode != null) {
			botao = e.keyCode;
		} else if (e.which != null) {
			botao = e.which;
		}
		//console.log('botao'+botao);
		if (botao==2||botao==3) {
			oncontextmenu='return false';
		}
	}
}

document.onmousedown=clique
document.oncontextmenu = new Function("return false;")


function disableselect(e){
	return false
}
function reEnable(){
	return true
}/*
document.onselectstart=new Function ("return false")
if (window.sidebar){
	document.onmousedown=disableselect;
	document.onclick=reEnable;
}*/