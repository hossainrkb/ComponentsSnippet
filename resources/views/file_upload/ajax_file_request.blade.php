<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax file request</title>
</head>

<body>
    <div>
        <input type="file" id="file_upload" name="file_upload" onchange="setRenameField(this)">
    </div>
    <div id="setRenameField"></div>
    <div>
        <button title="Add" onclick="fileUploadSubmit(this)">
            Upload
        </button>
    </div>

    <script>
        const BASE_URL = 'http://127.0.0.1:8000/';

        function setRenameField(input) {
            var setRenameField = document.querySelector(
                "#setRenameField"
            );
            setRenameField.innerHTML = "";
            var div = document.createElement("div");
            var input_text = document.createElement("input");
            input_text.setAttribute("placeholder", "Rename file");
            input_text.setAttribute("id", "renameFieldInfo");
            div.append(input_text);
            setRenameField.append(div);
        }

        var sendHttpRequestFile = (method, url, data) => {
            console.log(data)
            return fetch(url, {
                method: method,
                body: data,
                headers: data ?
                    {
                        Accept: "application/json"
                    } :
                    {},
            }).then((response) => {
                if (response.status >= 400) {
                    // !response.ok
                    return response.json().then((errResData) => {
                        var error = new Error("Something went wrong!");
                        error.data = errResData;
                        throw error;
                    });
                }
                return response.json();
            });
        };

        function fileUploadSubmit(input) {
            var file_upload = document.getElementById("file_upload");
            var renameFileName = document.getElementById("renameFieldInfo");
            if (file_upload.files[0] == undefined) {
                alert("You didn't select File");
                return;
            }
            var fd = new FormData();
            fd.append("attached_file", file_upload.files[0]);
            fd.append("attached_file_name", renameFileName.value);
            fd.append("_token", "{{ csrf_token() }}");

            sendHttpRequestFile(
                    "POST",
                    BASE_URL +
                    `add-file-to-server`, fd
                )
                .then((responseData) => {
                    console.log(responseData);
                })
                .catch((err) => {
                    console.log(err, err.data);
                });
        }

    </script>
</body>

</html>
