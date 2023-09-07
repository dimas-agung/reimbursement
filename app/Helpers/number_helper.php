<?php

    function GenerateDocNO($nomor, $kode_doc)
    {
        $nomorFix = '';
        $year = date('Y');
        $nomorFix = $kode_doc.'-'.$nomor.'-'.$year;
        return $nomorFix;
    }