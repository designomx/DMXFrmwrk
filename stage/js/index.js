$( "#btnSelecEstado" ).click(function() {
	if($( "#selectEstado" ).val()!=-1){
		//Funcion para revisar los SELECT del selector principal
		sessionStorage.setItem("estado",$( "#selectEstado" ).val());
	}else{
		alert("Debe seleccionar un estado");
		return false;
	}
});

// Listen for orientation changes
window.addEventListener("orientationchange", function() {
  // Announce the new orientation number
  location.reload();
}, false);

jQuery(document).ready(function(){

	$('.mobileSelect').hide();
	CargarAnuncio();
	cargarmas();
		$(".cargarmas").hide();
	var data={
		SelectDeEstados:"true"
	}
	jQuery.ajax({
		//dataType:"json",
		type: "POST",
		url: "listado.php",
		data: data
	})
    .done(function(data){
		jQuery("#SelectDeEstados").html(data);
    })
    .fail(function(data){
    	console.log(data);
    	window.location.href = "index.php";
    });

    jQuery('#slideshow').fadeSlideShow();

    //checkMobile();
    resize();
    if(localStorage.getItem("primeraVisitaEligeFacil") != "false"){
    	localStorage.setItem("primeraVisitaEligeFacil",false);
    	$('.videoYoutubeSponsor').remove();

    	$("#embed02")[0].src += "&autoplay=1";
    	//Siempre se abre el modal del video.
		$( "#modalVideoBienvenida" ).openModal({
			complete: function() { $('.lean-overlay').remove();$("#embed02").remove() } // Callback for Modal close
		});
    }
});

$(document.body).on('click touchend', ".btnServicioMobile", function () { 
	//console.log('btnServicioMobile');
	if($(this).hasClass('servicioSeleccionado')){
		$(this).removeClass('servicioSeleccionado');
		$(this).find('.check-plan-mobile').removeClass('checked-opt');
	}else{
		if($(this).hasClass('servicioCelular')){
			if($('.servicioSeleccionado').length==0){
				$(this).addClass('servicioSeleccionado');
				$(this).find('.check-plan-mobile').addClass('checked-opt');
			}else{
				//console.log('Lo sentimos, este servicio no se puede comparar con su selección actual.');
				$('#modalIncompatibles').openModal();
			}
		}
		if($(this).hasClass('servicioStreaming')){
			if($('.servicioSeleccionado').length==0){
				$(this).addClass('servicioSeleccionado');
				$(this).find('.check-plan-mobile').addClass('checked-opt');
			}else{
				//console.log('Lo sentimos, este servicio no se puede comparar con su selección actual.');
				$('#modalIncompatibles').openModal();
			}
		}
		if($(this).hasClass('triplePlay')){
			if($('.servicioCelular').hasClass('servicioSeleccionado') || $('.servicioStreaming').hasClass('servicioSeleccionado')){
				//console.log('Lo sentimos, este servicio no se puede comparar con su selección actual.');
				$('#modalIncompatibles').openModal();
			}else{
				$(this).addClass('servicioSeleccionado');
				$(this).find('.check-plan-mobile').addClass('checked-opt');
			}
		}
	}	
});

function CargarAnuncio(){
	if($('.AnuncioHomeDerecho').length){
		
		var data={
				CargarAnuncio:true,
				id_anuncio:3
			}
	
		jQuery.ajax({
			//dataType:"json",
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
	    	//$(".AnuncioDerechoHome").html("PruebaCargando")
			jQuery(".AnuncioHomeDerecho").append(data);
	    })
	    .fail(function(data){
	    	console.log(data);
	    	window.location.href = "index.php";
	    });
	    
	}
	if($('.AnuncioComparadorCentro').length){
		

		var data={
				CargarAnuncio:true,
				id_anuncio:5
			}
	
		jQuery.ajax({
			//dataType:"json",
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
	    	//$(".AnuncioDerechoHome").html("PruebaCargando")
			jQuery(".AnuncioComparadorCentro").append(data);
	    })
	    .fail(function(data){
	    	console.log(data);
	    	window.location.href = "index.php";
	    });
	    
	}
}

