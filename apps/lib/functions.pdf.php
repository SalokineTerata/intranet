<?php

/*

  Nous utilisons par défaut HTML2FPDF
  qui se base et inclus sur une version modifiéede FPDF

 */

/*
  //HTML to FreePDF: Les Classes HTML2FPDF() et FDPF() sont créés
  $path='../lib/html2fpdf/';
  define('RELATIVE_PATH',$path);
  define('FPDF_FONTPATH', RELATIVE_PATH.'font/');
  include ("../lib/html2fpdf/html2fpdf.php");
 */

//Free PDF: Classe Racine
//$fpdf_path="../lib/fpdf/";
//define('RELATIVE_PATH',$fpdf_path);
//define('FPDF_FONTPATH', RELATIVE_PATH.'font/');
//include ($fpdf_path."fpdf.php");
//Extension Free PDF Import: Etend la Classe FPDF vers FPDI
//$fpdi_path="../lib/fpdi/";
//include ($fpdi_path."fpdi.php");
//HTML2PDF : Etend la Classe FPDI vers FPDF_WriteHTML
$html2pdf_path = "../lib/html2pdf/";

//include ($html2pdf_path."html2pdf.php");

/* * **********
  Fonctions PDF
 * ********** */


function fpdf_write_data($title, $data, $title_format, $data_format, &$pdf) {
//
//Dictionnaire des variables:
//---------------------------
    $title;         //Intitulé de la valeur
    $data;          //Donnée à afficher
    $title_format;  //Tableau contenant les informations de formatage du titre
    $data_format;   //Tableau contenant les informations de formatage de la donnée
    $ln = 0;          //Pas de retour à la ligne après l'intitulé
    $retait = 10;

//Retraitement de l'encodage des données.
//La base MySQL travail en UTF-8. Le format PDF ne gère pas nativement l'UTF-8
    //$data = mb_convert_encoding($data, "ISO-8859-15" , "UTF-8");
    //$title = mb_convert_encoding($title, "ISO-8859-15" , "UTF-8");


    $pdf->SetFont($title_format[0], $title_format[1], $title_format[2]);
    $title_taille = $pdf->GetStringWidth($title);

    $pdf->SetFont($data_format[0], $data_format[1], $data_format[2]);
    $data_taille = $pdf->GetStringWidth($data);

    $total_taille = $title_taille + $data_taille;
    $total_limite = $title_format[4] + $data_format[4];

//Correction des données
    if ($data == "0000-00-00") {
        $data = "";
    }

//Vérification et corrections des limites des tailles
    if ($title_taille > $title_format[4]) {
        $title_largeur = $title_taille;
    } else {
        $title_largeur = $title_format[4];
    }
    $data_largeur = $data_format[4];

    /*
      Les Tableaux de formatage sont constitués de la manière suivante:
      [0] = Police utilisée (ex: "Arial")
      [1] = Style utilisé (ex: "BIU")
      [2] = Taille de la police (ex: "12")
      [3] = Interligne (ex: "6")
      [4] = Largeur de la colonne (ex: "50") 0=Jusqu'au bout de la Page
      [5] = Alignement

      Pour plus d'information, voir le site de FPDF (http://www.fpdf.org/?lang=fr)
     */

//Corps de la fonction
    if ($data != "") {
        if ($title) {//Existe-il un titre ?
            $pdf->SetFont($title_format[0], $title_format[1], $title_format[2]);
            $pdf->Cell($title_largeur, $title_format[3], $title . ":", 0, 0, $title_format[5]);

            if (
                    ($title_taille > $title_format[4])
                    or ( ($total_taille > $total_limite) and ( $data_format[4] <> 0))
            ) {
                //Dans le Cas où l'intitulé est plus grand que la largeur de la colonne
                //Alors on vérifie si l'ensemble tiens sur la ligne complète
                //Si ce n'est pas le cas, on saute une ligne
                if ($total_taille > $total_limite) {
                    $pdf->Ln();
                    //$pdf->SetX($pdf->GetX()+$title_format[4]);
                    $pdf->SetX($pdf->GetX() + $retait);

                    if ($data_format[4]) {
                        $data_largeur = $total_limite - $retait;
                    } else {
                        $data_largeur = 0;
                    }
                } else { //Si tout tient sur une ligne
                    //Correction du $data_format[4]
                    $data_largeur = $data_format[4] - ($title_largeur - $title_format[4]);
                    $pdf->SetX($pdf->GetX() + 2);
                }
                //$pdf->SetX($pdf->GetX()+$title_format[4]);
            }
        }//Fin du test de l'existence du titre

        $pdf->SetFont($data_format[0], $data_format[1], $data_format[2]);
        $pdf->MultiCell($data_largeur, $data_format[3], $data, 0, $data_format[5]);
        return TRUE;
    } else {
        if (!$title) {
            $pdf->SetY($pdf->GetY() + 3);
            $pdf->SetFont($title_format[0], $title_format[1], $title_format[2]);
            $pdf->Cell($title_format[4] + $data_format[4], 0, $title . "", 0, 1);
            $pdf->SetY($pdf->GetY() + 3);
            return TRUE;
        } else
            return FALSE;
    }
}

