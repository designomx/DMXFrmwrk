$('.modal-trigger').leanModal({
	ready: function() {
        if($(".lean-overlay").length > 1) {
            $(".lean-overlay:not(:first)").each(function() {
                $(this).remove();
                $('body').removeAttr("style");
            });
        }
    },
    complete: function() {
        $(".lean-overlay").each(function() {
            $(this).remove();
        });
    }		
});

jQuery(document.body).on('click', "#planes #verPlan", function () { 
	var id_plan=$(this).data("value");
	jQuery("#ContenidoModal").empty();
	var url = "#deatilsModal";
	if(sessionStorage.getItem("ServicioStreaming")==1){
		$( "#selectEstado" ).prop('disabled', 'disabled');
		var data={
			verDetallesStreaming:"true",
			id_paquete:id_plan,
			async:false
		}
	}else{
		$( "#selectEstado" ).removeAttr("disabled");
		if(sessionStorage.getItem("ServicioCelular")==1){
			var data={
				estado:sessionStorage.getItem("estado"),
				celular:"1",
				verDetalles:"true",
				id_plan:id_plan,
				async:false
			}	
		}else{
			var data={
				estado:sessionStorage.getItem("estado"),
				telefono:sessionStorage.getItem("ServicioTelefono"),
				internet:sessionStorage.getItem("ServicioInternet"),
				television:sessionStorage.getItem("ServicioTelevision"),
				verDetalles:"true",
				id_plan:id_plan,
				async:false
			}	
		}
	}
	jQuery.ajax({
		type: "POST",
		url: "listado.php",
		async : false,
		data: data,
	})
    .done(function(data){
        var json = $.parseJSON(data);
		jQuery("#ContenidoModal").html(json.contenido);
		jQuery("#footerBotonesModal").html(json.footer);
		$('#deatilsModal').openModal({
			ready: function() {
		        if($(".lean-overlay").length > 1) {
		            $(".lean-overlay:not(:first)").each(function() {
		                $(this).remove();
		            });
		        }
		    },
		    complete: function() {
		        $(".lean-overlay").each(function() {
		            $(this).remove();
		        });
		        if($('#MeGustariaContratar').prop('checked')){
		        	MeGustariaContratar($('#MeGustariaContratar').attr("data-idPlan"));
		        }
		    }		
		});
		if($('#ContenidoModal table').length) {
	        $('#ContenidoModal table').addClass('responsive-table striped');
	    }
     	$('.acordionEquipos').collapsible({
	      	accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
	    });
    })
    .fail(function(data){
    	console.log(data);
    });
});

