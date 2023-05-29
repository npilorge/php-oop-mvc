$(document).ready(function() 
{
    // Load the car table
    loadCarsTable();

    /**
     * Action when clicking on the add button
     */
    $(document).on("click", "#add-button", function()
    {
        // Reset the form
        $("#cars-form")[0].reset();
        $("#car-id").val('');

        // Modify the modal before display
        $("#carsModalLabel").html("Ajouter une voiture");
        $("#save-button").html("Ajouter");

        // Open the modal
        $("#carsModal").modal("show");
    });

    /**
     * Action when clicking on the edit button
     */
    $(document).on("click", ".edit-button", function()
    {
        // Get the car ID
        var id = $(this).data("car-id");

        // Populate the carId value in the edit form field
        $("#car-id").val(id);

        // Pre-populate the modal
        populateModal(id);

        // Modify the modal before display
        $("#carsModalLabel").html("Modifier une voiture");
        $("#save-button").html("Modifier");

        // Open the modal
        $("#carsModal").modal("show");
    });

    /**
     * Action when clicking on the submit button
     */
    $("#cars-form").submit(function(event) 
    {
        // Prevents the form from submitting normally
        event.preventDefault();
        
        // Get the data from the form
        var data = $(this).serialize();

        // Get the car ID (if available)
        var id = $("#car-id").val();

        // If the id exists...
        if(id) 
        {
            updateCar(data);
        } 
        else 
        {
            createCar(data);
        }
    });

    /**
     * Action when clicking on the delete button
     */
    $(document).on("click", ".delete-button", function()
    {
        // Get the car ID
        var id = $(this).data("car-id");

        // Open the delete modal
        $("#deleteModal").modal("show");

        // On confirmation of the delete
        $(document).on("click", "#confirmDelete", function()
        {
            // Close the delete modal
            $("#deleteModal").modal("hide");

            // Delete the car
            deleteCar(id);
        });

    });

    /**
     * Create an alert to display
     */
    function alertTrigger(type, message)
    {
        // Generates the display
        $("#liveAlert").html(
            '<div class="alert alert-'+ type +' alert-dismissible" role="alert"><div>'+ message +'</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        );

        // Close the alert after a delay
        setTimeout(function() {
            $(".alert").fadeTo(300, 0).slideUp(300, function(){
                $(this).remove();
            });
        }, 3000);
    }

    /**
     * Load the car table
     */
    function loadCarsTable() 
    {
        $.ajax(
        {
            url: "showCars",
            method: "POST",
            success: function(response) 
            {
                // Display the list cars
                $("#cars-table tbody").html(response);
            },
            error: function(xhr, status, error) 
            {
                // Display an error if the AJAX request fails
                alertTrigger("danger","Erreur lors de l'affichage des voitures : " + error);
            }
        });
    }

    /**
     * Populate the modal with a car
     *
     * @param {number} id The car ID to show
     */
    function populateModal(id)
    {
        $.ajax(
        {
            url: "getCar",
            method: "POST",
            data: {carId: id},
            dataType: "json",
            success: function(response) 
            {
                // Pre-populate the form with the car's data
                $.each(response, function(index, element) {
                    $("#cars-form #marque").val(element.marque);
                    $("#cars-form #modele").val(element.modele);
                    $("#cars-form #immatriculation").val(element.immatriculation);
                    $("#cars-form #carburant").val(element.carburant);
                    $("#cars-form #prix").val(element.prix);
                    $("#cars-form #type_vente").val(element.type_vente);
                    $("#cars-form #reserve").prop('checked', element.reserve);
                });
            },
            error: function(xhr, status, error) 
            {
                // Display an error if the AJAX request fails
                alertTrigger("danger","Erreur lors de l'affichage des voitures : " + error);
            }
        });
    }

    /**
     * Create a car
     *
     * @param {array} data The car data
     */
    function createCar(data)
    {
        $.ajax(
        {
            url: "createCar",
            method: "POST",
            data: data,
            success: function(response) 
            {
                // Close the modal
                $("#carsModal").modal("hide");

                // Reset the form
                $("#cars-form")[0].reset();

                // Display a success if the AJAX request worked
                alertTrigger("success","La voiture a été ajoutée avec succès !");
                        
                // Load the update car table
                loadCarsTable();
            },
            error: function(xhr, status, error) 
            {
                // Close the modal
                $("#carsModal").modal("hide");

                // Display an error if the AJAX request fails
                alertTrigger("danger","Erreur lors de l'ajout de la voiture : " + error);
            }
        });
    }

    /**
     * Update a car
     *
     * @param {array} data The car data
     */
    function updateCar(data)
    {
        $.ajax(
        {
            url: "updateCar",
            method: "POST",
            data: data,
            success: function(response) 
            {
                // Close the modal
                $("#carsModal").modal("hide");

                // Reset the form
                $("#cars-form")[0].reset();

                // Display a success if the AJAX request worked
                alertTrigger("success","La voiture a été modifiée avec succès !");

                // Load the update car table
                loadCarsTable();
            },
            error: function(xhr, status, error) 
            {
                // Close the modal
                $("#carsModal").modal("hide");

                // Display an error if the AJAX request fails
                alertTrigger("danger","Erreur lors de la modification de la voiture : " + error);
            }
        });
    }    

    /**
     * Delete a car
     *
     * @param {number} id The car ID to delete
     */
    function deleteCar(id)
    {
        $.ajax(
            {
                url: "deleteCar",
                method: "POST",
                data: {carId: id},
                success: function(response) 
                {
                    // Display a success if the AJAX request worked
                    alertTrigger("success","La voiture a été supprimée avec succès !");

                    // Load the update car table
                    loadCarsTable();
                },
                error: function(xhr, status, error) 
                {
                    // Display an error if the AJAX request fails
                    alertTrigger("danger","Erreur lors de la suppression de la voiture : " + error);
                }
            });
    }
});
