<?php

class Connection
{
    private string $connection;

    public function __construct(string $connection)
    {
        $this->connection = $connection;
    }

    public function getConnection() : string
    {
        return $this->connection;
    }
}