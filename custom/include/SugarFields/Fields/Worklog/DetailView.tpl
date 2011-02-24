{assign var="value" value={{sugarvar key='value' string=true}} }
{php}
$value = preg_replace("#&lt;(/)?b&gt;#", "<$1b>", $this->_tpl_vars['value']);
echo nl2br($value);
{/php}