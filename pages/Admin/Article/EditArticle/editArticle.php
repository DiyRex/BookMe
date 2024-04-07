<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Admin") {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }

        .container {
            flex: 1; 
        }
    </style>
</head>

<body>
<?php include_once './components/navbar.php';

    require_once './data/fetchArticles.php';
    if(isset($_GET['id'])){
        $article = fetchArticleByID($_GET['id']);
        $title = $article['Title'];
        $body = $article['Content'];
        $authorID = $article['AuthorID'];
    }
    ?>
<div class="container mt-5">
        <div id="successAlert" class="alert alert-success" role="alert" style="display: none;">
        Published successfully!
        </div>
        <h2 class="mb-4">Edit Article</h2>
        <form id="articleform" method="POST">
            <input type="hidden" id="author_id" value=<?=$authorID?>>
            <input type="hidden" id="article_id" value=<?=$_GET['id']?>>
            <!-- Article Title -->
            <div class="form-group row">
                <label for="articleTitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="art_title" id="articleTitle" placeholder="Article Title" value=<?=$title?> required>
                </div>
            </div>

            <!-- Article Body -->
            <div class="form-group row">
                <label for="articleBody" class="col-sm-2 col-form-label">Body</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="articleBody" name="art_body" rows="5" placeholder="Article Body" required><?=$body?></textarea>
                </div>
            </div>

            <!-- Trigger Modal Button -->
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" data-toggle="modal" data-target="#articleModal" class="btn text-white" style="background-color: #004B23;">Update Article</button>
                    <a href="/explore?action=article" type="button" class="btn btn-secondary text-white">Back to Articles</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="articleModalLabel">Edit Article</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        Do you want to edit the article ?
        </div>
        <div class="modal-footer">
            <button id="confirmButton" type="button" class="btn text-white" style="background-color: #004B23;" form="articleform" onclick="submitArticle()">Confirm</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    <div class="mt-5">
        <?php include_once './components/footer.php';?>
    </div>
    <script>
    function submitArticle() {
        var formData = {
            art_id: $("#article_id").val(),
            art_title: $("#articleTitle").val(),
            art_body: $("#articleBody").val(),
            art_author: $("#author_id").val()
        };


        $.ajax({
            type: "POST",
            url: "/editArticle", 
            data: formData,
            success: function(response) {
       
                console.log("Response from server: ", response);
                $("#successAlert").text("Published successfully!").show().delay(5000).fadeOut();
            },
            error: function(xhr, status, error) {
     
                console.error("Error occurred: ", status, error);
       
                $("#successAlert").addClass('alert-danger').text("Failed to publish!").show().delay(5000).fadeOut();
            }
        });
        
        $("#articleModal").modal('hide'); 
        $("#successAlert").show().delay(5000).fadeOut(); 
        
    }
    </script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>