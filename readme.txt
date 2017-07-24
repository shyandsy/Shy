Shy is a very basic MVC framework for study purpose.

V1.2
1.Support PSR-4 autoload mechanism
2.Session, base on the PHP interface SessionHandlerInterface
    file session
3.Log
    file log

------------------------------------------------------------

V1.1
-Application Config
    -db
    -debug status
    -directory
-Application
    -debug status
    -bootstrap
-ShyCart
    -app

* the privilege of view-cache must be 777

------------------------------------------------------------

v1.0
-front controller pattern
-request/response encapsulation
-serer/cookie/session encapsulation
-routing request to destination controller
    -default control if get['route'] havent given
    -error page if controller does not exist

functionality categories:
-engine
    controller
    model
    view
-library