jQuery(document.body).on('click', "#btnComparar", function () { 
	if($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null){
		alert("Debe seleccionar más de un plan para comparar");
	}else{
		jQuery("#owl-demo").empty();
		$("#owl-demo").data('owlCarousel').destroy();
		var i=0;
		$(".span-bx-selected").each(function() {
		    // ...
		    //.empty()
		    //.append()
		    //$(this).attr(value);
		    //alert($(this).attr("value"))
		    if(sessionStorage.getItem("ServicioStreaming")==1){
		    	$( "#selectEstado" ).prop('disabled', 'disabled');
		    	var data=	{
					CompararPaqueteOTT:true,
					id_paquete:$(this).attr("value"),
					num_plan_comp:i
				}
		    }else{
		    	$( "#selectEstado" ).removeAttr("disabled");
		    	var data=	{
					CompararPlanes:true,
					id_plan:$(this).attr("value"),
					num_plan_comp:i,
					estado:$( "#selectEstado" ).val()

				}
		    }					    
			//CargarPlanes();
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				async : false,
				data: data
			})
		    .done(function(data){
		    	//console.log(data);
				jQuery("#owl-demo").append(data);
				$(".paq-comparado0").scroll(function(){
                	$(".paq-comparado").scrollTop($(".paq-comparado0").scrollTop());
                });
                $(".paq-comparado1").scroll(function(){
                	$(".paq-comparado").scrollTop($(".paq-comparado1").scrollTop());
                });
                $(".paq-comparado2").scroll(function(){
                	$(".paq-comparado").scrollTop($(".paq-comparado2").scrollTop());
                });
                $(".paq-comparado3").scroll(function(){
                	$(".paq-comparado").scrollTop($(".paq-comparado3").scrollTop());
                });
                $(".paq-comparado4").scroll(function(){
                	$(".paq-comparado").scrollTop($(".paq-comparado4").scrollTop());
                });
                $(".paq-comparado5").scroll(function(){
                	$(".paq-comparado").scrollTop($(".paq-comparado5").scrollTop());
                });
		    })
			i+=1;
		});
		$('#modal-comparador').show(function(){
			if($(".item").length>0){
				if($(".item").length=1){
					var primero=1,
						segundo=1,
						tercero=1
				}
				if($(".item").length==2){
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
		$('.delAtributo').each(function(){
        	//console.log($(this).attr('data-dato'));
        	if($('.delAtributo.atributo'+$(this).attr('data-dato')).length == $(".item").length){
        		$(this).hide();
        	}else{
        		$(this).show();
        	}
        })
	}
	$('.modal-trigger').leanModal({
		ready: function() {
	        if($(".lean-overlay").length > 1) {
	            $(".lean-overlay:not(:first)").each(function() {
	                $(this).remove();
	            });
	        }
	    },
	    complete: function() {
	        $(".lean-overlay").each(function() {
	            $(this).remove();
	        });
	    }			
	});
})

function eliminarDelComparador(id_plan){
//Funcion para eliminar planes dentro de la vista del comparador
	jQuery("#"+id_plan).remove();
	var id_plan="plan_"+id_plan;
	var VaciarComparador='<i class="material-icons">done</i>';
		$("."+id_plan).html(VaciarComparador);
		$( "#" + id_plan ).removeClass( "slctd-plan" );
		$( "." + id_plan ).removeClass( "span-bx-selected" );
		$( "." + id_plan ).removeClass( "slctd-plan" );
		$( "." + id_plan ).removeClass( id_plan );
	if($(".item").length>1){
		$("#owl-demo").data('owlCarousel').destroy();
		if($(".item").length==2){
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
	}else{
		jQuery( ".close-modal-btn" ).trigger( "click" );
	}		
}

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
	//Funcion para revisar los SELECT del selector principal
	$.blockUI({ message: null });
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	var celular=0,internet=0,telefono=0,television=0,streaming=0;
	if(jQuery("#celular").hasClass( "active-selection" )){
		//alert("celular");
		celular=1;
		//console.log("celular");				
		sessionStorage.setItem("ServicioCelular","1");			
	}else{
		sessionStorage.setItem("ServicioCelular","0");
	}
	if(jQuery("#internet").hasClass( "active-selection" )){
		//alert("internet");
		internet=1;
		//console.log("internet");
		sessionStorage.setItem("ServicioInternet","1");	
	}else{
		sessionStorage.setItem("ServicioInternet","0");
	}
	if(jQuery("#telefono").hasClass( "active-selection" )){
		//alert("telefono");
		telefono=1;
		//console.log("telefono");
		sessionStorage.setItem("ServicioTelefono","1");	
	}else{
		sessionStorage.setItem("ServicioTelefono","0");
	}
	if(jQuery("#television").hasClass( "active-selection" )){
		//alert("television");
		television=1;
		sessionStorage.setItem("ServicioTelevision","1");
	}else{
		sessionStorage.setItem("ServicioTelevision","0");
	}
	if(jQuery("#streaming").hasClass( "active-selection" )){
		//alert("streaming");
		streaming=1;
		//console.log(streaming);
		sessionStorage.setItem("ServicioStreaming","1");
	}else{
		sessionStorage.setItem("ServicioStreaming","0");
	}

	if(sessionStorage.getItem("ServicioStreaming")==1){
		$( "#selectEstado" ).prop('disabled', 'disabled');
		var Filtros = [];
		var getFiltrosCheckEmpresasStreaming=JSON.parse(sessionStorage.getItem("filtrosCheckEmpresasStreaming"));
		var get1 = window["slidertest"]["noUiSlider"]["get"]();
		newFiltro = {};
		newFiltro['tipo'] = 'precio';
		newFiltro['Maximo'] = get1[1];
		newFiltro['Minimo'] = get1[0];
		//console.log(get1[0]);
		//console.log(get1[1]);
		Filtros.push(JSON.stringify(newFiltro));
		if (!(getFiltrosCheckEmpresasStreaming === null) )
		{	//console.log("filtros empresas")
			jQuery.each(getFiltrosCheckEmpresasStreaming, function( index, value ) {
				//console.log("id_tipoDato: "+value.empresa+" id del div: "+ value.value );
				var temp='#'+value.value;
				if (jQuery(temp).is(":checked"))
				{
					//console.log("valorCheck");
					newFiltro = {};
        			newFiltro['tipo'] = 'checkEmpresas';
        			newFiltro["empresa"] = value.empresa;	
	        		Filtros.push(JSON.stringify(newFiltro));						
				}
			});
		}
		if($('#ordenAscDesc').is(':checked')){
			var orden="DESC";
		}else{
			var orden="ASC";
		}
		var data=	{
				'Streamingfiltros[]':Filtros,
				orden:orden
		}
		//console.log(Filtros);
		//CargarPlanes();
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			async : false,
			data: data
		})
	    .done(function(data){
			jQuery("#planes").html(data);
			VaciarComparador()
			$('.modal-trigger').leanModal({
				ready: function() {
			        if($(".lean-overlay").length > 1) {
			            $(".lean-overlay:not(:first)").each(function() {
			                $(this).remove();
			            });
			        }
			    },
			    complete: function() {
			        $(".lean-overlay").each(function() {
			            $(this).remove();
			        });
			    }			
			});
			window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "Listo"
				});
			}, 1000);
			$(".cargarmas").hide();
			cargarmas();
			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			document.querySelector('#filter-go').scrollIntoView();
			setTimeout($.unblockUI, 3000);
	    })
	}else{
		$( "#selectEstado" ).removeAttr("disabled");
		var getFiltros= JSON.parse(sessionStorage.getItem("filtros"));
		var getFiltrosCheck= JSON.parse(sessionStorage.getItem("filtrosCheck"));
		var getFiltrosCheckEmpresas=JSON.parse(sessionStorage.getItem("filtrosCheckEmpresas"));
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
			var orden="DESC";
		}else{
			var orden="ASC";
		}
		if($('#checkboxRedes').is(':checked')){
			//console.log("checkboxRedes");
			var redesSociales= 1;
		}else{
			var redesSociales= 0;
		}
		var data=	{
				'filtros[]':Filtros,
				celular:sessionStorage.getItem("ServicioCelular"),
				internet:sessionStorage.getItem("ServicioInternet"),
				telefono:sessionStorage.getItem("ServicioTelefono"),
				television:sessionStorage.getItem("ServicioTelevision"),
				streaming:sessionStorage.getItem("ServicioStreaming"),
				estado:$( "#selectEstado" ).val(),
				orden:orden,
				redesSociales: redesSociales
		}
		//CargarPlanes();
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			data: data,
			async: false
		})
	    .done(function(data){
	    	if(sessionStorage.getItem("ServicioCelular")==1){
	    	}
			jQuery("#planes").html(data);
			if($(".cargarmas").length<1){
				jQuery("#planes").html('<h1 class="nocriteria center">No hay resultados que mostrar con los criterios seleccionados.</h1>');
				//location.reload();
			}
			VaciarComparador();
			$('.modal-trigger').leanModal({
				//dismissible: false, // Modal can be dismissed by clicking outside of the modal
				//opacity: .5, // Opacity of modal background
				//in_duration: 300, // Transition in duration
				//out_duration: 200, // Transition out duration
				//ready: function() { alert('Ready'); }, // Callback for Modal open
				ready: function() {
			        if($(".lean-overlay").length > 1) {
			            $(".lean-overlay:not(:first)").each(function() {
			                $(this).remove();
			            });
			        }
			    },
			    complete: function() {
			        $(".lean-overlay").each(function() {
			            $(this).remove();
			        });
			    }			
			});
			$(".cargarmas").hide();
			cargarmas();
			window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "Listo"
				});
			}, 1000);

			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			//document.querySelector('.discover-title').scrollIntoView();
			document.querySelector('#filter-go').scrollIntoView();
			setTimeout($.unblockUI, 3000);
	    })
	    .fail(function(data){
	    	setTimeout($.unblockUI, 1000);
	    	window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "ERROR"
				});
			}, 1000);
			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			document.querySelector('#filter-go').scrollIntoView();
			setTimeout($.unblockUI, 3000);
			window.location.href = "index.php";
	    })
	}
	checkMobile();
}//function CargarPlanesConFiltros()

//Habilitar/deshabilitar los input para los planes de celulares
function habilitar(item,value) {
	CargarFiltrosCheckEmpresasConFiltro();
	if($('#checkbox1').is(':checked')){
    	$('input.checkbox1').removeAttr("disabled");
	}
	if(!$('#checkbox1').is(':checked')){
    	$( "input.checkbox1" ).prop( "checked", false );
    	$('input.checkbox1').attr("disabled", true);
    }
	CargarPlanesConFiltros();
}

//Ordenar asecendiente o descendiente los planes
jQuery(document.body).on('change', "#ordenAscDesc", function () { 
	CargarPlanesConFiltros();
})
 