$( "#descubreBTN" ).click(function() {
	if (sessionStorage.getItem("estado") === null) {
		return false;
	}else{
		if((sessionStorage.getItem("ServicioCelular") === null || sessionStorage.getItem("ServicioCelular")==0) && (sessionStorage.getItem("ServicioInternet") === null || sessionStorage.getItem("ServicioInternet")==0) && (sessionStorage.getItem("ServicioTelefono") === null || sessionStorage.getItem("ServicioTelefono")==0) && (sessionStorage.getItem("ServicioTelevision") === null || sessionStorage.getItem("ServicioTelevision")==0) && (sessionStorage.getItem("ServicioStreaming") === null || sessionStorage.getItem("ServicioStreaming")==0)   ){
					return false;
		}else{
			
		}
	}

});
$("#btnBuscar").click(function(){
	var contador=0,celular=0,internet=0,telefono=0,television=0,streaming=0;
	if($("#celular").hasClass( "active-selection" ) || $('.servicioCelular').hasClass('servicioSeleccionado')){
		//alert("celular");
		celular=1;
		contador+=1;
		sessionStorage.setItem("ServicioCelular","1");			
	}else{
		sessionStorage.setItem("ServicioCelular","0");
	}
	if($("#internet").hasClass( "active-selection" ) || $('.servicioInternet').hasClass('servicioSeleccionado')){
		//alert("internet");
		internet=1;
		contador+=1;
		sessionStorage.setItem("ServicioInternet","1");	
	}else{
		sessionStorage.setItem("ServicioInternet","0");
	}
	if($("#telefono").hasClass( "active-selection" ) || $('.servicioTelefono').hasClass('servicioSeleccionado')){
		//alert("telefono");
		telefono=1;
		contador+=1;
		sessionStorage.setItem("ServicioTelefono","1");	
	}else{
		sessionStorage.setItem("ServicioTelefono","0");
	}
	if($("#television").hasClass( "active-selection" ) || $('.servicioTelevision').hasClass('servicioSeleccionado')){
		//alert("television");
		television=1;
		contador+=1;
		sessionStorage.setItem("ServicioTelevision","1");
	}else{
		sessionStorage.setItem("ServicioTelevision","0");
	}
	if($("#streaming").hasClass( "active-selection" ) || $('.servicioCelular').hasClass('servicioStreaming')){
		//alert("streaming");
		streaming=1;
		contador+=1;
		sessionStorage.setItem("ServicioStreaming","1");
	}else{
		sessionStorage.setItem("ServicioStreaming","0");
	}
	//Llamar directo a listado-comparador.php sin archivo de por medio (servicio)
	if(contador<1){
		//alert("Debe seleccionar al menos un tipo de servicio");
		$('#modalSinServicios').openModal();

		return false;
	}else{
		jQuery( "#btnBuscarHidden" ).trigger( "click" );
	}
});
function VerVideo(element,url,source){
	//alert("revisa videos")
	//console.log("verVideo: "+$(element).data("url"));
	//PostId
	var id=	$(element).data("id");
	//PostId
	var titulo=	$(element).data("titulo");
	if(source=="youtube"){
		//console.log("youtube");
		$('#contenedorVideo').html('<iframe width="853" height="480" src="'+url+'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>');
	}
	if(source=="vimeo"){
		//console.log("vimeo");
		$('#contenedorVideo').html('<iframe src="'+url+'" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
	}
	$('#videoModalFooter').html('<a href="http://www.eligefacil.com/blog/?p='+id+'" class="waves-effect btn-flat">Más</a>');
	$("#tituloVideo").html(titulo);
}
function cargarmas(){
	//console.log("cargar mas")
	//console.log($(".cargarmas").length);

	if($(".cargarmas").length<5){
		var j=$(".cargarmas").length;
	}else{
		var j=5;
	}
	var k=$(".planmostrado").length;
	//console.log(k);
	for(var i=k; i<k+j;i++){
		$("#cargarmas"+i).removeClass("cargarmas");
		$("#cargarmas"+i).addClass("planmostrado");
	}
	$(".planmostrado").show();
	if($(".cargarmas").length<1){
		$("#btnCargarMas").hide();
		//$( "#btnCargarMas" ).prop( "disabled", true );
	}else{
		$("#btnCargarMas").show();
	}
}
/*
$('#btnVerVideo2').on('click', function() {
	jQuery( "#btnVerVideo" ).trigger( "click" );
});
$('#btnVerVideo').on('click', function() {
		
});
*/
$("#RegistrarUsuario").submit(function(ev){
	ev.preventDefault();
	RegistrarUsuario();
})
function RegistrarUsuario(){
	var nombreUsuario=$( "#nombreUsuario" ).val();
	var emailUsuario=$( "#emailUsuario" ).val();
	console.log(nombreUsuario);
	console.log(emailUsuario);
	enviarCorreo(nombreUsuario,emailUsuario);
};

isMobile = false;
function checkMobile(){
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 	//$('.scroll-box1').scrollLeft(90);
	 	isMobile=true;
	 	$('.widget-wrapper').css('height','450px')
	 	$('.desktopSelect').hide();
	 	$('.mobileSelect').show();
	}else{
		isMobile=false;
		$('.mobileSelect').hide();
		$('.desktopSelect').show();
		$(".scroll-box1").mCustomScrollbar({
			axis: "x",
			theme: "minimal",
			updateOnContentResize: true
		});
	}
}

