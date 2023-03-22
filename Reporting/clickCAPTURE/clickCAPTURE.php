<?php
  /* This script is only for "Click Capture" reporting */

  include '../../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
  include '../../PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

  //include '../../../../_Configuration\ Files/Reporting/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
  //include '../../../../_Configuration\ Files/Reporting/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
  
  
  class Record {
    public $efcid;
    public $purl;
    public $firstname;
    public $lastname;
    public $email;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $phone;
    public $mobile;
    public $dateTime;
    public $eventInfo;
    public $gender;
    public $highSchool;
    public $gradYear;
    public $ceeb;
    public $gpa;
    public $listSource;
    public $browserCodeName;
    public $browserName;
    public $platform;
    
    public function __construct ($d) {
      $this -> efcid       = $d[0];
      $this -> purl            = $d[1];
      $this -> firstname       = $d[2];
      $this -> lastname        = $d[3];
      $this -> email           = $d[4];
      $this -> address         = $d[5];
      $this -> city            = $d[6];
      $this -> state           = $d[7];
      $this -> zip             = $d[8];
      $this -> phone           = $d[9];
      $this -> mobile          = $d[10];
      $this -> dateTime        = $d[11];
      $this -> eventInfo       = $d[12];
      $this -> gender          = $d[13];
      $this -> highSchool      = $d[14];
      $this -> gradYear        = $d[15];
      $this -> ceeb            = $d[16];
      $this -> gpa             = $d[17];
      $this -> listSource      = $d[18];
      $this -> browserCodeName = $d[19];
      $this -> browserName     = $d[20];
      $this -> platform        = $d[21];
    }
  }

  // Variables
  $records = array ();    //create an empty array for storage
  $targetFile = fopen ('output.csv', 'w');  //create output file


  // loop through directory to locate zip file and extract its contents
  $sourceFile = fopen ("data.csv", 'r');

  while ($data = fgetcsv ($sourceFile, 1000, ',')) {
    array_push ($records, new Record ($data));
  }

  //sort the records array by date property
  usort ($records, function ($a, $b) {
    $date1 = strtotime ($a -> dateTime);
    $date2 = strtotime ($b -> dateTime);
    if ($date1 < $date2) return 1;
    if ($date1 > $date2) return -1;
  });
        
  fwrite ($targetFile, "efcid,purl,first name,last name,email,address,city,state,zip,phone,mobile,date,event_info,gender,highschool,graduation_year,ceeb,gpa,list source,browserCodeName,browserName,platform,points\n");

  //Loop through the records array and write to output file.
  for ($counter = 0; $counter < count ($records) - 1; $counter++) {
    fwrite ($targetFile, $records[$counter] -> efcid . ",");
    fwrite ($targetFile, $records[$counter] -> purl . ",");
    fwrite ($targetFile, $records[$counter] -> firstname . ",");
    fwrite ($targetFile, '"' . $records[$counter] -> lastname . '",');
    fwrite ($targetFile, $records[$counter] -> email . ",");
    fwrite ($targetFile, $records[$counter] -> address . ",");
    fwrite ($targetFile, $records[$counter] -> city . ",");
    fwrite ($targetFile, $records[$counter] -> state . ",");
    fwrite ($targetFile, $records[$counter] -> zip . ",");
    fwrite ($targetFile, $records[$counter] -> phone . ",");
    fwrite ($targetFile, $records[$counter] -> mobile . ",");
    fwrite ($targetFile, $records[$counter] -> dateTime . ",");
    fwrite ($targetFile, '"' . $records[$counter] -> eventInfo . '",');
    fwrite ($targetFile, $records[$counter] -> gender . ",");
    fwrite ($targetFile, $records[$counter] -> highSchool . ",");
    fwrite ($targetFile, $records[$counter] -> gradYear . ",");
    fwrite ($targetFile, $records[$counter] -> ceeb . ",");
    fwrite ($targetFile, $records[$counter] -> gpa . ",");
    fwrite ($targetFile, $records[$counter] -> listSource . ",");
    fwrite ($targetFile, $records[$counter] -> browserCodeName . ",");
    fwrite ($targetFile, $records[$counter] -> browserName . ",");
    fwrite ($targetFile, $records[$counter] -> platform . ",");
    fwrite ($targetFile, "5\n");
  }

  //The rest of the code coverts the destination csv file into an excel spreadsheet
  $objReader = PHPExcel_IOFactory::createReader ('CSV');
  $objReader -> setDelimiter (",");
  $objReader -> setInputEncoding ('UTF-8');
  $objPHPExcel = $objReader -> load ('output.csv');

  $range = $objPHPExcel -> getActiveSheet () -> calculateWorksheetDimension ();
  $objPHPExcel -> getActiveSheet () -> setAutoFilter ($range);

  for ($col = 'A'; $col !== 'N'; $col++) {
    $objPHPExcel -> getActiveSheet () -> getColumnDimension ($col) -> setAutoSize (true);
  }

  $objPHPExcel -> getDefaultStyle () -> getAlignment () -> setHorizontal (PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

  $objWriter = PHPExcel_IOFactory::createWriter ($objPHPExcel, 'Excel2007');
  $objWriter -> save ('report.xlsx');

  fclose ($sourceFile);
  fclose ($targetFile);
?>