$("#SelectDeEstados").change(function(){
	//alert($( "#selectEstado" ).val());
	sessionStorage.setItem("estado",$( "#selectEstado" ).val());	
	$.when(
		CargarPlanes()
	).then(function(){
	   //alert('All AJAX Methods Have Completed!');
	   if($(".cargarmas").length>1 || $(".planmostrado").length>1){
		   	CargarFiltrosCheckEmpresas();
		   	if(sessionStorage.getItem("ServicioCelular")==1){
				CargarFiltrosCheck();
			}else{
				jQuery("#filtrosCheckCelulares").html("");		

			}
			CargarFiltrosSliders();
		}else{
			jQuery("#filtrosCheck").html("");
			jQuery("#filtrosCheckEmpresas").html("");
			jQuery("#filtros").html("");	
			jQuery("#filtrosCheckCelulares").html("");		

		}
	});
})

jQuery(document).ready(function(){
	setTimeout(function(){
		resize();
	},300) 
	var urlGet=decodeURIComponent(window.location.href);
	if((urlGet.indexOf("plan") > -1) && (urlGet.indexOf("l=") > -1) && (urlGet.indexOf("s") > -1) ) {
       //alert("your url contains plan");

       	var getUrlParameterPlan = function getUrlParameterPlan(sParam) {
		    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;
        	var cantidadURL=0;
        	var ids= new Array();
		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0].indexOf(sParam) > -1) {
		            //return sParameterName[1] === undefined ? true : alert(sParameterName[1]);
		            if (sParameterName[1] !== undefined){
		            	jQuery( "#plan_"+sParameterName[1] ).trigger( "click" );
		            	cantidadURL+=1;
		            	ids.push(sParameterName[1]);
		            }
		        }
		    }
		    if(cantidadURL==1){
		        	//alert("Seleccionar ver detalles");
		        	jQuery( ".verplan_"+ids[0] ).trigger( "click" );
		    }else{
		    	jQuery( "#btnComparar" ).trigger( "click" );
		    }
		};
		var getUrlParameterServicio = function getUrlParameterServicio(sParam) {
		    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;
			sessionStorage.setItem("ServicioCelular","0");			
			sessionStorage.setItem("ServicioTelefono","0");
			sessionStorage.setItem("ServicioInternet","0");
			sessionStorage.setItem("ServicioTelevision","0");
			sessionStorage.setItem("ServicioStreaming","0");
		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');


		        if (sParameterName[0].indexOf(sParam) > -1) {
		            //return sParameterName[1] === undefined ? true : alert(sParameterName[1]);

		            if (sParameterName[1] !== undefined){
		            	if(sParameterName[1]==1){
							sessionStorage.setItem("ServicioCelular","1");
							//console.log("Celular URL")			
						}
						if(sParameterName[1]==2){
							sessionStorage.setItem("ServicioTelefono","1");	
						}
						if(sParameterName[1]==3){
							sessionStorage.setItem("ServicioInternet","1");	
						}
						if(sParameterName[1]==4){
							sessionStorage.setItem("ServicioTelevision","1");
						}
						if(sParameterName[1]==5){
							sessionStorage.setItem("ServicioStreaming","1");
						}
		            }
		        }
		    }
		};
		var getUrlParameterLocation = function getUrlParameterLocation(sParam) {
		    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;

		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0] === sParam) {
		            //return sParameterName[1] === undefined ? true : alert(sParameterName[1]);
		            if (sParameterName[1] !== undefined){
		            	sessionStorage.setItem("estado",sParameterName[1]);
		            }
		        }
		    }
		};
		//alert(getUrlParameter("plan[]"));
		getUrlParameterLocation("l");
		getUrlParameterServicio("s");
		//console.log(sessionStorage.getItem("CargaInicial"))
		$.when(
			CargarEstados(),
		VerificarServicios(),
		Seleccion()
	
		).then(function(){
		   //alert('All AJAX Methods Have Completed!');
		   sessionStorage.setItem("CargaInicial", "0");
		   CargarPlanes();
		   getUrlParameterPlan("plan");
		   CargarFiltrosSliders();
		});
		CargarAnuncio();
		document.querySelector('#filter-go').scrollIntoView();
		jQuery('#slideshow').fadeSlideShow();

    }else{
    	$.when(
			CargarEstados(),
			VerificarServicios(),
			Seleccion()
		).then(function(){
			//alert('All AJAX Methods Have Completed!');
			sessionStorage.setItem("CargaInicial", "0");
			CargarPlanes();
			CargarFiltrosSliders();
			//Iniciar a interceptar el click después de la primera carga
	   		jQuery('.products-box').click(function() {
	   			console.log('products-box')
				var celular=0,internet=0,telefono=0,television=0,streaming=0,CambioEnServicio=0;
				var contador=0;
				sessionStorage.removeItem("filtros");
				sessionStorage.removeItem("filtrosCheck");
				sessionStorage.removeItem("filtrosCheckEmpresas");
				jQuery(".servicioSeleccionado").removeClass('servicioSeleccionado')
				if(jQuery("#celular").hasClass( "active-selection" )){
					celular=1;
					contador+=1;
					jQuery(".servicioCelular").addClass('servicioSeleccionado')
					if(sessionStorage.getItem("ServicioCelular")!=1){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioCelular","1");
						//console.log("CELULAR");			
					}
				}else{
					if(sessionStorage.getItem("ServicioCelular")!=0){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioCelular","0");
					}
				}
				if(jQuery("#internet").hasClass( "active-selection" )){
					internet=1;
					contador+=1;
					jQuery(".servicioInternet").addClass('servicioSeleccionado')
					if(sessionStorage.getItem("ServicioInternet")!=1){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioInternet","1");	
						//console.log("INTERNET");		
					}	
				}else{
					if(sessionStorage.getItem("ServicioInternet")!=0){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioInternet","0");	
						//console.log("INTERNET");		
					}	
				}
				if(jQuery("#telefono").hasClass( "active-selection" )){
					telefono=1;
					contador+=1;
					jQuery(".servicioTelefono").addClass('servicioSeleccionado')
					if(sessionStorage.getItem("ServicioTelefono")!=1){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioTelefono","1");
						//console.log("INTERNET");		
					}	
					//console.log("TELEFONO");	
				}else{
					if(sessionStorage.getItem("ServicioTelefono")!=0){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioTelefono","0");	
						//console.log("INTERNET");		
					}	
				}
				if(jQuery("#television").hasClass( "active-selection" )){
					television=1;
					contador+=1;
					jQuery(".servicioTelevision").addClass('servicioSeleccionado')
					if(sessionStorage.getItem("ServicioTelevision")!=1){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioTelevision","1");
						//console.log("INTERNET");		
					}	
				}else{
					if(sessionStorage.getItem("ServicioTelevision")!=0){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioTelevision","0");	
						//console.log("INTERNET");		
					}	
				}
				if(jQuery("#streaming").hasClass( "active-selection" )){
					contador+=1;
					jQuery(".servicioStreaming").addClass('servicioSeleccionado')
					if(sessionStorage.getItem("ServicioStreaming")!=1){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioStreaming","1");
						//console.log("INTERNET");		
					}	
				}else{
					if(sessionStorage.getItem("ServicioStreaming")!=0){
						CambioEnServicio=1;
						sessionStorage.setItem("ServicioStreaming","0");	
						//console.log("INTERNET");		
					}	
				}

				var celular=sessionStorage.getItem("ServicioCelular");
			    var telefono=sessionStorage.getItem("ServicioTelefono");
			    var internet=sessionStorage.getItem("ServicioInternet");
			    var television=sessionStorage.getItem("ServicioTelevision");
			    var streaming=sessionStorage.getItem("ServicioStreaming");
			    //console.log("contador: "+contador);
				if(sessionStorage.getItem("ServicioStreaming")==1){
					$( "#selectEstado" ).prop('disabled', 'disabled');
				}else{
					$( "#selectEstado" ).removeAttr("disabled");
				}
				if(contador>0 && CambioEnServicio==1){
				    CargarPlanes();
				    if($(".cargarmas").length>1 || $(".planmostrado").length>1){
						CargarFiltrosCheckEmpresas();
						if(sessionStorage.getItem("ServicioCelular")==1){
							CargarFiltrosCheck();
						}else{
							jQuery("#filtrosCheckCelulares").html("");		
						}
						CargarFiltrosSliders();
					}else{
						jQuery("#filtrosCheck").html("");
						jQuery("#filtrosCheckEmpresas").html("");
						jQuery("#filtros").html("");
						jQuery("#filtrosCheckCelulares").html("");		

					}
				}
			});
		});
		CargarAnuncio();
		document.querySelector('#filter-go').scrollIntoView();
		jQuery('#slideshow').fadeSlideShow();
    }
});//document ready


