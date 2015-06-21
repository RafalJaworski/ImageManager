<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
         'driver'         => 'Pdo',
         'dsn'            => 'mysql:dbname=image_manager;host=localhost',
         'driver_options' => array(
             PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
         ),
     ),
     'service_manager' => array(
        'factories' => array(
        'Zend\Db\Adapter\Adapter'  //This kye is used in Module.php -> $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        => 'Zend\Db\Adapter\AdapterServiceFactory',
    ),
    // PUT BELOW TO THE LOCAL.PHP THAT CAN'T BE SENT TO GITHUB
//         return array(
//             'db' => array(
//                 'username' => 'root',
//                 'password' => 'root',
//             ),
//         );
),
);
