<?php
    include_once "class/DB.php";
    include_once "class/Controller.php";

    use portalove\DB;
    use portalove\Controller;

    global $controller;

    $db         = new DB("127.0.0.1","portalove-riesenia","root","", 3306);
    $controller = new Controller($db);

    if (isset($_POST['operation'])) {
        switch ($_POST['operation']) {
            case 'create':
                $controller->createComment($_POST['nick'], $_POST['text']);
                break;
            case 'update-item':
                $controller->setItemToUpdate($_POST['id'], $_POST['nick'], $_POST['text']);
                break;
            case 'update':
                $controller->updateComment($_POST['id'], $_POST['text']);
                break;
            case 'delete':
                $controller->removeComment($_POST['id']);
                break;
            default:
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PortaloveRiesenia</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/templatemo-diagoona.css" rel="stylesheet" />
<!--

TemplateMo 550 Diagoona

https://templatemo.com/tm-550-diagoona

-->
</head>

<body>
    <div class="tm-container">
        <div>
            <div class="tm-row pt-4">
                <div class="tm-col-left">
                    <div class="tm-site-header media">
                        <i class="fas fa-umbrella-beach fa-3x mt-1 tm-logo"></i>
                        <div class="media-body">
                            <h1 class="tm-sitename">PortaloveRiesenia2022</h1>
                            <p class="tm-slogon">projekt na demončtráciu CRUD operácii</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tm-row">
                <div class="tm-col-left"></div>
                <main class="tm-col-right">
                    <section class="tm-content">
                        <h2 class="mb-5 tm-content-title">Rozpravajte sa</h2>
<?php
    $item_to_update = $controller->getItemToUpdate();
    if (empty($item_to_update)) {
        echo <<<END
                        <form method="post">
                          <input type="hidden" name="operation" value="create" />
                          <div class="form-group">
                            <label>Nick</label>
                            <input type="text" name="nick" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Komentár</label>
                            <textarea class="form-control" name="text"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Komentuj</button>
                        </form>
END;
    } else {
        echo <<<END
                        <form method="post">
                          <input type="hidden" name="operation" value="update" />
                          <input type="hidden" name="id" value="{$item_to_update['id']}" />
                          <div class="form-group">
                            <label>Nick</label>
                            <input type="text" name="nick" class="form-control" value="{$item_to_update['nick']}" disabled>
                          </div>
                          <div class="form-group">
                            <label>Komentár</label>
                            <textarea class="form-control" name="text">{$item_to_update['text']}</textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </form>
END;
    }
?>
                        <hr class="mb-5 mt-5">
<?php
  $controller->printComments();
?>
                    </section>
                </main>
            </div>
        </div>

        <div class="tm-row">
            <div class="tm-col-left text-center">
                <ul class="tm-bg-controls-wrapper">
                    <li class="tm-bg-control active" data-id="0"></li>
                    <li class="tm-bg-control" data-id="1"></li>
                    <li class="tm-bg-control" data-id="2"></li>
                </ul>
            </div>
        </div>

        <!-- Diagonal background design -->
        <div class="tm-bg">
            <div class="tm-bg-left"></div>
            <div class="tm-bg-right"></div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>
</html>