$( window ).resize(function() {
    resize();
})

function resize(){
	/*
	$.blockUI({ message: null }); 
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	*/
	var _wHght = $(window).width()
	if(_wHght<480){
		$('.widget-wrapper').css('height','450px')
	 	$('.desktopSelect').hide();
	 	$('.mobileSelect').show();
	 	//$('.slide-widget').css('top',$('#main-nav-bar').height());
	 	//$('#slideshow').css('top',$('#main-nav-bar').height());
	 	//$('#blog-module').css('top',$('#main-nav-bar').height());
	}else{
		//$('.widget-wrapper').css('height','360px')
		$('.mobileSelect').hide();
		$('.desktopSelect').show();
		$(".scroll-box1").mCustomScrollbar({
			axis: "x",
			theme: "minimal",
			updateOnContentResize: true
		});
	}
	 
	if($('#main-nav-bar').is(":visible") && /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)  && window.matchMedia("(orientation: landscape)").matches){
		$('.slide-widget').css('top',$('#main-nav-bar').height());
		$('#slideshow').css('top',$('#main-nav-bar').height());
		$('#blog-module').css('top',$('#main-nav-bar').height());
	}
	/*
 	window.setTimeout(function() {
		overlay.update({
			icon: "images/assets/check.png",
			text: "Listo"
		});
	}, 1000);
	window.setTimeout(function() {
		overlay.hide();
	}, 2000);
	setTimeout($.unblockUI, 1000);
	*/
}

function enviarCorreo(nombre,email){
  	console.log("function enviarCorreo nombre: "+nombre);
  	console.log("function enviarCorreo email: "+email);
  	console.log("Enviando correo..");
  	$.blockUI({ message: null }); 
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	var nombre_enviar=nombre;
	var email_enviar=email;
	var data={
			nombre:nombre_enviar,
			email:email_enviar
		}
	jQuery.ajax({
		//dataType:"json",
		type: "POST",
		url: "register.php",
		data: data
	})
    .done(function(data){
    	console.log(data)
    	if(data==true){
    		//console.log(data)
    		//alert("true");
    		alert("!Hemos envíado a tu correo un enlace para acceder al sitio!");
    		$( "#nombreUsuario" ).val("");
			$( "#emailUsuario" ).val("");
    		window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "Listo revisa tu correo!"
				});
			}, 1000);
			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			setTimeout($.unblockUI, 3000);

    	}else{
    		if(data=="duplicado"){
    			alert("Correo ya registrado, se reenvío enlace");
    			$( "#nombreUsuario" ).val("");
				$( "#emailUsuario" ).val("");
				//console.log(data);
	    		//alert("false");
	    		window.setTimeout(function() {
					overlay.update({
						icon: "images/assets/check.png",
						text: "Listo"
					});
				}, 1000);
				window.setTimeout(function() {
					overlay.hide();
				}, 2000);
				setTimeout($.unblockUI, 3000);
    		}else{
    			if(data=="error"){
	    			//alert("Correo ya registrado, se reenvío enlace");
	    			$( "#nombreUsuario" ).val("");
					$( "#emailUsuario" ).val("");
					//console.log(data);
		    		//alert("false");
		    		window.setTimeout(function() {
						overlay.update({
							icon: "images/assets/cross.png",
							text: "Error en DB"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);
				}else{
					//console.log(data);
		    		//alert("false");
		    		window.setTimeout(function() {
						overlay.update({
							icon: "images/assets/cross.png",
							text: "Error"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);
				}
			}
    	}
    	//console.log(data)
    })
    .fail(function(data){
    	console.log(data);
    	//window.location.href = "indexBE.php";
    });
}
