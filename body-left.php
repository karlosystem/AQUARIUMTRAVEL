<div class="module_banners1">
    <div class="boxIndent">
        <div class="wrapper">
            <div class="bannergroup_banners1">
                <div class="banneritem">
                    <?php 
						$cls_banner_home3 = new cls_tbl_banner();
						$cls_banner_home3->width_container = 230;
						$cls_banner_home3->height_container = 413;
						$cls_banner_home3->position_int = 3;
						print $cls_banner_home3->nivoSlider2();  
					?>               
                   <div class="clr"></div>                    
                </div>
            </div>
        </div>
    </div>
</div>   

                        
<div class="module-category">
  <div class="boxIndent">
      <div class="arrowlistmenu">
			<h3 class="headerbar">VACACIONES CONFIRMADAS</h3>
            <ul>
           		<?php	  
				  #viajes internacionales
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(2);
				  print $str_nacionales;
				?> 	  
            </ul>

            <h3 class="headerbar">PAQUETES INTERNACIONALES</h3>
            <ul>
           		<?php	  
				  #viajes internacionales
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(1);
				  print $str_nacionales;
				?> 	  
            </ul>

			<h3 class="headerbar">HOTELES DECAMERON</h3>
            <ul>
           		<?php	  
				  #Circuitos Turisticos
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(84);
				  print $str_nacionales;
				?> 	  
            </ul>

			<h3 class="headerbar">TOURS COMBINADOS</h3>
            <ul>
           		<?php	  
				  #viajes internacionales
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(4);
				  print $str_nacionales;
				?> 	  
            </ul>
            
           
            
            <h3 class="headerbar">PAQUETES NACIONALES</h3>
            <ul>
           		<?php	  
				  #viajes internacionales
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(3);
				  print $str_nacionales;
				?> 	  
            </ul>

			<h3 class="headerbar">PLAYAS DEL NORTE</h3>
            <ul>
           		<?php	  
				  #viajes internacionales
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(180);
				  print $str_nacionales;
				?> 	  
            </ul>


			<h3 class="headerbar">PAQUETES DE LUNA DE MIEL</h3>
            <ul>
           		<?php	  
				  #viajes internacionales
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(5);
				  print $str_nacionales;
				?> 	  
            </ul>
            
            
           
            
          <h3 class="headerbar">CRUCEROS SIN VISA</h3>
            <ul>
           		<?php	  
				  #cruceros
				  $categorias = new cls_tbl_paquete();
				  $str_nacionales = $categorias->lista_categorias_ul(136);
				  print $str_nacionales;
				?> 	  
            </ul>

            
       </div>

  </div>
</div>

<div class="module_banners1">
    <div class="boxIndent">
        <div class="wrapper">
            <div class="bannergroup_banners1">
                <div class="banneritem">
                    <a href="<?php echo _URL?>contenido.php?cid=8" title="MINCETUR" target="_new">
                    	<center>
                        <img src="<?php echo _URL?>images/mincetour.jpg">
                        </center>
                    </a>
                    <br /><br />
					<a href="<?php echo _URL?>tickets.php" target="_self">
                    	<center>
                        <img src="<?php echo _URL?>images/tickets.jpg">
                        </center>
                    </a>
                    <br /><br />
                    <a href="<?php echo _URL?>contenido.php?cid=6" target="_self">
                    	<center>
                        <img src="<?php echo _URL?>images/oltursa-logo-index.jpg">
                        </center>
                    </a>
                   
                    <br /><br />
                    <a href="<?php echo _URL?>paquetes-turisticos-punta-sal-solo-traslados-desde-lima-pid-114.html" target="_self">
                    	<center>
                        <img src="<?php echo _URL?>images/logo_traslados.jpg">
                        </center>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</div>   