{{if empty($displayParams.textonly)}}{{sugarvar_regex key='value' search="#&lt;(/)?b&gt;#" replace='<$1b>' htmlentitydecode='true'}}{{else}}{{sugarvar key='value'}}{{/if}}
