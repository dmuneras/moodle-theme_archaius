<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'theme_archaius', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   theme_archaius
 * @copyright 2012 onwards Daniel Munera Sanchez  {@link http://dmuneras.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//REGIONS
$string['pluginname'] = 'Archaius';
$string['region-side-post'] = 'Derecha';
$string['region-side-pre'] = 'Izquierda';
$string['region-side-center-pre'] = "Antes del contenido principal";
$string['region-side-center-post'] = "Después del contenido principal";
$string['region-footer-left'] = "Izquierda footer";
$string['region-footer-center'] = "Centro footer";
$string['region-footer-right'] = "Derecha footer";

//PRESENTATION PAGE
$string['choosereadme'] = '<div class="clearfix"><div class="theme_screenshot"><h2>Archaius</h2>                                                                                      
<img src="archaius/pix/screenshot.png" />                                                                                                                                             
<h3>Créditos</h3><p><a href="http://docs.moodle.org/en/Theme_credits">http://docs.moodle.org/en/Theme_credits</a></p>                                                           
<h3>Documentación</h3>
<p><a href="http://docs.moodle.org/en/Themes">http://docs.moodle.org/en/Themes</a></p>    
<p><a href="https://github.com/dmuneras/moodle-theme_archaius/wiki">Archaius wiki</a></p>                                                               
<h3>Reportar un error o proponer una mejora</h3>
<p><a href="http://tracker.moodle.org">http://tracker.moodle.org</a></p>
<p><a href="https://github.com/dmuneras/moodle-theme_archaius/issues">Proyecto en Github</a></p>
</div>                                                                                 
<div class="theme_description"><h2>Acerca de</h2><p>Archaius es un tema gráfico de tres columnas que se caracteriza por sus bloques y temario en los cursos.
Es muy flexible, cuenta con diferentes opciones para el cambio de apariencia y con poco conocimiento en desarrollo para web se pueden lograr grandes resultados.</p>
<p>Propongo una solución diferentes para \'Docking blocks\'.</p>                                                                                                                  
<h2>Tweaks</h2>
<p>Si piensas modificar el tema es recomendable que lo dupliques primero y le cambies el nombre. Esto evitará que sus cambios sean sobreescritos por actualizaciones, y vas a tener los archivos originales por si algo malo ocurre.                                                                                                                                                                       
Más información para la modificación de temas puede ser encontrada en: <a href="http://docs.moodle.org/en/Theme">MoodleDocs</a>.</p>                                                               
<h2>Créditos</h2><p>Este tema fue inspirado por Anomaly, que fue diseñado originalmente para Moodle 1.9 por Patrick Malley.                                                                                                                     
Archaius fue creado por Daniel Múnera Sánchez (dmunera119@gmail.com)</p>
 <p>El logo fue una contribución de Juan Pablo Londoño Bastidas, diseñador gráfico de la Universidad EAFIT de Colombia.</p>
 <p>Finalmente, muchas gracias a Ana Beatriz Chiquito por el apoyo para crear el primer prototipo.</p>';

//THEME OPTIONS
$string['logo'] = 'logo';
$string['logodesc'] = 'Dirección URL del logo para ser agregado.';

$string['mlogo'] = 'Logo para dispositivos móviles';
$string['mlogodesc'] = 'Logo para dispositivos móviles, aparecerá cuando el ancho de la pantalla sea menor que 768px';

$string['customcss'] = 'Reglas CSS personalizadas.';
$string['customcssdesc'] = 'Puedes añadir reglas CSS personalizadas para mejorar tu diseño.';

$string['customjs'] = 'Javascript';
$string['customjsdesc'] = 'Puedes añadir Javacript a tu sitio, jQuery esta disponible.';

$string['footnote'] = "Nota de pie.";
$string['footnotedesc'] = "Nota de pie.";

$string['themecolor'] = "Color para el Header y el Footer de tu sitio.";
$string['themecolordesc'] = "Elige el color del Header y el Footer de tu sitio.";

$string['headercolor'] = "Color de los encabezados de los bloques.";
$string['headercolordesc'] = "Elige el color de los encabezados de los bloques.";

$string['currentcolor'] = "Color del encabezado del bloque actual.";
$string['currentcolordesc'] = "Color del encabezado actual.";

$string['bgcolor'] = "Color de fondo.";
$string['bgcolordesc'] = "Elige el Color de fondo de tu sitio.";

$string['custommenucolor'] = "Color del menú horizontal.";
$string['custommenucolordesc'] = "Color del menú horizontal.";

$string['currentcustommenucolor'] = "Color del item actual en el menú horizontal.";
$string['currentcustommenucolordesc'] = "Elige el color del item actual en el menú horizontal.";

$string["collapsibleTopics"] = "Efecto del temario plegable.";
$string["collasibleTopicsdesc"] = "Activar o desactivar el efecto gráfico del temario plegable.";

$string["hideShowBlocks"] = "Efecto para esconder y mostrar los bloques.";
$string["hideShowBlocksdesc"] = "Activar o desactivar el efecto para esconder y mostrar los bloques, es muy útil para ver el contenido principal usando el 100% del espacio disponible.";

$string["accordionBlocks"] = "Activar efecto acordeón";
$string["accordionBlocksdesc"] = "Activar efecto acordeón para los bloques laterales";

$string["slideshowheight"] = "Altura del carusel de la página principal";
$string["slideshowheightdesc"] = "Altura del carusel de la página principal, Se debe poner solo el número, este será utizado como PIXEL. NO PONER 'px' al final";

//SLIDESHOW
$string["description"] = "Insertar HTML para crear un <i>slide</i>.";
$string["position"] = "Posición del <i>slide</i>.";
$string["errorPosition"] = "<span class ='error'>Position is not a number or is equal to 0, 0 is not a valid position</span>";
$string["addSlide"] = "Adicionar un nuevo <i>slide</i>";
$string["update_description"] = "Actualizar descripción";
$string["activateSlideshow"] = 'Activar carusel de la página principal.';
$string["activateSlideshowdesc"] = 'Activar carusel de la página principal, el <i>slide</i> puede ser una imagen o solo HTML. La altura máxima es de 300px.';
$string["pos"] = "Posición";
$string["activatePausePlaySlideshow"] = "Activar el botón para pausar e iniciar el carusel de la página principal.";
$string["activatePausePlaySlideshowdesc"] = "Activar el botón para pausar e iniciar el carusel de la página principal.";
$string["slideshowTimeout"] = "tiempo entre <i>slides</i>";
$string["slideshowTimeoutdesc"] = "Tiempo en milisegundos para pasar de <i>slide</i>, tiene que se mayor a 1500ms (1.5segundos)";

//Form exceptions
$string["positionException"] = "La posición es requerida y tiene que ser mayor que cero.";
$string["descriptionEditorException"] = "No queremos un slide en blanco.";
$string["confirmationDeleteSlide"] = "Esta seguro que quiere eliminar este slide?";
$string["noSlides"] = "No hay ningún <i>slide</i> en el momento.";


