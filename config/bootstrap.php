<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 01/06/2020 23:41
 */

Yii::setAlias('@components', __DIR__ . '/../components');
Yii::setAlias('@controllers', __DIR__ . '/../controllers');
Yii::setAlias('@models', __DIR__ . '/../models');
Yii::setAlias('@widgets', __DIR__ . '/../widgets');
Yii::setAlias('@console', __DIR__ . '/../console');


/**
 * @param $expression
 * @param bool $return
 * @return string
 */
function dump($expression, $return=true)
{
    if ($expression === null) $expression = 'NULL';
    if ($expression === true) $expression = 'TRUE';
    if ($expression === false) $expression = 'FALSE';
    $html = '<pre>'.print_r($expression, $return).'</pre>';
    if ($return) return $html;
    echo $html;
}
