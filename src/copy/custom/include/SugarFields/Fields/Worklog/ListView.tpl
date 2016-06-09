{capture name=worklog assign=log}{sugar_fetch object=$parentFieldArray key=$col}{/capture}
{convert_worklog log=$log}