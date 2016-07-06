<?php

class SugarFieldWorklogHelpers
{
    static $urlREGEX = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+(\/\S*)?/";


    /**
     * Decodes the json or text from the database for display
     * @param $value
     * @return string
     */
    public static function decodeJsonValueForAPI($value, $targetUser = null, $userLink = false)
    {
        if (!is_object($targetUser)) {
            global $current_user;
            $targetUser = $current_user;
        }

        $display = array();
        if (self::isJson($value)) {
            $worklogs = json_decode($value, true);
            foreach ($worklogs as $worklog) {

                if (isset($worklog['usr']) && isset($worklog['tsp'])) {
                    $display[$worklog['tsp']]['date'] = self::getDateTimeString($worklog['tsp'], $targetUser);
                    $display[$worklog['tsp']]['user']['id'] = $worklog['usr'];
                    $display[$worklog['tsp']]['user']['id'] = $worklog['usr'];

                    $string = '<small><strong>';
                    $string .= self::getUserString($worklog['usr'], $userLink);
                    $string .= " on ";
                    $string .= self::getDateTimeString($worklog['tsp'], $targetUser);
                    $string .= '</strong></small>';
                }

                if (isset($worklog['msg'])) {
                    if (!isset($worklog['tsp']) || $worklog['tsp'] == 0) {
                        $string .= self::getMessageString($worklog['msg']);
                    } else {
                        $string .= self::getMessageString(htmlspecialchars($worklog['msg'], ENT_QUOTES));
                    }
                }

                $display[$worklog['tsp']] = $string;
            }
        } else {
            $display[0] = self::getMessageString($value);
        }

        return $display;
    }

    /**
     * Decodes the json or text from the database for display
     * @param $value
     * @return string
     */
    public static function decodeJsonValue($value, $targetUser = null, $userLink = false)
    {
        if (!is_object($targetUser)) {
            global $current_user;
            $targetUser = $current_user;
        }

        $display = array();
        if (self::isJson($value)) {
            $worklogs = json_decode($value, true);
            foreach ($worklogs as $worklog) {
                $string = '';
                if (isset($worklog['usr']) && isset($worklog['tsp'])) {
                    $string .= '<small><strong>';
                    $string .= self::getUserString($worklog['usr'], $userLink);
                    $string .= " on ";
                    $string .= self::getDateTimeString($worklog['tsp'], $targetUser);
                    $string .= '</strong></small>';
                }

                if (isset($worklog['msg'])) {
                    if (!isset($worklog['tsp']) || $worklog['tsp'] == 0) {
                        $string .= self::getMessageString($worklog['msg']);
                    } else {
                        $string .= self::getMessageString(htmlspecialchars($worklog['msg'], ENT_QUOTES));
                    }
                }

                $display[$worklog['tsp']] = $string;
            }
        } else {
            $display[0] = self::getMessageString($value);
        }

        return implode('<br/><br/>', $display);
    }

    /**
     * Generates the message format for a log
     * @param $string
     * @return string
     */
    public static function getMessageString($string, $replace = "<br>")
    {
        $string = self::parseURLS($string);
        $string = preg_replace("/\r\n|\r|\n/", $replace, $string);

        return '<br>' . $string;
    }

    /**
     * Parses a string to determine if old formats of sugar urls are present.
     * If present, reformats the url for the user.
     * @param $string
     * @return mixed
     */
    public static function parseURLS($string)
    {
        $replacements = array();
        if (preg_match_all(self::$urlREGEX, $string, $urls)) {

            if (isset($urls[0])) {
                foreach ($urls[0] as $url) {
                    $replacements[$url] = self::reformatURL($url);
                }
            }
        }

        foreach ($replacements as $url => $replacement) {
            if ($url !== $replacement) {
                $string = str_replace($url, $replacement, $string);
            }
        }

        return $string;
    }

    /**
     * Reformats a sugar url to meet sidecar rules
     * @param $url
     * @return string
     */
    public static function reformatURL($url)
    {
        global $sugar_config;
        $site_url = str_replace("http://", '', $sugar_config['site_url']);
        $site_url = str_replace("https://", '', $site_url);
        if (!self::hasString($site_url, $url)) {
            return self::setClickableURLs($url);
        }

        $original_url = $url;
        $properties = parse_url($url);

        $module = '';
        $record = '';
        $action = '';

        //if ajax
        if (isset($properties['fragment'])) {
            if (self::hasString("ajaxUILoc=", $properties['fragment'])) {
                $decoded = urldecode(str_replace("ajaxUILoc=index.php%3F", '', $properties['fragment']));
                parse_str($decoded);
            } else if (self::hasString("module=Home&amp;action=index", $properties['query']) && !empty($properties['fragment'])) {
                return self::setClickableURLs($url);
            } else if (self::hasString("bwc/index.php", $properties['fragment'])) {
                //url is already bwc
                return self::setClickableURLs($url);
            }
        } //if query string
        else if (isset($properties['query'])) {
            if (self::hasString("index.php", $properties['path'])) {
                parse_str(str_replace("index.php?", '', $properties['query']));
            }
        }

        if (isModuleBWC($module) && !self::hasString("#bwc", $url)) {
            $url = self::setClickableURLs(rtrim($sugar_config['site_url'], '/') . "/#bwc/index.php?module={$module}&action={$action}&record={$record}");
        } else if (!isModuleBWC($module) && self::hasString(array("index.php/#", "index.php#"), $url)) {
            //ignore as this is a valid url
            $url = self::setClickableURLs($url);
        } else if (!isModuleBWC($module) && self::hasString("index.php", $url)) {
            $url = self::setClickableURLs(rtrim($sugar_config['site_url'], '/') . "/#" . buildSidecarRoute($module, $record, $action));
        }

        if ($original_url != $url) {
            if (version_compare($GLOBALS['sugar_version'], '7.6', '<')) {
                return trim($url) . '<a href="javacript:void(0)" class="btn btn-invisible worklog-popovers" rel="popover" data-content="' . $original_url . '" data-original-title="Parsed from:"><i class="icon-info-sign"></i></a>';
            } else {
                return trim($url) . '<a href="javacript:void(0)" class="btn btn-invisible worklog-popovers" rel="popover" data-content="' . $original_url . '" data-original-title="Parsed from:"><i class="fa-info"></i></a>';
            }
        }

        return self::setClickableURLs($url);
    }

