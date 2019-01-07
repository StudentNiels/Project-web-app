<?php
/*
$string = 'ABC Hogeschool
,Academie Artemis Hogeschool voor Styling
,Academie voor Wetgeving
,Aeres Hogeschool
,Amsterdam School of Real Estate
,Amsterdamse Hogeschool voor de Kunsten
,ArtEZ hogeschool voor de kunsten
,Avans Hogeschool
,Avans+
,Business School Nederland
,Capabel Hogeschool
,Centrum voor Humanistische VormingÃ‚Â
,Christelijke Hogeschool Ede
,Codarts Hogeschool voor de Kunsten
,Cursus Godsdienst Onderwijs
,De Haagse Hogeschool
,Design Academy Eindhoven
,Driestar Hogeschool
,EuroCollege University of Applied Sciences
,European Institute For Brand Management
,Fontys Hogescholen
,Fotovakschool
,Gerrit Rietveld Academie
,Hanzehogeschool Groningen
,HAS Hogeschool
,HBO Da Vinci Drechtsteden
,HKU
,Hogeschool De Kempel
,Hogeschool der Kunsten Den Haag
,Hogeschool Dirksen
,Hogeschool E3
,Hogeschool Inholland
,Hogeschool iPabo
,Hogeschool ISBW
,Hogeschool Leiden
,Hogeschool NCOI
,Hogeschool NIFA
,Hogeschool Notenboom
,Hogeschool NOVI
,Hogeschool PBNA
,Hogeschool Rotterdam
,Hogeschool Schoevers
,Hogeschool SDO
,Hogeschool Tio
,Hogeschool Utrecht
,Hogeschool van Amsterdam
,Hogeschool van Arnhem en Nijmegen
,Hogeschool voor Pedagogisch en Sociaal-Agogisch Onderwij
,Hogeschool West-Nederland voor Vertaler en Tolk
,Hotelschool The Hague
,HZ University of Applied Sciences
,Instituut Defensie Leergangen
,Inter College Business School
,Iselinge Hogeschool
,Islamitische Universiteit Europa
,Islamitische Universiteit Rotterdam
,ITV Hogeschool voor Tolken en Vertalen
,IVA Driebergen Business School
,Katholieke Pabo Zwolle
,Koninklijk Actuarieel Genootschap & Actuarieel Instituut
,LOI Hogeschool
,Markus Verbeek Praehep
,Marnix Academie
,NCOI / Pro Education
,Nederlandse Loodsencorporatie
,Nederlandse School voor Onderwijs Management
,Netherlands Business Academy
,Netherlands Maritime University
,NHA
,NHL Hogeschool
,NHTV internationaal hoger onderwijs Breda
,NTI
,Nyenrode New Business School
,Opleidingsinstelling Geestelijke Gezondheidszorg Verpleeg
,Oysterwyck Hogeschool
,Philipse Business School
,Register Belastingadviseurs
,Saxion
,Saxion Next
,Schouten & Nelissen University
,SOD Next
,SOMT
,Stenden Hogeschool
,Stenden Masters
,Team Academy
,The New School for Information Services
,THIM Hogeschool voor Fysiotherapie
,Thomas More Hogeschool
,TMO Fashion Business School
,Tyndale Theological Seminary
,Van Hall Larenstein
,Viaa
,Wagner Group
,Webster University
,Windesheim
,Wittenborg University of Applied Sciences
,Zuyd Hogeschool
';
$allescholen = explode(",", $string);
include('conn.php');

foreach($allescholen as $school){
  $query = "INSERT INTO school (SchoolID, SchoolNaam) VALUES ( NULL,  ?)";
if(  $stmt = mysqli_prepare($conn, $query)){
    mysqli_stmt_bind_param($stmt, 's',  $school);
    mysqli_stmt_execute($stmt);
  }
}
 ?>
*/
