jQuery(document).ready(function(){
	CargarAnuncio();
 	$.when(
		CargarEstados(),
		VerificarServicios(),
		Seleccion()
	
	).then(function(){
	   //alert('All AJAX Methods Have Completed!');
	   localStorage.setItem("CargaInicial", "0");
	   CargarPlanes();
	});
});//document ready

function botones(){
	jQuery( "#planes #verPlan" ).click(function() {
		var id_plan=$(this).data("value");
		jQuery("#ContenidoModal").empty();
		var url = "#deatilsModal";
		//window.location('#deatilsModal');
		if(localStorage.getItem("ServicioStreaming")==1){
			var data={
				verDetallesStreaming:"true",
				id_paquete:id_plan
			}
		}else{
			var data={
				verDetalles:"true",
				id_plan:id_plan
			}	
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
			$("#ContenidoModal").html(data);

			if($('#ContenidoModal table').length) {
		        $('#ContenidoModal table').addClass('responsive-table striped');
		    }
	    })
	    .fail(function(data){
	    	console.log(data);
	    });
	})
}
jQuery( "#btnComparar" ).click(function() {
	if($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null){
		alert("Debe seleccionar más de un plan para comparar");
	}else{
		jQuery("#owl-demo").empty();
		$("#owl-demo").data('owlCarousel').destroy();
		$(".span-bx-selected").each(function() {
		    // ...
		    //.empty()
		    //.append()
		    //$(this).attr(value);
		    //alert($(this).attr("value"))
		    if(localStorage.getItem("ServicioStreaming")==1){
		    	var data=	{
					CompararPaqueteOTT:true,
					id_paquete:$(this).attr("value")
				}
		    }else{
		    	var data=	{
					CompararPlanes:true,
					id_plan:$(this).attr("value")
				}
		    }
		    
			//CargarPlanes();
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				data: data
			})
		    .done(function(data){
				jQuery("#owl-demo").append(data);
				//botones();
		    })
		   
		});

		$('#modal-comparador').show(function(){
			if($(".item").length>0){
				if($(".item").length=1){
					var primero=1,
						segundo=1,
						tercero=1
				}
				if($(".item").length=2){
					var primero=2,
						segundo=2,
						tercero=2
				}
				if($(".item").length>2){
					var primero=3,
						segundo=3,
						tercero=2
				}
				$("#owl-demo").owlCarousel({
		  		  	items : primero,
		  		  	itemsDesktop : [980,segundo],
		  		  	itemsDesktopSmall : [980,tercero],
		  		  	itemsTablet: [768,1],
		  			navigation: true,
		  			mouseDrag: false,
		  			touchDrag: false,
		  			navigationText: [
		  			  "<i class='material-icons'>navigate_before</i>",
		  			  "<i class='material-icons'>navigate_next</i>"
		  			  ],
		  			beforeInit : function(elem){
		  			  //Parameter elem pointing to $("#owl-demo")
		  			}
				});
			}
		}).animate({
		    top: 0
		},1000);
	}
})