    /**
     * Add the clickable anchor for urls
     * @param $string
     * @return mixed
     */
    public static function setClickableURLs($string)
    {
        return preg_replace(self::$urlREGEX, "<a href=\"\\0\" target=\"_blank\">\\0</a>", $string);
    }

    /**
     * Generates the user string for a log
     * @param $userId
     * @return string
     */
    public static function getUserString($userId, $asLink = true)
    {
        $user = BeanFactory::getBean("Users", $userId);
        if ($asLink) {
            return "<a href=\"#bwc/index.php?module=Employees&action=DetailView&record={$user->id}\" data-original-title=\"{$user->full_name}\">{$user->full_name}</a>";
        } else {
            return $user->full_name;
        }
    }

    /**
     * Generates the timestamp for a log
     * @param $timestamp
     * @return string
     */
    public static function getDateTimeString($timestamp, $user)
    {
        global $timedate;
        return $timedate->asUser($timedate->fromTimestamp($timestamp), $user);
    }

    /**
     * Determines if a string is json
     * @param $string
     * @return bool
     */
    public static function isJson($string)
    {
        return (
        (
            is_string($string)
            &&
            (
                is_object(json_decode($string))
                || is_array(json_decode($string))
            )
        )
        ) ? true : false;
    }

    /**
     * Determines if a string contains a substring
     *
     * @param $needles
     * @param $haystack
     * @return bool
     */
    public static function hasString($needles, $haystack)
    {
        if (!is_array($needles)) {
            $needles = array($needles);
        }

        $found = false;
        foreach ($needles as $needle) {
            $needle = strtoupper($needle);
            $haystack = strtoupper($haystack);
            $position = strpos($haystack, $needle);
            if ($position === false) {
                //do nothing
            } else {
                $found = true;
                break;
            }
        }

        return $found;
    }

    /**
     * This method adds an entry with the given string to the given bean and attribute.  This
     * function assumes the given field name of the given bean is a worklog field.
     */
    public static function addLogEntry($bean, $field, $logEntry, $userId = '')
    {
        $value = '';
        $worklogs = array();
        if (!empty($bean->id) && (!isset($bean->new_with_id) || $bean->new_with_id == false)) {
            if (isset($bean->fetched_row[$field]) && !empty($bean->fetched_row[$field])) {
                //if the stored value is json
                if (SugarFieldWorklogHelpers::isJson($bean->fetched_row[$field])) {
                    $value = $bean->fetched_row[$field];
                    $worklogs = json_decode($bean->fetched_row[$field], true);
                } else {
                    $value = $bean->fetched_row[$field];
                    //reformat the db value to add old logs into one message
                    $worklogs[0] = array(
                        'msg' => $bean->fetched_row[$field],
                    );
                }
            }
        }
        //if weve already updated the worklog during this save and the value is already json
        if (SugarFieldWorklogHelpers::isJson($bean->$field)) {
            $updated = false;
            $worklogAdditions = json_decode($bean->$field, true);
            foreach ($worklogAdditions as $key => $worklogAddition) {
                if (
                    is_array($worklogAddition)
                    && isset($worklogAddition['tsp'])
                    && isset($worklogAddition['usr'])
                    && isset($worklogAddition['msg'])
                ) {
                    $updated = true;
                    $worklogs[$key] = $worklogAddition;
                }
            }

            if ($updated) {
                $value = json_encode($worklogs);
            }
        }
        if (empty($logEntry)) {
            $bean->$field = $value;
        } else {
            if (empty($userId)) {
                global $current_user;
                $userId = $current_user->id;
            }
            $timestamp = time();
            if (isset($worklogs[$timestamp])) {
                $worklogs[$timestamp]['msg'] .= "\n" . $logEntry;
            } else {
                $worklogs[$timestamp] = array(
                    'tsp' => $timestamp,
                    'usr' => $userId,
                    'msg' => $logEntry,
                );
            }
            $bean->$field = json_encode($worklogs);
        }
    }
}
