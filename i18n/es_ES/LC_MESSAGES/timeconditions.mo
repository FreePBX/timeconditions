��    r      �  �   <      �	  >   �	     �	     
     
     %
     ;
     D
     W
  "   f
     �
     �
     �
  9   �
     �
  ,   �
  +     �   F     5     =     F     M  #   Y     }     �     �     �     �               &  >   -  O   l  Y   �  �       �     �     �     �     �               -     J     P     T     [     l     |     �     �     �     �     �     �     �     �     �  !   �  #        ,     @  &   V  )   }     �     �     �     �  �   �  	   ~     �  %  �     �     �  !   �  #   �          !  �  5  (  )  |   R  9   �  0   	     :     C     R     h     |     �  
   �     �  
   �     �     �     �     �  	   �     �           '  	   ;     E     T     d  �   h       "     -   4  
   b  $   m     �     �  	   �     �  >  �  O        X     r     �  $   �     �     �     �  ,   �     +     8     >  H   E     �  ;   �  8   �  #     	   8!  	   B!     L!     S!  "   `!     �!     �!     �!  #   �!  %   �!  #   "     ;"     C"  N   K"  m   �"  o   #  "  x#     �%     �%     �%     �%     �%     �%     �%  %   &     +&     1&     6&     <&     J&  	   \&     f&     s&  	   v&     �&  	   �&     �&     �&     �&     �&  .   �&  2   �&     *'     G'  2   f'  C   �'  	   �'     �'     �'     (  �   (  
   �(     �(  T  )     [*     b*  *   j*  -   �*     �*     �*  �  �*  �  �-  �   S0  B   �0  6   !1     X1     _1     t1     �1     �1     �1     �1     �1     �1     2     2     "2     +2     22     >2  #   Q2     u2  
   �2     �2     �2     �2  �   �2  	   ~3  "   �3  E   �3     �3  1   �3  &   ,4     S4     h4  
   w4         e      T           !   D   c   %   K      (   6   B   5   Z   n   >              ,   &            J          W   M   -          '              ;   S   ^           q      ]   l   \   A               
          =   g   p              P       9           R   7      `         k         b   *       N             C   _   :          I   #   Y   E   "       @   d      f   )   8   h   .   3            r      $   1   +   2   U               0              O   H   V   j                  [       F       L               a       <   m   X   ?       4   /       o          G   i   	           Q        %sWARNING:%s No time defined for this condition, please review --Select a Group-- : Time Condition Override Actions Add New Time Group... Add Time Add Time Condition Add Time Group Add a time for this time condition Applications April August Cannot remove the only rule. At least 1 rule is required. Change Override Checking for old timeconditions to upgrade.. Could not delete time group as it is in use Creates a condition where calls will go to one of two destinations (eg, an extension, IVR, ring group..) based on the time and/or date. This can be used for example to ring a receptionist during the day, or go directly to an IVR at night. Current December Delete Description Destination if time does not matche Destination if time matches Destination matches Destination non-matches ERROR: failed to convert field  Edit Time Condition: %s (%s) Enable Maintenance Polling February Friday Give this Time Condition a brief name to help you identify it. If set dialing the feature code will require a pin to change the override state If set the hint will be INUSE if the time condition is matched, and NOT_INUSE if it fails If set to false, this will override the execution of the Time Conditions maintenance task launched by call files. If all the feature codes for time conditions are disabled, the maintenance task will not be launched anyhow. Setting this to false would be fairly un-common. You may want to set this temporarily if debugging a system to avoid the periodic dialplan running through the CLI that the maintenance task launches and can be distracting. Invert BLF Hint January July June Linked Time Group List Time Conditions List Time Groups Maintenance Polling Interval March May Monday Month Day finish Month Day start Month finish Month start No No Override Not received November OK October Override Code Pin Override State Permanent Override matching state Permanent Override unmatching state Permanently matched Permanently unmatched Please enter a valid Override Code Pin Please enter a valid Time Conditions Name Reset Reset Override Saturday Select a Group Select a Time Group created under Time Groups. Matching times will be sent to matching destination. If no group is selected, call will always go to no-match destination. September Server time: Specify the time zone by name if the destinations are in a different time zone than the server. Type two characters to start an auto-complete pick-list. <br/><strong>Important</strong>: Your selection here <strong>MUST</strong> appear in the pick-list or in the /usr/share/zoneinfo/ directory. Submit Sunday Temporary Override matching state Temporary Override unmatching state Temporary matched Temporary unmatched The polling interval in seconds used by the Time Conditions maintenance task, launched by an Asterisk call file used to update Time Conditions override states as well as keep custom device state hint values up-to-date when being used with BLF. A shorter interval will assure that BLF keys states are accurate. The interval should be less than the shortest configured span between two time condition states, so that a manual override during such a period is properly reset when the new period starts. This Time Condition can be set to Temporarily go to the 'matched' or 'unmatched' destination in which case the override will automatically reset once the current time span has elapsed. If set to Permanent it will stay overridden until manually reset. All overrides can be removed with the Reset Override option. Temporary Overrides can also be toggled with the %s feature code, which will also remove a Permanent Override if set but can not set a Permanent Override which must be done here or with other applications such as an XML based phone options. This section will be removed from this time group and all current settings including changes will be updated. OK to proceed? This time group is currently in use and cannot be deleted This will display as the name of this Time Group Thursday Time Condition Time Condition Module Time Condition name Time Condition: %s Time Conditions Time Group Time Groups Time Zone: Time to Start Time to finish Time(s) Tuesday Unchanged Unknown State Upgraded %s and created group %s Use System Timezone Wednesday Week Day Start Week Day finish Yes You have not selected a time group to associate with this timecondition. It will go to the un-matching destination until you update it with a valid group already exists checking for generate_hint field.. converting timeconditions time field to int.. false goto generating feature codes if needed.. no upgrade needed starting migration true goto unnamed Project-Id-Version: FreePBX - módulo timeconditions module spanish translation
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2020-08-19 10:40+0000
PO-Revision-Date: 2016-12-11 01:54+0200
Last-Translator: Ernesto <ecasas@sangoma.com>
Language-Team: Spanish <http://weblate.freepbx.org/projects/freepbx/timeconditions/es_ES/>
Language: es_ES
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 2.4
X-Poedit-Language: Spanish
X-Poedit-Country: SPAIN
X-Poedit-SourceCharset: utf-8
 %sATENCIÓN:%s No se han definido horas para esta condición; por favor, revise -- Seleccione un grupo -- : Condición horaria anulada Acciones Agregar un nuevo Grupo de Horario... Agregar horario Agregar Condición Horaria Añadir grupo horario Agregar horario para esta condición horaria Aplicaciones Abril Agosto No se puede eliminar la única regla. Siempre debe existir al menos una. Sustituir cambio Comprobando condiciones horarias antiguas que actualizar... No se puede eliminar el Grupo Horario porque esta en uso Crea una condición en la que las llamadas irán a uno de los dos destinos (por ejemplo, una extensión, IVR, grupo de timbrado..) en función de la hora y/o la fecha. Esto se puede utilizar por ejemplo para llamar a un recepcionista durante el día, o ir directamente a un IVR por la noche. Corriente Diciembre Borrar Descripción Destino si el horario no coinciden Destino si la hora coincide Destinos en horario Destinos fuera de horario Error: fallo al convertir el campo  Editar Condiciones de horario:%s (%s) Habilitar Mantenimiento de Encuesta Febrero Viernes Déle a esta condición horaria un nombre breve para ayudarle a identificarlo. Si establece marcación, el código de característica requerirá un pin para cambiar el estado de anulación Si se establece, la sugerencia (hint) será INUSE si la condición horaria coincide, y NOT_INUSE si no coincide Si se establece en falso, se anulará la ejecución de la tarea de mantenimiento de las condiciones horarias iniciada por los archivos de llamada. Si todos los códigos de función para las condiciones horarias están desactivados, la tarea de mantenimiento no se iniciará de todos modos. Poner esto en falso sería bastante poco común. Es posible que desee establecer esto temporalmente si depura un sistema para evitar que el dial plan en forma periódica  ejecuta a través de la CLI que se inicie la tarea de mantenimiento y puede distraer. Invertir el BLF Enero Julio Junio Grupo Horario Enlazado Lista Condiciones Horarias Lista Grupos Horarios Intervalo de Polling de Mantenimiento Marzo Mayo Lunes Mes Dia Final Mes Día comienzo Mes final Mes Comienzo No No Anular No recibido Noviembre Hecho Octubre Pin de Anular Código Anular Estado Estado de coincidencia de reemplazo permanente Estado de no-coincidencia de anulación permanente Permanentemente  Coincidente Permanentemente no coincidente Introduzca un Pin de código de anulación válido Por favor, introduzca un nombre para la condición horaria válido. Reiniciar Anulación Reiniciar Sábado Seleccione un Grupo Seleccione un grupo horario creado en Grupos de horario. Los tiempos de coincidencia se enviarán al destino coincidente. Si no se selecciona ningún grupo, la llamada siempre irá al destino sin coincidencia. Septiembre Hora del Server: Especifique la zona horaria por nombre si los destinos están en una zona horaria diferente que el servidor. Escriba dos caracteres para iniciar una lista de selección de autocompletar. <br/><strong> Importante </strong>: Su selección aquí <strong>DEBE</strong> aparecer en la lista de selección o en el directorio /usr/share/zoneinfo/. Enviar Domingo Estado Anulación de Coincidencia Temporal Estado Anulación de no-Coincidencia Temporal Temporalmente Coincide Temporalmente no Coincide El intervalo de sondeo en segundos utilizado por la tarea de mantenimiento de las condiciones de tiempo, iniciado por un archivo de llamada de asterisco utilizado para actualizar los estados de anulación de condiciones de tiempo, así como mantener actualizados los valores de sugerencias de estado de dispositivos personalizados cuando se utiliza con BLF. Un intervalo más corto asegurará que los estados de las llaves BLF sean exactos. El intervalo debe ser menor que el intervalo configurado más corto entre dos estados de condición de tiempo, de modo que una anulación manual durante dicho periodo se restablezca correctamente cuando se inicia el nuevo período. Esta condición de tiempo se puede configurar para ir temporalmente al destino "emparejado" o "no coincidente", en cuyo caso la anulación se restablecerá automáticamente una vez transcurrido el lapso de tiempo actual. Si se establece en Permanente permanecerá anulado hasta que se restablezca manualmente. Todas las anulaciones se pueden eliminar con la opción Restablecer anulación. Las modificaciones temporales también se pueden alternar con el código de característica %s, que también eliminará un reemplazo permanente si se establece pero no se puede establecer un reemplazo permanente que debe realizarse aquí o con otras aplicaciones como las opciones de un teléfono basado en XML. Esta sección se eliminará de este grupo horario y se actualizarán todos los ajustes actuales, incluidos los cambios. OK para continuar? Este grupo horario está actualmente en uso y no se puede eliminar Esto se mostrará como el nombre de este grupo horario Jueves Condiciones horarias Modulo Condiciones Horarias Nombre Condición Horaria Condición Horaria: %s Condiciones Horarias Grupo horario Grupos Horarios Zona Horaria: Hora de Inicio Hora de terminar Horas(s) Martes Sin Alterar Estado Desconocido %s actualizadas y %s grupos creados Use zona horaria del sistema Miércoles Semana Día Inicio Semana Día Fin Si No ha seleccionado ningún grupo horario al que asociar esta condición horaria. Esta regla siempre irá al destino que no coincide a menos que la actualice con un grupo horario válido. Ya existe chequeando campo generate_hint ... Convirtiendo el campo de hora de las condiciones horarias a entero... falso ir generando códigos de función de ser necesario.. No es necesaria ninguna actualización Iniciando migración goto verdadero sin nombre 