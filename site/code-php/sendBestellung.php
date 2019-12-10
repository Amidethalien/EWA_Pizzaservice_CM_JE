<?php

$addresse=$_REQUEST["a"];

$_database = new mysqli("localhost", "root", "Thor", "Testi_Pizzaservice_DB");

/* check connection */
if ($_database->connect_errno) {
    printf("Connect failed: %s\n", $this->_database->connect_error);
    exit();
}

$sql="INSERT INTO Bestellung VALUES ('1','\"$addresse\"')";

$_database->query($sql);

echo "I was called!";
