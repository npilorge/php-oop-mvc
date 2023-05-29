<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableau de bord des voitures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <header>
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="page-header">Tableau de bord des voitures</h1>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade" id="carsModal" tabindex="-1" aria-labelledby="carsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="carsModalLabel"></h1>
                    </div>
                    <div class="modal-body">
                        <form id="cars-form">
                            <input type="hidden" id="car-id" name="car-id">
                            <div class="row mb-3">
                                <label for="marque" class="col-md-4 col-form-label">Marque</label>
                                <div class="col-md-8">
                                    <input type="text" name="marque" id="marque" class="form-control" maxlength="50" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="modele" class="col-md-4 col-form-label">Modèle</label>
                                <div class="col-md-8">
                                    <input type="text" name="modele" id="modele" class="form-control" maxlength="50" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="immatriculation" class="col-md-4 col-form-label">Immatriculation</label>
                                <div class="col-md-8">
                                    <input type="text" name="immatriculation" id="immatriculation" class="form-control" maxlength="20" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="carburant" class="col-md-4 col-form-label">Carburant</label>
                                <div class="col-md-8">
                                    <input type="text" name="carburant" id="carburant" class="form-control" maxlength="20" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="prix" class="col-md-4 col-form-label">Prix</label>
                                <div class="col-md-8">
                                    <input type="number" name="prix" id="prix" class="form-control" step="0.01" min="0" max="99999999.99" required>
                                </div>
                            </div>
                           <div class="row mb-3">
                                <label for="type_vente" class="col-md-4 col-form-label">Type de vente</label>
                                <div class="col-md-8">
                                    <select class="form-select" name="type-vente" id="type-vente" class="form-control" required>
                                        <option value="occasion">Occasion</option>
                                        <option value="neuve">Neuve</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="reserve" class="col-md-4 col-form-label">Réservé</label>
                                <div class="col-md-8">
                                    <input type="checkbox" name="reserve" id="reserve" class="form-check-input">
                                </div>
                            </div>
                            <button type="submit" id="save-button" class="btn btn-primary"></button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteCarConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteCarConfirmationLabel">Supprimer une voiture</h1>
                    </div>
                    <div class="modal-body">
                        Vous allez supprimer une voiture. Etes-vous sur ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmDelete" class="btn btn-primary">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal  -->
            <div class="row justify-content-md-center">
                <div class="col-lg-8">
                    <!-- Alert -->
                    <div id="liveAlert">
                        
                    </div>
                    <!-- End Alert -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" id="add-button" class="btn btn-primary">Ajouter</button>
                        </div>
                    <div class="panel-body">
                        <table id="cars-table" class="table table-bordered table-striped caption-top">
                            <caption>Liste des voitures</caption>
                            <thead>
                                <tr>
                                    <th scope="col">Marque</th>
                                    <th scope="col">Modèle</th>
                                    <th scope="col">Immatriculation</th>
                                    <th scope="col">Carburant</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Type de vente</th>
                                    <th scope="col">Réservé</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </main>

    <footer>        
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./public/js/script.js"></script>
</body>
</html>
