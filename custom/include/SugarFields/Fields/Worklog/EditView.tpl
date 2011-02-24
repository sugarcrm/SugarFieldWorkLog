{assign var="value" value={{sugarvar key='value' string=true}} }
{php}
$value = preg_replace("#&lt;(/)?b&gt;#", "<$1b>", $this->_tpl_vars['value']);
echo nl2br($value);
{/php}
<br /><br />
<h4>Enter New Work Log</h4>
<textarea id='{{sugarvar key='name'}}_worklog' name='{{sugarvar key='name'}}_worklog' tabindex='{{$tabindex}}' cols="120" rows="6"></textarea>