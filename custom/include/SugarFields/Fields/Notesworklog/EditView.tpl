<!-- include anything that is in the field -->
{if !empty({{sugarvar key='value' string=true}})}
    {{if empty($displayParams.textonly)}}{{sugarvar_regex key='value' search="#&lt;(/)?b&gt;#" replace='<$1b>' htmlentitydecode='true'}}{{else}}{{sugarvar key='value'}}{{/if}}
    <br /><br />
{/if}
<!-- include anything that is in the field -->

{sugar_load_worklog var=notes_{{$vardef.name}} module=$module id=${{$parentFieldArray}}.id.value }

{foreach from=$notes_{{$vardef.name}} item=note name={{$vardef.name}}_loop }
    <strong>{$note.name} on {$note.created}</strong><br>
    {if $note.is_updated eq true}
        <small>Updated by {$note.updated_by} on {$note.updated}</small><br />
    {/if}
    {$note.note|url2html|nl2br}
    <br /><br />
{/foreach}
<h4>Enter New Work Log</h4>
<textarea id='{{sugarvar key='name'}}_worklog' name='{{sugarvar key='name'}}_worklog' tabindex='{{$tabindex}}' cols="120" rows="6"></textarea>
