{if !empty({{sugarvar key='value' string=true}})}
    {{if empty($displayParams.textonly)}}{{sugarvar_regex key='value' search="#&lt;(/)?b&gt;#" replace='<$1b>' htmlentitydecode='true'}}{{else}}{{sugarvar key='value'}}{{/if}}
    <br /><br />
{/if}
<h4>Enter New Work Log</h4>
<textarea id='{{sugarvar key='name'}}_worklog' name='{{sugarvar key='name'}}_worklog' tabindex='{{$tabindex}}' cols="120" rows="6"></textarea>