function CargarPlanes(){
	if($('#ordenAscDesc').is(':checked')){
		var orden="DESC";
	}else{
		var orden="ASC";
	}
	//console.log(orden);
	$.blockUI({ message: null }); 

	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	if(sessionStorage.getItem("ServicioStreaming")==1){
		$( "#selectEstado" ).prop('disabled', 'disabled');
		//alert("Streaming");
		var data={
			CargarPlanesStreaming:"true",
			orden:orden
		}
	}else{
		$( "#selectEstado" ).removeAttr("disabled");
		var data={
			listadoSimple:"true",
			CargarPlanes:"true",
			celular:sessionStorage.getItem("ServicioCelular"),
			internet:sessionStorage.getItem("ServicioInternet"),
			telefono:sessionStorage.getItem("ServicioTelefono"),
			television:sessionStorage.getItem("ServicioTelevision"),
			streaming:sessionStorage.getItem("ServicioStreaming"),
			estado:sessionStorage.getItem("estado"),
			orden:orden
		}
	}
	jQuery.ajax({
		type: "POST",
		url: "listado.php",
		data: data,
		async : false

	})
    .done(function(data){
		jQuery("#planes").html(data);
		if($(".cargarmas").length<1){
			jQuery("#planes").html('<h1 class="nocriteria center">No hay resultados que mostrar con los criterios seleccionados.</h1>');
			jQuery("#filtrosCheck").html("");
			jQuery("#filtrosCheckEmpresas").html("");
			jQuery("#filtros").html("");
			jQuery("#filtrosCheckCelulares").html("");
			//location.reload();		
		}
		if($(".cargarmas").length==1){
			jQuery("#filtrosCheck").html("");
			jQuery("#filtrosCheckEmpresas").html("");
			jQuery("#filtros").html("");
			jQuery("#filtrosCheckCelulares").html("");
		}
		VaciarComparador();
		$('.modal-trigger').leanModal({
			//dismissible: false, // Modal can be dismissed by clicking outside of the modal
			//opacity: .5, // Opacity of modal background
			//in_duration: 300, // Transition in duration
			//out_duration: 200, // Transition out duration
			//ready: function() { alert('Ready'); }, // Callback for Modal open
			ready: function() {
		        if($(".lean-overlay").length > 1) {
		            $(".lean-overlay:not(:first)").each(function() {
		                $(this).remove();
		            });
		        }
		    },
		    complete: function() {
		        $(".lean-overlay").each(function() {
		            $(this).remove();
		        });
		    }		
		});
		$(".cargarmas").hide();
		cargarmas();
		window.setTimeout(function() {
			overlay.update({
				icon: "images/assets/check.png",
				text: "Listo"
			});
		}, 1000);
		window.setTimeout(function() {
			overlay.hide();
		}, 2000);
		//document.querySelector('.discover-title').scrollIntoView();
		document.querySelector('#filter-go').scrollIntoView();
		setTimeout($.unblockUI, 3000);
		/*
		if(sessionStorage.getItem("ServicioCelular")==1){
			jQuery( "#checkbox1" ).trigger( "click" );
			habilitar();
		}
		*/


    })
    .fail(function(data){
    	console.log(data);
    	setTimeout($.unblockUI, 1000);
		window.setTimeout(function() {
			overlay.update({
				icon: "images/assets/check.png",
				text: "Listo"
			});
		}, 1000);
		window.setTimeout(function() {
			overlay.hide();
		}, 2000);
		window.setTimeout(function() {
			overlay.hide();
		}, 2000);
		document.querySelector('#filter-go').scrollIntoView();
		setTimeout($.unblockUI, 3000);
		window.location.href = "index.php";
    });
    checkMobile();
}//function CargarPlanes()

