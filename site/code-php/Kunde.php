<?php	// UTF-8 marker äöüÄÖÜß€
/**
 * Class PageTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 * 
 * PHP Version 5
 *
 * @category File
 * @package  Pizzaservice
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de> 
 * @author   Ralf Hahn, <ralf.hahn@h-da.de> 
 * @license  http://www.h-da.de  none 
 * @Release  1.2 
 * @link     http://www.fbi.h-da.de 
 */

// to do: change name 'PageTemplate' throughout this file
require_once './Page.php';

/**
 * This is a template for top level classes, which represent 
 * a complete web page and which are called directly by the user.
 * Usually there will only be a single instance of such a class. 
 * The name of the template is supposed
 * to be replaced by the name of the specific HTML page e.g. baker.
 * The order of methods might correspond to the order of thinking 
 * during implementation.
 
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de> 
 * @author   Ralf Hahn, <ralf.hahn@h-da.de> 
 */
class Kunde extends Page
{
    // to do: declare reference variables for members
    protected $_BestellID=array();
    protected $_BestellName=array();
    protected $_BestellPreis=array();

    protected $_BestellPizza=array();
    // representing substructures/blocks
    
    /**
     * Instantiates members (to be defined above).   
     * Calls the constructor of the parent i.e. page class.
     * So the database connection is established.
     *
     * @return none
     */
    protected function __construct() 
    {
        parent::__construct();
        // to do: instantiate members representing substructures/blocks
    }
    
    /**
     * Cleans up what ever is needed.   
     * Calls the destructor of the parent i.e. page class.
     * So the database connection is closed.
     *
     * @return none
     */
    protected function __destruct() 
    {
        parent::__destruct();
    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is stored in an easily accessible way e.g. as associative array.
     *
     * @return none
     */
    protected function getViewData()
    {
        $datum=date("o-m-d");
        $sql="SELECT BestellID, BestellerName, Preis FROM Bestellung WHERE Bestellzeitpunkt='$datum';";
        $recordset=$this->_database->query($sql);
        if (!$recordset)
            throw new Exception("Fehler in Abfrage: ".$this->database->error);
        $a=0;
        while ($record=$recordset->fetch_assoc()){
            $this->_BestellID[$a]=$record["BestellID"];
            $this->_BestellName[$a]=$record["BestellerName"];
            $this->_BestellPreis[$a]=$record["Preis"];
            $a++;
        }
        $recordset->free();


    }
    
    /**
     * First the necessary data is fetched and then the HTML is 
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if avaialable- the content of 
     * all views contained is generated.
     * Finally the footer is added.
     *
     * @return none
     */
    protected function generateView() 
    {
        $this->getViewData();
        $this->generatePageHeader('Kunde');
        // to do: call generateView() for all members
        echo<<<Listenanfang
        
        <ul>
        
Listenanfang;
        for ($i=0; $i<count($this->_BestellID); $i++){
            echo "<li>
                    <span>BestellID:",$this->_BestellID[$i],"</span><br>
                    <span></span>
                  </li>   ";
        }


        echo <<<Kunde
        
Kunde;

        $this->generatePageFooter();
    }
    
    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If this page is supposed to do something with submitted
     * data do it here. 
     * If the page contains blocks, delegate processing of the 
	 * respective subsets of data to them.
     *
     * @return none 
     */
    protected function processReceivedData()
    {
        parent::processReceivedData();
        $Name = $_POST["name"];
        $Adresse = $_POST["adresse"];
        $sql="INSERT INTO Bestellung(BestellerName, Adresse, Preis) values('$Name', '$Adresse', 5.5);";
        if ($this->_database->query($sql)===TRUE){
        }else{
            echo "Error; " . $sql . "<br>" .$this->_database->error;
        }
        $sql="SELECT BestellID FROM Bestellung WHERE Bestellername='$Name'  ORDER BY BestellID DESC;";
        $recordset=$this->_database->query($sql);
        if (!$recordset)
            throw new Exception("Fehler in Abfrage: ".$this->database->error);
        $record=$recordset->fetch_assoc();
        $BID=$record["BestellID"];
        $sql="INSERT INTO Bestellte_Pizza(PizzenName,fBestellID, BP_Status) VALUES ('Krasse Pizza', '$BID', 'bestellt');";
        if ($this->_database->query($sql)===TRUE){
        }else{
            echo "Error; " . $sql . "<br>" .$this->_database->error;
        }

     }
    public static function main() 
    {
        try {
            $page = new Kunde();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page. 
// That is input is processed and output is created.
Kunde::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >