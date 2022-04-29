<!DOCTYPE html>
<html>
<head>
    <title>Cliente Web PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
</head>
<body>
<div class="container">
    <h3 align="left">Cliente Web PHP</h3>
    <br />
    <a href="create.php">Nuevo Cliente</a>
    <div class="panel panel-primary">
        <div class="panel-heading">Sample Data</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="personal" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Activo</th>
                        <th>Bolsa</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Rentabilidad</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br />
<br />
<br/>
Resultado: <span id="resultado">0</span>
</body>
</html>
<script type="text/javascript" language="javascript" src="view/js/script.js"></script>