function CargarFiltrosSliders(){
	if(sessionStorage.getItem("ServicioStreaming")==1){
		$( "#selectEstado" ).prop('disabled', 'disabled');
		var data={
			CargarSliderStreaming:"true"
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			async : false,
			data: data
		})
	    .done(function(data){
			jQuery("#filtros").html(data);	 	
	 		var _widthSlides = 0;
	 		$('.sliders-wrapp .slider-bx').each(function() {
	 		    _widthSlides += $(this).outerWidth( true );
	 		});
	 		$('.sliders-wrapp').css('width', _widthSlides);
	 	
	 		if (isMobile.any == false) {
	 			$(".sliders-scroll-bx").mCustomScrollbar({
					axis: "x",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				$(".checks-scroll-bx form").mCustomScrollbar({
					axis: "y",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
	 		}else {
	 			$(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
	 			$(".sliders-scroll-bx").mCustomScrollbar({
					axis: "x",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				$('.sliders-scroll-bx').mCustomScrollbar("scrollTo",'95');
	 		}
	 		$('').mCustomScrollbar("update");
	    })
	    .fail(function(data){
	    	console.log(data);
	    	//console.log("Error llamada en llamada Streaming a CargarFiltrosSliders");
	    });
	}else{
		$( "#selectEstado" ).removeAttr("disabled");
		var data={
			listadoSimple:"true",
			CargarFiltrosSliders:"true",
			celular:sessionStorage.getItem("ServicioCelular"),
			internet:sessionStorage.getItem("ServicioInternet"),
			telefono:sessionStorage.getItem("ServicioTelefono"),
			television:sessionStorage.getItem("ServicioTelevision"),
			streaming:sessionStorage.getItem("ServicioStreaming"),
			estado:sessionStorage.getItem("estado")
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			async : false,
			data: data
		})
	    .done(function(data){
			jQuery("#filtros").html(data);
			var _widthSlides = 0;
	 		jQuery('.sliders-wrapp .slider-bx').each(function() {
	 		    _widthSlides += jQuery(this).outerWidth( true );
	 		});
	 		jQuery('#filtros').css('width', _widthSlides);
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
				/*
				$(".slide-bar-bx").mouseup(function() {
				    CargarPlanesConFiltros();
				})
				*/
				$(".sliders-scroll-bx .sliders-wrapp").mCustomScrollbar("update");

	 		}else {
	 			jQuery(".sliders-scroll-bx, .checks-scroll-bx form .sliders-wrapp").addClass('ismobilescroll');
	 			$(".sliders-scroll-bx").mCustomScrollbar({
					axis: "x",
					theme: "dark-thin",
					autoHideScrollbar: true,
					updateOnContentResize: true
				});
				$('.sliders-scroll-bx').mCustomScrollbar("scrollTo",'95');
	 		}
	 		$().mCustomScrollbar("update");
	    })
	    .fail(function(data){
	    	console.log(data);
	    	//console.log("Error llamada en llamada cargo CargarFiltrosSliders");
	    });
	}
	//_fixedFiltersBx();
}

function CargarFiltrosCheck(){
	if(sessionStorage.getItem("ServicioStreaming")!=1){
		if(sessionStorage.getItem("ServicioCelular")==1){
			var data={
				listadoSimple:"true",
				CargarFiltrosCheckCelulares:"true",
				celular:sessionStorage.getItem("ServicioCelular"),
				internet:sessionStorage.getItem("ServicioInternet"),
				telefono:sessionStorage.getItem("ServicioTelefono"),
				television:sessionStorage.getItem("ServicioTelevision"),
				streaming:sessionStorage.getItem("ServicioStreaming"),
				estado:sessionStorage.getItem("estado")
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				async : false,
				data: data
			})
		    .done(function(data){
				jQuery("#filtrosCheckCelulares").html(data);
				if(document.getElementsByClassName("input.checkbox1")){
					$('input.checkbox1').attr("disabled", true);
				}
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
		 		}else {
		 			jQuery(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
		 		}
		    })
		    .fail(function(data){
		    	console.log(data);
		    });
		    /* No cargar filtros Check
		    var data={
				listadoSimple:"true",
				CargarFiltrosCheck:"true",
				CargarRedes:true,
				celular:sessionStorage.getItem("ServicioCelular"),
				internet:sessionStorage.getItem("ServicioInternet"),
				telefono:sessionStorage.getItem("ServicioTelefono"),
				television:sessionStorage.getItem("ServicioTelevision"),
				streaming:sessionStorage.getItem("ServicioStreaming"),
				estado:$( "#selectEstado" ).val()
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				async : false,
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
		    */

		}else{
			/* No cargar filtros Check
			var data={
				listadoSimple:"true",
				CargarFiltrosCheck:"true",
				celular:sessionStorage.getItem("ServicioCelular"),
				internet:sessionStorage.getItem("ServicioInternet"),
				telefono:sessionStorage.getItem("ServicioTelefono"),
				television:sessionStorage.getItem("ServicioTelevision"),
				streaming:sessionStorage.getItem("ServicioStreaming"),
				estado:$( "#selectEstado" ).val()
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				async : false,
				data: data
			})
		    .done(function(data){
				jQuery("#filtrosCheck").html(data);
				jQuery("#filtrosCheckCelulares").html("");
				if(document.getElementsByClassName("input.checkbox1")){
					$('input.checkbox1').attr("disabled", true);
				}
		    })
		    .fail(function(data){
		    	console.log(data);
		    });
		    */
		}
	}
}

function CargarFiltrosCheckEmpresas(){
	if(sessionStorage.getItem("ServicioStreaming")==1){
		$( "#selectEstado" ).prop('disabled', 'disabled');
		var data={
			CargarFiltrosCheckEmpresasStreaming:"true"
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			async : false,
			data: data
		})
	    .done(function(data){
			jQuery("#filtrosCheckEmpresas").html(data);

	    })
	    .fail(function(data){
	    	console.log(data);
	    });

	}else{
		$( "#selectEstado" ).removeAttr("disabled");
		var data={
			listadoSimple:"true",
			CargarFiltrosCheckEmpresas:"true",
			celular:sessionStorage.getItem("ServicioCelular"),
			internet:sessionStorage.getItem("ServicioInternet"),
			telefono:sessionStorage.getItem("ServicioTelefono"),
			television:sessionStorage.getItem("ServicioTelevision"),
			streaming:sessionStorage.getItem("ServicioStreaming"),
			estado:$( "#selectEstado" ).val()
		}
		jQuery.ajax({
			type: "POST",
			url: "listado.php",
			async : false,
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
	console.log('VerificarServicios')
    var celular=sessionStorage.getItem("ServicioCelular");
    var telefono=sessionStorage.getItem("ServicioTelefono");
    var internet=sessionStorage.getItem("ServicioInternet");
    var television=sessionStorage.getItem("ServicioTelevision");
    var streaming=sessionStorage.getItem("ServicioStreaming");
    if(celular=="1"){
    	//Seleccionar servicios desde el storage y reflejarlo en los botones, tanto en pantallas como en mobile
    	jQuery( "#celular, .cellplan" ).trigger( "click" );
    	$('.servicioCelular').addClass('servicioSeleccionado');
    	$('.servicioCelular').find('.check-plan-mobile').addClass('checked-opt');
    }
    if(telefono=="1"){
    	jQuery( "#telefono" ).trigger( "click" );
    	$('.servicioTelefono').addClass('servicioSeleccionado');
    	$('.servicioTelefono').find('.check-plan-mobile').addClass('checked-opt');
    }
    if(internet=="1"){
    	jQuery( "#internet, .tripleplay3" ).trigger( "click" );
    	$('.servicioInternet').addClass('servicioSeleccionado');
    	$('.servicioInternet').find('.check-plan-mobile').addClass('checked-opt');
    }
    if(television=="1"){
    	jQuery( "#television, .tripleplay2" ).trigger( "click" );
    	$('.servicioTelevision').addClass('servicioSeleccionado');
    	$('.servicioTelevision').find('.check-plan-mobile').addClass('checked-opt');
    }
    if(streaming=="1"){
    	jQuery( "#streaming, .streaming" ).trigger( "click" );
    	$('.servicioStreaming').addClass('servicioSeleccionado');
    	$('.servicioStreaming').find('.check-plan-mobile').addClass('checked-opt');
    }
    sessionStorage.setItem("CargaInicial", "1");
}

$(document.body).on('click touchend', ".btnServicioMobile", function () { 
	//console.log('btnServicioMobile');
	if($(this).hasClass('servicioSeleccionado')){
		$(this).removeClass('servicioSeleccionado');
		$(this).find('.check-plan-mobile').removeClass('checked-opt');
		if($(this).hasClass('servicioCelular')){ 
			//sessionStorage.setItem("ServicioCelular", "0");
			jQuery( "#celular, .cellplan" ).trigger( "click" );
		}
		if($(this).hasClass('servicioInternet')){ 
			//sessionStorage.setItem("ServicioInternet", "0");
			jQuery( "#internet" ).trigger( "click" );
		}
		if($(this).hasClass('servicioTelefono')){ 
			//sessionStorage.setItem("ServicioTelefono", "0");
			jQuery( "#telefono" ).trigger( "click" );
		}
		if($(this).hasClass('servicioTelevision')){ 
			//sessionStorage.setItem("ServicioTelevision", "0");
			jQuery( "#television" ).trigger( "click" );
		}
		if($(this).hasClass('servicioStreaming')){ 
			//sessionStorage.setItem("ServicioStreaming", "0");
			jQuery( "#streaming" ).trigger( "click" );
		}
	}else{
		if($(this).hasClass('servicioCelular')){
			if($('.servicioSeleccionado').length==0){
				$(this).addClass('servicioSeleccionado');
				$(this).find('.check-plan-mobile').addClass('checked-opt');
				jQuery( "#celular, .cellplan" ).trigger( "click" );
			}else{
				//console.log('Lo sentimos, este servicio no se puede comparar con su selección actual.');
				$('#modalIncompatibles').openModal();
			}
		}
		if($(this).hasClass('servicioStreaming')){
			if($('.servicioSeleccionado').length==0){
				$(this).addClass('servicioSeleccionado');
				$(this).find('.check-plan-mobile').addClass('checked-opt');
				jQuery( "#streaming" ).trigger( "click" );
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
				if($(this).hasClass('servicioTelefono')){
					jQuery( "#telefono" ).trigger( "click" );
				}
				if($(this).hasClass('servicioTelevision')){
					jQuery( "#television" ).trigger( "click" );
				}
				if($(this).hasClass('servicioInternet')){
					jQuery( "#internet" ).trigger( "click" );
				}
			}
		}
	}	
});

function Seleccion(){
	var CargaInicial= sessionStorage.getItem("CargaInicial");
	var celular=0,internet=0,telefono=0,television=0,streaming=0;
	var contador=0;
	//console.log("carga inicial: "+CargaInicial);
	if (CargaInicial == 1)
	{
		//console.log("seleccion()");
		if(jQuery("#celular").hasClass( "active-selection" ) || jQuery(".servicioCelular").hasClass('servicioSeleccionado')){
			celular=1;
			contador+=1;
			sessionStorage.setItem("ServicioCelular","1");
			//console.log("CELULAR");			
		}else{
			sessionStorage.setItem("ServicioCelular","0");
		}
		if(jQuery("#internet").hasClass( "active-selection" ) || jQuery(".servicioInternet").hasClass('servicioSeleccionado')){
			internet=1;
			contador+=1;
			sessionStorage.setItem("ServicioInternet","1");	
			//console.log("INTERNET");			
		}else{
			sessionStorage.setItem("ServicioInternet","0");
		}
		if(jQuery("#telefono").hasClass( "active-selection" ) || jQuery(".servicioTelefono").hasClass('servicioSeleccionado')){
			telefono=1;
			contador+=1;
			sessionStorage.setItem("ServicioTelefono","1");
			//console.log("TELEFONO");	
		}else{
			sessionStorage.setItem("ServicioTelefono","0");
		}
		if(jQuery("#television").hasClass( "active-selection" ) || jQuery(".servicioTelevision").hasClass('servicioSeleccionado')){
			television=1;
			contador+=1;
			//sessionStorage.setItem("ServicioTelevision","1");
		}else{
			sessionStorage.setItem("ServicioTelevision","0");
		}
		if(jQuery("#streaming").hasClass( "active-selection" ) || jQuery(".servicioStreaming").hasClass('servicioSeleccionado')){
			contador+=1;
			sessionStorage.setItem("ServicioStreaming","1");
		}else{
			sessionStorage.setItem("ServicioStreaming","0");
		}


		//CargarFiltrosSliders();
		if(sessionStorage.getItem("ServicioCelular")==1){
			CargarFiltrosCheck();
		}
		CargarFiltrosCheckEmpresas();
		VaciarComparador();
	}
}

function CargarEstados(){
	var data={
		SelectDeEstados:"true",
		estado:sessionStorage.getItem("estado")
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
    	window.location.href = "index.php";
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
	if($(".span-bx-selected").length<6 || $(".span-bx-selected").length==null || $( "."+item.id ).hasClass( item.id ) ){
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
	if(($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null)){
		$("#btnComparar" ).addClass( "noCompare" );
	}else{
		$("#btnComparar" ).removeClass( "noCompare" );
	}
	return false;
}
function RemoverSeleccionado(item,plan){
	var VaciarComparador='<i class="material-icons">done</i>';
	var idplan="plan_"+plan;
	$("#"+item.id).html(VaciarComparador);
	$("#"+item.id ).removeClass( "slctd-plan" );
	$("#"+item.id ).removeClass( "span-bx-selected" );
	$("#"+item.id ).removeClass( idplan );
	$("#"+ plan ).removeClass( "slctd-plan" );	
	if(($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null)){
		$("#btnComparar" ).addClass( "noCompare" );
	}else{
		$("#btnComparar" ).removeClass( "noCompare" );
	}
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
	if(($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null)){
		$("#btnComparar" ).addClass( "noCompare" );
	}else{
		$("#btnComparar" ).removeClass( "noCompare" );
	}
}

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


function cargarmas(){
	if($(".cargarmas").length<18){
		var j=$(".cargarmas").length;
	}else{
		var j=18;
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

var opts = {
	lines: 9,
	length: 12,
	width: 8,
	radius: 18,
	corners: 1,
	rotate: 0,
	direction: 1,
	color: '#ffffff',
	speed: 1.2,
	trail: 60,
	shadow: false,
	hwaccel: false,
	className: 'loadingSpinner',
	zIndex: 2e9,
	top: '40%',
	left: '50%'
};

function checkMobile(){
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			// some code..
	 	$(".iconosPlanes").hide();
	 	$('.scroll-box1').scrollLeft(90);
	 	//$('.widget-wrapper').css('height','450px')
	 	//$('.desktopSelect').hide();
	 	//$('.mobileSelect').show();
	}else{
		$('.mobileSelect').hide();
		$('.desktopSelect').show();
		$(".scroll-box1").mCustomScrollbar({
			axis: "x",
			theme: "minimal",
			updateOnContentResize: true
		});
	}
}

//Responsive menú mobile o desktop
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
	});*/
	var _wHght = $(window).width()
	if(_wHght<480){
		$('.widget-wrapper').css('height','470px')
	 	$('.desktopSelect').hide();
	 	$('.mobileSelect').show();
	 	//$('.slide-widget').css('top',$('#main-nav-bar').height());
	 	//$('#slideshow').css('top',$('#main-nav-bar').height());
	 	//$('#blog-module').css('top',$('#main-nav-bar').height());
	 	$(".checks-scroll-bx").css('overflow-x','scroll').css('height','10px').css('height','35px').mCustomScrollbar({
			axis: "x",
			theme: "minimal",
			autoHideScrollbar: true,
			updateOnContentResize: true,
			advanced:{autoExpandHorizontalScroll:true}
		}).css('width','1000px');

		setTimeout(function(){
  				$(".checks-scroll-bx").mCustomScrollbar('update').css('width','100%');
		},300);
		setTimeout(function(){
  				$('.checks-scroll-bx').mCustomScrollbar("scrollTo",'right')
		},600);
		setTimeout(function(){
  				$('.checks-scroll-bx').mCustomScrollbar("scrollTo",20)
		},1200);


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

function CargarFiltrosCheckEmpresasConFiltro(){
	sessionStorage.removeItem("filtrosCheckEmpresas");
	if($('#checkbox1').is(':checked')){
		var plan=1,prepago=0;
	}
	if($('#checkbox2').is(':checked')){
		var plan=0;prepago=1;
	}
	$( "#selectEstado" ).removeAttr("disabled");
	var data={
		//listadoSimple:"true",
		CargarFiltrosCheckEmpresasConFiltro:"true",
		celular:sessionStorage.getItem("ServicioCelular"),
		internet:sessionStorage.getItem("ServicioInternet"),
		telefono:sessionStorage.getItem("ServicioTelefono"),
		television:sessionStorage.getItem("ServicioTelevision"),
		streaming:sessionStorage.getItem("ServicioStreaming"),
		estado:$( "#selectEstado" ).val(),
		CelularPlan:plan,
		CelularPrepago:prepago
	}
	jQuery.ajax({
		type: "POST",
		url: "listado.php",
		async : false,
		data: data
	})
    .done(function(data){
		jQuery("#filtrosCheckEmpresas").html(data);

    })
    .fail(function(data){
    	console.log(data);
    });
    
}
function ImprimirPlan(plan,id){
	//alert(id);
}

function ImprimirComparacion(){
	var url="print-paqs.php?";
	var i=0;
	$( ".span-bx-selected" ).each(function( index ) {
	  if (i==0){
	  	url+="plan[]="+$( this ).attr("value");
	  	i=1;
	  }else{
	  	url+="&plan[]="+$( this ).attr("value");
	  }
	});
	window.open(url,'_blank');
	return false;
}

function ShareSingle(id){
	sessionStorage.setItem("CompartirSingle",id);
	$('#modalMailShareSingle').openModal();
}
function SendMailSingle(){
	$.blockUI({ message: null }); 
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	var data={
			celular:sessionStorage.getItem("ServicioCelular"),
			telefono:sessionStorage.getItem("ServicioTelefono"),
			television:sessionStorage.getItem("ServicioTelevision"),
			internet:sessionStorage.getItem("ServicioInternet"),
			streaming:sessionStorage.getItem("ServicioStreaming"),
			nombreFrom:$( "#SingleFromNombre" ).val(),
			emailFrom:$( "#SingleFromEmail" ).val(),
			nombreTo:$( "#SingleToNombre" ).val(),
			emailTo:$( "#SingleToEmail" ).val(),
			estado:$( "#selectEstado" ).val(),
			plan:sessionStorage.getItem("CompartirSingle")
		}
	jQuery.ajax({
		//dataType:"json",
		type: "POST",
		url: "sharemail.php",
		data: data
	})
    .done(function(data){

    	if(data==true){
    		$( "#SingleFromNombre" ).val("");
			$( "#SingleFromEmail" ).val("");
			$( "#SingleToNombre" ).val("");
			$( "#SingleToEmail" ).val("");
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
    		//alert("false");
    		window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "ERROR"
				});
			}, 1000);
			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			setTimeout($.unblockUI, 3000);

    	}
    })
    .fail(function(data){
    	//console.log(data);
    	window.location.href = "indexBE.php";
    });
    
}

function ShareComparacion(){
	var i=0;
	var planes= new Array();
	$( ".span-bx-selected" ).each(function( index ) {
	  planes.push($( this ).attr("value"));
	});
	$.blockUI({ message: null }); 
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	var data={
			celular:sessionStorage.getItem("ServicioCelular"),
			telefono:sessionStorage.getItem("ServicioTelefono"),
			television:sessionStorage.getItem("ServicioTelevision"),
			internet:sessionStorage.getItem("ServicioInternet"),
			streaming:sessionStorage.getItem("ServicioStreaming"),
			nombreFrom:$( "#CompareFromName" ).val(),
			emailFrom:$( "#CompareFromEmail" ).val(),
			nombreTo:$( "#CompareToName" ).val(),
			emailTo:$( "#CompareToEmail" ).val(),
			estado:$( "#selectEstado" ).val(),
			planes:planes
		}
	jQuery.ajax({
		//dataType:"json",
		type: "POST",
		url: "sharemail.php",
		data: data
	})
    .done(function(data){

    	if(data==true){
    		$( "#CompareFromName" ).val("");
			$( "#CompareFromEmail" ).val("");
			$( "#CompareToName" ).val("");
			$( "#CompareToEmail" ).val("");
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
    		window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "ERROR"
				});
			}, 1000);
			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			setTimeout($.unblockUI, 3000);

    	}
    })
    .fail(function(data){
    	console.log(data);
    	window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "ERROR"
				});
			}, 1000);
			window.setTimeout(function() {
				overlay.hide();
			}, 2000);
			setTimeout($.unblockUI, 3000);
    	//window.location.href = "indexBE.php";
    });
}

