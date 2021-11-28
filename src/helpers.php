<?php

if ( ! function_exists('set_value_in_array_nested')) {
    /**
     * @throws ErrorException
     */
    function set_value_in_array_nested(array &$array, $key, $value)
    {
        if (strpos($key, '.') === false) {
            if (array_key_exists($key, $array)) {
                return $array[$key] = $value;
            }

            throw new ErrorException("Given key '".$key
                ."' is not found in the default options");
        }

        $keys = explode('.', $key);

        foreach ($keys as $i => $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                if (count($keys) === 1) {
                    break;
                }

                unset($keys[$i]);

                // set pointer to access array element
                $array = &$array[$segment];

                continue;
            }

            throw new ErrorException("Given key '".$segment."' is not found in the default options");
        }

        $array[end($keys)] = $value;

        return $array;
    }

    if ( ! function_exists('slugify')) {
        /**
         * String slug
         *
         * @param $title
         * @param  string  $separator
         *
         * @return string
         */
        function slugify($title, string $separator = '-'): string
        {
            // Convert all dashes/underscores into separator
            $flip = $separator === '-' ? '_' : '-';

            $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

            // Replace @ with the word 'at'
            $title = str_replace('@', $separator.'at'.$separator, $title);

            // Remove all characters that are not the separator, letters, numbers, or whitespace.
            $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', strtolower($title));

            // Replace all separator characters and whitespace by a single separator
            $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

            return trim($title, $separator);
        }
    }
}

if ( ! function_exists('has_spacial_char')) {
    function has_spacial_char($my_string)
    {
        $pattern = '/[\'^£$%&*()}{@#~:?><,|=_+¬-]/';

        return preg_match($pattern, $my_string);
    }
}