//$.noConflict();
jQuery(function() {
	
		FRMWRK.main.init();
		FRMWRK.comparador.init();
		function random(owlSelector){
			owlSelector.children().sort(function(){
				return Math.round(Math.random()) - 0.5;
			}).each(function(){
			  $(this).appendTo(owlSelector);
			});
		  }
		 $("#owl-demo").owlCarousel({
		  	items : 3,
		  	itemsDesktop : [980,3],
		  	itemsDesktopSmall : [980,2],
		  	itemsTablet: [768,1],
			navigation: true,
			mouseDrag: false,
			touchDrag: false,
			navigationText: [
			  "<i class='material-icons'>navigate_before</i>",
			  "<i class='material-icons'>navigate_next</i>"
			  ],
			beforeInit : function(elem){
			  //Parameter elem pointing to $("#owl-demo")
			}
	});
	});

	function CargarPlanesConFiltros(){
		//alert("Comparar!");
		//Funcion para revisar los SELECT del selector principal
		var celular=0,internet=0,telefono=0,television=0,streaming=0;
		if(jQuery("#celular").hasClass( "active-selection" )){
			celular=1;
			localStorage.setItem("ServicioCelular","1");			
		}else{
			localStorage.setItem("ServicioCelular","0");
		}
		if(jQuery("#internet").hasClass( "active-selection" )){
			internet=1;
			localStorage.setItem("ServicioInternet","1");	
		}else{
			localStorage.setItem("ServicioInternet","0");
		}
		if(jQuery("#telefono").hasClass( "active-selection" )){
			telefono=1;
			localStorage.setItem("ServicioTelefono","1");	
		}else{
			localStorage.setItem("ServicioTelefono","0");
		}
		if(jQuery("#television").hasClass( "active-selection" )){
			television=1;
			localStorage.setItem("ServicioTelevision","1");
		}else{
			localStorage.setItem("ServicioTelevision","0");
		}
		if(jQuery("#streaming").hasClass( "active-selection" )){
			streaming=1;
			localStorage.setItem("ServicioStreaming","1");
		}else{
			localStorage.setItem("ServicioStreaming","0");
		}
		if(localStorage.getItem("ServicioStreaming")==1){
			var Filtros = [];
			var getFiltrosCheckEmpresasStreaming=JSON.parse(localStorage.getItem("filtrosCheckEmpresasStreaming"));
			var get1 = window["slidertest"]["noUiSlider"]["get"]();
			newFiltro = {};
    		newFiltro['tipo'] = 'precio';
    		newFiltro['Maximo'] = get1[1];
    		newFiltro['Minimo'] = get1[0];
    		Filtros.push(JSON.stringify(newFiltro));
    		if (!(getFiltrosCheckEmpresasStreaming === null) )
			{	
				jQuery.each(getFiltrosCheckEmpresasStreaming, function( index, value ) {
					var temp='#'+value.value;
					if (jQuery(temp).is(":checked"))
					{
						newFiltro = {};
	        			newFiltro['tipo'] = 'checkEmpresas';
	        			newFiltro["empresa"] = value.empresa;	
		        		Filtros.push(JSON.stringify(newFiltro));						
					}
				});
			}
			if($('#ordenAscDesc').is(':checked')){
				var orden="ASC";
			}else{
				var orden="DESC";
			}
			var data=	{
					'Streamingfiltros[]':Filtros,
					orden:orden
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				data: data
			})
		    .done(function(data){
				jQuery("#planes").html(data);
				botones();
				VaciarComparador()
				jQuery('.modal-trigger').leanModal();
		    })
		}else{
			var getFiltros= JSON.parse(localStorage.getItem("filtros"));
			var getFiltrosCheck= JSON.parse(localStorage.getItem("filtrosCheck"));
			var getFiltrosCheckEmpresas=JSON.parse(localStorage.getItem("filtrosCheckEmpresas"));
			var Filtros = [];
			var get1 = window["slidertest"]["noUiSlider"]["get"]();
			newFiltro = {};
    		newFiltro['tipo'] = 'precio';
    		newFiltro['Maximo'] = get1[1];
    		newFiltro['Minimo'] = get1[0];
    		Filtros.push(JSON.stringify(newFiltro));
    		if (!(getFiltros === null))
			{
			    jQuery.each(getFiltros, function( index, value ) {
				var sliderActual=value.value;
				var get1 = window[value.value]["noUiSlider"]["get"]();
				newFiltro = {};
        		newFiltro['tipo'] = 'slider';
        		newFiltro["id_tipoDato"] = value.id_tipoDato;
        		newFiltro['Mayor'] = get1[1];
        		newFiltro['Menor'] = get1[0];
        		Filtros.push(JSON.stringify(newFiltro));				
				});
			}
			
			if (!(getFiltrosCheck === null) )
			{
				jQuery.each(getFiltrosCheck, function( index, value ) {
					var temp='#'+value.value;
					if (jQuery(temp).is(":checked"))
					{
						newFiltro = {};
	        			newFiltro['tipo'] = 'check';
	        			newFiltro["id_tipoDato"] = value.id_tipoDato;	
		        		Filtros.push(JSON.stringify(newFiltro));						
					}
				});
			}

			if (!(getFiltrosCheckEmpresas === null) )
			{	
				jQuery.each(getFiltrosCheckEmpresas, function( index, value ) {
					var temp='#'+value.value;
					if (jQuery(temp).is(":checked"))
					{
						newFiltro = {};
	        			newFiltro['tipo'] = 'checkEmpresas';
	        			newFiltro["empresa"] = value.empresa;	
		        		Filtros.push(JSON.stringify(newFiltro));						
					}
				});
			}
			if($('#ordenAscDesc').is(':checked')){
				var orden="ASC";
			}else{
				var orden="DESC";
			}
			var data=	{
					'filtros[]':Filtros,
					celular:localStorage.getItem("ServicioCelular"),
					internet:localStorage.getItem("ServicioInternet"),
					telefono:localStorage.getItem("ServicioTelefono"),
					television:localStorage.getItem("ServicioTelevision"),
					streaming:localStorage.getItem("ServicioStreaming"),
					estado:$( "#selectEstado" ).val(),
					orden:orden
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				data: data
			})
		    .done(function(data){
				jQuery("#planes").html(data);
				botones();
				VaciarComparador()
				jQuery('.modal-trigger').leanModal();
		    })
		}
	}
