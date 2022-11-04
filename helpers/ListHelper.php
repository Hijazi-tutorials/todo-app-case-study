<?php

class ListHelper
{
    /**
     * @throws Exception if key isn't exist & default isn't provided
     */
    public static function getValue(string $key, array $list, string $default = null): string
    {
        if (!in_array($key, array_keys($list)) && !$default) {
            throw new Exception("key of list isn't exist, passing the `\$default` param to handle this exception.");
        }

        return $list[$key] ?? $default;
    }

    /**
     * @throws Exception if $key isn't in configuration
     */
    public static function getConfigurationValue(string $key, array $configurations) {
        try {
            return self::getValue($key, $configurations);
        } catch (Exception $e) {
            throw new Exception("[OVERRIDE]: Add `$key` config value to your local configuration.");
        }
    }
}