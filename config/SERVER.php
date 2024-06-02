<?php //Conf de encriptación

//Paranetros de coneccion a la DB
    const SERVER="localhost";
    const DB="prestamos";
    const USER="root";
    const PASS="";

//SISTEMA GESTOR DE DB 
    const SGDB="mysql:host=".SERVER.";dbname=".DB;
 

    const METHOD= "AES-256-CBC";
    const SECRET_KEY='$AKIKOS@N20224';
    const SECRET_IV= '037970';
