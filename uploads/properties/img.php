<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./pages/Landlord/Editproperty/editProperty.css">
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Image Preview and Deletion</title>
    <style>
        .images-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .image-container {
            position: relative;
            display: inline-block;
        }
        .property-image {
            width: 100px; /* Adjust based on your preference */
            height: 100px; /* Adjust based on your preference */
            object-fit: cover;
        }
        .close-image-btn {
            position: absolute;
            top: 0;
            right: 0;
            border: none;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include_once './components/navbar.php';?>
<div class="container d-flex flex-column align-items-center justify-content-center">
    <h1 class="text-center title"><i class="fa-solid fa-house" style="color: #38B000;"></i> Edit <span style="color: #38b000">Property</span></h1>
    <div class="box col-10 col-md-6 text-white">
        <form action="/edit" method="POST">
            <input type="hidden" name="property_id" value="<?=$_GET['id']?>">
            <div class="form-group">
                <label for="titleInput">Title</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-signature" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="titleInput" name="title" placeholder="Title" value="<?=$title?>">
                </div>
            </div>
            <div class="form-group">
                <label for="descriptionInput">Description</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-file-lines" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="descriptionInput" name="description" placeholder="Description" value="<?=$description?>">
                </div>
            </div>
            <div class="form-group">
                <label for="addressInput">Address</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-location-dot" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="addressInput" name="address" placeholder="Address" value="<?=$address?>">
                </div>
            </div>
            <!-- Location Section -->
            <div class="form-group">
                <label for="locationInput">Location</label>
                <div id="map" class="map-section"></div>
                <input type="hidden" id="advCoordinates" name="coordinates" value="<?=$coordinates?>">
            </div>
            <div class="form-group">
                <label for="bedCountInput">Bed Count</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-bed" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="bedCountInput" name="bedCount" placeholder="Bed Count" value="<?=$bedCount?>">
                </div>
            </div>
            <div class="form-group">
                <label for="studentCountInput">Student Count</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-person" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="studentCountInput" name="stdCount" placeholder="Student Count" value="<?=$stdCount?>">
                </div>
            </div>
            <div class="form-group">
                <label for="keymoneyInput">Keymoney</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-rupee-sign" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="keymoneyInput" name="keymoney" placeholder="Keymoney" value="<?=$keymoney?>">
                </div>
            </div>
            <div class="form-group">
                <label for="rentInput">Rent</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-rupee-sign" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="rentInput" name="rent" placeholder="Rent" value="<?=$rent?>">
                </div>
            </div>
            <!-- Image Upload Section -->
            <div class="form-group">
                <label for="imageUpload">Images</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-images" style="color: #38B000;"></i></div>
                    </div>
                    <input type="file" class="form-control image-choose" id="imageUpload" multiple>
                </div>
            </div>
            <div class="images-row">
    <!-- Example images (replace these paths with your actual image paths) -->
    <div class="image-container">
        <img src="https://via.placeholder.com/100" alt="Property Image" class="property-image"/>
        <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
    </div>
    <div class="image-container">
        <img src="https://via.placeholder.com/100" alt="Property Image" class="property-image"/>
        <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
    </div>
    <div class="image-container">
        <img src="https://via.placeholder.com/100" alt="Property Image" class="property-image"/>
        <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
    </div>
    <!-- Add more images as needed -->
</div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn-publish">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="images-row">
    <!-- Example images (replace these paths with your actual image paths) -->
    <div class="image-container">
        <img src="https://via.placeholder.com/100" alt="Property Image" class="property-image"/>
        <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
    </div>
    <div class="image-container">
        <img src="https://via.placeholder.com/100" alt="Property Image" class="property-image"/>
        <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
    </div>
    <div class="image-container">
        <img src="https://via.placeholder.com/100" alt="Property Image" class="property-image"/>
        <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
    </div>
    <!-- Add more images as needed -->
</div>

<script>
    function removeImage(button) {
        // Remove the parent .image-container of the clicked button
        button.closest('.image-container').remove();
        
        // TODO: Here, you would also send an AJAX request to your server to delete the image file
        // and its database entry based on its path or a unique identifier.
    }
</script>

</body>
</html>
