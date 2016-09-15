<?php

require_once '../inc/php.php';

/**
 * Mise à jour ANIM
 */
$validationANIM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=1"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRANIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR ANIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FEANIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"ANIM\""
);

if ($validationANIM) {
    echo "Mise à jour ANIM OK <br>";
} else {
    echo " Mise à jour ANIM FAILDED <br>";
}
/**
 * Mise à jour CORNER ou  ILASIA
 */
$arrayRaccoucisClassifIncomplete = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaModel::KEYNAME . "," . FtaModel::FIELDNAME_SITE_PRODUCTION
                . " FROM " . FtaModel::TABLENAME
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"NINJA\""
);
if ($arrayRaccoucisClassifIncomplete) {
    foreach ($arrayRaccoucisClassifIncomplete as $value) {
        $idFta = $value[FtaModel::KEYNAME];
        $SiteDeProduction = $value[FtaModel::FIELDNAME_SITE_PRODUCTION];
        if ($SiteDeProduction == GeoModel::ID_SITE_CORNER) {
            /**
             * Alors LISASIA
             */
            $idRaccoucisNinja = "22";
            $raccoucis = "LISASIA";
        } {
            /**
             * Sinon CORNER
             */
            $idRaccoucisNinja = "3";
            $raccoucis = "CORNER";
        }

        $validationNINJA = DatabaseOperation::execute(
                        "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=" . $idRaccoucisNinja
                        . " WHERE " . FtaModel::KEYNAME . "=" . $idFta);

        if ($validationNINJA) {
            echo "Mise à jour " . $raccoucis . " OK <br>";
        } else {
            echo " Mise à jour  " . $raccoucis . " FAILDED <br>";
        }
    }

    $validationCORNER = DatabaseOperation::execute(
                    "UPDATE " . FtaModel::TABLENAME
                    . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=3"
                    . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"CORNER\""
    );
    $validationILASIA = DatabaseOperation::execute(
                    "UPDATE " . FtaModel::TABLENAME
                    . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=22"
                    . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"ILASIA\""
                    . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"`ILASIA`\""
                    . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"L'ILASIA\""
                    . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"LILASIA\""
    );
}


/**
 * Mise à jour DRIVE
 */
$validationDRIVE = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=6"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR DRIVE\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"DRIVE\""
);

if ($validationDRIVE) {
    echo "Mise à jour DRIVE OK <br>";
} else {
    echo " Mise à jour DRIVE FAILDED <br>";
}

/**
 * Mise à jour EVENSURG
 */
$validationEVEN = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=102"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"SURGEVEN\""
);

if ($validationEVEN) {
    echo "Mise à jour EVENSURG OK <br>";
} else {
    echo " Mise à jour EVENSURG FAILDED <br>";
}


/**
 * Mise à jour FE
 */
$validationFE = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=9"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FECG\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FEPIZZA\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FEQTT\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"PIZ\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FETG\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"QTT\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFASIE\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"`FE`\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FE\""
);

if ($validationFE) {
    echo "Mise à jour FE OK <br>";
} else {
    echo " Mise à jour FE FAILDED <br>";
}

/**
 * Mise à jour FEAUC
 */
$validationFEAUC = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=10"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFAUC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FEAUC\""
);

if ($validationFEAUC) {
    echo "Mise à jour FEAUC OK <br>";
} else {
    echo " Mise à jour FEAUC FAILDED <br>";
}


/**
 * Mise à jour FECAR
 */
$validationFECAR = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=11"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFCAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FECAR\""
);

if ($validationFECAR) {
    echo "Mise à jour FECAR OK <br>";
} else {
    echo " Mise à jour FECAR FAILDED <br>";
}
/**
 * Mise à jour FECAS
 */
$validationFECAS = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=12"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFCAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FECAS\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"CASFE\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FE CAS\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FECASINO\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFCAS\""
);

if ($validationFECAS) {
    echo "Mise à jour FECAS OK <br>";
} else {
    echo " Mise à jour FECAS FAILDED <br>";
}
/**
 * Mise à jour FEITM
 */