function CompartirComparacionFacebook(){
	//ev.preventDefault();
	var urlFacebook="https://www.facebook.com/sharer/sharer.php?u=";
	var url="http://www.eligefacil.com/fb_compare_share.php?";
	var i=0;
	url=url+"l="+$( "#selectEstado" ).val();
	if(sessionStorage.getItem("ServicioCelular")==1){
		url=url+"&s[]=1";
	}
	if(sessionStorage.getItem("ServicioTelefono")==1){
		url=url+"&s[]=2";
	}
	if(sessionStorage.getItem("ServicioTelevision")==1){
		url=url+"&s[]=4";
	}
	if(sessionStorage.getItem("ServicioInternet")==1){
		url=url+"&s[]=3";
	}
	if(sessionStorage.getItem("ServicioStreaming")==1){				
		url=url+"&s[]=5";
	}

	$( ".span-bx-selected" ).each(function( index ) {
	  	url+="&plan[]="+$( this ).attr("value");
	});
	var res = encodeURIComponent(url);
	res=urlFacebook+res;
	//window.open(res,'_blank');
	console.log(res);
	window.open(res,'_blank');
	//window.location=url;
	return false;
}

function CompartirComparacionTwitter(){
	var urlTwitter="https://twitter.com/home?status=";
	var url="http://www.eligefacil.com/fb_compare_share.php?";
	$( ".span-bx-selected" ).each(function( index ) {
	  url=url+"l="+$( "#selectEstado" ).val();
	if(sessionStorage.getItem("ServicioCelular")==1){
		url=url+"&s[]=1";
	}
	if(sessionStorage.getItem("ServicioTelefono")==1){
		url=url+"&s[]=2";
	}
	if(sessionStorage.getItem("ServicioTelevision")==1){
		url=url+"&s[]=4";
	}
	if(sessionStorage.getItem("ServicioInternet")==1){
		url=url+"&s[]=3";
	}
	if(sessionStorage.getItem("ServicioStreaming")==1){				
		url=url+"&s[]=5";
	}
	$( ".span-bx-selected" ).each(function( index ) {
	  	url+="&plan[]="+$( this ).attr("value");
	});
	var res = encodeURIComponent(url);
	res=urlTwitter+res;
	window.open(res,'_blank');
	//window.location=url;
	return false;
	});
}