/* * **********************
  eXtended PDF: Classe XPDF
  Basée sur la classe  FPDF
 * ********************** */



/* * *****************************************************************************
  Bookmark

  Description
  Cette extension ajoute le support des signets. La méthode pour ajouter un signet est la suivante :
  function Bookmark(string txt [, int level [, float y]])
  txt : titre du signet.
  level : niveau du signet (0 pour le plus haut niveau, 1 juste en dessous, etc). Valeur par défaut : 0.
  y : ordonnée de la destination du signet dans la page. -1 désigne la position courante. Valeur par défaut : 0.
 * ***************************************************************************** */

class PDF_Bookmark extends FPDI {

    var $outlines = array();
    var $OutlineRoot;

    function Bookmark($txt, $level = 0, $y = 0) {
        $txt = mb_convert_encoding($txt, "ISO-8859-15", "UTF-8");
        if ($y == -1)
            $y = $this->GetY();
        $this->outlines[] = array('t' => $txt, 'l' => $level, 'y' => $y, 'p' => $this->PageNo());
    }

    function _putbookmarks() {
        $nb = count($this->outlines);
        if ($nb == 0)
            return;
        $lru = array();
        $level = 0;
        foreach ($this->outlines as $i => $o) {
            if ($o['l'] > 0) {
                $parent = $lru[$o['l'] - 1];
                //Set parent and last pointers
                $this->outlines[$i]['parent'] = $parent;
                $this->outlines[$parent]['last'] = $i;
                if ($o['l'] > $level) {
                    //Level increasing: set first pointer
                    $this->outlines[$parent]['first'] = $i;
                }
            } else
                $this->outlines[$i]['parent'] = $nb;
            if ($o['l'] <= $level and $i > 0) {
                //Set prev and next pointers
                $prev = $lru[$o['l']];
                $this->outlines[$prev]['next'] = $i;
                $this->outlines[$i]['prev'] = $prev;
            }
            $lru[$o['l']] = $i;
            $level = $o['l'];
        }
        //Outline items
        $n = $this->n + 1;
        foreach ($this->outlines as $i => $o) {
            $this->_newobj();
            $this->_out('<</Title ' . $this->_textstring($o['t']));
            $this->_out('/Parent ' . ($n + $o['parent']) . ' 0 R');
            if (isset($o['prev']))
                $this->_out('/Prev ' . ($n + $o['prev']) . ' 0 R');
            if (isset($o['next']))
                $this->_out('/Next ' . ($n + $o['next']) . ' 0 R');
            if (isset($o['first']))
                $this->_out('/First ' . ($n + $o['first']) . ' 0 R');
            if (isset($o['last']))
                $this->_out('/Last ' . ($n + $o['last']) . ' 0 R');
            $this->_out(sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]', 1 + 2 * $o['p'], ($this->h - $o['y']) * $this->k));
            $this->_out('/Count 0>>');
            $this->_out('endobj');
        }
        //Outline root
        $this->_newobj();
        $this->OutlineRoot = $this->n;
        $this->_out('<</Type /Outlines /First ' . $n . ' 0 R');
        $this->_out('/Last ' . ($n + $lru[0]) . ' 0 R>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        $this->_putbookmarks();
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (count($this->outlines) > 0) {
            $this->_out('/Outlines ' . $this->OutlineRoot . ' 0 R');
            $this->_out('/PageMode /UseOutlines');
        }
    }

}

/* * *****************************************************************************
  Fin de PDF_Bookmark
 * ***************************************************************************** */

/* * **************************************************************************
 * Software: FPDF_Protection                                                 *
 * Version:  1.01                                                            *
 * Date:     2004/06/13                                                      *
 * Author:   Klemen VODOPIVEC                                                *
 * License:  Freeware                                                        *
 *                                                                           *
 * You may use and modify this software as you wish as stated in original    *
 * FPDF package.                                                             *
 *                                                                           *
 * Thanks: Cpdf (http://www.ros.co.nz/pdf) was my working sample of how to   *
 * implement protection in pdf.                                              *
 * ************************************************************************** */

class FPDF_Protection extends PDF_Bookmark {

