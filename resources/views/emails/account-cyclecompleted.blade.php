@component('mail::message')
<p>Hi {{ $content[0]->name }},</p>
<p>You did it once again!&nbsp;<strong><strong>You've just cycle out of {{ json_decode(App\Helpers::settings('matrix_levels'), true)[$content[1]] }} into {{ json_decode(App\Helpers::settings('matrix_levels'), true)[$content[2]] }} in ISCUBE COMMUNITY, congratulations!</strong></strong></p>
<p>Remember to keep your login details safe, as you may need it in the future.</p>
<p>Your cash bonuses and incentives can be seen here: <a href="https://iscubenetworks.com/matrix/incentives"><u>https://iscubenetworks.com/matrix/incentives</u></a>&nbsp;</p>
<p>&nbsp;</p>
<p>Having trouble accessing your account? Please contact us at <a href="mailto:admin@iscubenetworks.com"><u>admin@iscubenetworks.com</u></a>&nbsp;</p>
<p>&nbsp;</p>
<p>This is an automated message. Please do not reply.</p>
<p>Thank you.</p>
<p>&nbsp;</p>
<p>To your success, all the best!</p>
<p><strong><strong>Iscube Admin</strong></strong></p>
@endcomponent
