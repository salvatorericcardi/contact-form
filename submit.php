<?php

$submit = function($input) {
    $response = [];

    # make validation
    foreach ($input as $key => $value) {
        switch ($key) {
            case "name":
                $value = filter_var($value);
                break;
            case "email":
                $value = filter_var($value, FILTER_VALIDATE_EMAIL);
            case "content":
                $value = filter_var(strip_tags($value));
                break;
        }

        $response[$key] = $value;
    }

    return json_encode($response);
};

echo $submit($_POST);