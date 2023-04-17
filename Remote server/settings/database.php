<?php

    class database
    {
        private static ?mysqli $conn = null;

        /**
         * Starts DB connection when constructed.
         */
        public static function Connect(): void
        {
            //set up here your database credentials, or you can modify the script to include them outside the file, for example an .ENV file.
            $db = mysqli_connect("host", "username", "password", "database_name");
            if ($db->connect_error) {
                die(json_encode(array("errorDesc" => "Database connection error."), JSON_FORCE_OBJECT));
            }

            self::$conn = $db;
        }

        /**
         * Closes connection
         *
         * @return void
         */
        public static function CloseConnection(): void
        {
            if (self::$conn != null && mysqli_ping(self::$conn))
                mysqli_close(self::$conn);
        }

        /**
         * Checks if query generated any results.
         *
         * @param mysqli_result $result
         * @return bool
         */
        public static function Result(mysqli_result $result): bool
        {
            return mysqli_num_rows($result) > 0;
        }

        /**
         * Checks if there were any affected rows by previous query
         *
         * @return bool
         */
        public static function WasAffected(): bool
        {
            return mysqli_affected_rows(self::$conn) > 0;
        }

        /**
         * Remove any special strings from query to prevent SQL-Injection
         *
         * @param string $data
         * @return string
         */
        public static function Escape(string $data): string
        {
            return mysqli_real_escape_string(self::$conn, $data);
        }

        /**
         * Performs a query
         *
         * @param string $query
         * @return bool|mysqli_result
         */
        public static function Query(string $query): bool|mysqli_result
        {
            return mysqli_query(self::$conn, $query);
        }
    }