function contratar(id_plan,nombre_plan,empresa,estado){
	var target = document.createElement("div");
	document.body.appendChild(target);
	var spinner = new Spinner(opts).spin(target);
	var overlay = iosOverlay({
		text: "Cargando",
		spinner: spinner
	});
	$('#BtnEnviarContratacion').attr('data-id-plan',id_plan);
	$('#BtnEnviarContratacion').attr('data-nombre-plan',nombre_plan);
	$('#BtnEnviarContratacion').attr('data-empresa-plan',empresa);
	$('#BtnEnviarContratacion').attr('data-estado-plan',estado);
	var data={
			contratar:true,
			id_empresa:empresa,
			estado:estado
		}
	jQuery.ajax({
		//dataType:"json",
		type: "POST",
		url: "listado.php",
		data: data
	})
    .done(function(data){
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
    	$(".contenedorContactos").html(data)
    	console.log(data);
    })
    .fail(function(data){
    	console.log(data);
    	window.setTimeout(function() {
				overlay.update({
					icon: "images/assets/check.png",
					text: "ERROR"
				});
			}, 1000);
		window.setTimeout(function() {
			overlay.hide();
		}, 2000);
		setTimeout($.unblockUI, 3000);
    	//window.location.href = "indexBE.php";
    });

}