    var $encrypted;          //whether document is protected
    var $Uvalue;             //U entry in pdf document
    var $Ovalue;             //O entry in pdf document
    var $Pvalue;             //P entry in pdf document
    var $enc_obj_id;         //encryption object id
    var $last_rc4_key;       //last RC4 key encrypted (cached for optimisation)
    var $last_rc4_key_c;     //last RC4 computed key

    function FPDF_Protection($orientation = 'P', $unit = 'mm', $format = 'A4') {
        parent::FPDF($orientation, $unit, $format);

        $this->encrypted = false;
        $this->last_rc4_key = '';
        $this->padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08" .
                "\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";
    }

    /**
     * Function to set permissions as well as user and owner passwords
     *
     * - permissions is an array with values taken from the following list:
     *   copy, print, modify, annot-forms
     *   If a value is present it means that the permission is granted
     * - If a user password is set, user will be prompted before document is opened
     * - If an owner password is set, document can be opened in privilege mode with no
     *   restriction if that password is entered
     */
    function SetProtection($permissions = array(), $user_pass = '', $owner_pass = null) {
        $options = array('print' => 4, 'modify' => 8, 'copy' => 16, 'annot-forms' => 32);
        $protection = 192;
        foreach ($permissions as $permission) {
            if (!isset($options[$permission]))
                $this->Error('Incorrect permission: ' . $permission);
            $protection += $options[$permission];
        }
        if ($owner_pass === null)
            $owner_pass = uniqid(rand());
        $this->encrypted = true;
        $this->_generateencryptionkey($user_pass, $owner_pass, $protection);
    }

    /*     * **************************************************************************
     *                                                                           *
     *                              Private methods                              *
     *                                                                           *
     * ************************************************************************** */

    function _putstream($s) {
        if ($this->encrypted) {
            $s = $this->_RC4($this->_objectkey($this->n), $s);
        }
        parent::_putstream($s);
    }

    function _textstring($s) {
        if ($this->encrypted) {
            $s = $this->_RC4($this->_objectkey($this->n), $s);
        }
        return parent::_textstring($s);
    }

    /**
     * Compute key depending on object number where the encrypted data is stored
     */
    function _objectkey($n) {
        return substr($this->_md5_16($this->encryption_key . pack('VXxx', $n)), 0, 10);
    }

    /**
     * Escape special characters
     */
    function _escape($s) {
        $s = str_replace('\\', '\\\\', $s);
        $s = str_replace(')', '\\)', $s);
        $s = str_replace('(', '\\(', $s);
        $s = str_replace("\r", '\\r', $s);
        return $s;
    }

