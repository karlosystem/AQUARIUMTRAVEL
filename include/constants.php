<?php

define("_URL","http://localhost/aquarium/");

define("DEFAULT_LANGUAGE","es");
define("ADMIN_MODULOS","images/modulos/");

define("_SEOMOD",1); # URL AMIGABLE

define('DIR_WS_ADMIN', _URL . 'paneldecontrol/');

define('DIR_WS_ADS_LANGUAGES', _URL . 'include/languages/');
define('DIR_WW_LANGUAGES', 'include/languages/');
define('DIR_WS_LANGUAGES', 'include/languages/');
define('DIR_WS_ADMIN_LANGUAGES', '../include/languages/');


#Banner de Publicidad
define("_BANNERS","images/banner/");
define("_PAQUETES","images/paquete/");
define("_PASAJES","images/pasaje/");


#Categorias:::
define("ADMIN_IMG_CAT","../uploads/categoria/");
define("PUBLIC_IMG_CAT","uploads/categoria/");	
	
define("WCAT_",500);
define("HCAT_",375);


#Archivos PDF
define("_PDF","pdf/paquetes/");


#Departamentos
define("ADMIN_IMG_DEPARTAMETOS","../images/departamentos/");
define("PUBLIC_IMG_DEPARTAMENTOS","images/departamentos/");

define("W_DEPARTAMENTOS_MAX",350);
define("H_DEPARTAMENTOS_MAX",250);


#Cadenas de Hoteles
define("ADMIN_IMG_CADENA","../images/cadena/");
define("PUBLIC_IMG_CADENA","images/cadena/");

define("W_CADENA_MAX",200);
define("H_CADENA_MAX",200);

#Testimonios
define("ADMIN_IMG_TESTIMONIO","../images/testimonio/");
define("PUBLIC_IMG_TESTIMONIO","images/testimonio/");

define("W_SORTEO_MAX",350);
define("H_SORTEO_MAX",250);


#Pasajes
define("ADMIN_IMG_PASAJE","../images/pasaje/");
define("PUBLIC_IMG_PASAJE","images/pasaje/");

define("W_PASAJE_MAX",350);
define("H_PASAJE_MAX",250);

#Noticias ** ** 
define("ADMIN_PHOTOBIG_NOTICIA","../images/noticias/");
define("PUBLIC_PHOTOBIG_NOTICIA","images/noticias/");
#Noticias ** **




define("FCKEDITOR_PATH","../../../../../../images/") ;
define("FCKEDITOR_PATH2",_URL."images/") ;


/******************************************
* RUTA Y DIMENSION DEL CONTENIDO DE TEXTO
******************************************/
define("ADMIN_IMG_PAGE","../images/pages/");
define("PUBLIC_IMG_PAGE","images/pages/");



#Paquetes:::
define("ADMIN_IMG_PROD","../uploads/producto/");
define("PUBLIC_IMG_PROD","uploads/producto/");	

#Producto_detalle.php	
define("WPROD_",400);
define("HPROD_",400);

define("ADMIN_IMG_PMIN",ADMIN_IMG_PROD."min/"); 
define("PUBLIC_IMG_PMIN",PUBLIC_IMG_PROD."min/");	
	
define("WPROD_MIN",150);
define("HPROD_MIN",130);

define("ADMIN_IMG_PTHUMB",ADMIN_IMG_PROD."thumb/"); 
define("PUBLIC_IMG_PTHUMB",PUBLIC_IMG_PROD."thumb/");	
	
define("WPROD_THUMB",160);
define("HPROD_THUMB",160);

define("LIMIT_PRODUCTOS",6);

#Productos:::


#Album
define("ADMIN_ALBUM_BIG","../images/album/");
define("PUBLIC_ALBUM_BIG","images/album/");	
	
define("WALBUMALBUM_BIG",500);
define("HALBUMALBUM_BIG",375);

define("ADMIN_ALBUM_MIN",ADMIN_ALBUM_BIG."thumb/");
define("PUBLIC_ALBUM_MIN",PUBLIC_ALBUM_BIG."thumb/");

define("WALBUMALBUM_MIN",140);
define("HALBUMALBUM_MIN",140);

define("ADMIN_ALBUMFLYER_MIN",ADMIN_ALBUM_BIG."flyer/");
define("PUBLIC_ALBUMFLYER_MIN",PUBLIC_ALBUM_BIG."flyer/");

define("WALBUMALBUMFLYER_MIN",303);
define("HALBUMALBUMFLYER_MIN",223);
#Album


#Hoteles ** ** 
define("ADMIN_PHOTOBIG_HOTELES","../images/hoteles/");
define("PUBLIC_PHOTOBIG_HOTELES","images/hoteles/");
#Hoteles ** **


#Destinos ** ** 
define("ADMIN_PHOTOBIG_DESTINOS","../images/destinos/");
define("PUBLIC_PHOTOBIG_DESTINOS","images/destinos/");

define("W_DESTINOS_MAX",500);
define("H_DESTINOS_MAX",375);

#Destinos ** **

#Destinos ** ** 
define("ADMIN_PHOTOBIG_TOURS","../images/tours/");
define("PUBLIC_PHOTOBIG_TOURS","images/tours/");

define("W_TOURS_MAX",500);
define("H_TOURS_MAX",375);

