<?php

class ShouldException extends InvalidArgumentException {}

class Should_Not extends Should {
    protected static $neg = true;

    public static function throw_exception($fn, $klass=null,
                                           $emsg=null, $msg=null) {
        $msg = $klass;
        try {
            $fn();
        } catch (Exception $e) {
            static::fail($msg);
        }
    }
}

class Should {
    protected static $neg = false;

    protected static function assert($expr, $msg=null) {
        if (!!$expr === static::$neg) {
            throw new ShouldException($msg);
        }
    }

    public static function fail($msg) {
        throw new ShouldException($msg);
    }

    public static function eq($x, $y, $msg) {
        static::assert($x == $y, $msg);
    }

    public static function gt($x, $y, $msg) {
        static::assert($x > $y, $msg);
    }

    public static function ge($x, $y, $msg) {
        static::assert($x >= $y, $msg);
    }

    public static function lt($x, $y, $msg) {
        static::assert($x < $y, $msg);
    }

    public static function le($x, $y, $msg) {
        static::assert($x <= $y, $msg);
    }

    public static function be_ok($expr, $msg=null) {
        static::assert($expr, $msg);
    }

    public static function be_true($expr, $msg=null) {
        static::assert($expr === true, $msg);
    }

    public static function be_false($expr, $msg=null) {
        static::assert($expr === false, $msg);
    }

    public static function be_empty($expr, $msg=null) {
        static::assert(empty($expr), $msg);
    }

    public static function be_array($expr, $msg=null) {
        static::assert(is_array($expr), $msg);
    }

    public static function be_bool($expr, $msg=null) {
        static::assert(is_bool($expr), $msg);
    }

    public static function be_callable($expr, $msg=null) {
        static::assert(is_callable($expr), $msg);
    }

    public static function be_double($expr, $msg=null) {
        static::assert(is_double($expr), $msg);
    }

    public static function be_float($expr, $msg=null) {
        static::assert(is_float($expr), $msg);
    }

    public static function be_int($expr, $msg=null) {
        static::assert(is_int($expr), $msg);
    }

    public static function be_integer($expr, $msg=null) {
        static::assert(is_integer($expr), $msg);
    }

    public static function be_long($expr, $msg=null) {
        static::assert(is_long($expr), $msg);
    }

    public static function be_null($expr, $msg=null) {
        static::assert(is_null($expr), $msg);
    }

    public static function be_numeric($expr, $msg=null) {
        static::assert(is_numeric($expr), $msg);
    }

    public static function be_object($expr, $msg=null) {
        static::assert(is_object($expr), $msg);
    }

    public static function be_real($expr, $msg=null) {
        static::assert(is_real($expr), $msg);
    }

    public static function be_resource($expr, $msg=null) {
        static::assert(is_resource($expr), $msg);
    }

    public static function be_scalar($expr, $msg=null) {
        static::assert(is_scalar($expr), $msg);
    }

    public static function be_string($expr, $msg=null) {
        static::assert(is_string($expr), $msg);
    }

    public static function be_set($expr, $msg=null) {
        static::assert(isset($expr), $msg);
    }

    public static function be_a($obj, $class, $msg) {
        static::assert(is_a($obj, $class), $msg);
    }

    public static function be_subclass_of($obj, $class, $msg) {
        static::assert(is_subclass_of($obj, $class), $msg);
    }

    public static function have_key($key, $arr, $msg=null) {
        static::assert(array_key_exists($key, $arr), $msg);
    }

    public static function have_value($value, $arr, $msg=null) {
        static::assert(in_array($value, $arr), $msg);
    }

    public static function have_property($prop, $class, $msg=null) {
        static::assert(property_exists($class, $prop), $msg);
    }

    public static function have_method($method, $obj, $msg=null) {
        static::assert(method_exists($obj, $method), $msg);
    }

    public static function count($arr, $len, $message) {
        static::assert(count($obj) === $len, $msg);
    }

    public static function preg_match($pattern, $subject, $msg) {
        static::assert(preg_match($pattern, $subject), $msg);
    }

    public static function throw_exception($fn, $klass=null,
                                           $emsg=null, $msg=null) {
        try {
            $fn();
        } catch (Exception $e) {
            if($klass) {
                self::be_a($e, $klass, $msg);
            }
            if ($emsg) {
                self::preg_match($emsg, $e->getMessage(), $msg);
            }
            return;
        }
        static::fail($msg);
    }
}
