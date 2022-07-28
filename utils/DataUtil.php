<?php

namespace Utils;

class DataUtil
{
    const DATABASE_DIR = 'database';
    const PATH = self::DATABASE_DIR . DIRECTORY_SEPARATOR . 'users.json';
    private function __construct() {}

    public static function createRecord(array $record)
    {
        $data = self::getData();
        $data[uniqid()] = $record;
        self::putData($data);
    }

    public static function readRecord(array $record)
    {
        $data = self::getData();
        if ($data)
        {
            foreach ($data as $user)
            {
                if (isset($record['login']))
                {
                    if ($user['login'] == $record['login'])
                    {
                        return $user;
                    }
                }
                elseif (isset($record['email']))
                {
                    if ($user['email'] == $record['email'])
                    {
                        return $user;
                    }
                }
            }
        }
        return Null;
    }

    public static function updateRecord(array $record)
    {
        self::changeData($record);
    }

    public static function deleteRecord(array $record)
    {
        self::changeData($record, true);
    }

    private static function getData()
    {
        self::checkPath();
        $data = file_get_contents(self::PATH);
        if ($data)
        {
            return json_decode($data, true);
        }
        else
        {
            return Null;
        }
    }

    private static function putData($data)
    {
        self::checkPath();
        $data = json_encode($data);
        file_put_contents(self::PATH, $data);
    }

    private static function changeData(array $record, bool $delete = false)
    {
        $data = self::getData();
        foreach ($data as $key => $user)
        {
            if ($user['login'] == $record['login'])
            {
                if (!$delete)
                {
                    $data[$key] = $record;
                }
                elseif ($delete)
                {
                    unset($data[$key]);
                }
            }
            self::putData($data);
        }
    }
    private static function checkPath()
    {
        if(!file_exists(DataUtil::DATABASE_DIR))
        {
            mkdir('/database');
        }
        if(!file_exists(self::PATH))
        {
            file_put_contents(self::PATH,"");
        }
    }
}