/*******************************
	* GALERIA DE HOTELES
*******************************/
define("ADMIN_PHOTOBIG_HOTELESGALLERY","../images/hoteles/galeria/");
define("PUBLIC_PHOTOBIG_HOTELESGALLERY","images/hoteles/galeria/");
define("WHOTELMES_BIG",549);
define("HHOTELMES_BIG",427);

define("ADMIN_PHOTOMIN_HOTELESPREVIEW","../images/hoteles/galeria/preview/");
define("PUBLIC_PHOTOMIN_HOTELESPREVIEW","images/hoteles/galeria/preview/");
define("WHOTELMES_PREVIEW",150);
define("HHOTELMES_PREVIEW",100);
/********************************************/


#EMAIL CONFIG 
define("_ISSMTP",1);
define("_MAIL_HOST","mail.americanexpeditions.pe");
define("_MAIL_PORT",25);
define("_MAIL_USER","correo@americanexpeditions.pe");
define("_MAIL_PASS","@meric@n2010expediti0ns");
define("_MAIL_FROM","correo@americanexpeditions.pe");
define("_MAIL_TO","informes@americanexpeditions.pe");
define("_MAIL_FROM_NAME","MAIL - AMERICANEXPEDITIONS");
	
	

define("_TITLE_PUBLIC","AQUARIUM TRAVEL");
#----------------------------------------------------------------------------------------------------------
define("_TITLE_TESTIMONIOS","TESTIMONIOS DE NUESTROS CLIENTES | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_TESTIMONIOS","AQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_TESTIMONIOS","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);
#----------------------------------------------------------------------------------------------------------
define("_TITLE_GALLERYPHOTO","GALERIA DE FOTOS | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_GALLERYPHOTO","AQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_GALLERYPHOTO","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);
#----------------------------------------------------------------------------------------------------------
define("_TITLE_GALLERYVIDEOS","GALERIA DE VIDEOS YOUTUBE | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_GALLERYVIDEOS","AQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_GALLERYVIDEOS","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

#----------------------------------------------------------------------------------------------------------
define("_TITLE_CONTACTENOS","CONTACTENOS | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_CONTACTENOS","CONTACTENOS PAQUETES TURISTICOS PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU | "._TITLE_PUBLIC);

define("_TITLE_KEYWORD_CONTACTENOS","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

#----------------------------------------------------------------------------------------------------------
define("_TITLE_RESERVAS","RESERVAS | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_RESERVAS","RESERVAS DE PAQUETES TURISTICOS INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES | "._TITLE_PUBLIC);

define("_TITLE_KEYWORD_RESERVAS","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

#----------------------------------------------------------------------------------------------------------
define("_TITLE_PASAJES","PASAJES AEREOS BARATOS | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_PASAJES","PAQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_PASAJES","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

#----------------------------------------------------------------------------------------------------------
define("_TITLE_HOTELES","HOTELES | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_HOTELES","AQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_HOTELES","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

#----------------------------------------------------------------------------------------------------------
define("_TITLE_FOTOS","GALERIA DE FOTOS | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_FOTOS","AQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_FOTOS","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

#----------------------------------------------------------------------------------------------------------
define("_TITLE_VIDEOS","VIDEOS YOUTUBE | "._TITLE_PUBLIC);
define("_TITLE_DESCRIPTION_VIDEOS","AQUETES TURISTICOS-PAQUETES INTERNACIONALES - VIAJES INTERNACIONALES- VACACIONES-PASAJES ECONOMICOS- TURISMO EN PERU - AGENCIA DE VIAJES - TOURS A PERU - VIAJES A PERU - VACACIONES EN PERU - PASAJES AEREOS BARATOS - VIAJES SAN ANDRES-VIAJES- SANTA MARTA -CARTAGENA COLOMBIA-VARADERO-HABABA-MIAMI-ALQUILER DE AUTO-OFERTAS DE VIAJE-BUENOS AIRES-OFERTAS DE PASAJES AEREOS-PUNTA CANA-CRUCERO-CUSCO-AREQUIPA-SELVA PERUANA-PAQUETES TURISTICOS A PERU-RIO DE JANEIRO-BUZIOS-SAOPAULO-PASAJES,VIAJES Y TURISMO-VACACIONES EN CRUCERO-EUROPA TURISTICA-TURISMO A EUROPA-TOURS EUROPA-MIAMI-ORLANDO-DISNEY | "._TITLE_PUBLIC);
define("_TITLE_KEYWORD_VIDEOS","paquetes internacionales,pasajes baratos,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

define("_TITLE_DESTINOS","DESTINOS TURISTICOS | "._TITLE_PUBLIC);

define("_TITLE_OFERTAS","Ofertas de Paquetes Turisticos en Perú Todo Incluido");
define("_TITLE_DESCRIPTION_OFERTAS","Aprovecha las mejores Ofertas de Paquetes Turísticos Internacionales y Nacionales, Todo Incluido desde Lima - Perú");
define("_TITLE_KEYWORD_OFERTAS","ofertas internacionales,viajes,ofertas de viaje,viajes a peru,vacaciones en peru,vacaciones sol y playa,agencias de viajes y turismo,turismo,cuzco,paquetes turisticos,peru,peruvian travel service,agencias,lima,vacaciones,agencias de viajes,cuzco,luna de miel,viajes negocios,viajes relajantes,reservas aereas,travel tours,viajes,vuelos,excursiones,ofertas,viajes,vuelos,hoteles | "._TITLE_PUBLIC);

?>
