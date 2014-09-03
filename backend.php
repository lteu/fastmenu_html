<?php

/**
 * 
 * Developer: Liu Tong
 * Email: granwit@gmail.com
 * all rights reserved
*/

?>



<!DOCTYPE html>
<html>
<head>
    <title>Fast Menu</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='Description' content='fast menu mockup' />
    <meta name="author" content="liu tong">
    <link rel="shortcut icon" href="favicon.ico">

    <script type='text/javascript' src='js/lib/jquery-1.7.2.min.js'></script>
    <link type='text/css' href='css/bootstrap.css' rel='stylesheet' />
    <script type='text/javascript' src='js/lib/bootstrap.min.js'></script>

    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class='container'>
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Menù</h3>
                <div class="listapiatti"></div>
            </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">   
                <h3 class="panel-title">Modifica Piatto</h3>
            </a>
        </div>
        <div id="collapse1" class="collapse in">
            <div class="panel-body">

              <div class="form-group">
                <label for="nomepiatto">Nome Piatto</label>
                <input class="form-control" id="nomepiatto" placeholder="inserire un nome del piatto">
            </div>
            <div class="form-group">
                <label for="idpiatto">ID Piatto</label>
                <input class="form-control" id="idpiatto" placeholder="inserire id del piatto">
            </div>
            <div class="form-group">
                <label for="prezzopiatto">Prezzo</label>
                <input class="form-control" id="prezzopiatto" placeholder="inserire il prezzo in euro">
            </div>
            <div class="form-group">
                <label for="ingredientipiatto">Ingredienti</label>
                <input class="form-control" id="ingredientipiatto" placeholder="inserire gli ingredienti del piatto">
            </div>
            <div class="form-group">
                <label for="categpiatto">Categoria</label>
                <select class="form-control" id="categpiatto">
                  <option>Antipasto</option>
                  <option>Primo</option>
                  <option>Secondo</option>
                  <option>Contorno</option>
                  <option>Dolce</option>
                  <option>Bevande</option>
              </select>
          </div>
          <button class="btn btn-danger">Elimina</button>
          <button class="btn btn-primary pull-right aggiungipiatto">Aggiungi</button>

      </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">  
        <h3 class="panel-title">Modifica Utenti</h3>
    </a>
</div>
<div id="collapse2" class="collapse">
    <div class="panel-body">
        <form role="form">
          <div class="form-group">
            <label for="nomepiatto">Nome Cameriere</label>
            <input class="form-control" id="nomepiatto" placeholder="inserire un nome del piatto">
        </div>
        <div class="form-group">
            <label for="idpiatto">PIN</label>
            <input class="form-control" id="idpiatto" placeholder="inserire id nome del piatto">
        </div>
        <button class="btn btn-danger">Elimina</button>
        <button class="btn btn-primary pull-right">Aggiungi</button>
    </form>
</div>
</div>
</div>
</div>

</body>

<script type='text/javascript' src='js/ajax.js'></script>
<script type='text/javascript' src='js/backend.js'></script>
</html>


<script>

</script>