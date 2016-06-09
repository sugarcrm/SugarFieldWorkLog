{convert_worklog log=$vardef.value}
<textarea id="{$vardef.name}" name="{$vardef.name}" rows="{$displayParams.rows|default:3}" cols="{$displayParams.cols|default:20}" title='{$vardef.help}' tabindex="{$tabindex}" {if !empty($vardef.readOnly) || !empty($displayParams.readOnly)}readonly="1"{/if}></textarea>

