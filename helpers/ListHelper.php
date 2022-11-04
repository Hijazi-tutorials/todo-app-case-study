<?php

class ListHelper
{
    /**
     * @throws Exception if key isn't exist & default isn't provided
     */
    public static function getValue(string $key, array $list, string $default = null, string $exception_msg = null): string
    {
        if (!in_array($key, array_keys($list)) && !$default) {
            throw new Exception($exception_msg ?? "key of list isn't exist, passing the `\$default` param to handle this exception.");
        }

        return $list[$key] ?? $default;
    }

    public static function getConfigurationValue(string $key, array $configurations) {
        return self::getValue($key, $configurations, null, "[OVERRIDE]: Add `$key` config value to your local configuration.");
    }
}