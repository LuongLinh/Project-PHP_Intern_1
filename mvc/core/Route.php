<?php
class Route
{

    function handleRouteMiddlewares($url)
    {
        global $routes;
        unset($routes["default_controller"]);

        $url = trim($url, "/");

        if (empty($url)) {
            $url = "/";
        }
        $handleUrl = $url;

        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match("~" . $key . "~is", $url)) {
                    if (!empty($value["middlewares"])) {
                        if (is_array($value["middlewares"])) {
                            $handleUrl = $value["middlewares"];
                        } else {
                            $urlMiddlewares = $value["middlewares"];
                            $handleUrl = config(("middlewares." . $urlMiddlewares . ""));
                        }
                    }
                }
            }
        }
        return $handleUrl;
    }

    function handleRouteController($url)
    {
        global $routes;
        unset($routes["default_controller"]);

        $url = trim($url, "/");

        if (empty($url)) {
            $url = "/";
        }
        $handleUrl = $url;

        // die;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match("~" . $key . "~is", $url)) {
                    if (!empty($value["action"])) {
                        $handleUrl  = preg_replace("~" . $key . "~is", $value["action"], $url);
                    } else if (empty($value["middlewares"])) {
                        $handleUrl  = preg_replace("~" . $key . "~is", $value, $url);
                    }
                }
            }
        }
        return $handleUrl;
    }
}
