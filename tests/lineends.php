<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This is a visual test case, testing canvas support for text output.
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

if (file_exists('vendor/autoload.php')) {
    // use composer if available
    require_once 'vendor/autoload.php';
} else {
    // otherwise rely on classic PEAR include_path
    require_once 'Image/Canvas.php';
}

$font = array('name' => 'Verdana', 'size' => 10);

$canvas =& Image_Canvas::factory(
    'png',
    array('width' => 300, 'height' => 300)
);

$shapes = array('arrow', 'box', 'diamond', 'arrow2', 'lollipop', 'line');

$j = 0;
for ($i = 0; $i < 360; $i += 30) {
    $x0 = 150;
    $y0 = 150;
    if ($j >= count($shapes)) {
        $j = 0;
    }
    $shape1 = $shapes[$j]; $j++;

    if ($j >= count($shapes)) {
        $j = 0;
    }
    $shape2 = $shapes[$j]; $j++;

    $canvas->setLineColor('black');
    $canvas->line(
        array(
            'x0' => $x0 + cos(deg2rad($i)) * 50,
            'y0' => $y0 - sin(deg2rad($i)) * 50,
            'x1' => $x0 + cos(deg2rad($i)) * 100,
            'y1' => $y0 - sin(deg2rad($i)) * 100,
            'end0' => $shape1,
            'size0' => 8,
            'color0' => 'red',
            'end1' => $shape2,
            'color1' => 'green',
            'size1' => 8
        )
    );
    $canvas->setFont($font);
    $canvas->addText(
        array(
            'x' => $x0 + cos(deg2rad($i)) * 125, 
            'y' => $y0 - sin(deg2rad($i)) * 125, 
            'text' => $i,
            'alignment' => array(
                'horizontal' => ((($i > 90) && ($i < 270)) ? 'right' : ((($i == 90) || ($i == 270)) ? 'center' : 'left')), 
                'vertical' => (($i < 180) ? 'bottom' : ((($i == 0) || ($i == 180)) ? 'center' : 'top')), 
            )            
        )
    );
}
$canvas->show();

?>
