<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Simple Web Contact Form</title>
        
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        
        <!-- Wysiwyg Editor -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    </head>
    <body>
        <div id="container">

        </div>
        <form id="form" class="col-6 position-absolute start-50 top-50 translate-middle" action="submit.php" method="post" novalidate>
            <div class="mb-2">
                <label class="mb-1" for="name">User's name</label>
                <input class="form-control" type="text" name="name" id="name" aria-describedby="nameFeedback" required>
                <div id="nameFeedback" class="invalid-feedback"></div>
            </div>
            <div class="mb-2">
                <label class="mb-1" for="email">User's email</label>
                <input class="form-control" type="email" name="email" id="email" aria-describedby="emailFeedback" required>
                <div id="emailFeedback" class="invalid-feedback"></div>
            </div>  
            <div class="mb-2">
                <label class="mb-1" for="issue">User's issue</label>
                <select class="form-select" name="issue" id="issue" aria-describedby="issueFeedback" required>
                    <option disabled></option>
                    <option value="query">Query</option>
                    <option value="feedback">Feedback</option>
                    <option value="complaint">Complaint</option>
                    <option value="other">Other</option>
                </select>
                <div id="issueFeedback" class="invalid-feedback"></div>
            </div>
            <div class="mb-2">
                <input id="x" class="input" value="Editor content goes here" type="hidden" name="content">
                <trix-editor input="x"></trix-editor>
            </div>
            <button id="btn" class="btn btn-primary mt-3" type="submit">Submit</button>
        </form>
        <script>
            form.onsubmit = async (e) => {
                e.preventDefault()

                let response = await fetch("submit.php", {
                    method: "post",
                    body: new FormData(e.target)
                })    

                let result = await response.json()

                let keys = Object.keys(result)
                keys.forEach(key => {
                    let el = document.getElementById(key)
                    if(el) {
                        if(result[key] === "") {
                            if(el.classList.contains("is-valid")) {
                                el.classList.remove("is-valid")
                            }

                            el.classList.add("is-invalid")
                            el.nextElementSibling.textContent = `Enter a valid ${key}`
                        } else {
                            if(el.classList.contains("is-invalid")) {
                                el.classList.remove("is-invalid")
                            }

                            el.classList.add("is-valid")
                            el.nextElementSibling.textContent = ""
                        }
                    }
                })
            }
        </script>
    </body>
</html>