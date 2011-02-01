{assign var="value" value={{sugarvar key='value' string=true}} }
{php}
$value = html_entity_decode($this->_tpl_vars['value']);
echo nl2br($value);
{/php}