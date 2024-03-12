<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Student") {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Article</title>
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include_once './components/navbar.php';?>
    <div class="container">

        <div class="col-12">
            <h2 class="text-center mt-4 mb-4"><i class="fa-solid fa-book"></i>  <span style="color: #38b000">Articles</span></h2>
            <?php
            include_once './data/fetchArticles.php';
            $articles = fetchArticles();
            foreach($articles as $article){
                echo'
                <div class="row-6 p-3 border border-dark rounded mt-2">
                <div class="d-flex justify-content-between">
                    <p class="text-secondary">'.$article['Added'].'</p>
                </div>
                <p><strong>By </strong>'.$article['Name'].'</p>
                <h3 class="text">'.$article['Title'].'</h3>
                <p>'.$article['Content'].'</p>
                <input type="hidden" id="id" name="id" value='.$article['ArticleID'].'>
            </div>
                ';
            }
            ?>
        </div>
        <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this article?
        </div>
        <div class="modal-footer">
            <!-- Delete Confirmation Button -->
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
    </div>

   </div>
   <script>
    function loadmodal(id){
        $("#confirmDeleteModal").modal('show');
        $('#confirmDeleteBtn').on('click', function() {
            // Perform AJAX GET request to delete the article
            $.ajax({
                type: "GET",
                url: "/deleteArticle?id=" + id,
                success: function(response) {
                    // Handle success
                    location.reload(); // Reload the page to update the list
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert("Failed to delete the article.");
                }
            });

            // Close the modal
            $('#confirmDeleteModal').modal('hide');
        });
    }

   </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>