function habilitar(item,value) {

	if(value==true)
	{	
		// habilitamos
	    var id=$(item).attr("id");
		if (window["document"]["getElementsByClassName"](id)){
			if($('#checkbox1').is(':checked')){
		    	$('input.checkbox1').removeAttr("disabled");
			}
    	}
	}else if(value==false){
		if (window["document"]["getElementsByClassName"](id)){
	    	if(!$('#checkbox1').is(':checked')){
		    	$( "input.checkbox1" ).prop( "checked", false );
		    	$('input.checkbox1').attr("disabled", true);
		    }
	    }
	}
	CargarPlanesConFiltros();
}

$("#ordenAscDesc").change(function(){
	CargarPlanesConFiltros();
})
 
$("#SelectDeEstados").change(function(){
	localStorage.setItem("estado",$( "#selectEstado" ).val());	
	$.when(
		CargarFiltrosCheckEmpresas(),
		CargarFiltrosCheck(),
		CargarFiltrosSliders()
	).then(function(){
	   CargarPlanes();
	});
})

jQuery('.products-box').click(function() {
	var celular=0,internet=0,telefono=0,television=0,streaming=0;
	var contador=0;
	localStorage.removeItem("filtros");
	localStorage.removeItem("filtrosCheck");
	localStorage.removeItem("filtrosCheckEmpresas");
	if(jQuery("#celular").hasClass( "active-selection" )){
		celular=1;
		contador+=1;
		localStorage.setItem("ServicioCelular","1");
	}else{
		localStorage.setItem("ServicioCelular","0");
	}
	if(jQuery("#internet").hasClass( "active-selection" )){
		internet=1;
		contador+=1;
		localStorage.setItem("ServicioInternet","1");	
	}else{
		localStorage.setItem("ServicioInternet","0");
	}
	if(jQuery("#telefono").hasClass( "active-selection" )){
		telefono=1;
		contador+=1;
		localStorage.setItem("ServicioTelefono","1");
	}else{
		localStorage.setItem("ServicioTelefono","0");
	}
	if(jQuery("#television").hasClass( "active-selection" )){
		television=1;
		contador+=1;
		localStorage.setItem("ServicioTelevision","1");
	}else{
		localStorage.setItem("ServicioTelevision","0");
	}
	if(jQuery("#streaming").hasClass( "active-selection" )){
		contador+=1;
		localStorage.setItem("ServicioStreaming","1");
	}else{
		localStorage.setItem("ServicioStreaming","0");
	}

	var celular=localStorage.getItem("ServicioCelular");
    var telefono=localStorage.getItem("ServicioTelefono");
    var internet=localStorage.getItem("ServicioInternet");
    var television=localStorage.getItem("ServicioTelevision");
    var streaming=localStorage.getItem("ServicioStreaming");
	if(localStorage.getItem("ServicioStreaming")==1){
		$( "#selectEstado" ).prop('disabled', 'disabled');
	}else{
		$( "#selectEstado" ).removeAttr("disabled");
	}
	if(contador>0){
	    CargarPlanes();
		CargarFiltrosCheckEmpresas();
		CargarFiltrosCheck();
		CargarFiltrosSliders();
	}
});

