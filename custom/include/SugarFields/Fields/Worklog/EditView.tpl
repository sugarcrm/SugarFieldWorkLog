{assign var="value" value={{sugarvar key='value' string=true}} }
{php}
if(isset($_POST['isDuplicate']) && $_POST['isDuplicate'] == "true") {
    $value = "";
} else {
    $value = preg_replace("#&lt;(/)?b&gt;#", "<$1b>", $this->_tpl_vars['value']);
}
echo nl2br(url2html($value));
{/php}
<br /><br />
<h4>Enter New Work Log</h4>
<textarea id='{{sugarvar key='name'}}_worklog' name='{{sugarvar key='name'}}_worklog' tabindex='{{$tabindex}}' cols="120" rows="6"></textarea>