$validationFEITM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=13"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"ITMFST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FEITM\""
);

if ($validationFEITM) {
    echo "Mise à jour FEITM OK <br>";
} else {
    echo " Mise à jour FEITM FAILDED <br>";
}
/**
 * Mise à jour FENAC
 */
$validationFENAC = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=14"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FE NAC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FENAC\""
);

if ($validationFENAC) {
    echo "Mise à jour FENAC OK <br>";
} else {
    echo " Mise à jour FENAC FAILDED <br>";
}
/**
 * Mise à jour FESIM
 */
$validationFESIM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=16"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FESIMPLY\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FESIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FR SIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFATAC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFSIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"UFSIMPLY\""
);

if ($validationFESIM) {
    echo "Mise à jour FESIM OK <br>";
} else {
    echo " Mise à jour FESIM FAILDED <br>";
}
/**
 * Mise à jour MDALD
 */
$validationMDALD = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=40"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDALDI\""
);

if ($validationMDALD) {
    echo "Mise à jour MDALD OK <br>";
} else {
    echo " Mise à jour MDALD FAILDED <br>";
}
/**
 * Mise à jour MDARG
 */
$validationMDARG = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=41"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDARG\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDARGEL\""
);

if ($validationMDARG) {
    echo "Mise à jour MDARG OK <br>";
} else {
    echo " Mise à jour MDARG FAILDED <br>";
}

/**
 * Mise à jour MDCAR
 */
$validationMDCAR = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=44"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDCAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDCAR/GJ\""
);

if ($validationMDCAR) {
    echo "Mise à jour MDCAR OK <br>";
} else {
    echo " Mise à jour MDCAR FAILDED <br>";
}

/**
 * Mise à jour MDEISM
 */
$validationMDEISM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=50"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDEISM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDEIS\""
);

if ($validationMDEISM) {
    echo "Mise à jour MDEISM OK <br>";
} else {
    echo " Mise à jour MDEISM FAILDED <br>";
}

/**
 * Mise à jour MDFDF
 */
$validationMDFDF = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=51"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDFDF\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDFD\""
);

if ($validationMDFDF) {
    echo "Mise à jour MDFDF OK <br>";
} else {
    echo " Mise à jour MDFDF FAILDED <br>";
}

/**
 * Mise à jour MDFRAN
 */
$validationMDFRAN = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=52"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDFRAN\""
);

if ($validationMDFRAN) {
    echo "Mise à jour MDFRAN OK <br>";
} else {
    echo " Mise à jour MDFRAN FAILDED <br>";
}

/**
 * Mise à jour MDFRANP
 */
$validationMDFRANP = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=53"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDFRA\""
);

if ($validationMDFRANP) {
    echo "Mise à jour MDFRANP OK <br>";
} else {
    echo " Mise à jour MDFRANP FAILDED <br>";
}

/**
 * Mise à jour MDGDJURY
 */
$validationMDGDJURY = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=54"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDGDJURY\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDGDJ\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDGJ\""
);

if ($validationMDGDJURY) {
    echo "Mise à jour MDGDJURY OK <br>";
} else {
    echo " Mise à jour MDGDJURY FAILDED <br>";
}

/**
 * Mise à jour MDIS
 */
$validationMDIS = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=89"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDDIS\""
);

if ($validationMDIS) {
    echo "Mise à jour MDIS OK <br>";
} else {
    echo " Mise à jour MDIS FAILDED <br>";
}

/**
 * Mise à jour MDLEAD
 */
$validationMDLEAD = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=56"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDLEAD\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDLEADER\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"`MDLEAD`\""
);

if ($validationMDLEAD) {
    echo "Mise à jour MDLEAD OK <br>";
} else {
    echo " Mise à jour MDLEAD FAILDED <br>";
}


/**
 * Mise à jour MDLID
 */
$validationMDLID = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=58"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDLIDL\""
);

