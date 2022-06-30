<?php
    require_once 'DB.php';

    class Bus
    {
        public $id;
        public $route;
        public $meetAt;
        public $code;
        public $driverName;
        public $supervisorName;
        public $supervisorPhoneNumber;
        public $seatsLeft;
        public $timeMove;
        public $timeArrive;
        public $fees;
        public $busObj;
        public $mydb;

        public function __construct()
        {
            $this->mydb = DB::getInstance();
        }

        public function insertNewBus($busRoute, $meetAt, $busCode, $driverName, $supervisorName, $supervisorPhoneNumber, $busSeats, $timeMove, $timeArrive)
        {
            $busRoute = strtolower($busRoute);
            $timeMove = strtolower($timeMove);
            $timeArrive = strtolower($timeArrive);

            $query = "SELECT id FROM bus_routes WHERE name='$busRoute'";
            $queryResult = mysqli_query($this->mydb, $query);
            // if queryResult -->>>
            $rows = mysqli_fetch_assoc($queryResult);
            $routeId = $rows['id'];

            $query = "SELECT * FROM bus_timing WHERE first_time='$timeMove' AND second_time='$timeArrive'";
            $queryResult = mysqli_query($this->mydb, $query);

            if(mysqli_num_rows($queryResult) == 1)
            {
                $rows = mysqli_fetch_assoc($queryResult);
                $busTimingId = $rows['id'];

                $query = "INSERT INTO bus (route_id, bus_timing_id, meet_at, code, driver_name, supervisor_name, seats_left) VALUES ($routeId, $busTimingId, '$meetAt', '$busCode', '$driverName', '$supervisorName', $busSeats)";
                    if($this->mydb->query($query) !== true)
                    {
                        $error = mysqli_error($this->mydb);
                        echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                    }
                    else
                    {
                        $lastId = mysqli_insert_id($this->mydb);

                        $query = "INSERT INTO bus_SV_numbers (bus_id, phone_number) VALUES ($lastId, '$supervisorPhoneNumber')";
                        if($this->mydb->query($query) !== true)
                        {
                            $error = mysqli_error($this->mydb);
                            echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                        }
                        else
                        {
                            echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";
                        }
                    }
            }
            else if(mysqli_num_rows($queryResult) == 0)
            {
                $query = "INSERT INTO bus_timing (first_time, second_time) VALUES ('$timeMove', '$timeArrive')";
                if($this->mydb->query($query) !== true)
                {
                    $error = mysqli_error($this->mydb);
                    echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                    return false;
                }
                else
                {
                    $busTimingId = mysqli_insert_id($this->mydb);

                    $query = "INSERT INTO bus (route_id, bus_timing_id, meet_at, code, driver_name, supervisor_name, seats_left) VALUES ($routeId, $busTimingId, '$meetAt', '$busCode', '$driverName', '$supervisorName', $busSeats)";
                    if($this->mydb->query($query) !== true)
                    {
                        $error = mysqli_error($this->mydb);
                        echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                        return false;
                    }
                    else
                    {
                        $lastId = mysqli_insert_id($this->mydb);

                        $query = "INSERT INTO bus_SV_numbers (bus_id, phone_number) VALUES ($lastId, '$supervisorPhoneNumber')";
                        if($this->mydb->query($query) !== true)
                        {
                            $error = mysqli_error($this->mydb);
                            echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                            return false;
                        }
                        else
                        {
                            echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";
                            return true;
                        }
                    }
                }
            }

            
           
        }

        public function insertNewRoute($routeName, $routeFees)
        {
            $routeName = strtolower($routeName);
            $query = "SELECT * FROM bus_routes WHERE name='$routeName'";
            $queryResult = mysqli_query($this->mydb, $query);
            $numberOfRows = mysqli_num_rows($queryResult);

            if($numberOfRows == 0)
            {
                $query = "INSERT INTO bus_routes (name, fees) VALUE ('$routeName', $routeFees)";
                if($this->mydb->query($query) !== true)
                {
                    $error = mysqli_error($this->mydb);
                    echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>$error</div>";
                }
                else
                {
                    echo "<div style='text-align:center; margin-top:15px;' class='text-success'>Successfully Added</div>";
                }
            }
            else
            {
                echo "<div style='text-align:center; margin-top:15px;' class='text-danger'>This Route is already added.</div>";
            }
        }

        public function checkIfStudentRegistered($studentId)
        {
            $query = "SELECT * FROM students_bus WHERE student_id=$studentId";
            $queryResult = mysqli_query($this->mydb, $query);
            if($queryResult)
            {
                $numberOfRows = mysqli_num_rows($queryResult);
                if($numberOfRows == 1)
                {
                    return mysqli_fetch_assoc($queryResult);
                }
                else
                {
                    return false;
                }
            }
        }

        public function fetchAllBuses()
        {
            $query = "SELECT b.id, br.name, b.meet_at, b.code, b.driver_name, b.supervisor_name, bsn.phone_number, b.seats_left, bt.first_time, bt.second_time, br.fees
                        FROM bus b
                        JOIN bus_routes br
                        ON b.route_id = br.id
                        JOIN bus_SV_numbers bsn
                        ON  bsn.bus_id = b.id
                        JOIN bus_timing bt
                        ON bt.id = b.bus_timing_id
                        ORDER BY br.id, bt.first_time, bt.second_time, seats_left DESC, name";
            $queryResult = mysqli_query($this->mydb, $query);
            $busesArr = array();
            while($row = mysqli_fetch_assoc($queryResult))
            {
                $this->busObj = new Bus();
                $this->busObj->id = $row['id'];
                $this->busObj->route = $row['name'];
                $this->busObj->meetAt = $row['meet_at'];
                $this->busObj->code = $row['code'];
                $this->busObj->driverName = $row['driver_name'];
                $this->busObj->supervisorName = $row['supervisor_name'];
                $this->busObj->supervisorPhoneNumber = $row['phone_number'];
                $this->busObj->seatsLeft = $row['seats_left'];
                $this->busObj->timeMove = $row['first_time'];
                $this->busObj->timeArrive = $row['second_time'];
                $this->busObj->fees = $row['fees'];
                $busesArr[] = $this->busObj;
            }
            return $busesArr;
        }
    }
?>