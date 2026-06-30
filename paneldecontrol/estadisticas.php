 <?php
 $SQL = "SELECT tbl_paquete.pk_paquete, tbl_paquete_details.txt_title, txt_date_to from tbl_paquete Inner Join 	tbl_paquete_details ON tbl_paquete.pk_paquete = tbl_paquete_details.fk_paquete
		LEFT JOIN tbl_categoria ON tbl_paquete.fk_categoria = tbl_categoria.pk_categoria 
		WHERE txt_date_to >= DATE_ADD(DATE(now()), INTERVAL 1 WEEK)
		ORDER BY txt_date_to LIMIT 0, 10";
 
 	$paquete = new cls_tbl_paquete();
	$resultado = $paquete->lista_paquetes_expira($SQL);	  
	$sw=0;
	$numFilas =  count($resultado);
 ?>
            <!-- Account overview -->
            <div class="grid_5">
                <div class="module">
                        <h2><span>Proximos Paquetes a Expirar</span></h2>
                        
                        <div class="module-body">
                        	<div class="module-table-body">
                            	<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
                                	<thead>
      									<tr>
                                        	<th>Paquete</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                    <?php 
										if($numFilas==0){  
									?>
                                    <tr>
        								<td colspan="2" align="center">No hay resultado de paquetes turísticos</td>
      								</tr>
                                    <?php 
									}else{
										$cint=1 ;
										foreach ($resultado  as $array)	{
											$titulo_paquete = $array['txt_title'];
											$fecha_expira_paquete = $array['txt_date_to'];
									?>
                                    <tr>
                                    	<td><a href="frm_paquete.php?id=<?php print $array['pk_paquete']?>" target="_self"><?php print $titulo_paquete;?></a></td>
                                        <td><?php echo Date::convert($fecha_expira_paquete,'Y-m-d','d-m-Y')?></td>
                                    </tr>
                                     <?php	
										$cint++;
										} 
									 }?>
                                    </tbody>  
                                </table>
                            </div>
<!--							
                             
                        	<p>
                                <a href="">espacio en construccion</a><br />
                            </p>-->

                        </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>