    function _putresources() {
        parent::_putresources();
        if ($this->encrypted) {
            $this->_newobj();
            $this->enc_obj_id = $this->n;
            $this->_out('<<');
            $this->_putencryption();
            $this->_out('>>');
        }
    }

    function _putencryption() {
        $this->_out('/Filter /Standard');
        $this->_out('/V 1');
        $this->_out('/R 2');
        $this->_out('/O (' . $this->_escape($this->Ovalue) . ')');
        $this->_out('/U (' . $this->_escape($this->Uvalue) . ')');
        $this->_out('/P ' . $this->Pvalue);
    }

    function _puttrailer() {
        parent::_puttrailer();
        if ($this->encrypted) {
            $this->_out('/Encrypt ' . $this->enc_obj_id . ' 0 R');
            $this->_out('/ID [()()]');
        }
    }

    /**
     * RC4 is the standard encryption algorithm used in PDF format
     */
    function _RC4($key, $text) {
        if ($this->last_rc4_key != $key) {
            $k = str_repeat($key, 256 / strlen($key) + 1);
            $rc4 = range(0, 255);
            $j = 0;
            for ($i = 0; $i < 256; $i++) {
                $t = $rc4[$i];
                $j = ($j + $t + ord($k{$i})) % 256;
                $rc4[$i] = $rc4[$j];
                $rc4[$j] = $t;
            }
            $this->last_rc4_key = $key;
            $this->last_rc4_key_c = $rc4;
        } else {
            $rc4 = $this->last_rc4_key_c;
        }

        $len = strlen($text);
        $a = 0;
        $b = 0;
        $out = '';
        for ($i = 0; $i < $len; $i++) {
            $a = ($a + 1) % 256;
            $t = $rc4[$a];
            $b = ($b + $t) % 256;
            $rc4[$a] = $rc4[$b];
            $rc4[$b] = $t;
            $k = $rc4[($rc4[$a] + $rc4[$b]) % 256];
            $out.=chr(ord($text{$i}) ^ $k);
        }

        return $out;
    }

    /**
     * Get MD5 as binary string
     */
    function _md5_16($string) {
        return pack('H*', md5($string));
    }

    /**
     * Compute O value
     */
    function _Ovalue($user_pass, $owner_pass) {
        $tmp = $this->_md5_16($owner_pass);
        $owner_RC4_key = substr($tmp, 0, 5);
        return $this->_RC4($owner_RC4_key, $user_pass);
    }

    /**
     * Compute U value
     */
    function _Uvalue() {
        return $this->_RC4($this->encryption_key, $this->padding);
    }

    /**
     * Compute encryption key
     */
    function _generateencryptionkey($user_pass, $owner_pass, $protection) {
        // Pad passwords
        $user_pass = substr($user_pass . $this->padding, 0, 32);
        $owner_pass = substr($owner_pass . $this->padding, 0, 32);
        // Compute O value
        $this->Ovalue = $this->_Ovalue($user_pass, $owner_pass);
        // Compute encyption key
        $tmp = $this->_md5_16($user_pass . $this->Ovalue . chr($protection) . "\xFF\xFF\xFF");
        $this->encryption_key = substr($tmp, 0, 5);
        // Compute U value
        $this->Uvalue = $this->_Uvalue();
        // Compute P value
        $this->Pvalue = -(($protection ^ 255) + 1);
    }

}

/* * **************************************************************************
  Fin de FPDF_Protection
 * ************************************************************************** */

//Configuration du Pied de page
class FPDF_Footer extends FPDF_Protection {

    function Footer() {
        //Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        //Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        //Numéro de page centré
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' sur {nb}', 0, 0, 'R');
    }

}

/* * ***********************************************************************
  Classe eXtend Free PDF
  Classe Finale est complète contenant FPDF et tout les scripts additionnels
 * *********************************************************************** */

class xfpdf extends FPDF_Footer {
    
}

?>