if ($validationMDLID) {
    echo "Mise à jour MDLID OK <br>";
} else {
    echo " Mise à jour MDLID FAILDED <br>";
}

/**
 * Mise à jour MDMONO
 */
$validationMDMONO = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=59"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDMONO\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDMONOP\""
);

if ($validationMDMONO) {
    echo "Mise à jour MDMONO OK <br>";
} else {
    echo " Mise à jour MDMONO FAILDED <br>";
}
/**
 * Mise à jour MDNORM
 */
$validationMDNORM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=61"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDNORM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDNORMA\""
);

if ($validationMDNORM) {
    echo "Mise à jour MDNORM OK <br>";
} else {
    echo " Mise à jour MDNORM FAILDED <br>";
}
/**
 * Mise à jour MDPROV
 */
$validationMDPROV = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=63"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDCORA\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDMATCH\""
);

if ($validationMDPROV) {
    echo "Mise à jour MDPROV OK <br>";
} else {
    echo " Mise à jour MDPROV FAILDED <br>";
}
/**
 * Mise à jour MDSIM
 */
$validationMDSIM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=66"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDSIM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDSM\""
);

if ($validationMDSIM) {
    echo "Mise à jour MDSIM OK <br>";
} else {
    echo " Mise à jour MDSIM FAILDED <br>";
}


/**
 * Mise à jour MDSU
 */
$validationMDSU = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=67"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDSU\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDDSU\""
);

if ($validationMDSU) {
    echo "Mise à jour MDSU OK <br>";
} else {
    echo " Mise à jour MDSU FAILDED <br>";
}

/**
 * Mise à jour MDTHIR
 */
$validationMDTHIR = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=68"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDTHIR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDTHI\""
);

if ($validationMDTHIR) {
    echo "Mise à jour MDTHIR OK <br>";
} else {
    echo " Mise à jour MDTHIR FAILDED <br>";
}

/**
 * Mise à jour MDTOUP
 */
$validationMDTOUP = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=69"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDTOUP\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MDTOU\""
);

if ($validationMDTOUP) {
    echo "Mise à jour MDTOUP OK <br>";
} else {
    echo " Mise à jour MDTOUP FAILDED <br>";
}


/**
 * Mise à jour MONO
 */
$validationMONO = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=70"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"MONOP\""
);

if ($validationMDTOUP) {
    echo "Mise à jour MONO OK <br>";
} else {
    echo " Mise à jour MONO FAILDED <br>";
}

/**
 * Mise à jour ORVDE
 */
$validationORVDE = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=72"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"OR VDE\""
);

if ($validationORVDE) {
    echo "Mise à jour ORVDE OK <br>";
} else {
    echo " Mise à jour ORVDE FAILDED <br>";
}


/**
 * Mise à jour PULPE
 */
$validationPULPE = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=73"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FEPULP\""
);

if ($validationPULPE) {
    echo "Mise à jour PULPE OK <br>";
} else {
    echo " Mise à jour PULPE FAILDED <br>";
}


/**
 * Mise à jour TR
 */
$validationTR = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=79"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFE\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR FE\""
);

if ($validationTR) {
    echo "Mise à jour TR OK <br>";
} else {
    echo " Mise à jour TR FAILDED <br>";
}

/**
 * Mise à jour TRAUC
 */
$validationTRAUC = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=80"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRAUC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRAUCH\""
);

if ($validationTRAUC) {
    echo "Mise à jour TRAUC OK <br>";
} else {
    echo " Mise à jour TRAUC FAILDED <br>";
}


/**
 * Mise à jour TRCAR
 */
$validationTRCAR = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=81"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRCAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"CAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TCAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR CAR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRCART\""
);

if ($validationTRCAR) {
    echo "Mise à jour TRCAR OK <br>";
} else {
    echo " Mise à jour TRCAR FAILDED <br>";
}

/**
 * Mise à jour TRCAS
 */
$validationTRCAS = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=83"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRCAS\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"CAS\""
);

