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
class Bestellung extends Page
{
    // to do: declare reference variables for members
    protected $_pizzaName=array();
    protected $_pizzaPreis=array();
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
        // to do: fetch data for this view from the database
        $sql="Select pizzaname, preis from Pizza";
        $recordset=$this->_database->query($sql);
        if (!$recordset)
            throw new Exception("Fehler in Abfrage: ".$this->database->error);
        $a=0;
        while ($record=$recordset->fetch_assoc()){
            $this->_pizzaName[$a]=$record["pizzaname"];
            $this->_pizzaPreis[$a]=$record["preis"];
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
        $this->generatePageHeader('Bestellung');
        // to do: call generateView() for all members
        echo <<<MAIN
        <body>
            <style>
                table, th, td {
                    border: 1px solid white;
                }
                body {
                    background-image: url(../Images/Fire.png);
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-size: cover;
                }
            </style>
            <h1 style="color: white">Testi Pizza Bestellservice</h1>
            <br>
            <h2 style="color: white">Bestellungen</h2>
            <br>
            <section>
            <h3 style="color: white">Speisekarte</h3>
            <div>
                <ul>
                    <li style="color: white">Krasse Pizza<br/><span data-price-euro="5,50">5,50</span>€<br>
                        <img src="../Images/testi_pizza.png" alt="Krasse Pizza" width="100" height="100" >
                        <button>In den Warenkorb</button></li>
                    <li style="color: white">Tee Pizza<br><span data-price-euro="6,50">6,50</span>€<br>
                        <img src="../Images/testi_pizza.png" alt="Tee Pizza" width="100" height="100" >
                        <button>In den Warenkorb</button></li>
                    <li style="color: white">Coole Pizza<br><span>8,50</span>€<br>
                        <img src="../Images/testi_pizza.png" alt="Coole Pizza" width="100" height="100" >
                        <button>In den Warenkorb</button></li>
                </ul>
            </div>
        </section>
MAIN;
        echo <<<WARENKORB
        <section>
        <h3 style="color: white">Warenkorb</h3>
        <div>
            <select name="Warenkorb[]" size="5" multiple>
                <option selected> Krasse Pizza</option>
                <option> Tee Pizza</option>
            </select>           
            <p style="color: white">Gesamtpreis: 12,00€</p>
        </div>
        <button>Element löschen</button>
        <button>Warenkorb leeren</button>
        <br>
        <br>
        <form>
            <input type="text" name="adresse" value="" placeholder="Ihre Adresse" />
            <br>
            <input type="button" value="Bestellen">
        </form>
        <button>Verwerfen</button>
WARENKORB;
        // to do: output view of this page
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
        // to do: call processReceivedData() for all members
    }

    /**
     * This main-function has the only purpose to create an instance 
     * of the class and to get all the things going.
     * I.e. the operations of the class are called to produce
     * the output of the HTML-file.
     * The name "main" is no keyword for php. It is just used to
     * indicate that function as the central starting point.
     * To make it simpler this is a static function. That is you can simply
     * call it without first creating an instance of the class.
     *
     * @return none 
     */    
    public static function main() 
    {
        try {
            $page = new Bestellung();
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
Bestellung::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >