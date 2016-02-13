document.addEventListener("deviceready", function(){
  document.addEventListener("resume", onResume, false);
  if(window.localStorage.getItem("primeraVez")!="1"){
    //inicializa todas las variables locales persistentes que se usan
    window.localStorage.setItem("primeraVez","1"); //si ya se inició sesión no entra aquí
    window.localStorage.setItem("despertador","0");//0 está inactiva la notificación
    window.localStorage.setItem("alimentos","0");
    window.localStorage.setItem("hidratacion","0");
    window.localStorage.setItem("recordatorios","0");
    window.localStorage.setItem("repetidor1","1");
    window.localStorage.setItem("repetidor2","1");
    window.localStorage.setItem("time-repetidor1",$("#time-repetidor1").val());
    window.localStorage.setItem("time-repetidor2",$("#time-repetidor2").val());
    onResume();
  }else{
    /*
//Formas para comprobar que las variables no sean nulas y se inician
    var items = window.localStorage.getItem('confirmacionRecordatorios');
    if (items === null || items.length === 0)
    {
        // items is null, [] or '' (empty string)
      window.localStorage.setItem("confirmacionRecordatorios","32");
    }
    var items = window.localStorage.getItem('confirmacionDespertador');
    if (items === null || items.length === 0)
    {
        // items is null, [] or '' (empty string)
      window.localStorage.setItem("confirmacionDespertador","32");
    }
    //alert(window.localStorage.getItem("confirmacionDespertador"));
    */
    onResume();
  }
  
//Funciones para disparar las notificaciones si hay algún cambio en alguno de los campos, switch ó campos de hora ó número
  $('input[name="despertador"]').on('switchChange.bootstrapSwitch', function(event, state) {
      if(state==true){
        //alert("cambio a verde");
        window.localStorage.setItem("despertador","1"); //1 está activa la notificación.
        //alert(window.localStorage.getItem("despertador"));
        agregar_DESPERTADORyALIMENTOS();
      }else{
        //alert("cambio a rojo");
        window.localStorage.setItem("despertador","0");
        //alert(window.localStorage.getItem("despertador"));

        cancelar(0);
        cancelar(1);
        cancelar(2);
        cancelar(3);
        cancelar(4);  
        limpiarALL();
        localStorage.despertador=0;
      }
  });
  $('input[name="alimentos"]').on('switchChange.bootstrapSwitch', function(event, state) {
      if(state==true){
        window.localStorage.setItem("alimentos","1");      
        agregar_ALIMENTOSyENTRENAMIENTO();   
        localStorage.alimentos=1;   
      }else{
        window.localStorage.setItem("alimentos","0");
        cancelar(10);
        cancelar(11);
        cancelar(12);
        cancelar(13);
        cancelar(14);
        limpiarALL();
        localStorage.alimentos=0;
      }
  });
  $('input[name="hidratacion"]').on('switchChange.bootstrapSwitch', function(event, state) {
      if(state==true){
        window.localStorage.setItem("hidratacion","1");
//Envío -1 en la hora para notificar que es un mensaje de hidratación y que necesita comenzar a notificar de inmediato
        var current_time = new Date();
        var proximaNotificacion=current_time.setMinutes(current_time.getMinutes()+15);
        window.localStorage.setItem("confirmacionHidratacion", proximaNotificacion);      
        var minutosProximaNotificacion = current_time.getMinutes()+15;
        var horaProximaNotificacion = current_time.getHours();
        add_reminder(20,'Mensaje de Hidratación',0,horaProximaNotificacion,minutosProximaNotificacion,'Hidratación!','hour');
        localStorage.hidratacion=1;
      }else{
        window.localStorage.setItem("hidratacion","0");
        cancelar(20);
        limpiarALL();
        localStorage.hidratacion=0;
      }
  });
  $('input[name="recordatorios"]').on('switchChange.bootstrapSwitch', function(event, state) {
      if(state==true){
        var current_time = new Date();
        var minutos_recordatorios=current_time.getMinutes();
        var hora_recordatorios=current_time.getHours();
        window.localStorage.setItem("recordatorios","1");
        window.localStorage.setItem("confirmacionRecordatorios", current_time.getTime());
        add_reminder(30,'Recordatorios Directos',0,hora_recordatorios,minutos_recordatorios,'Recordatorios!','hour');
      }else{
        window.localStorage.setItem("recordatorios","0");
        canelar(30);
        limpiarALL();
        localStorage.recordatorios=0;
      }
  });

  $

  $( "#repetidor1" ).change(function() {
    //alert( "entra a change" );
    if(window.localStorage.getItem("despertador")==1){
      agregar_DESPERTADORyALIMENTOS();
    }
  });

  $( "#repetidor2" ).change(function() {
    if(window.localStorage.getItem("alimentos")==1){
      agregar_ALIMENTOSyENTRENAMIENTO();
    }
  });

  $( "#time-repetidor1" ).change(function() {
    //alert( "entra a change" );
    window.localStorage.setItem("time-repetidor1",$("#time-repetidor1").val());
    if(window.localStorage.getItem("despertador")==1){
      agregar_DESPERTADORyALIMENTOS();
    }
  });

  $( "#time-repetidor2" ).change(function() {
    //alert( "entra a change" );
    window.localStorage.setItem("time-repetidor2",$("#time-repetidor2").val());
    if(window.localStorage.getItem("alimentos")==1){
      agregar_ALIMENTOSyENTRENAMIENTO();
    }
  });



$( "#cerrarSesion" ).click(function(){
    //var dataStringCS = $(this).data("registro");
    //var formData = 'email='+ dataString;        
    //alert(formData);
    //alert("entra a funcion");
  var cerrar_sesion = confirm("¿Está seguro que desea cerrar la sesion?");
  if (cerrar_sesion == true) {
    //limpiarALL();
    //cancelarALL();
    cancelarALL();
    //alert("pasa");

window.localStorage.clear();
          window.location = "index.html";

    
    } else {
        txt = "You pressed Cancel!";
    }
  });
  

//Funciones para agregar las dos primeras notificaciones que pueden 'setear' la hora y el número de repeticiones cada 5 minutos
  function agregar_DESPERTADORyALIMENTOS() {
//Comprobar el número de repeticiones que estén entre los intervalos que se desean 
    if ($("#repetidor1").val() > 6)
      {
          $("#repetidor1").val(6);
          showToast('Máximo 6 repeticiones');
      }
      else if ($("#repetidor1").val() < 5)
      {
          $("#repetidor1").val(5);
          showToast('Mínimo 5 comidas al día');
      }
      window.localStorage.setItem("repetidor1",$("#repetidor1").val());
      if($("#repetidor1").val()<=0){
        //Funcion para cancelar las 5 notificaciones del primer grupo de repeticiones, de 0 al 9 máximo
        cancelar(0);
        cancelar(1);
        cancelar(2);
        cancelar(3);
        cancelar(4); 
        limpiarALL();
      }else{
//Funcion para agregar notificacion, y se agregan las variables locales para la hora, lo minutos y la repetición
        var repeticiones1=$("#repetidor1").val();
        window.localStorage.setItem("repeticiones1",repeticiones1);
        var timeRepetidor1 = window.localStorage.getItem("time-repetidor1");
        var currentDate=new Date().getDate();
        var currentMonth=new Date().getMonth();
        var currentYear=new Date().getFullYear();
        var Fecha1=currentYear+"-"+currentMonth+"-"+currentDate;
        var schedule_time_repetidor1 = new Date((Fecha1 + " " + timeRepetidor1).replace(/-/g, "/")).getTime();
        schedule_time_repetidor1 = new Date(schedule_time_repetidor1);
        var horaRepetidor1 = schedule_time_repetidor1.getHours();
        var minutos_repeticion1 =schedule_time_repetidor1.getMinutes();
        //Ajusto las variables locales al nuevo horario
        window.localStorage.setItem("repeticiones1",repeticiones1);        
        window.localStorage.setItem("horaRepetidor1",horaRepetidor1);
        window.localStorage.setItem("minutos_repeticion1",minutos_repeticion1);
        window.localStorage.setItem("confirmacionDespertador","32");
        //Recordatorio despertar
        add_reminder(0,'Ya es hora de despertar',0,horaRepetidor1,minutos_repeticion1,'¡Despertar!','day'); 
        //Recordatorio desayuno
        minutos_repeticion1=minutos_repeticion1+30;
        add_reminder(1,'Ya es hora de tu desayuno',0,horaRepetidor1,minutos_repeticion1,'Desayunar','day');
        //Recordatorio primer snack
        add_reminder(2,'Ya es hora de un snack',0,horaRepetidor1+3,minutos_repeticion1,'Tiempo de un Snack','day');
        //Recordatorio Almorzar
        add_reminder(3,'Ya es hora de almorzar',0,horaRepetidor1+6,minutos_repeticion1,'Almorzar','day');
        //Recordatorio segundo snack
        add_reminder(4,'Ya es hora de un snack',0,horaRepetidor1+9,minutos_repeticion1,'Tiempo de un Snack','day');
        //Recordatorio cena
        add_reminder(5,'Ya es hora de cenar',0,horaRepetidor1+12,minutos_repeticion1,'Cenar','day');
        //Recordatorio opcional de snack antes de dormir
        if(repeticiones1==6){
          add_reminder(6,'Ya es hora de un snack',0,horaRepetidor1+15,minutos_repeticion1,'Tiempo de un Snack','day');
        }
        /*
        for (var i = 0; i <= repeticiones1 -1; i++) {
          minutos_repeticion1+=5;
          add_reminder(i,'Despertar y comer un desayuno bine balanceado',0,horaRepetidor1,minutos_repeticion1,'Despertarse y comer','day'); 
        }
        */
      }
  }
//Funciones para agregar las dos primeras notificaciones que pueden 'setear' la hora y el número de repeticiones cada 5 minutos
  function agregar_ALIMENTOSyENTRENAMIENTO() {
    // body...
    if ($("#repetidor2").val() > 6)
      {
          $("#repetidor2").val(6);
          showToast('Máximo 6 repeticiones');
      }
      else if ($("#repetidor2").val() < 5)
      {
          $("#repetidor2").val(5);
          showToast('Mínimo 5 comidas al día');
      }
      window.localStorage.setItem("repetidor2",$("#repetidor2").val());
      if($("#repetidor2").val()<=0){
        //Funcion para cancelar 
        cancelar(10);
        cancelar(11);
        cancelar(12);
        cancelar(13);
        cancelar(14);
        cancelar(15);
        cancelar(16);
        cancelar(17);  
        limpiarALL();
      }else{
        //Funcion para agregar notificacion
        var repeticiones2=Number($("#repetidor2").val());
        window.localStorage.setItem("repeticiones2",repeticiones2);
        var timeRepetidor2 = window.localStorage.getItem("time-repetidor2");
        var currentDate=new Date().getDate();
        var currentMonth=new Date().getMonth();
        var currentYear=new Date().getFullYear();
        var Fecha2=currentYear+"-"+currentMonth+"-"+currentDate;
        var schedule_time_repetidor2 = new Date((Fecha2 + " " + timeRepetidor2).replace(/-/g, "/")).getTime();
        schedule_time_repetidor2 = new Date(schedule_time_repetidor2);
        var horaRepetidor2 = schedule_time_repetidor2.getHours();
        var minutos_repeticion2 =schedule_time_repetidor2.getMinutes();
        //Ajusto las variables locales al nuevo horario
        window.localStorage.setItem("repeticiones2",repeticiones2);  
        window.localStorage.setItem("horaRepetidor2",horaRepetidor2);
        window.localStorage.setItem("minutos_repeticion2",minutos_repeticion2);
        window.localStorage.setItem("confirmacionAlimentos","32");
        add_reminder(10,'Ya es hora de despertar',0,horaRepetidor2,minutos_repeticion2,'¡Despertar!','day'); 
        //Recordatorio entrenamiento
        minutos_repeticion2=minutos_repeticion2+20;
        add_reminder(11,'Ya es hora de tu entrenamiento',0,horaRepetidor2,minutos_repeticion2,'Entrenar','day');
        //Recordatorio desayuno
        add_reminder(12,'Ya es hora de tu desayuno',0,horaRepetidor2+1,minutos_repeticion2,'Desayunar','day');
        //Recordatorio primer snack
        add_reminder(13,'Ya es hora de un snack',0,horaRepetidor2+4,minutos_repeticion2,'Tiempo de un Snack','day');
        //Recordatorio Almorzar
        add_reminder(14,'Ya es hora de almorzar',0,horaRepetidor2+7,minutos_repeticion2,'Almorzar','day');
        //Recordatorio segundo snack
        add_reminder(15,'Ya es hora de un snack',0,horaRepetidor2+10,minutos_repeticion2,'Tiempo de un Snack','day');
        //Recordatorio cena
        add_reminder(16,'Ya es hora de cenar',0,horaRepetidor2+13,minutos_repeticion2,'Cenar','day');
        //Recordatorio opcional de snack antes de dormir
        if(repeticiones2==6){
          add_reminder(17,'Ya es hora de un snack',0,horaRepetidor2+16,minutos_repeticion2,'Tiempo de un Snack','day');
        }
        /*
        for (var i = 10; i <= repeticiones2 -1; i++) {
          minutos_repeticion2+=5;
          add_reminder(i,'Después de comer hay que entrenar',0,horaRepetidor2,minutos_repeticion2,'Alimentos y Entrenamiento','day'); 
        }
        */
      }
  }
//Función que se encarga de armar la estructura de la notificaciones, y comprobar si la aplicación tiene permisos para dar advertencias o no
  function add_reminder(id,mensaje,repeticiones,hora,minutos,titulo,every)
  {
//Compruba si es una notificación para el mismo día o para el día siguiente, dependiendo de la hora que 'seteo' el usuario, si es -1 es de inmediato

      var schedule_time = new Date();
      schedule_time.setHours(hora,minutos,00);
      var current_time = new Date().getTime();
      if(current_time>schedule_time){
        schedule_time.setDate(schedule_time.getDate() + 1);
      }  
    
    cordova.plugins.notification.local.hasPermission(function(granted){
      if(granted == true)
      {
        //alert(id+titulo+mensaje+schedule_time+hora+minutos+repeticiones);
        schedule(id, titulo, mensaje,schedule_time,every);
      }
      else
      {
        cordova.plugins.notification.local.registerPermission(function(granted) {
            if(granted == true)
            {
              //alert(id+titulo+message+schedule_time+hora+minutos+repeticiones);
              schedule(id, titulo, mensaje,schedule_time,every);
            }
            else
            {
              alert("Reminder cannot be added because app doesn't have permission");
            }
        });
      }
    });
  }
  <!-- initialize -->
//Funcion que registra la notificación en el equipo
    function schedule(id, titulo, mensaje, schedule_time,every)
  {
    cordova.plugins.notification.local.schedule({
        id: id,
        title: titulo,
        message: mensaje,
        firstAt: schedule_time,
        sound:"file://beep.caf",
        badge: true,
        every:every
    });

    //alert("Reminder added successfully")
    //showToast("Notificación agregada con éxito!");
  }

//Funciones para cancelar o limpiar una notificación, Cancelar cancela la Notificación pasadas y futuras, limpiar sólo vacía la bandeja de las notificaciones pasadas.
  function cancelar(id){
    cordova.plugins.notification.local.cancel(id, function() {
        //alert("done");
    }, this);
  }
  
  function limpiar(id){
    cordova.plugins.notification.local.clear(id, function() {
        //alert("done");
    }, this);
  }

  function cancelarALL(){
    cordova.plugins.notification.local.cancelAll(function() {
        //alert("done");
    }, this);
  }
  
  function limpiarALL(){
    cordova.plugins.notification.local.clearAll(function() {
        //alert("done");
    }, this);
  }

//Funciones nativas del plugin 'cordova-local-notification' para poder hacer acciones cuando:

//Cuando registra una notificación
  cordova.plugins.notification.local.on("schedule", function(notification) {
      //alert("scheduled: " + notification.id);
      showToast("Notificación agregada con éxito!");
  });

//Si se encuentra dentro de la aplicación y llega una notificación, puede mostrar un mensaje o hacer algo especial
  cordova.plugins.notification.local.on('trigger', function (notification) {
                    console.log('ontrigger', arguments);
                    //showToast('triggered: ' + notification.id,'short','center');
                    //alert("trigger"+notification.id);
                });

//Si da click a la notificación desde el menú de notificaciones del teléfono
  cordova.plugins.notification.local.on('click', function (notification) {
            console.log('onclick', arguments);
            //showToast('clicked: ' + notification.id,'short','center');
            //alert("clicked"+notification.id+"Va a ser cancelada");
        });

//Si cancela una notificación puede mandar un mensaje para avisar que canceló la notificación o algo por el estilo
  cordova.plugins.notification.local.on('cancel', function (notification) {
            console.log('oncancel', arguments);
            //showToast('canceled: ' + notification.id);
            //alert("canceled"+notification.id);

        });    

//Función para obtener las Ids de las notificaciones pendientes
  callback = function () {
      cordova.plugins.notification.local.getIds(function (ids) {
          showToast('IDs: ' + ids.join(' ,'));
      });
  };
//Función para mostrar avisos 'Toast', que muestra globos dentro de la aplicación
  showToast = function (text) {
      setTimeout(function () {
          if (device.platform != 'windows') {
              window.plugins.toast.showShortBottom(text);
          } else {
              //showDialog(text);
          }
      }, 100);
  };

//Función que se ejecuta cuando se reabre la aplicación, y comprueba que todos los valores estén en como la última vez que lo dejó el usuario por medio de windol.localStorage
  function onResume() {
    //Cargar lista de Notificaciones pendientes para que el usuario las acepte

    //Obtiene la fecha y hora actual para ver si el Usuario tiene notificaciones pendientes por 'Aceptar'
    var confirmacion = new Date().getDate();
    $("#time-repetidor1").val(window.localStorage.getItem("time-repetidor1"));
    $("#time-repetidor2").val(window.localStorage.getItem("time-repetidor2"));

    limpiarALL();

    if(window.localStorage.getItem("despertador")==0){
      $('input[name="despertador"]').bootstrapSwitch('state', false, false);
      limpiarALL();
      cancelar(0);
      cancelar(1);
      cancelar(2);
      cancelar(3);
      cancelar(4);
      cancelar(5);
      if(window.localStorage.getItem("repeticiones1")==6){
        cancelar(6);
      }
    }else if(window.localStorage.getItem("despertador")==1){
        $("#despertador").prop('checked', true);
        $('input[name="despertador"]').bootstrapSwitch('state', true, true);
        var horaRepetidor1 = window.localStorage.getItem("horaRepetidor1");
        var minutos_repeticion1= window.localStorage.getItem("minutos_repeticion1");
        var schedule_time = new Date();
        schedule_time.setHours(horaRepetidor1,minutos_repeticion1,00);
        var schedule_time_limit = new Date();
        schedule_time_limit.setHours(horaRepetidor1+1,minutos_repeticion1,00);
        var current_time = new Date().getTime();
        if(current_time>schedule_time && current_time<schedule_time_limit && window.localStorage.getItem("confirmacionDespertador")!=confirmacion){
          var r = confirm("Recuerde que tiene que despertar temprano y alimentarse sano");
          if (r == true) {
            window.localStorage.setItem("confirmacionDespertador", new Date().getDate());
          }
          //alert("Recuerde que tiene despertar temprano y alimentarse sano");
          limpiarALL();      
        }else{
          //Si ya pasó el tiempo que debería mostrarse
        }
    }
    if(window.localStorage.getItem("alimentos")==0){
      $("#alimentos").attr( "checked", false );
      $('input[name="alimentos"]').bootstrapSwitch('state', false, false);
      limpiarALL();
      cancelar(10);
      cancelar(11);
      cancelar(12);
      cancelar(13);
      cancelar(14);
      cancelar(15);
      cancelar(16);
      if(window.localStorage.getItem("repeticiones1")==6){
        cancelar(17);
      }
    }else if(window.localStorage.getItem("alimentos")==1){
        $("#alimentos").attr( "checked", true );
        $('input[name="alimentos"]').bootstrapSwitch('state', true, true);
        var horaRepetidor2 = window.localStorage.getItem("horaRepetidor2");
        var minutos_repeticion2= window.localStorage.getItem("minutos_repeticion2");
        var schedule_time = new Date();
        schedule_time.setHours(horaRepetidor2,minutos_repeticion2,00);
        var schedule_time_limit = new Date();
        schedule_time_limit.setHours(horaRepetidor2+1,minutos_repeticion2,00);
        var current_time = new Date().getTime();
        if(current_time>schedule_time && current_time<schedule_time_limit && window.localStorage.getItem("confirmacionAlimentos")!= confirmacion){
          var r = confirm("Recuerde que tiene que alimentarse bien y entrenar!");
          if (r == true) {
            window.localStorage.setItem("confirmacionAlimentos", new Date().getDate());
          }
          //alert("Recuerde que tiene que alimentarse bien y entrenar!");
          limpiarALL();      
        }else{
          //Si ya pasó el tiempo que debería mostrarse
        }
    }
    if(window.localStorage.getItem("hidratacion")==0){
      $("#hidratacion").attr( "checked", false );
      $('input[name="hidratacion"]').bootstrapSwitch('state', false, false);
      limpiarALL();
      cancelar(20);
    }else if(window.localStorage.getItem("hidratacion")==1){
        $("#hidratacion").attr( "checked", true );
        $('input[name="hidratacion"]').bootstrapSwitch('state', true, true);
        var current_time = new Date();
        if(window.localStorage.getItem("confirmacionHidratacion")< current_time.getTime()){
          var r = confirm("¿Ya se hidrató?");
          if (r == true) {
            var proximaNotificacion=current_time.setMinutes(current_time.getMinutes()+15);
            window.localStorage.setItem("confirmacionHidratacion", proximaNotificacion);
            var minutosProximaNotificacion = current_time.getMinutes()+15;
            var horaProximaNotificacion = current_time.getHours();
            add_reminder(20,'Mensaje de Hidratación',0,horaProximaNotificacion,minutosProximaNotificacion,'Hidratación!','hour');
          }else{
            //alert("Enrta a Cancel");
            var proximaNotificacion=current_time.setMinutes(current_time.getMinutes()+5);
            window.localStorage.setItem("confirmacionHidratacion", proximaNotificacion);
            var minutosProximaNotificacion = current_time.getMinutes()+5;
            var horaProximaNotificacion = current_time.getHours();
            add_reminder(20,'Mensaje de Hidratación',0,horaProximaNotificacion,minutosProximaNotificacion,'Hidratación!','hour');
          }
          //alert("Recuerde que tiene que alimentarse bien y entrenar!");
          limpiarALL();
        }else{
          //Si ya pasó el tiempo que debería mostrarse
        }
    }
    if(window.localStorage.getItem("recordatorios")==0){
      $("#recordatorios").attr( "checked", false );
      $('input[name="recordatorios"]').bootstrapSwitch('state', false, false);
      limpiarALL();
      cancelar(30);
    }else if(window.localStorage.getItem("recordatorios")==1){
        $("#recordatorios").attr( "checked", true );
        $('input[name="recordatorios"]').bootstrapSwitch('state', true, true);
        var current_time = new Date();
        if(window.localStorage.getItem("confirmacionRecordatorios")<current_time){
          var r = confirm("Recuerde que tiene recordatorios");
          if (r == true) {
            current_time = current_time.setHours(current_time.getHours()+3);
            window.localStorage.setItem("confirmacionRecordatorios", current_time);
            add_reminder(30,'Mensaje de recordatorios',0,current_time.getHours(),current_time.getMinutes(),'Recordatorios!','hour');
          }else{
            window.localStorage.setItem("confirmacionRecordatorios", current_time.getTime());
            add_reminder(30,'Mensaje de Recordatorios',0,current_time.getHours(),current_time.getMinutes()+5,'Recordatorios!','hour');
          }
          //alert("Recuerde que tiene que tiene recordatorios");
          limpiarALL();      
        }else{
          //Si ya pasó el tiempo que debería mostrarse
        }
    }
    $("#repetidor1").val(window.localStorage.getItem("repetidor1"));
    $("#repetidor2").val(window.localStorage.getItem("repetidor2"));
  }




}, false);


