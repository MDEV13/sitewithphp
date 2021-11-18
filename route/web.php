<?php
class Route{
   function loadPage($db, $controllerName, $actionName = 'index'){
       include_once 'app/Controllers/IndexController.php';
       include_once 'app/Controllers/UsersController.php';
       include_once 'app/Controllers/RoleController.php';

       switch ($controllerName) {
            case 'roles':
                $controller = new RoleController($db);
            break;
           case 'users':
               $controller = new UsersController($db);
               break;
           default:
               $controller = new IndexController($db);
       }
       // запускаємо необхідний метод
       $controller->$actionName();
   }
}
