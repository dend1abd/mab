<?php
	$_SESSION["op"] = retrieveS($_GET["op"]);
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data";
			
			$i = 0;
			while ($dataGen = mysql_fetch_array($rsGen)) 
			{
				$i++;
				$dataValue[] = ""; 
			}
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
			/*
	        $sqlCmd = "SELECT product_code, product_name, harga_beli, harga_jual, saldo_awal FROM mst_product a WHERE a.product_code ='" .$_SESSION["ID"]. "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["product_code"] = $data["product_code"];
				$_SESSION["product_name"] = $data["product_name"];
				$_SESSION["harga_beli"] = $data["harga_beli"];
				$_SESSION["harga_jual"] = $data["harga_jual"];
				$_SESSION["saldo_awal"] = $data["saldo_awal"]; 
				
			}
			else
				eror("Data Kosong");*/
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data";
			}
        }
        else    
            eror("invalid op");
?>