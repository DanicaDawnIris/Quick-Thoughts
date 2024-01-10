<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Quick Thoughts</title>
</head>

<body>

    <?php include 'header.php'; ?>

    <div id="thoughtsForm" class="main-container">
        <form id="thoughtsInputForm" method="post" action="process_form.php">
            <label for="thoughtsInput" class="label">Your Thoughts?</label>
            <textarea id="thoughtsInput" name="thoughtsInput" class="main-input-field"></textarea>
            <button type="submit" id="submitThought" class="button add-btn">Add Thoughts</button>
        </form>

        <div id="thoughtsListContainer">
            <ul id="thoughtsList" class="list">
                <!-- thoughts list -->
            </ul>
        </div>
    </div>

    <script>
        // function to update thoughts
        function updateThoughts(textSpan, thoughtsElement) {
            var updatedText = prompt('Update your thoughts:', textSpan.textContent.trim());
            if (updatedText !== null) {

                // update thoughts in database
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_thoughts.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {

                            // handle response
                            console.log(xhr.responseText);

                            // update content on page
                            textSpan.textContent = updatedText;
                        } else {
                            console.error('Error updating thoughts:', xhr.statusText);
                        }
                    }
                };
                xhr.send('thoughtText=' + encodeURIComponent(textSpan.textContent.trim()) + '&updatedText=' + encodeURIComponent(updatedText));
            }
        }

        // function to delete thoughts
        function deleteThoughts(thoughtsElement) {
            if (confirm('Are you sure you want to delete this thought?')) {
                var xhr = new XMLHttpRequest();
                var formData = new FormData();
                formData.append('thoughtText', thoughtsElement.querySelector('span').textContent.trim());

                xhr.open('POST', 'delete_thoughts.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // handle response
                            console.log(xhr.responseText);

                            // check if deletion was successful
                            if (xhr.responseText.includes('deleted successfully')) {
                                thoughtsElement.remove();

                                // reload thoughts
                                fetchThoughts();
                            } else {
                                console.error('Error deleting thought:', xhr.responseText);
                            }
                        } else {
                            console.error('Error deleting thoughts:', xhr.statusText);
                        }
                    }
                };
                xhr.send(formData);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('thoughtsInputForm').addEventListener('submit', function (event) {
                event.preventDefault();
                postThoughts();
            });

            function postThoughts() {
                var thoughtsInput = document.getElementById('thoughtsInput');
                var thoughtsList = document.getElementById('thoughtsList');

                if (thoughtsInput.value.trim() !== '') {

                    // submit data
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'process_form.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4) {
                            if (xhr.status == 200) {

                                // handle response
                                console.log(xhr.responseText);

                                // reload thoughts 
                                fetchThoughts(); // reload after adding new
                                thoughtsInput.value = ''; // clear input field
                            } else {
                                console.error('Error adding thoughts:', xhr.statusText);
                            }
                        }
                    };
                    xhr.send('thoughtsInput=' + encodeURIComponent(thoughtsInput.value));
                }
            }

            // function to fetch thoughts
            function fetchThoughts() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_thoughts.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {

                            // update thoughts list with fetched data
                            thoughtsList.innerHTML = xhr.responseText;
                        } else {
                            console.error('Error fetching thoughts:', xhr.statusText);
                        }
                    }
                };
                xhr.send();
            }

            fetchThoughts();

        });
    </script>
</body>

</html>