function CargarPlanes(){
	if($('#ordenAscDesc').is(':checked')){
		var orden="ASC";
	}else{
		var orden="DESC";
	}
	if(localStorage.getItem("ServicioStreaming")==1){
		//alert("Streaming");
		var data={
			CargarPlanesStreaming:"true",
			orden:orden
		}
	}else{
		var data={
			listadoSimple:"true",
			CargarPlanes:"true",
			celular:localStorage.getItem("ServicioCelular"),
			internet:localStorage.getItem("ServicioInternet"),
			telefono:localStorage.getItem("ServicioTelefono"),
			television:localStorage.getItem("ServicioTelevision"),
			streaming:localStorage.getItem("ServicioStreaming"),
			estado:$( "#selectEstado" ).val(),
			orden:orden
		}
	}
	jQuery.ajax({
		type: "POST",
		url: "listado.php",
		data: data
	})
    .done(function(data){
		jQuery("#planes").html(data);
		botones();
		VaciarComparador()
		jQuery('.modal-trigger').leanModal();
    })
    .fail(function(data){
    	console.log(data);
    	window.location.href = "indexBE.php";
    });
}

function CargarFiltrosSliders(){
	if(localStorage.getItem("ServicioStreaming")==1){
		var data={
			CargarSliderStreaming:"true"
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
			jQuery("#filtros").html(data);
			var _widthSlides = 0;
	 		jQuery('.sliders-wrapp .slider-bx').each(function() {
	 		    _widthSlides += jQuery(this).outerWidth( true );
	 		});
	 		jQuery('.sliders-wrapp').css('width', _widthSlides);
	 	
	 		if (isMobile.any == false) {
	 			jQuery(".sliders-scroll-bx").mCustomScrollbar({
					axis: "x",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				jQuery(".checks-scroll-bx form").mCustomScrollbar({
					axis: "y",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				$(".slide-bar-bx").mouseup(function() {
				    CargarPlanesConFiltros();
				})
	 		}else {
	 			jQuery(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
	 		}

	    })
	    .fail(function(data){
	    	console.log(data);
	    	console.log("Error llamada en llamada Streaming a CargarFiltrosSliders");
	    });
	}else{
		var data={
			listadoSimple:"true",
			CargarFiltrosSliders:"true",
			celular:localStorage.getItem("ServicioCelular"),
			internet:localStorage.getItem("ServicioInternet"),
			telefono:localStorage.getItem("ServicioTelefono"),
			television:localStorage.getItem("ServicioTelevision"),
			streaming:localStorage.getItem("ServicioStreaming"),
			estado:$( "#selectEstado" ).val()
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
			jQuery("#filtros").html(data);
			var _widthSlides = 0;
	 		jQuery('.sliders-wrapp .slider-bx').each(function() {
	 		    _widthSlides += jQuery(this).outerWidth( true );
	 		});
	 		jQuery('.sliders-wrapp').css('width', _widthSlides);
	 	
	 		if (isMobile.any == false) {
	 			jQuery(".sliders-scroll-bx").mCustomScrollbar({
					axis: "x",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				jQuery(".checks-scroll-bx form").mCustomScrollbar({
					axis: "y",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				$(".slide-bar-bx").mouseup(function() {
				    CargarPlanesConFiltros();
				})
	 		}else {
	 			jQuery(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
	 		}

	    })
	    .fail(function(data){
	    	console.log(data);
	    	console.log("Error llamada en llamada cargo CargarFiltrosSliders");
	    });
	}
}

function CargarFiltrosCheck(){
	if(localStorage.getItem("ServicioStreaming")!=1){
		var data={
			listadoSimple:"true",
			CargarFiltrosCheck:"true",
			celular:localStorage.getItem("ServicioCelular"),
			internet:localStorage.getItem("ServicioInternet"),
			telefono:localStorage.getItem("ServicioTelefono"),
			television:localStorage.getItem("ServicioTelevision"),
			streaming:localStorage.getItem("ServicioStreaming"),
			estado:$( "#selectEstado" ).val()
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
			jQuery("#filtrosCheck").html(data);
			if(document.getElementsByClassName("input.checkbox1")){
				$('input.checkbox1').attr("disabled", true);
			}
	    })
	    .fail(function(data){
	    	console.log(data);
	    });
	}
}
function CargarFiltrosCheckEmpresas(){
	if(localStorage.getItem("ServicioStreaming")==1){
		var data={
			CargarFiltrosCheckEmpresasStreaming:"true"
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
			jQuery("#filtrosCheckEmpresas").html(data);

	    })
	    .fail(function(data){
	    	console.log(data);
	    });

	}else{
		var data={
			listadoSimple:"true",
			CargarFiltrosCheckEmpresas:"true",
			celular:localStorage.getItem("ServicioCelular"),
			internet:localStorage.getItem("ServicioInternet"),
			telefono:localStorage.getItem("ServicioTelefono"),
			television:localStorage.getItem("ServicioTelevision"),
			streaming:localStorage.getItem("ServicioStreaming"),
			estado:$( "#selectEstado" ).val()
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data
		})
	    .done(function(data){
			jQuery("#filtrosCheckEmpresas").html(data);

	    })
	    .fail(function(data){
	    	console.log(data);
	    });
  	}
}
function VerificarServicios(){
    var celular=localStorage.getItem("ServicioCelular");
    var telefono=localStorage.getItem("ServicioTelefono");
    var internet=localStorage.getItem("ServicioInternet");
    var television=localStorage.getItem("ServicioTelevision");
    var streaming=localStorage.getItem("ServicioStreaming");
    if(celular=="1"){
    	jQuery( "#celular, .cellplan" ).trigger( "click" );
    }
    if(telefono=="1"){
    	jQuery( "#telefono" ).trigger( "click" );
    }
    if(internet=="1"){
    	jQuery( "#internet, .tripleplay3" ).trigger( "click" );
    }
    if(television=="1"){
    	jQuery( "#television, .tripleplay2" ).trigger( "click" );
    }
    if(streaming=="1"){
    	jQuery( "#streaming, .streaming" ).trigger( "click" );
    }
    localStorage.setItem("CargaInicial", "1");

}

function Seleccion(){
	var CargaInicial= localStorage.getItem("CargaInicial");
	var celular=0,internet=0,telefono=0,television=0,streaming=0;
	var contador=0;
	if (CargaInicial == 1)
	{

			if(jQuery("#celular").hasClass( "active-selection" )){
				celular=1;
				contador+=1;
				localStorage.setItem("ServicioCelular","1");
			}else{
				localStorage.setItem("ServicioCelular","0");
			}
			if(jQuery("#internet").hasClass( "active-selection" )){
				internet=1;
				contador+=1;
				localStorage.setItem("ServicioInternet","1");	
			}else{
				localStorage.setItem("ServicioInternet","0");
			}
			if(jQuery("#telefono").hasClass( "active-selection" )){
				telefono=1;
				contador+=1;
				localStorage.setItem("ServicioTelefono","1");
			}else{
				localStorage.setItem("ServicioTelefono","0");
			}
			if(jQuery("#television").hasClass( "active-selection" )){
				television=1;
				contador+=1;
				localStorage.setItem("ServicioTelevision","1");
			}else{
				localStorage.setItem("ServicioTelevision","0");
			}
			if(jQuery("#streaming").hasClass( "active-selection" )){
				contador+=1;
				localStorage.setItem("ServicioStreaming","1");
			}else{
				localStorage.setItem("ServicioStreaming","0");
			}


			CargarFiltrosSliders();
			CargarFiltrosCheck();
			CargarFiltrosCheckEmpresas();
			VaciarComparador();
	}
}
function CargarEstados(){
	var data={
		SelectDeEstados:"true",
		estado:localStorage.getItem("estado")
	}
	jQuery.ajax({
		type: "POST",
		url: "listado.php",
		data: data
	})
    .done(function(data){
		jQuery("#SelectDeEstados").html(data);
    })
    .fail(function(data){
    	console.log(data);
    	//window.location.href = "indexBE.php";
    });
}
function VaciarComparador(){
	var VaciarComparador='<i class="material-icons">done</i>';
	$( "#span-bx1" ).html(VaciarComparador);
	$( "#span-bx1" ).removeClass( "slctd-plan" );
	$( "#span-bx1" ).removeClass( "span-bx-selected" );
	$( "#span-bx1" ).removeClass( "slctd-plan" );
	$( "#span-bx2" ).html(VaciarComparador);
	$( "#span-bx2" ).removeClass( "slctd-plan" );
	$( "#span-bx2" ).removeClass( "span-bx-selected" );
	$( "#span-bx2" ).removeClass( "slctd-plan" );
	$( "#span-bx3" ).html(VaciarComparador);
	$( "#span-bx3" ).removeClass( "slctd-plan" );
	$( "#span-bx3" ).removeClass( "span-bx-selected" );
	$( "#span-bx3" ).removeClass( "slctd-plan" );
	$( "#span-bx4" ).html(VaciarComparador);
	$( "#span-bx4" ).removeClass( "slctd-plan" );
	$( "#span-bx4" ).removeClass( "span-bx-selected" );
	$( "#span-bx4" ).removeClass( "slctd-plan" );
	$( "#span-bx5" ).html(VaciarComparador);
	$( "#span-bx5" ).removeClass( "slctd-plan" );
	$( "#span-bx5" ).removeClass( "span-bx-selected" );
	$( "#span-bx5" ).removeClass( "slctd-plan" );
	$( "#span-bx6" ).html(VaciarComparador);
	$( "#span-bx6" ).removeClass( "slctd-plan" );
	$( "#span-bx6" ).removeClass( "span-bx-selected" );
	$( "#span-bx6" ).removeClass( "slctd-plan" );
}
function Comparar(item,id_plan,color){
	var plan="#plan_"+id_plan;
	var itemid="'"+item.id+"'";
	if($(".span-bx-selected").length<6 || $(".span-bx-selected").length==null){
		if($( "#"+item.id ).hasClass( "slctd-plan" )){
			var VaciarComparador='<i class="material-icons">done</i>';
			$("."+item.id).html(VaciarComparador);
			$( "#" + item.id ).removeClass( "slctd-plan" );
			$( "." + item.id ).removeClass( "span-bx-selected" );
			$( "." + item.id ).removeClass( "slctd-plan" );
			$( "." + item.id ).removeClass( item.id );
		}else{
			$("#"+ item.id ).addClass( "slctd-plan" );
			if(!$( "#span-bx1" ).hasClass( "slctd-plan" )){
				var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx1" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
				$("#span-bx1" ).addClass( "slctd-plan" );
				$("#span-bx1" ).addClass( "span-bx-selected" );
				$("#span-bx1" ).addClass( item.id );
				$("#span-bx1" ).attr("value",id_plan);
				$("#span-bx1").html(planSeleccionado);
			}else{
				if(!$( "#span-bx2" ).hasClass( "slctd-plan" )){
					var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx2" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
					$("#span-bx2" ).addClass( "slctd-plan" );
					$("#span-bx2" ).addClass( "span-bx-selected" );
					$("#span-bx2" ).addClass( item.id );
					$("#span-bx2" ).attr("value",id_plan);
					$("#span-bx2").html(planSeleccionado);
				}else{
					if(!$( "#span-bx3" ).hasClass( "slctd-plan" )){
						var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx3" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
						$("#span-bx3" ).addClass( "slctd-plan" );
						$("#span-bx3" ).addClass( "span-bx-selected" );
						$("#span-bx3" ).addClass( item.id );
						$("#span-bx3" ).attr("value",id_plan);
						$("#span-bx3").html(planSeleccionado);
					}else{
						if(!$( "#span-bx4" ).hasClass( "slctd-plan" )){
							var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx4" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
							$("#span-bx4" ).addClass( "slctd-plan" );
							$("#span-bx4" ).addClass( "span-bx-selected" );
							$("#span-bx4" ).addClass( item.id );
							$("#span-bx4" ).attr("value",id_plan);
							$("#span-bx4").html(planSeleccionado);
						}else{
							if(!$( "#span-bx5" ).hasClass( "slctd-plan" )){
								var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx5" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
								$("#span-bx5" ).addClass( "slctd-plan" );
								$("#span-bx5" ).addClass( "span-bx-selected" );	
								$("#span-bx5" ).addClass( item.id );
								$("#span-bx5" ).attr("value",id_plan);			
								$("#span-bx5").html(planSeleccionado);
							}else{
								if(!$("#span-bx6" ).hasClass( "slctd-plan" )){
									var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx6" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
									$("#span-bx6" ).addClass( "slctd-plan" );
									$("#span-bx6" ).addClass( "span-bx-selected" );
									$("#span-bx6" ).addClass( item.id );
									$("#span-bx6" ).attr("value",id_plan);
									$("#span-bx6").html(planSeleccionado);
								}
							}
						}
					}
				}
			}
		}
	}else{
		alert("Debe seleccionar máximo 6 planes para comparar");
	}
}
function RemoverSeleccionado(item,plan){
	var VaciarComparador='<i class="material-icons">done</i>';
	$("#"+item.id).html(VaciarComparador);
	$("#"+item.id ).removeClass( "slctd-plan" );
	$("#"+item.id ).removeClass( "span-bx-selected" );
	$("#"+ plan ).removeClass( "slctd-plan" );	
}

function CompararPaqueteOTT(item,id_plan){
	var plan="#plan_"+id_plan;
	var itemid="'"+item.id+"'";
	var color="#000";
	if($(".span-bx-selected").length<6 || $(".span-bx-selected").length==null){
		if($( "#"+item.id ).hasClass( "slctd-plan" )){
			var VaciarComparador='<i class="material-icons">done</i>';
			$("."+item.id).html(VaciarComparador);
			$( "#" + item.id ).removeClass( "slctd-plan" );
			$( "." + item.id ).removeClass( "span-bx-selected" );
			$( "." + item.id ).removeClass( "slctd-plan" );
			$( "." + item.id ).removeClass( item.id );
		}else{
			$("#"+ item.id ).addClass( "slctd-plan" );
			if(!$( "#span-bx1" ).hasClass( "slctd-plan" )){
				var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx1" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
				$("#span-bx1" ).addClass( "slctd-plan" );
				$("#span-bx1" ).addClass( "span-bx-selected" );
				$("#span-bx1" ).addClass( item.id );
				$("#span-bx1" ).attr("value",id_plan);
				$("#span-bx1").html(planSeleccionado);
			}else{
				if(!$( "#span-bx2" ).hasClass( "slctd-plan" )){
					var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx2" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
					$("#span-bx2" ).addClass( "slctd-plan" );
					$("#span-bx2" ).addClass( "span-bx-selected" );
					$("#span-bx2" ).addClass( item.id );
					$("#span-bx2" ).attr("value",id_plan);
					$("#span-bx2").html(planSeleccionado);
				}else{
					if(!$( "#span-bx3" ).hasClass( "slctd-plan" )){
						var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx3" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
						$("#span-bx3" ).addClass( "slctd-plan" );
						$("#span-bx3" ).addClass( "span-bx-selected" );
						$("#span-bx3" ).addClass( item.id );
						$("#span-bx3" ).attr("value",id_plan);
						$("#span-bx3").html(planSeleccionado);
					}else{
						if(!$( "#span-bx4" ).hasClass( "slctd-plan" )){
							var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx4" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
							$("#span-bx4" ).addClass( "slctd-plan" );
							$("#span-bx4" ).addClass( "span-bx-selected" );
							$("#span-bx4" ).addClass( item.id );
							$("#span-bx4" ).attr("value",id_plan);
							$("#span-bx4").html(planSeleccionado);
						}else{
							if(!$( "#span-bx5" ).hasClass( "slctd-plan" )){
								var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx5" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
								$("#span-bx5" ).addClass( "slctd-plan" );
								$("#span-bx5" ).addClass( "span-bx-selected" );	
								$("#span-bx5" ).addClass( item.id );
								$("#span-bx5" ).attr("value",id_plan);			
								$("#span-bx5").html(planSeleccionado);
							}else{
								if(!$("#span-bx6" ).hasClass( "slctd-plan" )){
									var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx6" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
									$("#span-bx6" ).addClass( "slctd-plan" );
									$("#span-bx6" ).addClass( "span-bx-selected" );
									$("#span-bx6" ).addClass( item.id );
									$("#span-bx6" ).attr("value",id_plan);
									$("#span-bx6").html(planSeleccionado);
								}
							}
						}
					}
				}
			}
		}
	}else{
		alert("Debe seleccionar máximo 6 planes para comparar");
	}
}
function CargarAnuncio(){
	if($('.AnuncioHomeDerecho').length>0){
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
	    	//window.location.href = "indexBE.php";
	    });
	}
	if($('.AnuncioComparadorCentro').length>0){
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
	    	//window.location.href = "indexBE.php";
	    });
	}
}
