��    e      D  �   l      �     �     �     �     �     �     �     �  "   	     *	     7	     =	  9   D	     ~	  +   �	  �   �	     �
     �
     �
     �
  #   �
     �
          !     9     V     q     z  >   �  O   �  Y     �  j     '     7     ?     D     I     ^     o     �     �     �     �     �     �     �     �     �     �     �     �            !   %  #   G     k       &   �  )   �     �     �     �       �     	   �     �  %  �     �       !     #   *     N     `  �  t  (  h  |   �  9     0   H     y     �     �     �     �     �  
   �     �  
   �                     %  	   -     7     E  	   Y     c     r     �  
   �  	   �     �  �  �     j  %   �     �  ,   �     �     �        7   ?  $   w  
   �  
   �  �   �     4  P   P  a  �                       T   /  R   �  .   �  2     *   9  6   d  
   �     �  �   �  �   1   �   �   �  �!      �#     �#  
   �#     �#      �#  %   �#  "   $     1$     :$     ?$     L$     j$     �$     �$     �$     �$     �$     �$  
   �$  "   �$     %  5   6%  9   l%     �%     �%  V   �%  P   5&     �&  !   �&     �&  '   �&  e  �&     P(     _(  �  t(     3*     :*  1   G*  5   y*     �*     �*  �   �*  �  �+  r   \/  f   �/  J   60     �0     �0     �0     �0     �0     �0     1     1     91     S1     e1     y1     �1     �1     �1  4   �1     �1     2     '2     E2     L2     ^2     l2         @   X   \       9       A   /      4   2      ]   #      `       1      L   '   W       F       B   E   H                  3      6       a   %         0   ?   )      "   M      G       $   ^      I                 d       K   >   Q   D       C   R          !          (   .   -   J   
   8           +          	                       N       T          [      b   5   =       Y   ;      :                      P       _               V      Z   ,   <                     S       U   e   c      O   *   7   &    --Select a Group-- : Time Condition Override Actions Add New Time Group... Add Time Add Time Condition Add Time Group Add a time for this time condition Applications April August Cannot remove the only rule. At least 1 rule is required. Change Override Could not delete time group as it is in use Creates a condition where calls will go to one of two destinations (eg, an extension, IVR, ring group..) based on the time and/or date. This can be used for example to ring a receptionist during the day, or go directly to an IVR at night. Current December Delete Description Destination if time does not matche Destination if time matches Destination matches Destination non-matches Edit Time Condition: %s (%s) Enable Maintenance Polling February Friday Give this Time Condition a brief name to help you identify it. If set dialing the feature code will require a pin to change the override state If set the hint will be INUSE if the time condition is matched, and NOT_INUSE if it fails If set to false, this will override the execution of the Time Conditions maintenance task launched by call files. If all the feature codes for time conditions are disabled, the maintenance task will not be launched anyhow. Setting this to false would be fairly un-common. You may want to set this temporarily if debugging a system to avoid the periodic dialplan running through the CLI that the maintenance task launches and can be distracting. Invert BLF Hint January July June List Time Conditions List Time Groups Maintenance Polling Interval March May Monday Month Day finish Month Day start Month finish Month start No No Override Not received November October Override Code Pin Override State Permanent Override matching state Permanent Override unmatching state Permanently matched Permanently unmatched Please enter a valid Override Code Pin Please enter a valid Time Conditions Name Reset Reset Override Saturday Select a Group Select a Time Group created under Time Groups. Matching times will be sent to matching destination. If no group is selected, call will always go to no-match destination. September Server time: Specify the time zone by name if the destinations are in a different time zone than the server. Type two characters to start an auto-complete pick-list. <br/><strong>Important</strong>: Your selection here <strong>MUST</strong> appear in the pick-list or in the /usr/share/zoneinfo/ directory. Submit Sunday Temporary Override matching state Temporary Override unmatching state Temporary matched Temporary unmatched The polling interval in seconds used by the Time Conditions maintenance task, launched by an Asterisk call file used to update Time Conditions override states as well as keep custom device state hint values up-to-date when being used with BLF. A shorter interval will assure that BLF keys states are accurate. The interval should be less than the shortest configured span between two time condition states, so that a manual override during such a period is properly reset when the new period starts. This Time Condition can be set to Temporarily go to the 'matched' or 'unmatched' destination in which case the override will automatically reset once the current time span has elapsed. If set to Permanent it will stay overridden until manually reset. All overrides can be removed with the Reset Override option. Temporary Overrides can also be toggled with the %s feature code, which will also remove a Permanent Override if set but can not set a Permanent Override which must be done here or with other applications such as an XML based phone options. This section will be removed from this time group and all current settings including changes will be updated. OK to proceed? This time group is currently in use and cannot be deleted This will display as the name of this Time Group Thursday Time Condition Time Condition Module Time Condition name Time Condition: %s Time Conditions Time Group Time Groups Time Zone: Time to Start Time to finish Time(s) Tuesday Unchanged Unknown State Use System Timezone Wednesday Week Day Start Week Day finish Yes false goto true goto unnamed Project-Id-Version: PACKAGE VERSION
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2021-10-06 02:40+0000
PO-Revision-Date: 2016-06-22 11:42+0200
Last-Translator: psdk <hyavari26@gmail.com>
Language-Team: Persian (Iran) <http://weblate.freepbx.org/projects/freepbx/timeconditions/fa_IR/>
Language: fa_IR
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Weblate 2.4
 --انتخاب یک گروه-- ：بازنویسی شرط زمانی عملیات افزودن گروه زمانی جدید... افزودن زمان افزودن شرط زمانی افزودن گروه زمانی افزودن زمان برای این شرط زمانی برنامه‌های کاربردی آوریل آگوست نمی توان تنها قانون‌ موجود را حذف کرد. حداقل وجود یک قانون‌ الزامی است. تغییر بازنویسی نمی توان گروه زمانی درحال استفاده را حذف کرد هنگامی که تماس باید بر اساس تاریخ و زمان به یک مقصد هدایت شود، می بایست یک شرط زمانی تعریف کنید. به عنوان مثال در طول روز تماس به یک داخلی هدایت می شود در صورتی که در طول شب به منوی صوتی وصل خواهد شد. فعلی دسامبر حذف توضیحات مقصد تماس در صورتی که زمان همخوانی نداشته باشد مقصد تماس در صورتی که زمان همخوانی داشته باشد مقصد تماس در صورت همخوانی مقصد تماس در صورت ناهمخوانی ویرایش شرط زمانی ： %s (%s) فعال سازی درخواست های نگهداری فوریه جمعه نام کوتاهی برای این شرط زمانی تخصیص دهید تا از این طریق قابل تشخیص باشد. اگر برای شماره گیری کد ویژه تعریف کنید، برای تغییر وضعیت باید کلمه عبور را وارد نمایید اگر این گزینه تنظیم شود، در صورت همخوان بودن شرط زمانی، حالت INUSE برای BLF در نظر گرفته می شود. در غیر اینصورت NOT_INUSE گزینش می شود اگر این مقدار برابر با false ست شود، اجرای شرایط زمانی توسط کال فایل بازنویسی می شود. اگر تمام کدهای ویژه برای شرایط زمانی غیرفعال شوند، پروسه نگهداری اجرا نخواهد شد. تنظیم این مقدار بر روی false اصلا رایج نیست. ممکن است برای دیباگ کردن سیستم مورد استفاده قرار گیرد. معکوس کردن حالت BLF ژانویه جولای ژوئن فهرست شرایط زمانی فهرست گروه های زمانی زمان سرکشی نگهداری مارس می دوشنبه روز پایان در ماه روز شروع در ماه ماه اتمام ماه شروع خیر بدون بازنویسی دریافت نشده نوامبر اکتبر کمله عبور بازنویسی وضعیت بازنویسی بازنویسی وضعیت دائمی همخوانی بازنویسی وضعیت دائمی ناهمخوانی همخوانی دائمی ناهمخوانی دائمی لطفا یک کلمه عبور معتبر برای بازنویسی وارد کنید لطفا یک نام معتبر برای شرایط زمانی وارد کنید بازنشانی بازنویسی بازنشانی شنبه یک گروه انتخاب نمایید یک گروه زمانی از گروه های زمانی انتخاب کنید. تماس های همخوان با زمان به مقصد تعریف شده برای همخوانی ارسال می شوند. اگر گروهی انتخاب نشود، تماس ها همیشه به مقصد تعریف شده برای ناهمخوانی هدایت می شوند. سپتامبر ساعت سرور： اگر سرور در این منطقه زمانی نیست یک منطقه زمانی را برای آن مشخص کنید. برای مشخص کردن منطقه دو کاراکتر ابتدایی را وارد نمایید تا مابقی به صورت خودکار کامل شود. <br/><strong>مهم</strong>: انتخاب شما <strong>باید</strong> در لیست و یا در مسیر /usr/share/zoneinfo/ وجود داشته باشد. ثبت یکشنبه بازنویسی موقت وضعیت همخوان بازنویسی موقت وضعیت ناهمخوان همخوانی موقت ناهمخوانی موقت فواصل زمانی که پروسه سرکشی نگهداری شرایط زمانی توسط استریسک اجرا می شوند. فواصل زمانی کوتاه باعث افزایش دقت وضعیت نمایش BLF ها می شود. شرط زمانی می تواند به صورت موقت به مقصد همخوان یا ناهمخوان از لحاظ زمانی هدایت شود. در این حالت زمانی مه شرط زمانی به اتمام برسد، این وضعیت به صورت خودکار به حالت اصلی بازگردانده می شود. اگر به صورت دائمی تنظیم شود، پس از بازنویسی در همان حالت باقی می ماند تا زمانی که به صورت دستی بازنشانی شود. همه ی بازنویسی ها با گزینه Reset Override بازنشانی می شوند. بازنویسی های موقت نیز از طریق کد ویژه %s تغییر وضعیت داده می شوند حتی اگر به صورت دائمی بازنویسی شده باشد ولی نمی توانند حالت دائمی را از این طریق تنظیم کنند. این بخش از گروه زمانی و تمامی تنظیمات حذف می شود. ادامه می دهید؟ این گروه زمانی درحال استفاده است و نمی توان آن را حذف کرد به عنوان نام گروه زمانی نمایش داده می شود پنج شنبه شرط زمانی ماژول شرط زمانی نام شرط زمانی شرط زمانی ： %s شرایط زمانی گروه زمانی گروه‌های زمانی منطقه زمانی ： زمان شروع زمان پایان زمان (ها) سه‌شنبه بدون تغییر وضعیت نامشخص استفاده از منطقه زمانی سیستم چهارشنبه روز هفته ی شروع روز هفته ی پایان بله goto نادرست goto درست بدون نام 