��    ^           �      �     �          &     .     7     J  "   Y     |     �     �  9   �     �  �   �     �	     �	     �	     �	  #   �	     
     3
     G
     _
     |
     �
     �
  >   �
  O   �
  Y   6  �  �     M     ]     e     j     o     �     �     �     �     �     �     �     �     �     �                       !   /  #   Q     u     �  &   �  )   �     �     �       �     	   �     �  %  �     �     �  !     #   %     I     [  �  o  (  c  |   �  0   	     :     C     R     h     |     �  
   �     �  
   �     �     �     �     �  	   �     �       	        $     3     C  
   G  	   R    \     c  ;   �     �     �  2   �  0     Q   P     �     �     �  �   �  /   s  (  �     �     �     �     �  x   
  T   �  a   �  f   :  E   �  C   �     +      :   �   I   �   �   �   �!  G  9"  1   �%     �%     �%     �%  .   �%  *   &  ;   ,&     h&     q&     x&  D   �&  =   �&  E   '  A   X'     �'  !   �'     �'     �'  #   �'  K   (  k   O(  )   �(  +   �(  2   )  `   D)  
   �)     �)     �)  �  �)     �+  )   �+    �+     �-     �-  I   
.  M   T.  '   �.  +   �.  �  �.  $  �2    7  Y   8     o8  "   ~8  -   �8  *   �8  &   �8  "   !9     D9     d9     �9     �9     �9  
   �9     �9     �9  )   :  K   6:  
   �:  "   �:  (   �:     �:  !   �:  %    ;             C   +   8                M   L      I           6   R   
      ?             )   D   V   $   B   ;                        H          K          T       W       9       X   '       <   3   \      %          5           "                 0       !   =       >   Y      7   A                 Q      .   ]          N       P   -   4   ,      E       U   J   (      Z   1   O          [              F         :   ^   2       	   /      G   S       &   #   *   @            --Select a Group-- : Time Condition Override Actions Add Time Add Time Condition Add Time Group Add a time for this time condition Applications April August Cannot remove the only rule. At least 1 rule is required. Change Override Creates a condition where calls will go to one of two destinations (eg, an extension, IVR, ring group..) based on the time and/or date. This can be used for example to ring a receptionist during the day, or go directly to an IVR at night. Current December Delete Description Destination if time does not matche Destination if time matches Destination matches Destination non-matches Edit Time Condition: %s (%s) Enable Maintenance Polling February Friday Give this Time Condition a brief name to help you identify it. If set dialing the feature code will require a pin to change the override state If set the hint will be INUSE if the time condition is matched, and NOT_INUSE if it fails If set to false, this will override the execution of the Time Conditions maintenance task launched by call files. If all the feature codes for time conditions are disabled, the maintenance task will not be launched anyhow. Setting this to false would be fairly un-common. You may want to set this temporarily if debugging a system to avoid the periodic dialplan running through the CLI that the maintenance task launches and can be distracting. Invert BLF Hint January July June List Time Conditions List Time Groups Maintenance Polling Interval March May Monday Month Day finish Month Day start Month finish Month start No No Override November October Override Code Pin Permanent Override matching state Permanent Override unmatching state Permanently matched Permanently unmatched Please enter a valid Override Code Pin Please enter a valid Time Conditions Name Reset Reset Override Saturday Select a Time Group created under Time Groups. Matching times will be sent to matching destination. If no group is selected, call will always go to no-match destination. September Server time: Specify the time zone by name if the destinations are in a different time zone than the server. Type two characters to start an auto-complete pick-list. <br/><strong>Important</strong>: Your selection here <strong>MUST</strong> appear in the pick-list or in the /usr/share/zoneinfo/ directory. Submit Sunday Temporary Override matching state Temporary Override unmatching state Temporary matched Temporary unmatched The polling interval in seconds used by the Time Conditions maintenance task, launched by an Asterisk call file used to update Time Conditions override states as well as keep custom device state hint values up-to-date when being used with BLF. A shorter interval will assure that BLF keys states are accurate. The interval should be less than the shortest configured span between two time condition states, so that a manual override during such a period is properly reset when the new period starts. This Time Condition can be set to Temporarily go to the 'matched' or 'unmatched' destination in which case the override will automatically reset once the current time span has elapsed. If set to Permanent it will stay overridden until manually reset. All overrides can be removed with the Reset Override option. Temporary Overrides can also be toggled with the %s feature code, which will also remove a Permanent Override if set but can not set a Permanent Override which must be done here or with other applications such as an XML based phone options. This section will be removed from this time group and all current settings including changes will be updated. OK to proceed? This will display as the name of this Time Group Thursday Time Condition Time Condition Module Time Condition name Time Condition: %s Time Conditions Time Group Time Groups Time Zone: Time to Start Time to finish Time(s) Tuesday Unchanged Unknown State Use System Timezone Wednesday Week Day Start Week Day finish Yes false goto true goto Project-Id-Version: 1.3
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2019-02-21 23:41-0500
PO-Revision-Date: 2015-12-08 23:11+0200
Last-Translator: Andrew <andrew.nagy@the159.com>
Language-Team: Russian <http://weblate.freepbx.org/projects/freepbx/timeconditions/ru_RU/>
Language: ru_RU
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=3; plural=n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2;
X-Generator: Weblate 2.2-dev
 --Выбрать группу-- Перезаписать Правила по времени Действие Добавить время Добавить временное правило Добавить временную группу Добавить время для этого  условия по времени Приложения Апрель Август Невозможно удалить единственное правило. Должно существовать как минимум одно правило. Переопределить изменения Создаёт условия, при котором вызов будет распределяться на одно и более назначение (например внутренний номер, Интеркативное меню, ринг-группа..) основываяь на текущем времени/дате. Это можно использовать например направляя входящие вызовы секретарю в рабочее время, и на Интерактивное меню - в ночное. Текущее Декабрь Удалить Описание Направление вызова если текущее  время не соответствует условиям Назначение, если попадает во временную группу Назначение ,  если текущее  время  попадает в интервал Назначение ,  если текущее  время  не попадает в интервал Редактировать временные условия :%s (%s) Задействовать опрос по обслуживанию Февраль Пятница Хорошо бы присвоить какое-то описание для Правила по времени, это поможет в дальнейшем. Если установлено, набор кода функции потребует ПИН, чтобы изменить состояние переопределения Если установлено, индикатор будет InUse если условие по времени совпадают, и NOT_INUSE, если нет Если установлено в ложь, это переопределит выполнение задачи обслуживания правил по времени, начатой файлами звонков. Если все идентификационные коды для правил по времени будут отключены, то в этом случае задача обслуживания не будет начата. Установка этого в Ложь было бы несколько странно. Вы можете установить это в Ложь временно, отлаживая систему, чтобы избежать периодического отслеживания запуска задач обслуживания диалплана в CLI и не отвлекаться. Инвертировать BLF индикатор Январь Июль Июнь Список временных условий Список временных групп Интервал опроса по обслуживанию Март Май Понедельник День окончания  временного интервала День начала временного интервала Месяц окончания временного интервала Месяца начала временного интервала Нет Не перезаписывать Ноябрь Октябрь Переопределить ПИН Постоянно перезаписывать при совпадении Долговременное переопределение несоответствия состояния Постоянное совпадение Временное несовпадение Пожалуйста введите  пин-код Выбрать разрешённое название для Правила по времени Сброс Сброс перезаписи Суббота Выбрать группу из списка временных групп. В указаный временной интервал звонки будут направляться по указанному направлению. Если не выбрано никакой группы, звонки будут всегда направляться по назначению не попадающему в Правило по времени. Сентябрь Точное время (сервера): Пожалуйста введите имя временной зоны если нахначения находятся в других временных зонах по отношению к серверу . Введите первые два символа для выпадающего списка автозаполения . <br/><strong>Важно</strong>:Ваш выбор <strong>ДОЛЖЕН</strong>появиться в выпадающем списке или в директории /usr/share/zoneinfo/. Применить Воскресенье Временно перезаписывать при совпадении Временно перезаписывать при несовпадении Временное совпадение Временное несовпадение Интервал опроса в секундах используется задачей обслуживания правил по времени, запущенный call-файл Астериска используется для обновления правил по времени, переопределения состояния, а так же поддерживать различные состояния индикаторов устройств, использующих BLF. Короткий интервал гарантирует актуальное состояние клавиши BLF. Интервал должен быть меньше, чем самый короткий настроенный промежуток между двумя состояниями правил по времени, так чтобы переопределение во время такого периода уже закончилось, когда начинается новый период. Правило по времени может быть установлено на срабатывание назначения по совпадению или несовпадению, в обоих случаях перенаправление сработает в указанный промежуток времени. Если установлено в положение Постоянное совпадение, то это будет работать до тех пор, пока не будет включен другой режим ручным способом. Все установки могут быть отменены опцией Сброс перезаписи. Временные перезаписи могут быть переключены  при помощи сервисного кода %s, который также удалит и Постоянную перезапись, если она установлена, но не затронет внешние приложения, типа XML-скрипт с телефона. Эта сккция будет удалена из текущей временной группы и всех других установок, включая изменения, которые сейчас будут обновлены. ОК для продолжения? Это будет отображаться  как имя Временной группы Четверг Правило по времени Модуль правил по времени Имя  условия по времени Правило по времени: %s Правила по времени Временная группа Временная группа Часовой пояс: Начало интервала Конец интервала Время Вторник Неизменёный Неизвестное состояние Использовать системную временную группу Среда День недели начала День недели окончания Да переход, если ложь переход, если правда 