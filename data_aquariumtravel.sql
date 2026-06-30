/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.25a : Database - aquarium
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_administrador` */

CREATE TABLE `tbl_administrador` (
  `pk_usuario` int(10) NOT NULL,
  `fk_supervisor` int(10) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `type` enum('1','2','3') DEFAULT '3' COMMENT '1=> Administrador; 2=> Supervisor; 3 => Telemarketera',
  `email` varchar(150) DEFAULT NULL,
  `reg_ip` varchar(20) DEFAULT NULL,
  `last_signin` varchar(12) DEFAULT NULL,
  `int_status` int(1) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL COMMENT 'Fecha de registro de la telemarketera'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_aeropuerto` */

CREATE TABLE `tbl_aeropuerto` (
  `pk_aeropuerto` int(4) NOT NULL,
  `txt_nombre` varchar(220) NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_imagen` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_album` */

CREATE TABLE `tbl_album` (
  `pk_album` int(11) NOT NULL,
  `album_fecha` date NOT NULL,
  `album_status` int(1) NOT NULL,
  `album_dateadd` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_album_details` */

CREATE TABLE `tbl_album_details` (
  `fk_album` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `txt_title` varchar(100) NOT NULL,
  `txt_descripcion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_album_photo` */

CREATE TABLE `tbl_album_photo` (
  `id_photoalbum` varchar(20) NOT NULL,
  `fk_album` int(11) NOT NULL,
  `fotoalbum_big` varchar(50) NOT NULL,
  `fotoalbum_prev` varchar(50) NOT NULL,
  `foto_order` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_banner` */

CREATE TABLE `tbl_banner` (
  `pk_banner` int(11) NOT NULL,
  `txt_url` varchar(220) NOT NULL,
  `int_ispopup` int(1) NOT NULL DEFAULT '0',
  `txt_winwidth` int(3) DEFAULT NULL,
  `txt_winheight` int(3) DEFAULT NULL,
  `txt_destino` varchar(20) NOT NULL,
  `int_orden` int(2) NOT NULL,
  `int_estado` int(1) NOT NULL,
  `date_add` date DEFAULT NULL,
  `int_position` int(1) DEFAULT NULL,
  `txt_visibletitle` int(1) DEFAULT NULL,
  `int_fondo` int(1) DEFAULT NULL,
  `txt_colorfondo` varchar(7) DEFAULT NULL,
  `reg_update` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_banners_details` */

CREATE TABLE `tbl_banners_details` (
  `fk_banner` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '0',
  `txt_title` varchar(100) DEFAULT NULL,
  `txt_description` varchar(300) DEFAULT NULL,
  `txt_imagen` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_cadena` */

CREATE TABLE `tbl_cadena` (
  `pk_cadena` int(4) NOT NULL,
  `txt_nombre` varchar(120) CHARACTER SET utf8 NOT NULL,
  `txt_imagen` varchar(220) NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_creacion` date NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_categoria` */

CREATE TABLE `tbl_categoria` (
  `pk_categoria` int(11) NOT NULL,
  `fk_categoria` int(11) NOT NULL,
  `int_tipo` int(1) NOT NULL,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` text NOT NULL,
  `txt_meta` text NOT NULL,
  `txt_metatitle` varchar(220) NOT NULL,
  `txt_titulo` varchar(220) NOT NULL,
  `txt_imagen` varchar(120) NOT NULL,
  `int_estado` int(1) NOT NULL,
  `int_orden` char(2) NOT NULL,
  `txt_dateadd` date NOT NULL DEFAULT '0000-00-00',
  `txt_linkexterno` varchar(200) DEFAULT NULL,
  `fk_languages` int(1) NOT NULL,
  `int_visto` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_configuration` */

CREATE TABLE `tbl_configuration` (
  `configuration_id` int(11) NOT NULL,
  `configuration_title` varchar(255) NOT NULL,
  `configuration_key` varchar(255) NOT NULL,
  `configuration_value` text NOT NULL,
  `configuration_description` varchar(255) NOT NULL,
  `configuration_group_id` int(11) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `use_function` varchar(255) DEFAULT NULL,
  `set_function` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_contactos` */

CREATE TABLE `tbl_contactos` (
  `pk_contacto` int(11) NOT NULL,
  `txt_nombres` varchar(150) NOT NULL,
  `txt_email` varchar(100) NOT NULL DEFAULT '',
  `txt_telefono` varchar(20) NOT NULL DEFAULT '',
  `txt_pais` varchar(100) NOT NULL,
  `txt_comentario` text NOT NULL,
  `date_fecha` date NOT NULL DEFAULT '0000-00-00',
  `txt_nota` text NOT NULL,
  `txt_vendedor` varchar(220) NOT NULL,
  `fk_estado` int(1) NOT NULL,
  `txt_anotacion` text NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_contenido` */

CREATE TABLE `tbl_contenido` (
  `pk_content` int(11) NOT NULL,
  `fk_seccion` int(4) NOT NULL DEFAULT '0',
  `int_estado` int(1) NOT NULL,
  `txt_orden` int(1) DEFAULT NULL,
  `txt_imagen` varchar(100) DEFAULT NULL,
  `txt_dateadd` date NOT NULL,
  `txt_dateupdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_contenido_details` */

CREATE TABLE `tbl_contenido_details` (
  `fk_content` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `txt_title` varchar(200) NOT NULL,
  `txt_details` text,
  `txt_metatitle` varchar(220) NOT NULL,
  `txt_metalink` varchar(220) NOT NULL,
  `txt_metadescription` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_countries` */

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_departamento` */

CREATE TABLE `tbl_departamento` (
  `pk_departamento` int(4) NOT NULL,
  `fk_pais` int(4) NOT NULL DEFAULT '0',
  `txt_descripcion` varchar(120) CHARACTER SET utf8 NOT NULL,
  `txt_imagen` varchar(220) NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_creacion` date NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_destino` */

CREATE TABLE `tbl_destino` (
  `pk_destino` int(4) NOT NULL,
  `txt_nombre` varchar(220) NOT NULL,
  `txt_metatitle` varchar(255) NOT NULL,
  `txt_metadescription` varchar(255) NOT NULL,
  `fk_ubicacion` int(4) NOT NULL,
  `txt_descripcion` text CHARACTER SET utf8 NOT NULL,
  `txt_imagen` varchar(220) NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_creacion` date NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_empresa` */

CREATE TABLE `tbl_empresa` (
  `pk_empresa` int(4) NOT NULL,
  `txt_razon` varchar(120) NOT NULL,
  `txt_domicilio` varchar(220) NOT NULL,
  `txt_ruc` varchar(11) NOT NULL,
  `txt_email` varchar(50) NOT NULL,
  `txt_telefono` varchar(50) NOT NULL,
  `txt_fax` varchar(50) NOT NULL,
  `int_estado` int(4) NOT NULL,
  `txt_fecha` varchar(20) NOT NULL,
  `txt_personas` text NOT NULL,
  `txt_volumendolares` varchar(120) NOT NULL,
  `txt_volumensoles` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_estado` */

CREATE TABLE `tbl_estado` (
  `pk_estado` int(4) NOT NULL,
  `txt_descripcion` varchar(220) NOT NULL,
  `int_estado` int(1) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_hoteles` */

CREATE TABLE `tbl_hoteles` (
  `pk_hoteles` int(11) NOT NULL,
  `txt_direccion` text,
  `fk_departamento` int(4) NOT NULL DEFAULT '0',
  `fk_cadena` int(4) NOT NULL DEFAULT '0',
  `txt_link` varchar(220) NOT NULL,
  `txt_precio_simple` varchar(20) NOT NULL,
  `txt_precio_doble` varchar(20) NOT NULL,
  `txt_precio_triple` varchar(20) NOT NULL,
  `txt_precio_nino` varchar(20) NOT NULL,
  `int_estrellas` int(1) NOT NULL DEFAULT '0',
  `int_status` int(1) NOT NULL,
  `int_destacado` int(1) NOT NULL DEFAULT '0',
  `txt_image` varchar(100) DEFAULT NULL,
  `txt_datehoteles` date NOT NULL,
  `txt_dateadd` date NOT NULL,
  `txt_dateupdate` date NOT NULL,
  `mm_photoportada` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_hoteles_details` */

CREATE TABLE `tbl_hoteles_details` (
  `fk_hoteles` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `txt_title` varchar(220) NOT NULL,
  `txt_content` text NOT NULL,
  `txt_servicios` text NOT NULL,
  `txt_habitacion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_hoteles_gallery` */

CREATE TABLE `tbl_hoteles_gallery` (
  `pk_mmimage` int(11) NOT NULL,
  `fk_hoteles` int(11) NOT NULL DEFAULT '0',
  `mm_filenamebig` varchar(100) DEFAULT NULL,
  `mm_filenamemin` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_language` */

CREATE TABLE `tbl_language` (
  `languages_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` char(2) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `directory` varchar(32) DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_llamadas` */

CREATE TABLE `tbl_llamadas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `hora` varchar(20) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `destino` varchar(220) NOT NULL,
  `telefono01` varchar(20) NOT NULL,
  `telefono02` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `tipo` varchar(120) DEFAULT NULL,
  `observacion` text NOT NULL,
  `personal` varchar(50) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_newsletter` */

CREATE TABLE `tbl_newsletter` (
  `pk_newsletter` int(4) NOT NULL,
  `date_fecha` date NOT NULL,
  `txt_nombres` varchar(120) NOT NULL,
  `txt_email` varchar(120) NOT NULL,
  `int_estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_nivel` */

CREATE TABLE `tbl_nivel` (
  `pk_nivel` int(4) NOT NULL,
  `txt_descripcion` varchar(50) NOT NULL,
  `int_estado` int(1) NOT NULL,
  `language_id` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_noticia` */

CREATE TABLE `tbl_noticia` (
  `pk_noticia` int(11) NOT NULL,
  `int_status` int(1) NOT NULL,
  `txt_image` varchar(100) DEFAULT NULL,
  `txt_datenoticia` date NOT NULL,
  `txt_dateadd` date NOT NULL,
  `txt_dateupdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_noticia_details` */

CREATE TABLE `tbl_noticia_details` (
  `fk_noticia` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `txt_title` varchar(150) NOT NULL,
  `txt_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_paquete` */

CREATE TABLE `tbl_paquete` (
  `pk_paquete` int(11) NOT NULL,
  `txt_datepaquete` date NOT NULL,
  `fk_categoria` int(4) NOT NULL,
  `fk_destino` int(4) NOT NULL,
  `fk_aeropuerto` int(1) NOT NULL DEFAULT '1',
  `txt_bhoteles` varchar(100) NOT NULL,
  `txt_youtube` varchar(200) DEFAULT NULL,
  `int_status` int(1) NOT NULL,
  `txt_dateadd` date NOT NULL,
  `txt_dateupdate` date NOT NULL,
  `txt_date_from` date DEFAULT NULL,
  `txt_date_to` date DEFAULT NULL,
  `int_dias` int(2) DEFAULT NULL,
  `int_noches` int(2) DEFAULT NULL,
  `txt_precio` varchar(100) DEFAULT NULL,
  `txt_precio_soles` varchar(20) NOT NULL,
  `txt_tipo_cambio` varchar(20) NOT NULL,
  `int_ishome` int(1) DEFAULT NULL COMMENT 'Si el paquete turístico se visualiza en el inicio',
  `int_isdestacado` int(1) NOT NULL DEFAULT '0',
  `int_isnuevo` int(1) NOT NULL DEFAULT '0',
  `int_isultimos` int(1) NOT NULL DEFAULT '0',
  `int_agotado` int(1) NOT NULL DEFAULT '0',
  `int_visto` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_paquete_details` */

CREATE TABLE `tbl_paquete_details` (
  `fk_paquete` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `txt_title` varchar(200) NOT NULL,
  `txt_presentacion` text NOT NULL,
  `txt_contenido` text,
  `txt_tours` text NOT NULL,
  `txt_incluye` text NOT NULL,
  `txt_detalle` text NOT NULL,
  `txt_title_youtube` varchar(200) DEFAULT NULL,
  `txt_descyoutube` varchar(250) DEFAULT NULL,
  `txt_boleto` varchar(200) DEFAULT NULL,
  `txt_traslate` varchar(200) DEFAULT NULL,
  `txt_imagen` varchar(150) DEFAULT NULL,
  `txt_pdf` varchar(100) NOT NULL,
  `txt_meta_title` varchar(200) NOT NULL,
  `txt_meta_keyword` varchar(200) NOT NULL,
  `txt_meta_description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_paquete_images` */

CREATE TABLE `tbl_paquete_images` (
  `pict_id` int(11) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `prod_imgbig` varchar(100) DEFAULT NULL,
  `prod_imgmedium` varchar(100) DEFAULT NULL,
  `prod_imgmin` varchar(100) DEFAULT NULL,
  `prod_order` int(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_paquete_ratings` */

CREATE TABLE `tbl_paquete_ratings` (
  `fk_paquete` int(4) NOT NULL,
  `total_votes` int(5) NOT NULL DEFAULT '0',
  `total_value` int(5) NOT NULL DEFAULT '0',
  `used_ips` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_pasajes` */

CREATE TABLE `tbl_pasajes` (
  `pk_pasaje` int(4) NOT NULL,
  `txt_imagen` varchar(120) NOT NULL,
  `txt_cobertura` varchar(100) NOT NULL,
  `txt_metatitle` varchar(220) NOT NULL,
  `txt_metadescription` varchar(220) NOT NULL,
  `int_estado` int(1) NOT NULL,
  `txt_dateadd` date NOT NULL,
  `txt_datepasaje` date NOT NULL,
  `txt_dateupdate` date NOT NULL,
  `int_fondo` int(1) DEFAULT NULL,
  `txt_colorfondo` varchar(12) DEFAULT NULL,
  `int_visto` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_pasajes_details` */

CREATE TABLE `tbl_pasajes_details` (
  `fk_pasaje` int(4) NOT NULL,
  `language_id` int(1) NOT NULL,
  `txt_destino` varchar(220) NOT NULL,
  `txt_detalle` text NOT NULL,
  `txt_precio` varchar(220) NOT NULL,
  `txt_incluye` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_reservas` */

CREATE TABLE `tbl_reservas` (
  `pk_reserva` int(11) NOT NULL,
  `txt_name` varchar(150) NOT NULL DEFAULT '',
  `txt_ape` varchar(150) NOT NULL,
  `txt_email` varchar(100) NOT NULL DEFAULT '',
  `txt_direccion` varchar(250) DEFAULT NULL,
  `pais` varchar(100) NOT NULL DEFAULT '0',
  `fk_destino` int(4) NOT NULL DEFAULT '0',
  `fk_estado` int(1) NOT NULL DEFAULT '0',
  `txt_cantidad_adultos` varchar(50) NOT NULL,
  `txt_cantidad_ninos` varchar(50) NOT NULL,
  `txt_fecha_salida` date NOT NULL,
  `txt_fecha_retorno` date NOT NULL,
  `txt_telefono` varchar(20) NOT NULL DEFAULT '',
  `txt_celular` varchar(100) NOT NULL,
  `txt_ingreso` varchar(150) NOT NULL,
  `txt_comentario` text NOT NULL,
  `txt_fecha_llamar` date NOT NULL,
  `txt_nota` text NOT NULL,
  `txt_vendedor` varchar(220) NOT NULL,
  `txt_hoteles` varchar(220) NOT NULL,
  `txt_reserva` varchar(220) NOT NULL,
  `txt_tipo` varchar(220) NOT NULL,
  `date_fecha` datetime NOT NULL,
  `date_modificacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_seccion` */

CREATE TABLE `tbl_seccion` (
  `pk_seccion` int(10) NOT NULL,
  `txt_nombre` varchar(50) NOT NULL,
  `txt_url` varchar(200) NOT NULL,
  `txt_destino` varchar(15) NOT NULL,
  `txt_imagen` varchar(50) NOT NULL,
  `txt_orden` char(1) NOT NULL,
  `int_estado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_sorteo` */

CREATE TABLE `tbl_sorteo` (
  `pk_sorteo` int(11) NOT NULL,
  `txt_titulo` varchar(200) NOT NULL,
  `txt_ganador` varchar(200) NOT NULL,
  `txt_empresa` varchar(120) NOT NULL,
  `txt_cargo` varchar(120) NOT NULL,
  `txt_content` text NOT NULL,
  `txt_imgthumb` varchar(50) NOT NULL,
  `int_order` int(5) DEFAULT NULL,
  `txt_fecha` date NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_dateadd` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_testimonios` */

CREATE TABLE `tbl_testimonios` (
  `pk_testimonios` int(11) NOT NULL,
  `txt_imgthumb` varchar(50) NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_dateadd` date DEFAULT NULL,
  `txt_datetestimonio` date NOT NULL,
  `txt_dateupdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_testimonios_details` */

CREATE TABLE `tbl_testimonios_details` (
  `fk_testimonio` int(4) NOT NULL,
  `language_id` int(1) NOT NULL,
  `txt_title` varchar(220) NOT NULL,
  `txt_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_tours` */

CREATE TABLE `tbl_tours` (
  `pk_tours` int(4) NOT NULL,
  `txt_nombre` varchar(220) NOT NULL,
  `txt_imagen` varchar(220) NOT NULL,
  `txt_descripcion` text NOT NULL,
  `fk_destino` int(4) NOT NULL,
  `int_estado` int(1) NOT NULL DEFAULT '0',
  `txt_creacion` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_tours_ratings` */

CREATE TABLE `tbl_tours_ratings` (
  `fk_tours` int(4) NOT NULL,
  `total_votes` int(5) NOT NULL DEFAULT '0',
  `total_value` int(5) NOT NULL DEFAULT '0',
  `used_ips` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbl_video` */

CREATE TABLE `tbl_video` (
  `id` mediumint(6) unsigned NOT NULL,
  `video_title` varchar(100) NOT NULL DEFAULT '',
  `date_video` varchar(20) DEFAULT NULL,
  `yt_id` varchar(50) NOT NULL DEFAULT '',
  `yt_thumb` varchar(255) NOT NULL DEFAULT '',
  `added` varchar(11) NOT NULL DEFAULT '0',
  `video_destacado` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_webgrupos` */

CREATE TABLE `tbl_webgrupos` (
  `pk_grupo` int(11) NOT NULL,
  `txt_nombre` varchar(50) NOT NULL,
  `int_estado` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_webmodulos` */

CREATE TABLE `tbl_webmodulos` (
  `pk_modulo` int(11) NOT NULL,
  `fk_grupo` int(10) NOT NULL,
  `txt_nombre` varchar(50) NOT NULL,
  `txt_imagen` varchar(50) NOT NULL,
  `txt_include` varchar(50) NOT NULL,
  `int_estado` char(1) NOT NULL,
  `txt_sesion` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `vw_categorias_top10_mas_visto` */

DROP TABLE IF EXISTS `vw_categorias_top10_mas_visto`;

/*!50001 CREATE TABLE  `vw_categorias_top10_mas_visto`(
 `categoria` varchar(100) ,
 `int_visto` int(11) 
)*/;

/*Table structure for table `vw_contactos_historico` */

DROP TABLE IF EXISTS `vw_contactos_historico`;

/*!50001 CREATE TABLE  `vw_contactos_historico`(
 `anio` varchar(4) ,
 `cantidad` bigint(21) 
)*/;

/*Table structure for table `vw_cotizaciones_anio` */

DROP TABLE IF EXISTS `vw_cotizaciones_anio`;

/*!50001 CREATE TABLE  `vw_cotizaciones_anio`(
 `anio` varchar(4) ,
 `cantidad` bigint(21) 
)*/;

/*Table structure for table `vw_cotizaciones_mes_2023` */

DROP TABLE IF EXISTS `vw_cotizaciones_mes_2023`;

/*!50001 CREATE TABLE  `vw_cotizaciones_mes_2023`(
 `mes` varchar(69) ,
 `cantidad` bigint(21) 
)*/;

/*Table structure for table `vw_paquetes` */

DROP TABLE IF EXISTS `vw_paquetes`;

/*!50001 CREATE TABLE  `vw_paquetes`(
 `pk_paquete` int(11) ,
 `txt_title` varchar(200) 
)*/;

/*Table structure for table `vw_paquetes_top20_mas_visto` */

DROP TABLE IF EXISTS `vw_paquetes_top20_mas_visto`;

/*!50001 CREATE TABLE  `vw_paquetes_top20_mas_visto`(
 `paquete` varchar(200) ,
 `int_visto` int(11) 
)*/;

/*Table structure for table `vw_pasajes_top10_mas_visto` */

DROP TABLE IF EXISTS `vw_pasajes_top10_mas_visto`;

/*!50001 CREATE TABLE  `vw_pasajes_top10_mas_visto`(
 `pk_pasaje` int(4) ,
 `pasaje` varchar(220) ,
 `int_visto` int(11) 
)*/;

/*View structure for view vw_categorias_top10_mas_visto */

/*!50001 DROP TABLE IF EXISTS `vw_categorias_top10_mas_visto` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_categorias_top10_mas_visto` AS select `aquarium`.`tbl_categoria`.`txt_nombre` AS `categoria`,`aquarium`.`tbl_categoria`.`int_visto` AS `int_visto` from `tbl_categoria` order by `aquarium`.`tbl_categoria`.`int_visto` desc limit 0,10 */;

/*View structure for view vw_contactos_historico */

/*!50001 DROP TABLE IF EXISTS `vw_contactos_historico` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_contactos_historico` AS select date_format(`aquarium`.`tbl_contactos`.`date_fecha`,'%Y') AS `anio`,count(0) AS `cantidad` from `tbl_contactos` group by year(`aquarium`.`tbl_contactos`.`date_fecha`) order by date_format(`aquarium`.`tbl_contactos`.`date_fecha`,'%Y') desc */;

/*View structure for view vw_cotizaciones_anio */

/*!50001 DROP TABLE IF EXISTS `vw_cotizaciones_anio` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_cotizaciones_anio` AS select date_format(`aquarium`.`tbl_reservas`.`date_fecha`,'%Y') AS `anio`,count(0) AS `cantidad` from `tbl_reservas` where (date_format(`aquarium`.`tbl_reservas`.`date_fecha`,'%Y') <> '0000') group by year(`aquarium`.`tbl_reservas`.`date_fecha`) order by date_format(`aquarium`.`tbl_reservas`.`date_fecha`,'%Y') desc */;

/*View structure for view vw_cotizaciones_mes_2023 */

/*!50001 DROP TABLE IF EXISTS `vw_cotizaciones_mes_2023` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_cotizaciones_mes_2023` AS select date_format(`aquarium`.`tbl_reservas`.`date_fecha`,'%M %Y') AS `mes`,count(0) AS `cantidad` from `tbl_reservas` where (year(`aquarium`.`tbl_reservas`.`date_fecha`) = 2023) group by year(`aquarium`.`tbl_reservas`.`date_fecha`),month(`aquarium`.`tbl_reservas`.`date_fecha`) */;

/*View structure for view vw_paquetes */

/*!50001 DROP TABLE IF EXISTS `vw_paquetes` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_paquetes` AS select `aquarium`.`tbl_paquete_details`.`fk_paquete` AS `pk_paquete`,`aquarium`.`tbl_paquete_details`.`txt_title` AS `txt_title` from (`tbl_paquete` join `tbl_paquete_details` on((`aquarium`.`tbl_paquete`.`pk_paquete` = `aquarium`.`tbl_paquete_details`.`fk_paquete`))) */;

/*View structure for view vw_paquetes_top20_mas_visto */

/*!50001 DROP TABLE IF EXISTS `vw_paquetes_top20_mas_visto` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_paquetes_top20_mas_visto` AS select `aquarium`.`tbl_paquete_details`.`txt_title` AS `paquete`,`aquarium`.`tbl_paquete`.`int_visto` AS `int_visto` from (`tbl_paquete` join `tbl_paquete_details` on((`aquarium`.`tbl_paquete`.`pk_paquete` = `aquarium`.`tbl_paquete_details`.`fk_paquete`))) order by `aquarium`.`tbl_paquete`.`int_visto` desc limit 0,20 */;

/*View structure for view vw_pasajes_top10_mas_visto */

/*!50001 DROP TABLE IF EXISTS `vw_pasajes_top10_mas_visto` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`aquarium`@`localhost` SQL SECURITY DEFINER VIEW `vw_pasajes_top10_mas_visto` AS select `aquarium`.`tbl_pasajes_details`.`fk_pasaje` AS `pk_pasaje`,`aquarium`.`tbl_pasajes_details`.`txt_destino` AS `pasaje`,`aquarium`.`tbl_pasajes`.`int_visto` AS `int_visto` from (`tbl_pasajes` join `tbl_pasajes_details` on((`aquarium`.`tbl_pasajes`.`pk_pasaje` = `aquarium`.`tbl_pasajes_details`.`fk_pasaje`))) order by `aquarium`.`tbl_pasajes`.`int_visto` desc limit 0,10 */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