jQuery( "#BtnEnviarContratacion" ).click(function() {
	if(($( "#EnviarNombreContratacion" ).val() !="") && ($( "#EnviarCorreoContratacion" ).val() !="") && (($( "#EnviarTelefonoContratacion" ).val()!="") || ($( "#EnviarMovilContratacion").val()!=""))) 
	{

	
		$.blockUI({ message: null }); 
		var target = document.createElement("div");
		document.body.appendChild(target);
		var spinner = new Spinner(opts).spin(target);
		var overlay = iosOverlay({
			text: "Cargando",
			spinner: spinner
		});
		var data={
				nombre:$( "#EnviarNombreContratacion" ).val(),
				email:$( "#EnviarCorreoContratacion" ).val(),
				telefono:$( "#EnviarTelefonoContratacion" ).val(),
				movil:$( "#EnviarMovilContratacion" ).val(),
				estado:$('#BtnEnviarContratacion').attr('data-estado-plan'),
				id_plan:$('#BtnEnviarContratacion').attr('data-id-plan'),
				nombre_plan:$('#BtnEnviarContratacion').attr('data-nombre-plan'),
				empresa_plan:$('#BtnEnviarContratacion').attr('data-empresa-plan')
			}
		jQuery.ajax({
			//dataType:"json",
			type: "POST",
			url: "mailtoContrataciones.php",
			data: data
		})
	    .done(function(data){

	    	if(data==true){
	    		//alert("true");
	    		$( "#EnviarNombreContratacion" ).val("");
				$( "#EnviarCorreoContratacion" ).val("");
				$( "#EnviarMovilContratacion" ).val("");
				$( "#EnviarTelefonoContratacion" ).val("");
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
	    		//alert("false");
	    		window.setTimeout(function() {
					overlay.update({
						icon: "images/assets/check.png",
						text: "ERROR"
					});
				}, 1000);
				window.setTimeout(function() {
					overlay.hide();
				}, 2000);
				setTimeout($.unblockUI, 3000);

	    	}
	    	console.log(data)
	    })
	    .fail(function(data){
	    	console.log(data);
	    	//window.location.href = "indexBE.php";
	    });
	}else{
		alert("Debe completar el nombre, el correo y alguno de los dos números telefónicos");
	}
});

$(document.body).on('change', "#MeGustariaContratar", function () {
//$("#MeGustariaContratar").change(function(){
	//alert("change checkbox");
})

function MeGustariaContratar(id_plan){
	//alert(id_plan);
	var data={
				id_plan:id_plan
			}
		jQuery.ajax({
			//dataType:"json",
			type: "POST",
			url: "CountContratar.php",
			data: data
		})
	    .done(function(data){

	    	if(data==true){
	    		//alert("true");
	    		//alert("Gracias por querer contratar desde eligefacil.com")
	    	}else{
	    		//alert("false");
	    	}
	    	console.log(data)
	    })
	    .fail(function(data){
	    	console.log(data);
	    	//window.location.href = "indexBE.php";
	    });
}
$(document.body).on('click','.contractModadClose',function (){
	if($('.lean-overlay').length>0){
		$('.lean-overlay').remove()
	}
})