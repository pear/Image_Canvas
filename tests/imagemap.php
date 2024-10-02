<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This is a visual test case, testing image map support
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This library is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version. This library is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser
 * General Public License for more details. You should have received a copy of
 * the GNU Lesser General Public License along with this library; if not, see
 * <http://www.gnu.org/licenses/>
 *
 * @category  Images
 * @package   Image_Canvas
 * @author    Jesper Veggerby <pear.nosey@veggerby.dk>
 * @author    Stefan Neufeind <pear.neufeind@speedpartner.de>
 * @copyright 2003-2009 The PHP Group
 * @license   http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version   SVN: $Id$
 * @link      http://pear.php.net/package/Image_Canvas
 */  

require_once 'vendor/autoload.php';

$canvas =& Image_Canvas::factory(
    'png', 
    array('width' => 800, 'height' => 500, 'usemap' => true, 'antialias' => 'native')
);

$canvas->setLineColor('black');
$canvas->rectangle(array('x0' => 0, 'y0' => 0, 'x1' => $canvas->getWidth() - 1, 'y1' => $canvas->getHeight() - 1));


$canvas->setLineColor('gray');
$canvas->line(
    array(
        'x0' => 450, 
        'y0' => 50, 
        'x1' => 550, 
        'y1' => 100,
        'url' => 'http://pear.veggerby.dk/',
        'target' => '_blank',
        'alt' => 'Line',
        'mapsize' => 5
    )
);

$canvas->setLineColor('gray');
$canvas->line(
    array(
        'x0' => 600, 
        'y0' => 125, 
        'x1' => 700, 
        'y1' => 50,
        'url' => 'http://pear.veggerby.dk/',
        'target' => '_blank',
        'alt' => 'Line',
        'mapsize' => 5
    )
);

$canvas->setLineColor('blue');
$canvas->rectangle(
    array(
        'x0' => 50, 
        'y0' => 50, 
        'x1' => 350, 
        'y1' => 100,
        'url' => 'http://pear.veggerby.dk/',
        'target' => '_blank',
        'alt' => 'Rectangle'
    )
);

$canvas->setLineColor('red');
$canvas->ellipse(
    array(
        'x' => 200, 
        'y' => 200, 
        'rx' => 75, 
        'ry' => 75,
        'url' => 'http://pear.php.net/Image_Graph/',
        'alt' => 'Circle'
    )
);

$canvas->setLineColor('brown');
$canvas->ellipse(
    array(
        'x' => 500, 
        'y' => 200, 
        'rx' => 100, 
        'ry' => 75,
        'url' => 'http://pear.php.net/Image_Graph/',
        'alt' => 'Ellipse'
    )
);

$canvas->setLineColor('green');
for ($i = 0; $i < 8; $i++) {
    $canvas->addVertex(array('x' => 115 + $i * 50, 'y' => 330, 'alt' => 'Vertex #' . $i * 3, 'url' => 'test?id=' . $i * 3));
    $canvas->addVertex(array('x' => 100 + $i * 50, 'y' => 325, 'alt' => 'Vertex #' . ($i * 3 + 1), 'url' => 'test?id=' . ($i * 3 + 1)));
    $canvas->addVertex(array('x' => 125 + $i * 50, 'y' => 350, 'alt' => 'Vertex #' . ($i * 3 + 2), 'url' => 'test?id=' . ($i * 3 + 2)));
}
$canvas->polygon(
    array(
        'connect' => false, 
        'url' => 'http://php.net/',
        'alt' => 'Open polygon',
        'map_vertices' => true
    )
);

$canvas->setLineColor('purple');
for ($i = 0; $i < 8; $i++) {
    $canvas->addVertex(array('x' => 100 + $i * 50, 'y' => 355));
    $canvas->addVertex(array('x' => 125 + $i * 50, 'y' => 380 + 2 * $i));
}
$canvas->addVertex(array('x' => 550, 'y' => 355));
for ($i = 4; $i >= 0; $i--) {
    $canvas->addVertex(array('x' => 120 + $i * 100, 'y' => 430 + $i * 5));
    $canvas->addVertex(array('x' => 110 + $i * 100, 'y' => 405 - $i * 5));
}
$canvas->polygon(
    array(
        'connect' => true, 
        'url' => 'http://pear.php.net/',
        'alt' => 'Closed polygon'
    )
);    

$canvas->setLineColor('orange');
$canvas->pieslice(
    array(
        'x' => 600, 
        'y' => 400, 
        'rx' => 50, 
        'ry' => 50, 
        'v1' => 10, 
        'v2' => 350, 
        'url' => 'http://www.dr.dk/',    
        'alt' => 'Pieslice'
    )
);

$canvas->setLineColor('silver');
$canvas->pieslice(
    array(
    'x' => 700, 
        'y' => 300, 
        'rx' => 100, 
        'ry' => 50, 
        'v1' => 45, 
        'v2' => 275,
        'srx' => 25,
        'sry' => 10, 
        'url' => 'http://www.dr.dk/',    
        'alt' => 'Donut slice',
        'htmltags' => array(
            'onMouseOver' => 'alert("Hello, World!");'
        )
    )
);

print $canvas->toHtml(
    array(
        'filename' => 'imagemap.png',
        'filepath' => './',
        'urlpath' => ''
    )
);

?>
