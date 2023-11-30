
<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:net-banking.database.windows.net,1433; Database = net_banking", "nakshatra", "naksh_sree23032003");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "nakshatra", "pwd" => "naksh_sree23032003  ", "Database" => "net_banking", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:net-banking.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>