if ($validationTRCAS) {
    echo "Mise à jour TRCAS OK <br>";
} else {
    echo " Mise à jour TRCAS FAILDED <br>";
}

/**
 * Mise à jour TRCHA
 */
$validationTRCHA = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=84"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRCHA\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFCHA\""
);

if ($validationTRCHA) {
    echo "Mise à jour TRCHA OK <br>";
} else {
    echo " Mise à jour TRCHA FAILDED <br>";
}

/**
 * Mise à jour TREPC
 */
$validationTREPC = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=85"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TREPC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR EPC\""
);

if ($validationTREPC) {
    echo "Mise à jour TREPC OK <br>";
} else {
    echo " Mise à jour TREPC FAILDED <br>";
}

/**
 * Mise à jour TRFR
 */
$validationTRFR = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=87"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFR\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR FR\""
);

if ($validationTRFR) {
    echo "Mise à jour TRFR OK <br>";
} else {
    echo " Mise à jour TRFR FAILDED <br>";
}


/**
 * Mise à jour TRFST
 */
$validationTRFST = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=88"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"`FSTSU`\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FST SU\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"FSTSU\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR FEST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR FST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFEST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRSFT\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"`TRFST\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"`TRFST`\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFST SU\""
);

if ($validationTRFST) {
    echo "Mise à jour TRFST OK <br>";
} else {
    echo " Mise à jour TRFST FAILDED <br>";
}


/**
 * Mise à jour TRITM
 */
$validationTRITM = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=90"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRITM\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRFE ITM\""
);

if ($validationTRITM) {
    echo "Mise à jour TRITM OK <br>";
} else {
    echo " Mise à jour TRITM FAILDED <br>";
}

/**
 * Mise à jour TRNAC
 */
$validationTRNAC = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=92"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRNAC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TR NAC\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRNAA\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRNAC14\""
);

if ($validationTRNAC) {
    echo "Mise à jour TRNAC OK <br>";
} else {
    echo " Mise à jour TRNAC FAILDED <br>";
}

/**
 * Mise à jour TRSURG
 */
$validationTRSURG = DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=97"
                . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRSURG\""
                . " OR " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE  \"TRSUR\""
);

if ($validationTRSURG) {
    echo "Mise à jour TRSURG OK <br>";
} else {
    echo " Mise à jour TRSURG FAILDED <br>";
}

/**
 * Mise à jour des raccourcis existant
 */
$arrayRaccoucisClassifIncompleteAuto = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . ClassificationRaccourcisModel::KEYNAME . "," . ClassificationRaccourcisModel::FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS
                . " FROM " . ClassificationRaccourcisModel::TABLENAME
                . " WHERE " . ClassificationRaccourcisModel::KEYNAME . "<>-1"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>1"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>3"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>22"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>6"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>102"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>9"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>10"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>11"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>12"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>13"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>14"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>16"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>40"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>41"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>44"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>50"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>51"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>52"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>53"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>54"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>89"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>56"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>58"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>59"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>61"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>63"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>66"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>67"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>68"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>69"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>70"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>72"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>73"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>79"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>80"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>81"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>83"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>84"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>85"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>87"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>88"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>90"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>92"
                . " AND " . ClassificationRaccourcisModel::KEYNAME . "<>97"
);
if ($arrayRaccoucisClassifIncompleteAuto) {
    foreach ($arrayRaccoucisClassifIncompleteAuto as $value) {
        $idRacourcisClassification = $value[ClassificationRaccourcisModel::KEYNAME];
        $racourcisClassification = $value[ClassificationRaccourcisModel::FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS];


        $validationRaccoucisClassifIncompleteAuto = DatabaseOperation::execute(
                        "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "=" . $idRacourcisClassification
                        . " WHERE " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . " LIKE \"" . $racourcisClassification . "\"");

        if ($validationRaccoucisClassifIncompleteAuto) {
            echo "Mise à jour " . $racourcisClassification . " OK <br>";
        } else {
            echo " Mise à jour " . $racourcisClassification . " FAILDED <br>";
        }
    }
}
?>
